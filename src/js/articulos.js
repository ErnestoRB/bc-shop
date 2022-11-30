$(document).ready(() => {
  function getProducts() {
    const contenedor = $("#contenedorProductos");
    contenedor.empty();
    $.get(
      "http://localhost:9999/api/productos.php?categoria=1",
      function (data, status) {
        const obj = JSON.parse(data);
        console.log(obj);
        obj.forEach((articulo) => {
          let esDeOferta = true;
          let titulo = $("<div>").html(`
        <div class="card col-3" style="width: 18rem;">
        <img height="256" height "256" src="/static/${
          articulo.imagen
        }" class="img-product card-img-top img efecto3" alt="imagen de ${
            articulo.nombre
          }">
        <div class="card-body">
            <h5 class="card-title"> ${articulo.nombre} ${
            esDeOferta
              ? '<span class="badge text-bg-danger">Oferta!</span>'
              : ""
          } </h5>
            <p class="card-text">${articulo.descripcion}</p>
            <p>Existencias: ${articulo.existencia}</p>
            <p>
                <span class="' . ${
                  esDeOferta ? "text-decoration-line-through text-danger" : ""
                } . '" >$ ${articulo.precio}</span>
                <span> ${esDeOferta ? articulo.precio * 0.9 : ""}</span>
            </p>
            <form data-cart-form>
                <input type="hidden" name="id" value="${articulo.idProducto}" />
                <input type="number" class="form-control" name="cantidad" step="" min="1" max="${
                  articulo.existencia
                }" value="1" />
                <button type="submit" class="btn btn-primary"><i class="bi bi-cart-plus-fill"></i></button>
            </form>
        </div>
    </div>    
        `);
          contenedor.append(titulo);
          window.carrito.loadForms();
        });
      }
    );
  }

  getProducts();
});
