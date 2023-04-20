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
    if (code === 200 && message === "200 OK") {
      addons = Object.keys(body).flatMap(ad => {
        return Object.keys(body[ad].addon_options).map(adv => {
          const t = body[ad]["addon_options"][adv]
          return { 
            addon_val_id: adv, 
            addon_name: body[ad]["addon_name"], 
            addon_val: t["addon_val"], 
            addon_val_price: t["addon_val_price"], 
            is_current: false 
          }
        })
      })
      console.log("all addons fetched:", addons)
    }
  }).fail((jqXHR, textStatus, errorThrown) => {
    console.log("error when get addons detail:", jqXHR)
  })

  $("#add-product-btn").click(() => {
    if (currentProduct) currentProduct = null 
    $(".modal").modal("show") 
  })

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
        currentProduct.addons = Object.keys(currentProduct.addons).flatMap(ad => Object.keys(currentProduct.addons[ad].addon_options).map(adv => adv))
        console.log("currentProduct:", currentProduct)
        $(".modal").modal("show")
      }
    }).fail((jqXHR, textStatus, errorThrown) => {
      console.log(jqXHR)
    })  
  })

  $("#product-id-float-inp").prop("disabled", true)

  $(".modal").on("hidden.bs.modal", resetProductForm)
  $(".modal").on("show.bs.modal", () => {
    if (currentProduct) {
      console.log("go here")
      const { 
        id, 
        product_name, 
        category_id, 
        image, 
        description, 
        addons: productAddonValIds
      } = currentProduct
      $(".modal-title").html(`Cập nhật sản phẩm ${id}`)
      $("#product-id-float-inp").val(`${id}`)
      $("#product-name-float-inp").val(`${product_name}`)
      $(`#category-selection option[value="${category_id}"]`).attr("selected", true)
      $("#product-description-textarea").val(`${description}`)
      $("#product-addons__list").html("")

      $.each(productAddonValIds, (i, addonValId) => {
        const b = addons.find((e) => e["addon_val_id"] === addonValId)
        $("#product-addons__list").append(`
          <div class="product-addon" data-addon-val-id="${b["addon_val_id"]}" style="display: grid; grid-template-columns: 1fr .1fr; column-gap: .5rem; margin-top: 8px;">
            <div class="form-floating">
              <select class="addon-selection form-select">
                <option selected value="${b["addon_val_id"]}">${b["addon_name"]} - ${b["addon_val"]} ${b["addon_val_price"] && "(" + b["addon_val_price"] + "đ)" || ""}</option>
                ${ addons
                    .filter((e) => !e.is_current)
                    .map((e) => `<option value="${e.addon_val_id}">${e.addon_name} - ${e.addon_val} ${e.addon_val_price && "(" + e.addon_val_price + "đ)" || ""}</option>`)
                }
              </select>
              <label>Thuộc tính</label>
            </div>
            <button class="remove-product-addon-btn" data-addon-val-id="${b["addon_val_id"]}" style="opacity: .8;"><i class="bi bi-dash-circle"></i></button>
          </div>
        `)        
      })
      $("#product-addons__list").delegate(".remove-product-addon-btn", "click", function(e) {
        e.preventDefault()
        const addonValId = $(this).data("addon-val-id")
        currentProduct.addons = currentProduct.addons.filter((e) => e !== addonValId)
        $(`.product-addon[data-addon-val-id="${addonValId}"]`).remove()
        updateAddons()
      })
      updateAddons()
      return
    }
    resetProductForm()
  })

  function resetProductForm() {
    $(".modal-title").html("Thêm sản phẩm mới")
    $("#product-id-float-inp").val(`P${Math.floor(Math.random() * 10000).toString().padStart(5, 0)}`)
    $("#product-name-float-inp").val("")
    $("#product-description-textarea").val("")
    $("#category-selection").prop("selectedIndex", 0)
    $("#currency-selection").prop("selectedIndex", 0)
    $("#product-addons__list").html('<p style="opacity: .8; text-align: center;">Chưa có dữ liệu</p>')
    if (currentProduct) currentProduct = null
  }

  function updateAddons() {
    const addonIdsSelected = Array.from($("#product-addons .addon-selection")).map((e) => e.value)
    addons = addons.map((e) => addonIdsSelected.includes(e.addon_val_id) ? { ...e, is_current: true } : { ...e, is_current: false })
    if (currentProduct) currentProduct.addons =  [...addonIdsSelected ]
    Array.from($("#product-addons .addon-selection")).forEach((addonSelection) => {
      const d = addons.find((e) => e.addon_val_id === addonSelection.value)
      addonSelection.innerHTML = 
        `<option value="${d.addon_val_id}" selected>${d.addon_name} - ${d.addon_val} ${d.addon_val_price && "(" + d.addon_val_price + "đ)" || ""}</option>` + 
        addons.filter((e) => !e.is_current).map((e) => `<option value="${e.addon_val_id}">${e.addon_name} - ${e.addon_val} ${e.addon_val_price && "(" + e.addon_val_price + "đ)" || ""}</option>`).join("")
    })
  }

  $("#add-addon-btn").click(() => {
    if ($("#product-addons__list").find("p").length === 1) $("#product-addons__list").html("")
    const newProductAddonOption = document.createElement("div")
    newProductAddonOption.setAttribute("style", "display: grid; grid-template-columns: 1fr .1fr; column-gap: .5rem; margin-top: 8px;")
    newProductAddonOption.setAttribute("class", "product-addon")
    newProductAddonOption.innerHTML = `
      <div class="form-floating">
        <select class="addon-selection form-select">
          ${ addons
            .filter((e) => !e.is_current)
            .map((e) => `<option value="${e.addon_val_id}">${e.addon_name} - ${e.addon_val} ${e.addon_val_price && "(" + e.addon_val_price + "đ)" || ""}</option>`)
          }
        </select>
        <label>Thuộc tính</label>
      </div>
      <button class="remove-product-addon-btn" style="opacity: .8;"><i class="bi bi-dash-circle"></i></button>
    `
    $(newProductAddonOption).appendTo("#product-addons__list")
    updateAddons()
  })

  $("#product-addons").delegate(".addon-selection", "change", function(e) {
    e.preventDefault()
    updateAddons()
  })
})