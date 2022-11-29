window.carrito = (function () {
  let cart = []; // { id, cantidad }

  window.addEventListener("DOMContentLoaded", () => {
    const storedCart = window.localStorage.getItem("cart");
    if (storedCart) {
      cart = JSON.parse(storedCart);
    }

    const carritoButton = document.getElementById("carrito");
    carritoButton.addEventListener("click", async (evt) => {
      evt.preventDefault();
      const results = await window.carrito.getProductsData();
      const wrapper = document.createElement("div");
      wrapper.classList.add("container");
      const element = document.createElement("table");
      let total = 0;
      element.classList.add("table", "table-dark", "table-stripped");
      if (results.length > 0) {
        wrapper.innerHTML += `<b>Hay ${results.length} artículo(s) en el carrito</b>`;
        element.innerHTML += `<thead><tr>
        <th>Imagen</th>
        <th>Articulo</th>
        <th>Precio unitario</th>
        <th>Cantidad</th>
        <th>Total $</th>
        </tr></thead>`;
        results.forEach((item) => {
          total += item.precio * item.cantidad;
          element.innerHTML += `<tr>
        <td><img src="/static/${item.imagen}" width="64"></td>
        <td>${item.nombre}</td>
        <td>$${item.precio}</td>
        <td>${item.cantidad}</td>
        <td>$${item.precio * item.cantidad}</td>
        </tr>`;
        });
        element.innerHTML += `<tr>
        <td colspan="4"></td>
        <td>Total: $${total}</td>
        </tr>`;
        wrapper.append(element);
        wrapper.innerHTML += `<div class="d-flex justify-content-end">
        <button class="btn btn-danger" onclick="window.carrito.clearCart(); location.reload()">Limpiar carrito</button>
        <a class="btn btn-primary" href="carrito.php">Ir al carrito</a>
        </div>`;
      } else {
        wrapper.innerHTML += `<b>No has agregado ningun artículo a el carrito</b>`;
      }
      swal({
        title: "Previsualización de carrito",
        content: wrapper,
        buttons: false,
      });
    });
    const cartNumber = document.getElementById("cartNumber");
    const buttons = document.querySelectorAll("[data-cart-id]");
    if (!!cartNumber) {
      cartNumber.textContent = cart.length;
    }

    buttons.forEach((button) => {
      button.addEventListener("click", async () => {
        const productId = button.dataset.cartId;
        const added = window.carrito.addToCart(productId, 1);
        const productData = await getProductData(productId);
        if (added) {
          const element = document.createElement("div");
          element.classList.add("container");
          element.innerHTML = `<div class="row py-4">
          <div class="col"><img class="img-product-sm" src="/static/${productData.imagen}"></div>
          <div class="d-flex flex-column col">
            <h4 class="text-info">${productData.nombre}</h4>
            <div>$${productData.cantidad}</div>
            <div>Cantidad: <b>${productData.cantidad}</b></div>
          </div>
          </div>`;
          swal({
            title: `Producto agregado al carrito!`,
            content: element,
            icon: "success",
          });
        } else {
          const response = await swal({
            title: `El producto ${productData.nombre} ya estaba agregado al carrito!`,
            text: "¿Deseas continuar?",
            icon: "warning",
            buttons: ["Olvidalo", "Entiendo, agregar"],
          });
          if (response == true) {
            window.carrito.addCantidad(productId, 1);
          }
        }
      });
    });
  });

  window.addEventListener("beforeunload", () => {
    window.localStorage.setItem("cart", JSON.stringify(cart));
  });

  return {
    addToCart: function (id, cantidad) {
      if (!!cartNumber) {
        cartNumber.textContent = cart.length;
      }
      const found = this.isOnCart(id);
      if (!found) {
        cart.push({ id, cantidad });
      }
      return !found;
    },
    addCantidad: function (id, cantidad) {
      const found = this.isOnCart(id);
      if (found) {
        found.cantidad += cantidad;
      }
      return !!found;
    },
    isOnCart: function (id) {
      return cart.find((item) => item.id === id);
    },
    removeFromCart: function (id) {
      const i = cart.findIndex((item) => item.id === id);
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
    async getProductsData() {
      return (
        await Promise.all(
          cart.map((item) => {
            return getProductData(item.id, item.cantidad);
          })
        )
      ).filter((item) => item != undefined);
    },
  };
})();

function getProductData(id, cantidad = 1) {
  return fetch("/api/producto.php?id=" + id).then(async (res) => {
    if (res.ok) {
      const json = await res.json();
      json.cantidad = cantidad;
      return json;
    } else {
      return undefined;
    }
  });
}
