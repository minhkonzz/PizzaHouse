$(document).ready(() => {
   let currentProduct = {
      name: "", 
      price: "", 
      category: "", 
      description: ""
   }

   let currentProductCopy = null 
   const currentProductAddonOptionIds = []
   let addons = null

   let currentSelectionIdent = null

   function hideOptionsBox(ident) {
      $(`.select__wrapper[data-ident=${ident}] .options__box`).fadeOut(150)
      $(`.select__wrapper[data-ident=${ident}] .select__box i`).css("transform", "rotate(0)")
   }

   $(document).click((e) => {
      if (!$(e.target).closest(".select__wrapper").length) hideOptionsBox(currentSelectionIdent)
   })

   function resetProductForm() {
     currentProduct = {
        name: "", 
        price: "", 
        category: "", 
        description: "",
        addon_options: []
     }
     $(".modal-title").html("Thêm sản phẩm mới")
     $('.field__wrapper[data-ident=product-id]').css("display", "none")
     $("#product__image").html(`
        <i class="bi bi-image-fill"></i>
        <p id="title">Kích thước ảnh giới hạn 2048px, định dạng PNG hoặc JPEG</p>
     `)
     $("#product-addons__list").html('<p style="opacity: .8; text-align: center; font-size: 13px; font-style: italic;">Chưa có dữ liệu</p>')
   }

   $("#product__image-container #upload-btn").click(() => {
      const uploadOptions = {
         success: function(files) {
            const { link, thumbnailLink } = files[0]
            $("#product__image").html(`<img src="${link}" alt="product__image">`)
            currentProduct["image"] = thumbnailLink
         },
         linkType: "direct", 
         extensions: ["png", "jpeg", "jpg"]
      }
      Dropbox.choose(uploadOptions)
   })
 
   callAjax(
     "admin/quan-ly-thuc-don/danh-muc?json_only=1", 
     (body) => {
       $('.select__wrapper[data-ident="categories"] .options__box').html("")
       const { categories } = body
       $.each(categories, (i, category) => {
         const { category_id, category_name } = category
         $('.select__wrapper[data-ident=categories] .options__box').append(`<p class="option" data-value="${category_id}">${category_name}</p>`)
       })
     }
   )
 
   callAjax(
     "admin/quan-ly-thuc-don/thuoc-tinh/detail", 
     (body) => {
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
     }
   )
 
   $("#add-product-btn").click(() => {
     resetProductForm()
     $(".modal").modal("show") 
   })
 
   $("#product__list").delegate(".product-delete-btn", "click", function(e) {
     e.preventDefault()
     const productId = $(this).data("product-id") 
     callAjax(
       `admin/quan-ly-thuc-don/san-pham/${productId}`, 
       (body) => { alert("Delete success") }, 
       "DELETE"
     )
   })
 
   $("#product__list").delegate(".product-update-btn", "click", function(e) {
     e.preventDefault() 
     const productId = $(this).data("product-id") 
     callAjax(
       `admin/quan-ly-thuc-don/san-pham/${productId}?json_only=1`, 
       (body) => {
         const { id, product_name, price, image, description, category_id, addons: productAddons } = body 
         currentProduct = {
            id, 
            image, 
            name: product_name,
            category: category_id, 
            price, 
            description,
         }
         currentProductCopy = { ...currentProduct }
         Object.values(productAddons).forEach((addon) => {
           Object.keys(addon["addon_options"]).forEach((addonOptionId) => {
             addons[addonOptionId]["is_current"] = true
             currentProductAddonOptionIds.push(addonOptionId)
           })
         })
         $(".modal").modal("show")
       }
     )
   })
 
   $("#product-id-float-inp").prop("disabled", true)


 
   $(".modal").on("hidden.bs.modal", resetProductForm)
   $(".modal").on("show.bs.modal", () => {
     const { id, name, price, category, image, description } = currentProduct
     if (id) {
       $('.field__wrapper[data-ident=product-id]').css("display", "block")
       $(".modal-title").html(`Cập nhật sản phẩm ${name}`)
       $("#product-id-float-inp").val(id)
       $("#product__image").html(`<img style="transform: scale(1.5, 1.5);" src="${image}" alt="product__image">`)
       $("#product-addons__list").html("")
       $.each(Object.keys(addons).filter((e) => addons[e]["is_current"]), (i, productAddonOptionId) => {
         const { addon_val, addon_val_price, addon_name } = addons[productAddonOptionId]
        $("#product-addons__list").append(`
           <div class="product-addon" data-addon-val-id="${productAddonOptionId}" style="display: grid; grid-template-columns: 1fr .1fr; column-gap: .5rem; margin-top: 8px;">
              <div class="select__wrapper" data-ident="${productAddonOptionId}">
                 <div class="select__box">
                    <p class="value" data-value="${productAddonOptionId}">${addon_name} - ${addon_val} ${addon_val_price && "(" + addon_val_price + "đ)" || ""}</p>
                    <i class="bi bi-chevron-down"></i>
                 </div>
                 <div class="options__box">
                    <p class="option" data-value="${productAddonOptionId}">${addon_name} - ${addon_val} ${addon_val_price && "(" + addon_val_price + "đ)" || ""}</p>
                 </div>
              </div>
              <button class="remove-product-addon-btn" style="opacity: .8;"><i class="bi bi-dash-circle"></i></button>
           </div>
         `)
         $(`.product-addon[data-addon-val-id="${productAddonOptionId}"] .remove-product-addon-btn`).click(() => {
           addons[productAddonOptionId]["is_current"] = false
           $(`.product-addon[data-addon-val-id="${productAddonOptionId}"]`).remove()
         })        
       })
     }
     $("#product-name-float-inp").val(name)
     $("#product-price-float-inp").val(price)
     $("#product-description-textarea").val(description)
   })

   $("#category__selection .select__box").click(function() {
      if ($(this).next(".options__box").css("display") === "none") {
         const ident = $(this).closest(".select__wrapper").data("ident")
         if (ident !== currentSelectionIdent) {
            hideOptionsBox(currentSelectionIdent)
            currentSelectionIdent = ident
         } 
         $(`.select__wrapper[data-ident=${ident}] .options__box`).fadeIn(150)
         $(`.select__wrapper[data-ident=${ident}] .select__box i`).css("transform", "rotate(180deg)")
      }
   })

  $("#product-addons").delegate(".select__box", "click", function() {
    if ($(this).next(".options__box").css("display") === "none") {
      const ident = $(this).closest(".select__wrapper").data("ident")
      if (ident !== currentSelectionIdent) {
         hideOptionsBox(currentSelectionIdent)
         currentSelectionIdent = ident
      } 
      $(`.select__wrapper[data-ident=${ident}] .options__box`).fadeIn(150)
      $(`.select__wrapper[data-ident=${ident}] .select__box i`).css("transform", "rotate(180deg)")

      const currentAddonOptionId = $(`.select__wrapper[data-ident=${ident}] .value`).data("value")
      const { addon_name, addon_val, addon_val_price } = addons[currentAddonOptionId]
      $(`.select__wrapper[data-ident=${ident}] .options__box`).html(`
         <p class="option" data-value="${currentAddonOptionId}">${addon_name} - ${addon_val} ${addon_val_price && "(" + addon_val_price + "đ)" || ""}</p>
         ${ Object.keys(addons).filter((e) => e !== currentAddonOptionId && !addons[e]["is_current"]).map((e) => {
          const { addon_name, addon_val, addon_val_price } = addons[e]
          return `<p class="option" data-value="${e}">${addon_name} - ${addon_val} ${addon_val_price && "(" + addon_val_price + "đ)" || ""}</p>`  
        }).join("") }
      `)
    }
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
       <div class="select__wrapper" data-ident="${addonOptionIdSelected}">
          <div class="select__box">
             <p class="value" data-value="${addonOptionIdSelected}">${addons[addonOptionIdSelected]["addon_name"]} - ${addons[addonOptionIdSelected]["addon_val"]} ${addons[addonOptionIdSelected]["addon_val_price"] && "(" + addons[addonOptionIdSelected]["addon_val_price"] + "đ)" || ""}</p>
             <i class="bi bi-chevron-down"></i>
          </div>
          <div class="options__box">
            <p class="option" data-value="${addonOptionIdSelected}">${addons[addonOptionIdSelected]["addon_name"]} - ${addons[addonOptionIdSelected]["addon_val"]} ${addons[addonOptionIdSelected]["addon_val_price"] && "(" + addons[addonOptionIdSelected]["addon_val_price"] + "đ)" || ""}</p>
          </div>
       </div>
       <button class="remove-product-addon-btn" style="opacity: .8;"><i class="bi bi-dash-circle"></i></button>
     `
     $(newProductAddonOption).appendTo("#product-addons__list")
     $(`.product-addon[data-addon-val-id="${addonOptionIdSelected}"] .remove-product-addon-btn`).click(() => {
       addons[addonOptionIdSelected]["is_current"] = false
       $(`.product-addon[data-addon-val-id="${addonOptionIdSelected}"]`).remove()
     })
   })

   $("#category__selection").delegate(".option", "click", function(e) {
      e.preventDefault() 
      const optionText = $(this).html()
      const optionValue = $(this).data("value")
      const ident = $(this).closest(".select__wrapper").data("ident")
      $(`.select__wrapper[data-ident=${ident}] .value`).attr("data-value", optionValue)
      $(`.select__wrapper[data-ident=${ident}] .value`).html(optionText)
      currentProduct["category"] = optionValue
      hideOptionsBox(ident)
   })

  $("#product-addons").delegate(".option", "click", function(e) {
    e.preventDefault()
    const optionText = $(this).html()
    const optionValue = $(this).data("value")
    const ident = $(this).closest(".select__wrapper").data("ident")
    const prevAddonOptionId = $(`.select__wrapper[data-ident=${ident}] .value`).data("value") 
    $(`.select__wrapper[data-ident=${ident}] .value`).attr("data-prev", prevAddonOptionId)
    $(`.select__wrapper[data-ident=${ident}] .value`).attr("data-value", optionValue)
    $(`.select__wrapper[data-ident=${ident}] .value`).html(optionText)
    addons[prevAddonOptionId]["is_current"] = false
    addons[optionValue]["is_current"] = true
    hideOptionsBox(ident)
  })

   $("#product-name-float-inp").change((e) => {
      currentProduct["name"] = e.target.value
   })

   $("#product-description-textarea").change((e) => {
      currentProduct["description"] = e.target.value
   })

   $("#product-price-float-inp").change((e) => {
      currentProduct["price"] = Number(e.target.value)
   })
 
   $("#save-product-btn").click(() => {
     const ajaxConfig = {
       url: "", 
       method: "", 
       data: null
     }
 
     if (currentProduct["id"]) {

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
       ajaxConfig["url"] = `admin/quan-ly-thuc-don/san-pham/${currentProduct.id}`
       ajaxConfig["method"] = "PUT"
       ajaxConfig["data"] = JSON.stringify(payload)
     } else {
       currentProduct["addon_options"] = Object.keys(addons).filter((e) => addons[e]["is_current"])
       ajaxConfig["url"] = "admin/quan-ly-thuc-don/san-pham"
       ajaxConfig["method"] = "POST"
       ajaxConfig["data"] = currentProduct
     } 
     callAjax(
       ajaxConfig["url"], 
       null,
       ajaxConfig["method"],
       ajaxConfig["data"]
     )
   })
 })