$(document).ready(() => {

  let currentCategory = null; 

  $("#category-id-float-inp").prop("disabled", true)
  $(".modal").on("hidden.bs.modal", () => {
    $("#category-id-float-inp").val("")
    $("#category-name-float-inp").val("")
    currentCategory = null
  })

  $("#add-category-btn").click(() => { $(".modal").modal("show") })

  $("#category__list").delegate(".category-update-btn", "click", function() {
    const categoryId = $(this).data("category-id") 
    $.ajax({
      url: `http://localhost/pizza-complete-version/admin/quan-ly-thuc-don/danh-muc/${categoryId}`,
      method: "GET"
    }).done((response) => {
      const { code, message, body } = JSON.parse(response)
      if (code === 200 && message === "200 OK") {
        const { id, category_name: categoryName } = body
        currentCategory = { id, categoryName }
        $(".modal").modal("show")
      }
    }).fail((jqXHR, textStatus, errorThrown) => {
      console.log("get category by id failed:", jqXHR)
    })
  })

  $("#category__list").delegate(".category-delete-btn", "click", function() {
    const categoryId = $(this).data("category-id")
    $.ajax({
      url: `http://localhost/pizza-complete-version/admin/quan-ly-thuc-don/danh-muc/${categoryId}`, 
      method: "DELETE"
    }).done((response) => {
      console.log("this is response:", response)
      alert(`Xóa danh mục có mã ${categoryId} thành công`)
      setTimeout(() => { window.location.href = "http://localhost/pizza-complete-version/admin/quan-ly-thuc-don/danh-muc" }, 3000)
    }).fail((jqXHR, textStatus, errorThrown) => {
      console.log(jqXHR)
    })  
  })

  $(".modal").on("show.bs.modal", () => {
    if (currentCategory) {
      $("#category-id-float-inp").val(currentCategory?.id)
      $("#category-name-float-inp").val(currentCategory?.categoryName)
      return
    }
    $("#category-id-float-inp").val(`C${Math.floor(Math.random() * 10000).toString().padStart(5, 0)}`)
    $("#category-name-float-inp").val("")
  })

  $("#save-category-btn").click(() => {
    const categoryId = currentCategory && currentCategory.id || $("#category-id-float-inp").val()
    const categoryName = $("#category-name-float-inp").val()
    $.ajax({
      ...(
        currentCategory ? 
        { 
          url: `http://localhost/pizza-complete-version/admin/quan-ly-thuc-don/danh-muc/${categoryId}`, 
          method: "PUT", 
          data: JSON.stringify({ categoryId, categoryName }) 
        } : 
        { url: "http://localhost/pizza-complete-version/admin/quan-ly-thuc-don/danh-muc", 
          method: "POST", 
          data: { categoryId, categoryName } 
        }
      ) 
    }).done((response) => {
      const { code, message } = JSON.parse(response);
      if (code === 200 && message === "200 OK") {
        window.location.href = "http://localhost/pizza-complete-version/admin/quan-ly-thuc-don/danh-muc";
      }
    }).fail((jqXHR, textStatus, errorThrown) => {
      console.log("fail:", jqXHR)
    })
  })
})