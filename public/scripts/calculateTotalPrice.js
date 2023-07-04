'use strict'

document.addEventListener('DOMContentLoaded', () => {
    const services = document.querySelectorAll(".form-check-input");
    const totalPrice = document.querySelector('#product-price');

    services.forEach((service) => {
        service.addEventListener('click', (event) => {
            if (event.target.checked) {
                totalPrice.innerHTML = (parseFloat(totalPrice.innerHTML) +
                    parseFloat(event.target.getAttribute('data-service-price'))).toFixed(2);
            } else {
                totalPrice.innerHTML = (parseFloat(totalPrice.innerHTML) -
                    parseFloat(event.target.getAttribute('data-service-price'))).toFixed(2);
            }
        })
    })
});
