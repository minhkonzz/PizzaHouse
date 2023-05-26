$(document).ready(() => {
   $(".fields").delegate(".custom__field", "focusin focusout", function(e) {
      const parent = $(this).closest(".field__wrapper")
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

   /***************** Dropdown selection *****************/
   let currentIdent = null

   function hideOptionsBox(ident) {
      $(`.select__wrapper[data-ident=${ident}] .options__box`).fadeOut(150)
      $(`.select__wrapper[data-ident=${ident}] .select__box i`).css("transform", "rotate(0)")
   }

   $(document).click((e) => {
      if (!$(e.target).closest(".select__wrapper").length) hideOptionsBox(currentIdent)
   })

   $(".selects").delegate(".select__box", "click", function() {
      const ident = $(this).closest(".select__wrapper").data("ident")
      if (ident !== currentIdent) {
         hideOptionsBox(currentIdent)
         currentIdent = ident
      } 
      $(`.select__wrapper[data-ident=${ident}] .options__box`).fadeIn(150)
      $(`.select__wrapper[data-ident=${ident}] .select__box i`).css("transform", "rotate(180deg)")
   })
   $(".selects").delegate(".option", "click", function() {
      const optionText = $(this).html()
      const optionValue = $(this).data("value")
      const ident = $(this).closest(".select__wrapper").data("ident")
      const prevValue = $(`.select__wrapper[data-ident=${ident}] .value`).data("value") 
      $(`.select__wrapper[data-ident=${ident}] .value`).attr("data-prev", prevValue)
      $(`.select__wrapper[data-ident=${ident}] .value`).attr("data-value", optionValue)
      $(`.select__wrapper[data-ident=${ident}] .value`).html(optionText)
      hideOptionsBox(ident)
   })
})