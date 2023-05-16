$(document).ready(() => {
   $(".add-role__section__about").delegate(".custom__field", "focusin focusout", function(e) {
      const parent = $(this).closest(".field__wrapper")
      console.log(parent.data("ident"))
      const styleSet = e.type === "focusin" ? 
      {
         top: 0, 
         background: "#fff", 
         "font-size": "12px", 
         padding: "0 5px", 
         "margin-left": "-5px"
      } : 
      {
         top: parent.hasClass("txtarea") ? "20px" : "50%", 
         background: "transparent", 
         "font-size": "14px", 
         padding: 0, 
         "margin-left": 0
      }
      Object.keys(styleSet).forEach((c) => $(`.field__wrapper[data-ident="${parent.data("ident")}"] .field__placeholder`).css(c, styleSet[c]))  
   })
})