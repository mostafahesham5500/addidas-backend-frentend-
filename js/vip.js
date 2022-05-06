var shop = document.querySelectorAll('span.shoping');
shop.forEach(el =>{
    el.onclick = function(){
        this.nextElementSibling.querySelector(".add_cart").click();
    }
})

var card = document.querySelector(".cart-items-container");
document.querySelector(".fa-shopping-cart").onclick = function(){
card.classList.toggle("active");
}