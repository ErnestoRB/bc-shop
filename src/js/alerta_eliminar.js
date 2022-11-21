document.addEventListener("DOMContentLoaded", () => {
  const elements = document.querySelectorAll("[data-eliminar-producto]");
  elements.forEach((element) => {
    element.addEventListener("click", async () => {
      const id = element.dataset.eliminarProducto;
      const value = await window.swal({
        icon: "warning",
        title: "Estás seguro de eliminar el producto con id: '" + id + "'",
        buttons: {
          si: { text: "Si", value: true },
          no: { text: "No", value: false },
        },
      });
      if (value) {
        location.replace("/deleteArticulo?id=" + id);
      }
    });
  });
});
