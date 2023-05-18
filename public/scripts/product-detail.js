$(document).ready(() => {

  const { id: product_id, product_name, image: product_image, category_name, price} = $(".product-detail__main").data("product")
  let productPrice = price, lastPrice = 0
  const productAddCart = {
    product_id, 
    product_name,
    product_image,
    category_name,
    qty_add: 1,
    addons: {}
  }

  $(".product-detail__price span").html(`${productPrice}đ`)

  $(".product-detail__addon-options").delegate(".product-detail__addon-option", "click", function() {
    const { addon_id, addon_val_id, addon_val, addon_val_price, apply_product_price } = $(this).data("addon")
    if (apply_product_price && apply_product_price === 1) {
      productPrice = addon_val_price
      productAddCart.addons[addon_id] = { [addon_val_id]: { addon_val, addon_val_price: 0 }}
    }
    else productAddCart.addons[addon_id] = { [addon_val_id]: { addon_val, addon_val_price }}
    lastPrice = productPrice + Object.values(productAddCart.addons).reduce((acc, cur) => {
      return acc + Object.values(cur)[0].addon_val_price
    }, 0)
    $(".product-detail__price span").html(`${lastPrice}đ`)
  })

  $("#product-detail__add-cart").click(() => {
    $("#dialog").fadeIn(230)
    $.ajax({
      url: "http://localhost/pizza-complete-version/gio-hang", 
      method: "POST", 
      data: {
        ...productAddCart, 
        total_price: lastPrice,
        addons: Object.values(productAddCart.addons).reduce((acc, cur) => {
          const k = Object.keys(cur)[0]
          acc[k] = cur[k].addon_val 
          return acc
        }, {})
      }
    }).done((response) => {
      const { code, message } = JSON.parse(response) 
      if (code === 200 && message === "200 OK") {
         $("body").css("overflow-y", "hidden")
         $("#spinner").css("display", "none")
         $("#dialog__main").css("display", "initial")
      }
    }).fail((jqXHR) => {
      console.log(jqXHR)
    })
  })

  $("#product-detail__quantity").change(function() {
    productAddCart["qty_add"] = Number(this.value)
  })
})