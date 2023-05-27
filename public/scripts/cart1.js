$(document).ready(() => {
  const cartUpdates = {}

  $(".cart-main__items").delegate(".cart-qty-inp", "change", function(e) {
    const cartItemId = $(this).data("cart-id")
    // need validate cartItemId here
    cartUpdates[cartItemId] = Number(e.target.value)
  })

  $(".cart-main__items").delegate(".remove-cart-item-btn", "click", function() {
    $("#dialog").fadeIn(230)
    const cartItemId = $(this).data("cart-id")
    const productName = $(this).data("product-name")     
    callAjax(
      `gio-hang/${cartItemId}`, 
      (body) => { 
        $("#dialog__title").html(`Đã xóa ${productName}`)
        $("#dialog-redirect-btn a").html("Thanh toán") 
        $("#dialog-redirect-btn a").attr("href", `${host}thanh-toan`) 
        $("body").css("overflow-y", "hidden")
        $("#spinner").css("display", "none")
        $("#dialog__main").css("display", "initial") 
        setTimeout(() => { window.location.href = `${host}gio-hang` }, 2000)
      }, 
      "DELETE"
    )
  })

  $("#update-cart-btn").click(() => {
    $("#dialog").fadeIn(230)
    callAjax(
      "gio-hang", 
      (body) => {
        $("#dialog__title").html("Cập nhật giỏ hàng thành công")
        $("#dialog-redirect-btn a").html("Thanh toán") 
        $("#dialog-redirect-btn a").attr("href", `${host}thanh-toan`) 
        $("body").css("overflow-y", "hidden")
        $("#spinner").css("display", "none")
        $("#dialog__main").css("display", "initial") 
        setTimeout(() => { window.location.href = `${host}gio-hang` }, 2000)
      },
      "PUT", 
      JSON.stringify(cartUpdates)
    )
  })
})