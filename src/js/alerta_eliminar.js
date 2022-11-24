document.addEventListener("DOMContentLoaded", () => {
  const elements = document.querySelectorAll("[data-eliminar-producto]");
  elements.forEach((element) => {
    element.addEventListener("click", async () => {
      const id = element.dataset.eliminarProducto;
      const value = await window.swal({
        icon: "warning",
        title: "Estás seguro de eliminar el producto con id: '" + id + "'",
        text: "Esta accion es irreversible",
        buttons: {
          si: { text: "Si", value: true },
          no: { text: "No", value: false },
        },
      });
      if (value) {
        fetch("/api/delete_producto.php?id=" + id, { method: "delete" }).then(
          (res) => {
            if (res.ok) {
              window.swal(
                "Registro eliminado, recarga la página para ver los cambios",
                "",
                "success"
              );
            }
          }
        );
      }
    });
  });
});
