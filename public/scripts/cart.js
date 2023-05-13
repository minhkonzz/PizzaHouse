$(document).ready(() => {
  const cartUpdates = {}

  $(".cart-main__items").delegate(".cart-qty-inp", "change", function(e) {
    const cartItemId = $(this).data("cart-id")
    // need validate cartItemId here
    cartUpdates[cartItemId] = Number(e.target.value)
  })

  $(".cart-main__items").delegate(".remove-cart-item-btn", "click", function() {
    const cartItemId = $(this).data("cart-id") 
    // need validate cartItemId here
    $.ajax({
      url: `http://localhost/pizza-complete-version/gio-hang/${cartItemId}`, 
      method: "DELETE"
    }).done((response) => {
      const { code, message } = JSON.parse(response)
      if (code === 200 && message === "200 OK") alert("Xóa giỏ hàng thành công")
    }).fail((jqXHR) => {
      console.log(jqXHR)
    })              
  })

  $("#update-cart-btn").click(() => {
    $.ajax({
      url: "http://localhost/pizza-complete-version/gio-hang", 
      method: "PUT", 
      data: JSON.stringify(cartUpdates)
    }).done((response) => {
      const { code, message } = JSON.parse(response);
      if (code === 200 && message === "200 OK") alert("Update giỏ hàng thành công")
    }).fail((jqXHR) => {
      console.log(jqXHR)
    })
  })
})