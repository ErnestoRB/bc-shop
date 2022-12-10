$(document).ready(() => {
  const jForm = $("#orden-form");
  const form = jForm[0];
  let submitting = false;

  jForm.submit((evt) => {
    evt.preventDefault();
    if (submitting) {
      swal("Ya se esta creando tu orden");
      return;
    }
    const envio = form.elements.envio.value;
    const politicas = form.elements.politicas.checked;
    const pago = form.elements.pago.value;
    console.log(envio, politicas, pago);
    if (!politicas) {
      swal("Falta aceptar las políticas!", "", "error");
      return;
    }
    if (!envio) {
      swal("Falta escoger metodo de envio!", "", "error");
      return;
    }
    if (!pago) {
      swal("Falta escoger metodo de pago", "", "error");
      return;
    }
    submitting = true;
    swal("Creando tu orden...");
    $.ajax("/api/crear_orden.php", {
      method: "POST",
      data: JSON.stringify({ envio, politicas, pago }),
      contentType: "application/json",
    })
      .done((data, status) => {
        const json = JSON.parse(data);
        if (json.link) {
          swal("Orden hecha!", "", "success").then((value) =>
            window.location.assign(json.link)
          );
        }
      })
      .always(() => (submitting = false));
  });

  $("[name='envio']").change(function () {
    const value = this.dataset.costo;
    $("#costoEnvio").text("$" + value);
    console.log(subtotal);
    $("#total").text("$" + (Number(subtotal) + Number(value)));
  });
});
