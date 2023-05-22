$(document).ready(() => {
   // window.onload = () => { 
      
   // } 
   console.log("vao day deee")
   $("#loading").css("display", "none")
   $("#content").css("display", "initial")

   $(window).scroll(() => {
      $("header").toggleClass("sticky", $(window).scrollTop() > 0);
   });

   $("#sidebar-nav #close").click(() => {
      $("#sidebar-nav").css("left", "-300px");
   })

   $("#sidebar-nav__btn").click(() => {
      $("#sidebar-nav").css("left", 0);
   })

   $("#close-dialog-btn").click(() => {
      $("#dialog").fadeOut(230)
      $("body").css("overflow-y", "scroll")
   })
})