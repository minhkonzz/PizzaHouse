$(document).ready(() => {

  let currentProduct = null
  let currentProductCopy = null 
  const currentProductAddonOptionIds = []
  let addons = null

  function resetProductForm() {
    if (currentProduct) currentProduct = null
    $(".modal-title").html("Thêm sản phẩm mới")
    $("#product-id-float-inp").val(`P${Math.floor(Math.random() * 10000).toString().padStart(5, 0)}`)
    $("#product-name-float-inp").val("")
    $("#product-price-float-inp").val("")
    $("#product-description-textarea").val("")
    $("#category-selection").prop("selectedIndex", 0)
    $("#product-addons__list").html('<p style="opacity: .8; text-align: center;">Chưa có dữ liệu</p>')
  }

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
      addons = Object.values(body).reduce((acc, cur) => {
        const curAddonOptions = cur["addon_options"]
        Object.keys(curAddonOptions).forEach((e) => {
          acc[e] = {
            addon_val: curAddonOptions[e]["addon_val"],
            addon_val_price: curAddonOptions[e]["addon_val_price"],
            addon_name: cur["addon_name"],
            is_current: false
          }
        })
        return acc
      }, {})
      console.log("all addons fetched:", addons)
    }
  }).fail((jqXHR, textStatus, errorThrown) => {
    console.log("error when get addons detail:", jqXHR)
  })

  $("#add-product-btn").click(() => {
    if (currentProduct) currentProduct = null 
    $(".modal").modal("show") 
  })

  $("#product__list").delegate(".product-delete-btn", "click", function(e) {
    e.preventDefault()
    const productId = $(this).data("product-id")
    $.ajax({
      url: `http://localhost/pizza-complete-version/admin/quan-ly-thuc-don/san-pham/${productId}`, 
      method: "DELETE"
    }).done((response) => {
      const { code, message, body } = JSON.parse(response) 
      if (code === 200 && message === "200 OK") {
        alert("Delete success")
      }
    }).fail((jqXHR, textStatus, errorThrown) => {
      console.log(jqXHR)
    })
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
        const { id, product_name, price, image, description, category_id, addons: productAddons } = body 
        currentProduct = { id, product_name, price, image, description, category_id }
        currentProductCopy = { ...currentProduct }
        Object.values(productAddons).forEach((addon) => {
          Object.keys(addon["addon_options"]).forEach((addonOptionId) => {
            addons[addonOptionId]["is_current"] = true
            currentProductAddonOptionIds.push(addonOptionId)
          })
        })
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
      const { id, product_name, price, category_id, image, description } = currentProduct
      $(".modal-title").html(`Cập nhật sản phẩm ${id}`)
      $("#product-id-float-inp").val(id)
      $("#product-name-float-inp").val(product_name)
      $("#product-price-float-inp").val(price)
      $(`#category-selection option[value="${category_id}"]`).attr("selected", true)
      $("#product-description-textarea").val(description)
      $("#product-addons__list").html("")

      $.each(Object.keys(addons).filter((e) => addons[e]["is_current"]), (i, productAddonOptionId) => {
        const { addon_val, addon_val_price, addon_name } = addons[productAddonOptionId]
        $("#product-addons__list").append(`
          <div class="product-addon" data-addon-val-id="${productAddonOptionId}" style="display: grid; grid-template-columns: 1fr .1fr; column-gap: .5rem; margin-top: 8px;">
            <div class="form-floating">
              <select class="addon-selection form-select" data-addon-val-id="${productAddonOptionId}">
                <option value="${productAddonOptionId}" selected>${addon_name} - ${addon_val} ${addon_val_price && "(" + addon_val_price + "đ)" || ""}</option>
              </select>
              <label>Thuộc tính</label>
            </div>
            <button class="remove-product-addon-btn" style="opacity: .8;"><i class="bi bi-dash-circle"></i></button>
          </div>
        `)
        $(`.product-addon[data-addon-val-id="${productAddonOptionId}"] .remove-product-addon-btn`).click(() => {
          addons[productAddonOptionId]["is_current"] = false
          $(`.product-addon[data-addon-val-id="${productAddonOptionId}"]`).remove()
        })        
      })
      return
    }
    resetProductForm()
  })

  $("#product-addons").delegate(".addon-selection", "click", function() {
    if (!$(this).prop("open")) {
      const currentAddonOptionId = $(this).val()
      const { addon_name, addon_val, addon_val_price } = addons[currentAddonOptionId]
      $(this).html(`
        <option value="${currentAddonOptionId}" selected>${addon_name} - ${addon_val} ${addon_val_price && "(" + addon_val_price + "đ)" || ""}</option>
        ${ Object.keys(addons).filter((e) => e !== currentAddonOptionId && !addons[e]["is_current"]).map((e) => {
          const { addon_name, addon_val, addon_val_price } = addons[e]
          return `<option value="${e}">${addon_name} - ${addon_val} ${addon_val_price && "(" + addon_val_price + "đ)" || ""}</option>`  
        }).join("") }
      `)
    }
    $(this).prop("open", !$(this).prop("open"))
  })

  $("#add-addon-btn").click(() => {
    if ($("#product-addons__list").find("p").length === 1) $("#product-addons__list").html("")
    const addonOptionIdSelected = Object.keys(addons).filter((e) => !addons[e]["is_current"])[0]
    addons[addonOptionIdSelected]["is_current"] = true
    const newProductAddonOption = document.createElement("div")
    newProductAddonOption.setAttribute("style", "display: grid; grid-template-columns: 1fr .1fr; column-gap: .5rem; margin-top: 8px;")
    newProductAddonOption.setAttribute("class", "product-addon")
    newProductAddonOption.setAttribute("data-addon-val-id", addonOptionIdSelected)
    newProductAddonOption.innerHTML = `
      <div class="form-floating">
        <select class="addon-selection form-select" data-addon-val-id="${addonOptionIdSelected}">
          <option value="${addonOptionIdSelected}" selected>${addons[addonOptionIdSelected]["addon_name"]} - ${addons[addonOptionIdSelected]["addon_val"]} ${addons[addonOptionIdSelected]["addon_val_price"] && "(" + addons[addonOptionIdSelected]["addon_val_price"] + "đ)" || ""}</option>
        </select>
        <label>Thuộc tính</label>
      </div>
      <button class="remove-product-addon-btn" style="opacity: .8;"><i class="bi bi-dash-circle"></i></button>
    `
    $(newProductAddonOption).appendTo("#product-addons__list")
    $(`.product-addon[data-addon-val-id="${addonOptionIdSelected}"] .remove-product-addon-btn`).click(() => {
      addons[addonOptionIdSelected]["is_current"] = false
      $(`.product-addon[data-addon-val-id="${addonOptionIdSelected}"]`).remove()
    })
  })

  $("#product-addons").delegate(".addon-selection", "change", function(e) {
    e.preventDefault()
    const prevAddonOptionId = $(this).data("addon-val-id")
    const addonOptionIdSelected = e.target.value
    addons[prevAddonOptionId]["is_current"] = false
    addons[addonOptionIdSelected]["is_current"] = true
  })

  $("#save-product-btn").click(() => {

    const ajaxConfig = {
      url: "", 
      method: "", 
      data: null
    }

    if (currentProduct) {

      // update current product fields
      currentProduct = {
        ...currentProduct, 
        product_name: $("#product-name-float-inp").val(),
        price: Number($("#product-price-float-inp").val()),
        category_id: $("#category-selection").val(), 
        description: $("#product-description-textarea").val()
      }

      const payload = {}
      const addonOptionIdsSelected = Object.keys(addons).filter((e) => addons[e]["is_current"])
      const addonOptionIdsCompare = new Set([...addonOptionIdsSelected, ...currentProductAddonOptionIds])
      const isAddonOptionsChange = addonOptionIdsCompare.size !== addonOptionIdsSelected.length || addonOptionIdsCompare.size !== currentProductAddonOptionIds.length
      if (isAddonOptionsChange) {
        payload["addon_options_change"] = [...addonOptionIdsSelected, ...currentProductAddonOptionIds].reduce((acc, cur) => {
          if (addonOptionIdsSelected.includes(cur) && !currentProductAddonOptionIds.includes(cur)) return [...acc, { addon_option_id: cur, status: "ADD" }]
          if (!addonOptionIdsSelected.includes(cur) && currentProductAddonOptionIds.includes(cur)) return [...acc, { addon_option_id: cur, status: "DELETE" }]
          return acc
        }, [])
      } 
      Object.keys(currentProduct).forEach((e) => {
        if (currentProduct[e] !== currentProductCopy[e]) payload[e] = currentProduct[e]
      })
      ajaxConfig["url"] = `http://localhost/pizza-complete-version/admin/quan-ly-thuc-don/san-pham/${currentProduct.id}`
      ajaxConfig["method"] = "PUT"
      ajaxConfig["data"] = JSON.stringify(payload)
    } else {
      ajaxConfig["url"] = "http://localhost/pizza-complete-version/admin/quan-ly-thuc-don/san-pham"
      ajaxConfig["method"] = "POST"
      ajaxConfig["data"] = {
        product_id: $("#product-id-float-inp").val(), 
        product_name: $("#product-name-float-inp").val(),
        product_image: "",
        product_price: Number($("#product-price-float-inp").val()),
        product_category: $("#category-selection").val(),
        product_description: $("#product-description-textarea").val(),
        addon_options: Object.keys(addons).filter((e) => addons[e]["is_current"])
      }
    }

    $.ajax(ajaxConfig)
      .done((response) => {
        // const { code, message, body } = JSON.parse(response) 
        // if (code === 200 && message === "200 OK") {
        //   console.log("body:", body)
        // }
        console.log("response:", response)
      })
      .fail((jqXHR, textStatus, errorThrown) => {
        console.log(jqXHR)
      })
  })
})