$(document).ready(function () {
  //Reccarga al hacer clik en el
  //boton par generar nuevo clave
  $("#refreshCaptcha").click(function (event) {
    CargarCaptcha();
  });

  CargarCaptcha();
});

/**
  Realiza la peticion AJAX
  al servidor para generar clave
 */
function CargarCaptcha() {
  $.ajax({
    url: "Captcha.php",
    type: "post",
    dataType: "text",
    data: { capt: "visto" },
  })
    .done(function (data) {
      // alert(data);
      var visto = $.parseJSON(data);
      //Dibujamos en el CANVA las claves
      //devueltas por el servidor
      var canva = document.getElementById("capatcha");
      var dibujar = canva.getContext("2d");
      canva.width = canva.width;
      dibujar.fillStyle = "green";
      dibujar.font = '20pt "NeoPrint M319"';
      dibujar.fillText(visto.retornar, 6, 39);
      //console.log(data);
    })
    .fail(function () {
      //console.log("error");
    })
    .always(function () {
      //console.log("complete");
    });
}
