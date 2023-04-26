$(document).ready(() => {

  const p1 = /^[a-zA-ZÀ-ỹ\s]+$/ig
  const p2 = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/ig
  const p3 = /^[a-zA-Z0-9À-ỹ\s]+$/ig
  const p4 = /^[0-9]+$/ig

  $("#make-order-btn").click(() => {
    try {
      const errs = []
      const customerName = $("input[name=buyer_name]").val().match(p1)[0] || (errs.push("Tên người mua hàng không hợp lệ") && "")
      console.log("buyer_name_ok")
      const customerEmail = $("input[name=buyer_email]").val().match(p2)[0] || (errs.push("Email người mua không hợp lệ") && "")
      console.log("buyer_email_ok")
      const customerPhone = $("input[name=buyer_phone]").val().match(p4)[0] || (errs.push("Điện thoại người mua không hợp lệ") && "")
      console.log("buyer_phone_ok")
      const shipAddressDetail = $("input[name=buyer_address]").val().match(p3)[0] || (errs.push("Địa chỉ nhận hàng không hợp lệ") && "")
      console.log("receiver_address_ok")
      const checkoutDistrict = $("select[name=checkout_district] option:selected").val()
      const checkoutCity = $("select[name=checkout_city] option:selected").val()
      const checkoutWard = $("select[name=checkout_ward] option:selected").val()
      const receiverName = $("input[name=receiver_name]").val().match(p1)[0] || (errs.push("Tên người nhận hàng không hợp lệ") && "")
      console.log("receiver_name_ok")
      const receiverPhone = $("input[name=receiver_phone]").val().match(p4)[0] || (errs.push("Điện thoại người nhận hàng") && "")
      console.log("receiver_phone_ok")
      const getInShopCheck = $("input[name=get-in-shop-checker][type=checkbox]").prop("checked")
      const payMethodId = $("input[name=checkout-pay-method]:checked").val()
      const checkoutOrderNote = $("#checkout__order-note").val().match(p3)[0] || (errs.push("Ghi chú đơn hàng chứa ký tự không hợp lệ") && "")
      console.log("note_ok")
      if (errs.length > 0) throw new Error(errs.join("\n"))
      $.ajax({
        url: "http://localhost/pizza-complete-version/thanh-toan", 
        method: "POST", 
        data: {
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
          "pay_method_id": payMethodId,
          "note": checkoutOrderNote
        }
      }).done((response) => {
        console.log("responsea:", response)
      }).fail((jqXHR, textStatus, errorThrown) => {
        console.log("error:", jqXHR)
      })
    } catch (error) { alert(error.message) }
  })
})