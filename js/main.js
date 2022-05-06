var search = document.querySelector(".show-search");

search.onclick = function(){
  this.nextElementSibling.classList.toggle("active");
}

var allLink = document.querySelectorAll(".nav-item a");

allLink.forEach(el => {
  el.onclick = function(e){
    var section = document.querySelector("#"+this.getAttribute("data-link"));
    console.log(section.offsetTop);
    window.scrollTo(0,section.offsetTop - 100);
    e.preventDefault();
    allLink.forEach(remove => {
      remove.parentElement.classList.remove("active");
    })
    el.parentElement.classList.add("active");
  }
});

var box = document.querySelector(".state");
var boxNum = document.querySelectorAll(".state .box  .num");
var allSection = document.querySelectorAll("section");
var moveUp = document.querySelector(".moveUp");
var x=0;
window.onscroll = function(){
  if(window.scrollY >= box.offsetTop - 300 && window.scrollY -100 <= box.offsetTop){
    boxNum.forEach(el => {
      if(x < 4){
        x++;
        var n = setInterval( function() {
          el.innerHTML =  parseInt(el.innerHTML) + 1;
          if(el.innerHTML == el.getAttribute("data-num")){
            clearInterval(n);
          }
        },3000 / parseInt(el.getAttribute("data-num")))
      }
    })
  }

  allSection.forEach(el => {
    if(window.scrollY >= el.offsetTop - 200 && window.scrollY <= el.offsetTop + el.scrollHeight){
      allLink.forEach(remove => {
        remove.parentElement.classList.remove("active");
      })
      var m =document.querySelector("."+el.getAttribute("id"));
      m.parentElement.classList.add("active");
    }
  });

  if(window.scrollY >= 1000){
    moveUp.style.top = "90%";
  }else{
    moveUp.style.top = "-60px"
  }
}

moveUp.onclick = function(e){
  e.preventDefault();
  window.scrollTo(0,0)
  this.style.top = "-10%"
  console.log(this)
}

var card = document.querySelector(".cart-items-container");
document.querySelector(".fa-shopping-cart").onclick = function(){
  card.classList.toggle("active");
}
var shop = document.querySelectorAll('span.shoping');
shop.forEach(el =>{

    el.onclick = function(){
      console.log(this.nextElementSibling.querySelector(".add_cart").click())
        this.nextElementSibling.querySelector(".add_cart").click();
    }
})