window.carrito = (function () {
  const cart = []; // { id, cantidad }

  window.addEventListener("beforeunload", () => {
    window.localStorage.setItem("cart", this.cart);
  });

  return {
    addToCart: (id, cantidad) => {
      cart.push({ id, cantidad });
    },
    removeFromCart: (id) => {
      const i = cart.findIndex((item) => item.id === id);
      if (i != -1) {
        cart.splice(i, 1);
      }
    },
    clearCart: () => {
      cart.splice(0);
    },
    get cart() {
      return cart;
    },
  };
})();
