$(document).ready(() => {
  let currentProduct = null; 
  let addons = null

  $.ajax({
    url: "http://localhost/pizza-complete-version/admin/quan-ly-thuc-don/danh-muc?json_only=1", 
    method: "GET"
  }).done((response) => {
    const { code, message, body } = JSON.parse(response)
    if (code === 200 && message === "200 OK") {
      const categories = body
      $.each(categories, (i, category) => {
        const { id, category_name } = category
        $('select[name="product__list__categories"]').append(`<option value="${id}">${category_name}</option>`)
        $("#category-selection").append(`<option value="${id}">${category_name}</option>`)
      })
    }
  })

  $.ajax({
    url: "http://localhost/pizza-complete-version/admin/quan-ly-thuc-don/thuoc-tinh/detail", 
    method: "GET"
  }).done((response) => {
    const { code, message, body } = JSON.parse(response)
    if (code === 200 && message === "200 OK") addons = { ...body }
  }).fail((jqXHR, textStatus, errorThrown) => {
    console.log("error when get addons detail:", jqXHR)
  })

  $("#add-product-btn").click(() => { $(".modal").modal("show") })

  $("#product__list").delegate(".product-update-btn", "click", function(e) {
    e.preventDefault() 
    const productId = $(this).data("product-id")
    $.ajax({
      url: `http://localhost/pizza-complete-version/admin/quan-ly-thuc-don/san-pham/${productId}?json_only=1`, 
      method: "GET"
    }).done((response) => {
      const { code, message, body } = JSON.parse(response)
      if (code === 200 && message === "200 OK") {
        currentProduct = {...body}
        $(".modal").modal("show")
      }
    }).fail((jqXHR, textStatus, errorThrown) => {
      console.log(jqXHR)
    })  
  })

  $("#product-id-float-inp").prop("disabled", true)
  $(".modal").on("show.bs.modal", () => {
    if (currentProduct) {
      const { 
        id, 
        product_name, 
        category_id, 
        image, 
        description, 
        addons: currentAddons
      } = currentProduct
      $(".modal-title").html(`Cập nhật sản phẩm ${id}`)
      $("#product-id-float-inp").val(`${id}`)
      $("#product-name-float-inp").val(`${product_name}`)
      $(`#category-selection option[value="${category_id}"]`).attr("selected", true)
      $("#product-description-textarea").val(`${description}`)
      $("#product-addons__list").html("")
      const preparedCurrentAddons = Object.keys(currentAddons).flatMap(ad => {
        return Object.keys(currentAddons[ad].addon_options).map(adv => {
          return { addon_id: ad, addon_val_id: adv };
        })
      })
      const d = Object.keys(addons).flatMap(ad => {
        return Object.keys(addons[ad].addon_options).map(adv => {
          const t = addons[ad]["addon_options"][adv]
          return { addon_val_id: adv, addon_name: addons[ad]["addon_name"], addon_val: t["addon_val"], addon_val_price: t["addon_val_price"] }
        })
      })
      $.each(preparedCurrentAddons, (i, addonOption) => {
        const b = d.find((e) => e["addon_val_id"] === addonOption["addon_val_id"])
        $("#product-addons__list").append(`
          <div style="display: grid; grid-template-columns: 1fr .1fr; column-gap: .5rem; margin-top: 8px;">
            <div class="form-floating">
              <select class="addon-selection form-select">
                <option selected value="${b["addon_val_id"]}">${b["addon_name"]} - ${b["addon_val"]} ${b["addon_val_price"] && "(" + b["addon_val_price"] + "đ)" || ""}</option>
                ${ d.filter((e) => !preparedCurrentAddons.map((a) => a["addon_val_id"]).includes(e["addon_val_id"]))
                    .map((e) => `<option value="${e["addon_val_id"]}">${e["addon_name"]} - ${e["addon_val"]} ${e["addon_val_price"] && "(" + e["addon_val_price"] + "đ)" || ""}</option>`).join("") 
                }
              </select>
              <label>Thuộc tính</label>
            </div>
            <button class="remove-product-addon-btn" style="opacity: .8;"><i class="bi bi-dash-circle"></i></button>
          </div>
        `)        
      })
      return
    }
    $(".modal-title").html("Thêm sản phẩm mới")
    $("#product-id-float-inp").val(`P${Math.floor(Math.random() * 10000).toString().padStart(5, 0)}`)
    $("#product-name-float-inp").val("")
    $("#product-description-text-area").val("")
    $("#category-selection").prop("selectedIndex", 0)
    $("#currency-selection").prop("selectedIndex", 0)
    $("#product-addons__list").html('<p style="opacity: .8; text-align: center;">Chưa có dữ liệu</p>')
  })

  $("#add-addon-btn").click(() => {
    if ($("#product-addons__list").find("p").length === 1) $("#product-addons__list").html("")
    $("#product-addons__list").append(`
      <div style="display: grid; grid-template-columns: 1fr .1fr; column-gap: .5rem; margin-top: 8px;">
        <div class="form-floating">
          <select class="addon-selection form-select">
            <option value="">ok1</option>
            <option value="">ok2</option>
          </select>
          <label>Thuộc tính</label>
        </div>
        <button class="remove-product-addon-btn" style="opacity: .8;"><i class="bi bi-dash-circle"></i></button>
      </div>
    `)
  })
})