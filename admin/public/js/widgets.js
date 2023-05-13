$(document).ready(() => {
   $(".wk2").delegate(".custom__field", "focusin focusout", (e) => {
      const styleSet = e.type === "focusin" ? 
      [
        { prop: "top", value: 0 }, 
        { prop: "background", value: "#fff" }, 
        { prop: "font-size", value: "12px" },
        { prop: "padding", value: "0 5px" },
        { prop: "margin-left", value: "-5px" }
      ] : 
      [
        { prop: "top", value: "50%" }, 
        { prop: "background", value: "transparent" }, 
        { prop: "font-size", value: "14px" },
        { prop: "padding", value: "0" },
        { prop: "margin-left", value: "0" }
      ]
      styleSet.forEach((c) => $(".field__placeholder").css(c.prop, c.value))
   })
})