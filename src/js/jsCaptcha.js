$(document).ready(function () {
  var canva = document.getElementById("captcha");
  var dibujar = canva.getContext("2d");
  var myFont = new FontFace("NeoPrint M319", "url(/fonts/NeoPrintM319.otf)");

  myFont.load().then(function (font) {
    // with canvas, if this is ommited won't work
    document.fonts.add(font);
    canva.width = canva.width;
    dibujar.fillStyle = "green";
    dibujar.font = "20pt NeoPrint M319";
    //Reccarga al hacer clik en el
    //boton par generar nuevo clave
    $("#refreshCaptcha").click(function (event) {
      CargarCaptcha();
    });
    CargarCaptcha();
    console.log("Font loaded");
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
        canva.width = canva.width;
        dibujar.fillStyle = "green";
        dibujar.font = "20pt NeoPrint M319";
        dibujar.fillStyle = "green";
        dibujar.fillText(visto.retornar, 6, 39);

        //Dibujamos en el CANVA las claves
        //devueltas por el servidor

        //console.log(data);
      })
      .fail(function () {
        //console.log("error");
      })
      .always(function () {
        //console.log("complete");
      });
  }
});
