const className = "container";

window.carrito = (function () {
  let cart = []; // { id, cantidad }
  window.addEventListener("DOMContentLoaded", () => {
    const storedCart = window.localStorage.getItem("cart");
    if (storedCart) {
      cart = JSON.parse(storedCart);
    }
    async function generateCarritoWindow() {
      const results = await window.carrito.getProductsData();
      const wrapper = document.createElement("div");
      wrapper.classList.add("container");
      const tableResponsive = document.createElement("div");
      tableResponsive.classList.add("table-responsive");
      const table = document.createElement("table");
      let total = 0;
      table.classList.add("table", "table-dark", "table-stripped");
      if (results.length > 0) {
        wrapper.innerHTML += `<b>Hay ${results.length} artículo(s) en el carrito</b>`;
        table.innerHTML += `<thead><tr>
        <th>Eliminar</th>
        <th>Imagen</th>
        <th>Articulo</th>
        <th>Precio unitario</th>
        <th>Cantidad</th>
        <th>Precio final</th>
        </tr></thead>`;
        results.forEach((item) => {
          item.precioOferta = item.precio;
          const esDeOferta = item.oferta;
          if (esDeOferta) {
            item.precioOferta *= 0.9;
          }
          total += item.precioOferta * item.cantidad;
          table.innerHTML += `<tr>
        <td><button class="btn btn-danger" data-cart-delete="${
          item.idProducto
        }"><i class="bi bi-trash3-fill"></i></button></td>
        <td><img src="/static/${item.imagen}" width="64"></td>
        <td>${item.nombre}</td>
        <td>${
          esDeOferta
            ? `<p class="text-decoration-line-through text-danger">$${item.precio}</p>`
            : ""
        }        $${item.precioOferta}</td>
        <td>${item.cantidad}</td>
        <td>$${item.precioOferta * item.cantidad}</td>
        </tr>`;
        });
        table.innerHTML += `<tr>
        <td colspan="5"></td>
        <td>Subtotal: $${total}</td>
        </tr>`;
        tableResponsive.append(table);
        wrapper.append(tableResponsive);
        wrapper.innerHTML += `<div class="d-flex justify-content-end">
        <button data-cart-clear class="btn btn-danger">Limpiar carrito</button>
        <a class="btn btn-primary" href="/carrito.php">Ir al carrito</a>
        </div>`;
      } else {
        wrapper.innerHTML += `<b>No has agregado ningun artículo a el carrito</b>`;
      }
      swal({
        title: "Previsualización de carrito",
        className,
        content: wrapper,
        buttons: false,
      });
      const deleteButtons = document.querySelectorAll("[data-cart-delete]");
      deleteButtons.forEach((button) => {
        button.addEventListener("click", (evt) => {
          const id = button.dataset.cartDelete;
          window.carrito.removeFromCart(id);
          generateCarritoWindow();
        });
      });
      const clearButtons = document.querySelectorAll("[data-cart-clear]");
      clearButtons.forEach((button) => {
        button.addEventListener("click", (evt) => {
          window.carrito.clearCart();
          generateCarritoWindow();
        });
      });
    }
    const carritoButton = document.getElementById("carrito");
    carritoButton?.addEventListener("click", async (evt) => {
      evt.preventDefault();
      generateCarritoWindow();
    });
    if (!carritoButton) {
      console.warn("No hay ningun botón de carrito en esta pagina");
    }
    const cartNumber = document.getElementById("cartNumber");
    if (!!cartNumber) {
      cartNumber.textContent = cart.length;
    }
  });

  window.addEventListener("beforeunload", () => {
    window.localStorage.setItem("cart", JSON.stringify(cart));
  });

  return {
    addToCart: function (id, cantidad) {
      const found = this.isOnCart(id);
      if (!found) {
        cart.push({ id, cantidad: Number(cantidad) });
      }
      if (!!cartNumber) {
        cartNumber.textContent = cart.length;
      }
      return !found;
    },
    addCantidad: function (id, cantidad) {
      const found = this.isOnCart(id);
      if (found) {
        found.cantidad += Number(cantidad);
      }
      if (!!cartNumber) {
        cartNumber.textContent = cart.length;
      }
      return !!found;
    },
    isOnCart: function (id) {
      return cart.find((item) => item.id == id);
    },
    getCantidad: function (id) {
      const found = cart.find((item) => item.id == id);
      if (!found) {
        return 0;
      }
      return found.cantidad;
    },
    removeFromCart: function (id) {
      const i = cart.findIndex((item) => item.id == id);
      if (i != -1) {
        cart.splice(i, 1);
      }
      if (!!cartNumber) {
        cartNumber.textContent = cart.length;
      }
    },
    clearCart: function () {
      cart.splice(0);
      if (!!cartNumber) {
        cartNumber.textContent = cart.length;
      }
    },
    get cart() {
      return cart;
    },
    getProductData(id, cantidad = 1) {
      return fetch("/api/producto.php?id=" + id).then(async (res) => {
        if (res.ok) {
          const json = await res.json();
          json.cantidad = cantidad;
          return json;
        } else {
          this.removeFromCart(id);
          return undefined;
        }
      });
    },
    loadForms() {
      const forms = document.querySelectorAll("[data-cart-form]");
      forms.forEach((form) => {
        form.addEventListener("submit", async (evt) => {
          evt.preventDefault();
          const cantidad = Number(form.elements.cantidad.value);
          const productId = form.elements.id.value;
          const productData = await this.getProductData(productId);
          const newCantidad = window.carrito.getCantidad(productId) + cantidad;
          console.log(newCantidad);
          if (newCantidad > productData.existencia) {
            swal({
              title: `No es posible agregar ${cantidad} de ese producto!`,
              text: "Intenta agregando menos cantidad ",
              icon: "error",
              buttons: [true],
              className,
            });
            return;
          }
          const added = window.carrito.addToCart(productId, cantidad);
          if (added) {
            const element = document.createElement("div");
            element.classList.add("container");
            element.innerHTML = `<div class="row py-4">
            <div class="col"><img class="img-product-sm" src="/static/${productData.imagen}"></div>
            <div class="d-flex flex-column col">
              <h4 class="text-info">${productData.nombre}</h4>
              <div>$${productData.precio}</div>
              <div>Cantidad: <b>${cantidad}</b></div>
            </div>
            </div>`;
            swal({
              title: `Producto agregado al carrito!`,
              content: element,
              icon: "success",
              className,
            });
          } else {
            const response = await swal({
              title: `El producto ${productData.nombre} ya estaba agregado al carrito!`,
              text: "¿Deseas continuar? Agregarás " + cantidad + " al carrito.",
              icon: "warning",
              buttons: ["Olvidalo", "Entiendo, agregar"],
              className,
            });
            if (response == true) {
              window.carrito.addCantidad(productId, cantidad);
            }
          }
        });
      });
    },
    async getProductsData() {
      return (
        await Promise.all(
          cart.map((item) => {
            return this.getProductData(item.id, item.cantidad);
          })
        )
      ).filter((item) => item != undefined);
    },
  };
})();
