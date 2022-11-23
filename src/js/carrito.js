window.carrito = (function () {
  let cart = []; // { id, cantidad }

  window.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll("[data-cart-id]");

    buttons.forEach((button) => {
      button.addEventListener("click", () => {
        const productId = button.dataset.cartId;
        cart.push({ id: productId, cantidad: 1 });
        console.log(cart);
      });
    });

    const storedCart = window.localStorage.getItem("cart");
    if (storedCart) {
      cart = JSON.parse(storedCart);
    } else {
    }
  });

  window.addEventListener("beforeunload", () => {
    window.localStorage.setItem("cart", JSON.stringify(cart));
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
