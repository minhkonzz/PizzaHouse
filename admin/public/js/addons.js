$(document).ready(() => {

  let currentAddon = null
  let currentAddonCopy = null
  let currentAddonOption = null
  let isAddAddon = true

  function resetAddonOption() {
    $("#et").css("display", "none")
    $("#add-addon-val-btn").html("Thêm tùy chọn mới")
    $("#cancel-add-addon-val-btn").css("display", "none")
    $("#addon-val-float-inp").val("")
    $("#addon-val-price-float-inp").val("")
    if (currentAddonOption) currentAddonOption = null
  }

  $("#add-addon-btn").click(() => {
    if (!isAddAddon) isAddAddon = true
    currentAddon = {
      addonId: `AD${Math.floor(Math.random() * 10000).toString().padStart(5, 0)}`, 
      addonName: "", 
      addonOptions: [] 
    }
    $(".modal").modal("show")
  })

  $("#save-addon-btn").click(() => {
    const config = {
      "url": "", 
      "method": "",
      "data": null
    }
    if (!isAddAddon) {
      let addonOptionsChange = []
      const currentAddonOptions = currentAddon.addonOptions
      const currentAddonOptionsCopy = currentAddonCopy.addonOptions
      const currentAddonValIds = currentAddonOptionsCopy.map((e) => e["addon_val_id"])
      addonOptionsChange = [
        ...currentAddonOptions
          .filter((e) => !currentAddonValIds.includes(e["addon_val_id"]))
          .map((e) => { return {...e, status: "ADD"} })
      ]
      currentAddonOptionsCopy.forEach((e) => {
        const be = currentAddonOptions.find((be) => be["addon_val_id"] === e["addon_val_id"])
        if (!be) {
          addonOptionsChange.push({...e, status: "DELETE"})
          return
        }
        if (e["addon_val_id"] !== be["addon_val_id"] || e["addon_val_price"] !== be["addon_val_price"]) {
          addonOptionsChange.push({...be, status: "UPDATE"})
          return;
        }
      })
      
      const { addonId, addonName } = currentAddon
      config["data"] = JSON.stringify(
        addonName !== currentAddonCopy["addonName"] ? 
        { addonId, addonName, addonOptionsChange } : { addonId, addonOptionsChange }
      )
      config["url"] = `http://localhost/pizza-complete-version/quan-ly-thuc-don/thuoc-tinh/${currentAddon.addonId}`
      config["method"] = "PUT"
    } else {
      config["data"] = currentAddon
      config["url"] = "http://localhost/pizza-complete-version/quan-ly-thuc-don/thuoc-tinh"
      config["method"] = "POST"
    }

    $.ajax(config).done((response) => {
      console.log("response when click save addon:", response)
    }).fail((jqXHR, textStatus, errorThrown) => {
      console.log("AJax request failed:" + textStatus + ", " + errorThrown)
    })
  })

  $("#add-addon-val-btn").click(() => {
    const etDisplay = $("#et").css("display")
    if (etDisplay === "none") {
      $("#et").css("display", "grid")
      $("#add-addon-val-btn").html("Thêm tùy chọn")
      $("#cancel-add-addon-val-btn").css("display", "initial")
      return
    }
    if (!currentAddonOption && currentAddon && currentAddon.addonOptions && Array.isArray(currentAddon.addonOptions)) {
      if (currentAddon.addonOptions.length === 0) $("#addon-options").html("")
      const newAddonOption = {
        "addon_val_id": `ADV${Math.floor(Math.random() * 10000).toString().padStart(5, 0)}`, 
        "addon_val": $("#addon-val-float-inp").val(), 
        "addon_val_price": $("#addon-val-price-float-inp").val()
      }
      currentAddon.addonOptions.unshift(newAddonOption)
      $("#addon-options").prepend(`
        <div class="addon-option d-flex justify-content-between align-items-center" data-addon-val-id="${newAddonOption["addon_val_id"]}" style="padding: 18px 12px; background-color: rgb(238, 238, 238); font-weight: 500; margin: 8px 0; border-radius: 7px;">
          <p>${newAddonOption["addon_val"]} - ${newAddonOption["addon_val_price"]}đ</p>
          <button class="addon-val-remove-btn" data-addon-val-id="${newAddonOption["addon_val_id"]}" style="opacity: .8;"><i class="bi bi-dash-circle"></i></button>
        </div>
      `)
      return
    }
    if (currentAddonOption && currentAddon && currentAddon.addonOptions && Array.isArray(currentAddon.addonOptions)) {
      currentAddonOption = {
        ...currentAddonOption, 
        addonVal: $("#addon-val-float-inp").val(), 
        addonValPrice: $("#addon-val-price-float-inp").val()
      }
      const { addonValId, addonVal, addonValPrice } = currentAddonOption
      currentAddon.addonOptions = currentAddon.addonOptions.map((e) => 
        e["addon_val_id"] === addonValId ? 
        { 
          ...e,  
          addon_val: addonVal, 
          addon_val_price: addonValPrice
        } : e
      )
      $(`.addon-option[data-addon-val-id="${addonValId}"] p`).html(`${addonVal} - ${addonValPrice}đ`)
    }
  })

  $("#addon-options").delegate(".addon-option", "click", function(event) {
    event.preventDefault()
    if ($("#et").css("display") === "none") {
      $("#et").css("display", "grid")
      $("#cancel-add-addon-val-btn").css("display", "initial")
    }
    if (currentAddon && currentAddon.addonOptions && Array.isArray(currentAddon.addonOptions)) {
      const addonValId = $(this).data("addon-val-id");
      const addonOptionSelected = currentAddon.addonOptions.find((e) => e["addon_val_id"] === addonValId)
      if (addonOptionSelected) {
        $("#add-addon-val-btn").text("Cập nhật đặc tính")
        currentAddonOption = {
          addonValId: addonOptionSelected["addon_val_id"], 
          addonVal: addonOptionSelected["addon_val"],
          addonValPrice: addonOptionSelected["addon_val_price"]
        }
        $("#addon-val-float-inp").val(currentAddonOption["addonVal"])
        $("#addon-val-price-float-inp").val(currentAddonOption["addonValPrice"])
      }
    }
  })

  $("#cancel-add-addon-val-btn").click(resetAddonOption)

  $("#addon-id-float-inp").prop('disabled', true);
  $("#addon-name-float-inp").on("input", (e) => {
    currentAddon = {
      ...currentAddon, 
      addonName: e.target.value
    }
  })

  $(".modal").on("hidden.bs.modal", resetAddonOption)
  $(".modal").on("show.bs.modal", function() {
    $("#addon-id-float-inp").val(currentAddon.addonId)
    $("#addon-name-float-inp").val(currentAddon.addonName)
    if (isAddAddon) {
      $("#addon-options").html('<p style="opacity: .8; text-align: center;">Chưa có dữ liệu</p>')
      return
    }
    $("#addon-options").html("")
    $.each(currentAddon.addonOptions, function(i, addonOption) {
      $("#addon-options").append(`
        <div class="addon-option d-flex justify-content-between align-items-center" data-addon-val-id="${addonOption["addon_val_id"]}" style="padding: 18px 12px; background-color: rgb(238, 238, 238); font-weight: 500; margin: 8px 0; border-radius: 7px;">
          <p>${addonOption["addon_val"]} - ${addonOption["addon_val_price"]}đ</p>
          <button class="addon-val-remove-btn" data-addon-val-id="${addonOption["addon_val_id"]}" style="opacity: .8;"><i class="bi bi-dash-circle"></i></button>
        </div>
      `)
    })
  })

  $(".addons__list").delegate(".addon-update-btn", "click", function(e) {
    e.preventDefault()
    const addonId = $(this).data("addon-id")
    $.ajax({
      url: `http://localhost/pizza-complete-version/quan-ly-thuc-don/thuoc-tinh/${addonId}`,
      method: "GET"
    }).done((response) => {
      const addon = response.body
      currentAddon = {
        addonId: addon["addon_id"],
        addonName: addon["addon_name"], 
        addonOptions: addon["addon_options"]
      }
      currentAddonCopy = { ...currentAddon };
      if (isAddAddon) isAddAddon = false; 
      $(".modal").modal("show")
      $("#addon-options").delegate(".addon-val-remove-btn", "click", function(event) {
        event.preventDefault()
        event.stopPropagation()
        const addonValId = $(this).data("addon-val-id"); 
        if (currentAddon && currentAddon.addonOptions && Array.isArray(currentAddon.addonOptions)) {
          currentAddon.addonOptions = currentAddon.addonOptions.filter((addonOption) => addonOption["addon_val_id"] !== addonValId)
          $(`.addon-option[data-addon-val-id="${addonValId}"]`).remove()
        }
      })
    }).fail((jqXHR, textStatus, errorThrown) => {
      console.log(jqXHR)
    })
  })

  $("#addon__list").delegate(".addon-remove-btn", "click", function(e) {
    e.preventDefault()
    const addonId = $(this).data("addon-id")
    $.ajax({
      url: `http://localhost/pizza-complete-version/quan-ly-thuc-don/thuoc-tinh/${addonId}`, 
      method: "DELETE", 
      data: JSON.stringify({ addonId: addonId })
    }).done((response, textStatus, jqXHR) => {
      if (jqXHR.status === 200 && textStatus === "success") {
        alert("Delete success")
      }
    }).fail((jqXHR, textStatus, errorThrown) => {
      alert("Delete not success")
    })
  })
})