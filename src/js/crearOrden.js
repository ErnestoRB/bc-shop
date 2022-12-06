$(document).ready(() => {
  const jForm = $("#orden-form");
  const form = jForm[0];

  jForm.submit((evt) => {
    evt.preventDefault();
    const envio = form.elements.envio.value;
    const politicas = form.elements.politicas.value;
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
    swal("Orden hecha!", "", "success");
  });

  const envios = $("[name='envio']").change(function () {
    const value = this.dataset.costo;
    console.log(value);
    $("#costoEnvio").text("$" + value);
  });
});
