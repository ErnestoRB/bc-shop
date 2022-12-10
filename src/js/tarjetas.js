$(document).ready(() => {
  function getProducts(categoria) {
    const contenedor = $("#contprod");
    contenedor.empty();
    $.get("/api/productos.php", function (data, status) {
      const obj = JSON.parse(data);
      console.log(obj);
      obj.forEach((articulo) => {
        let esDeOferta = articulo.oferta;
        const agotado = articulo.existencia == 0;
        let titulo = $(`
        <div class="card col col-sm-6 col-md-3">
        <img height="256" height "256" src="/static/${
          articulo.imagen
        }" class="img-product card-img-top img efecto3" alt="imagen de ${
          articulo.nombre
        }">
        <div class="card-body">
            <h5 class="card-title"> ${articulo.nombre} ${
          esDeOferta
            ? '<span class="badge text-bg-danger">Oferta (-10%)!</span>'
            : ""
        } </h5>
            ${
              agotado
                ? "<b> Agotado </b>"
                : `<p>Existencias: ${articulo.existencia}</p>`
            }
            <p>
                <span class="' . ${
                  esDeOferta ? "text-decoration-line-through text-danger" : ""
                } . '" >$ ${articulo.precio}</span>
                <span> ${esDeOferta ? "$" + articulo.precio * 0.9 : ""}</span>
            </p>
            ${
              !agotado
                ? `<form data-cart-form>
            <input type="hidden" name="id" value="${articulo.idProducto}" />
            <input type="number" class="form-control" name="cantidad" step="" min="1" max="${articulo.existencia}" value="1" />
            <button type="submit" class="btn btn-primary"><i class="bi bi-cart-plus-fill"></i></button>
        </form>`
                : ""
            }
        </div>
    </div>    
        `);
        contenedor.append(titulo);
      });
      window.carrito.loadForms();
    });
  }

  getProducts();
});
