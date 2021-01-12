require('./bootstrap');

// Make 'vinyl_shop' accessible inside the HTML pages
import VinylShop from "./vinylShop";
window.VinylShop = VinylShop;

// Run the hello() function
VinylShop.hello();