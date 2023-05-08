$(document).ready(() => {
   $("#sidebar-nav #close").click(() => {
      $("#sidebar-nav").css("left", "-300px");
   })

   $("#sidebar-nav__btn").click(() => {
      $("#sidebar-nav").css("left", 0);
   })
})