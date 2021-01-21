require('./bootstrap');
window.Noty = require('noty');
Noty.overrideDefaults({
    theme: 'bootstrap-v4',
    type: 'warning',
    layout: 'center',
    modal: true,
});

// Make 'vinyl_shop' accessible inside the HTML pages
import VinylShop from "./vinylShop";
window.VinylShop = VinylShop;

// Form fields which are REQUIRED will be shown with red star
$(function(){
    $('[required]').each(function () {
        $(this).closest('.form-group')
               .find('label')
               .append('<sup class="text-danger mx-1">*</sup>');
    });

    $('nav i.fas').addClass('fa-fw mr-1');

    $('body').tooltip({
        selector: '[data-toggle="tooltip"]',
        html : true,
    }).on('click', '[data-toggle="tooltip"]', function () {
        // hide tooltip when you click on it
        $(this).tooltip('hide');
    });
});
