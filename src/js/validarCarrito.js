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
      const tableContainer = $(`<div class="table-responsive">`);
      const tableResponsive = $(
        `<table class="table table-bordered table-hover table-striped table-light">`
      );
      tableContainer.append(tableResponsive);
      const header = $(`<tr><td>
        Articulo
    </td>
    <td >
        Precio
    </td>
    <td >
        Cantidad
    </td>
    <td>
        <b>Precio total</b>
    </td>
    <td>
        <b>Acciones</b>
    </td></tr>`);

      tableResponsive.append(header);
      container.append(tableContainer);
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
        const item = $("<tr>").html(`
                    <td>
                        <img src="/static/${
                          articulo.imagen
                        }" class="img-product-sm" alt="...">
                    </td>
                    <td >
                        <div class="">${
                          esDeOferta
                            ? `<p class="text-decoration-line-through text-danger">$${articulo.precio}</p>`
                            : ""
                        }        $${articulo.precioOferta}</div>
                    </td>
                    <td >
                        <input disabled type="number" value="${
                          articulo.cantidad
                        }" style="width: 60px;">
                    </td>
                    <td>
                        <div> <b>$${
                          articulo.cantidad * articulo.precioOferta
                        }</b></div>

                    </td>
                    <td>
                        <div data-delete-container>
                        </div>
                    </td>`);
        item.find("[data-delete-container]").append(deleteButton);
        tableResponsive.append(item);
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
