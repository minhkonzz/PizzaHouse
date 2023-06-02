$(document).ready(() => {
   const { id: product_id, product_name, image: product_image, category_name, price} = $(".product-detail__main").data("product")

   let productPrice = Number(price), lastPrice = 0, quantity = 1

   console.log(price, typeof price)
   
   const productAddCart = {
      product_id, 
      product_name,
      product_image,
      category_name,
      qty_add: quantity,
      addons: {}
   }

   $(".product-detail__price span").html(`${productPrice.toLocaleString('en-US')}đ`)
   $(".product-detail__addon-options").delegate(".product-detail__addon-option", "click", function() {

      const { addon_val, addon_val_price, apply_product_price } = $(this).data("addon-val-extra")
      const addon_id = $(this).data("addon-id") 
      const addon_val_id = $(this).data("addon-val-id")

      if (productAddCart.addons[addon_id]) 
         $(`.product-detail__addon-option[data-addon-val-id=${productAddCart.addons[addon_id]["addon_val_id"]}]`).closest("li").css("border", "none")

      if (apply_product_price && apply_product_price === 1) {
         productPrice = Number(addon_val_price)
         productAddCart.addons[addon_id] = { addon_val_id, addon_val, addon_val_price: 0 }
      }
      else productAddCart.addons[addon_id] = { addon_val_id, addon_val, addon_val_price }
      lastPrice = productPrice + Object.values(productAddCart.addons).reduce((acc, cur) => acc + Number(cur["addon_val_price"]), 0)
      $(`.product-detail__addon-option[data-addon-val-id=${addon_val_id}]`).closest("li").css("border", "1px solid var(--primary-color)")
      $(".product-detail__price span").html(`${(lastPrice * quantity).toLocaleString('en-US')}đ`)
   })

   $("#product-detail__add-cart").click(() => {
      $("#dialog").fadeIn(230)
      callAjax(
         "gio-hang", 
         (body) => {
            $("#dialog__title").html("Thêm giỏ hàng thành công")
            $("#dialog-redirect-btn a").html("Xem giỏ hàng") 
            $("#dialog-redirect-btn a").attr("href", `${host}gio-hang`) 
            $("body").css("overflow-y", "hidden")
            $("#spinner").css("display", "none")
            $("#dialog__main").css("display", "initial") 
         },
         "POST", 
         {
            ...productAddCart, 
            total_price: lastPrice,
            addons: Object.values(productAddCart.addons).reduce((acc, cur) => {
               const { addon_val_id, addon_val } = cur
               acc[addon_val_id] = addon_val
               return acc
            }, {})
         }
      )
  })

   $("#product-detail__quantity").change(function() {
      quantity = Number(this.value)
      $(".product-detail__price span").html(`${(lastPrice * quantity).toLocaleString('en-US')}đ`)
      productAddCart["qty_add"] = Number(this.value)
  })
})