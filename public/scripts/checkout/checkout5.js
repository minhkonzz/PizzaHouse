$(document).ready(() => {

  const p1 = /^[a-zA-ZÀ-ỹ\s]+$/ig
  const p2 = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/ig
  const p3 = /^[a-zA-Z0-9À-ỹ\s]+$/ig
  const p4 = /^[0-9]+$/ig

  $("#make-order-btn").click(() => {
    try {
      const errs = []
      const customerName = $("input[name=buyer_name]").val().match(p1) && $("input[name=buyer_name]").val().match(p1)[0] || (errs.push("Tên người mua hàng không hợp lệ") && "")
      const customerEmail = $("input[name=buyer_email]").val().match(p2) && $("input[name=buyer_email]").val().match(p2)[0] || (errs.push("Email người mua không hợp lệ") && "")
      const customerPhone = $("input[name=buyer_phone]").val().match(p4) && $("input[name=buyer_phone]").val().match(p4)[0] || (errs.push("Điện thoại người mua không hợp lệ") && "")
      const shipAddressDetail = $("input[name=buyer_address]").val().match(p3) && $("input[name=buyer_address]").val().match(p3)[0] || (errs.push("Địa chỉ nhận hàng không hợp lệ") && "")
      const checkoutDistrict = $("select[name=checkout_district] option:selected").val()
      const checkoutCity = $("select[name=checkout_city] option:selected").val()
      const checkoutWard = $("select[name=checkout_ward] option:selected").val()
      const receiverName = $("input[name=receiver_name]").val().match(p1) && $("input[name=receiver_name]").val().match(p1)[0] || (errs.push("Tên người nhận hàng không hợp lệ") && "")
      const receiverPhone = $("input[name=receiver_phone]").val().match(p4) && $("input[name=receiver_phone]").val().match(p4)[0] || (errs.push("Điện thoại người nhận hàng") && "")
      const getInShopCheck = $("input[name=get-in-shop-checker][type=checkbox]").prop("checked")
      const payMethod = JSON.parse($("input[name=checkout-pay-method]:checked").val() || errs.push("Vui lòng chọn phương thức thanh toán") && "{}")
      const checkoutOrderNote = $("#checkout__order-note").val().match(p3) && $("#checkout__order-note").val().match(p3)[0] || (errs.push("Ghi chú đơn hàng chứa ký tự không hợp lệ") && "")
      if (errs.length > 0) throw new Error(errs.join("\n"))
      $("#dialog").fadeIn(230)
      const orderPayloads = {
        "order": {
          "buyer_name": customerName, 
          "buyer_email": customerEmail, 
          "buyer_phone": customerPhone, 
          "receive_address": shipAddressDetail, 
          "receiver_name": receiverName, 
          "receiver_phone": receiverPhone, 
          "take_in_shop": getInShopCheck, 
          "district": checkoutDistrict, 
          "city": checkoutCity, 
          "ward": checkoutWard, 
          "pay_method_id": payMethod["pay_method_id"],
          "note": checkoutOrderNote
        }
      }
      if (payMethod["online_pay"]) orderPayloads["online_pay"] = payMethod["online_pay"]
      callAjax(
        "thanh-toan", 
        (body) => {
           if (orderPayloads["online_pay"]) {
              const { payment_url } = body 
              window.location.href = payment_url
              return
           }
           $("#dialog__title").html(`Đặt đơn thành công`)
           $("#dialog-redirect-btn a").html("Xem thêm sản phẩm") 
           $("#dialog-redirect-btn a").attr("href", `${host}`) 
           $("body").css("overflow-y", "hidden")
           $("#spinner").css("display", "none")
           $("#dialog__main").css("display", "initial") 
           setTimeout(() => { window.location.href = `${host}` }, 2000)
        },
        "POST",
        orderPayloads
      )
    } catch (error) { alert(error.message) }
  })
})