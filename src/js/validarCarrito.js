$(document).ready(function () {
  const container = $("#card-body");
  const summary = $("#summary");

  if (window.carrito.cart?.length === 0) {
    setTimeout(() => {
      validarCarrito();
    }, 1000);
  }

  function validarCarrito() {
    fetch("/api/validar_carrito.php", {
      method: "POST",
      body: JSON.stringify(window.carrito.cart),
      headers: { "Content-Type": "application/json" },
    }).then(async (res) => {
      container.empty();
      summary.empty();
      const json = await res.json();

      if (!res.ok) {
        container.append("No hay elementos en el carrito");
        summary.append(
          "<p>Agrega mercancía <a href='articulos.php'>aquí</a></p>"
        );
        return;
      }
      json.carrito?.forEach((articulo) => {
        articulo.precioOferta = articulo.precio;
        const esDeOferta = articulo.oferta;
        if (esDeOferta) {
          articulo.precioOferta *= 0.9;
        }
        const deleteButton = $(
          '<button class="btn btn-danger bi bi-trash"></button>'
        );
        deleteButton.click(() => {
          window.carrito.removeFromCart(articulo.idProducto);
          validarCarrito();
        });
        const item = $('<div class="row px-0 mx-0">').html(`
                    <div class="col-sm-3 col-6">
                        <img src="/static/${
                          articulo.imagen
                        }" class="card-img-top" alt="...">
                    </div>
                    <div class="col-sm-4 ps-2 col-6 py-2">
                        <div class="">${
                          esDeOferta
                            ? `<p class="text-decoration-line-through text-danger">$${articulo.precio}</p>`
                            : ""
                        }        $${articulo.precioOferta}</div>
                    </div>
                    <div class="col-sm-2 ps-2 col-6 py-2">
                        <input disabled type="number" value="${
                          articulo.cantidad
                        }" style="width: 60px;">
                    </div>
                    <div class="col-sm-3 col-6 p-2 d-flex justify-content-between">
                        <div> <b>$${
                          articulo.cantidad * articulo.precioOferta
                        }</b></div>
                        <div data-delete-container>
                        </div>
                    </div>`);
        item.find("[data-delete-container]").append(deleteButton);
        container.append(item);
        console.log(item);
      });
      const total = json.carrito?.reduce((acum, articulo) => {
        return (acum += articulo.precioOferta * articulo.cantidad);
      }, 0);

      const pagarButton = $(
        '<button class="btn btn-info w-100"> IR A CREAR ORDEN</button>'
      );

      summary.append(
        $(`
          <div class="row">
                    <div class="col">
                        <span>${json.carrito?.length || 0} articulo(s)</span>
                    </div>
                    <div class="col">
                        <b>$${total}</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <span>Envio</span>
                    </div>
                    <div class="col">
                        <b>A determinar en la siguiente fase</b>
                    </div>
                </div>
                <hr>
                <small class="mt-4">
                  Impuestos incluidos (16%): <small class="fw-bold">$${(
                    total * 0.16
                  ).toFixed(2)}</small>
                </small>
                <div class="d-flex justify-content-between">
                    <div>
                        <b>Total (IVA incluido)</b>
                    </div>
                    <div>
                        <b>$${(total * 1.16).toFixed(2)} + envío</b>
                    </div>
                </div>

                <div class="d-flex flex-column justify-content-center mt-2">
                    <span class="block text-decoration-none text-info">Usa un código de descuento</span>
                    <input type="text" id="codigo" class="form-control"/>
                    <small>Se aplicarán en la siguiente pantalla</span>
                </div>
                <div data-comprar-button class="mt-4">
                    
                </div>`)
      );
      summary.find("[data-comprar-button]").append(pagarButton);

      pagarButton.click(() => {
        const cupon = $("#codigo")[0].value;
        crearOrden({ articulos: json.carrito, cupones: [cupon] });
      });
    });

    function crearOrden(data) {
      if (!data) return;
      fetch("/api/pre_orden.php", {
        method: "POST",
        credentials: "include",
        body: JSON.stringify(data),
        headers: { "Content-Type": "application/json" },
      }).then(async (res) => {
        const json = await res.json();
        if (res.ok) {
          window.carrito.clearCart();
          window.location.assign("/crearorden.php");
        } else {
          swal("Error al crear la orden: " + json.message);
        }
      });
    }
  }
});
