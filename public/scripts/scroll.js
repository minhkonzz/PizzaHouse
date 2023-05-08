$(document).ready(() => {
   $(window).scroll(() => {
      $("header").toggleClass("sticky", $(window).scrollTop() > 0);
   });
})