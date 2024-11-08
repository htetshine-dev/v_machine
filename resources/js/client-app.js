import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function addToCart(productId) {
    // For now, just alerting the product id (This should be connected to your backend logic)
    alert("Product ID " + productId + " added to the cart!");
}
