$(document).ready(() => {

  let currentCategory = null; 
  let deleteCategoryIds = []

  $(".table__row.filters input[type=checkbox]").change(function() {
    const checkedAll = $(this).prop("checked")
    $(".table__row input[type=checkbox]").prop("checked", checkedAll)
    deleteCategoryIds = checkedAll ? Array.from($(".table__row:not(.filters) input[type=checkbox]")).map((e) => $(e).data("category-id")) : []
    $("#multiple-remove-btn").css("opacity", Number(deleteCategoryIds.length > 0))
    $("#multiple-remove-btn").html(`remove(${deleteCategoryIds.length})`)
  })

  $(".table__row:not(.filters)").delegate("input[type=checkbox]", "change", function() {
     const categoryId = $(this).data("category-id")
     deleteCategoryIds = $(this).prop("checked") ? [ ...deleteCategoryIds, categoryId ] : deleteCategoryIds.filter((e) => e !== categoryId)
     $("#multiple-remove-btn").css("opacity", Number(deleteCategoryIds.length > 0))
     $("#multiple-remove-btn").html(`remove(${deleteCategoryIds.length})`)
  })

  $("#multiple-remove-btn").click(() => {
     callAjax(
        "admin/quan-ly-thuc-don/danh-muc/list", 
        null, 
        "DELETE", 
        JSON.stringify({ removeIds: deleteCategoryIds })
     )
  })

  $("#category-id-float-inp").prop("disabled", true)
  $(".modal").on("hidden.bs.modal", () => {
    $("#category-id-float-inp").val("")
    $("#category-name-float-inp").val("")
    currentCategory = null
  })

  $("#add-category-btn").click(() => { $(".modal").modal("show") })

  $("#category__list").delegate(".category-update-btn", "click", function() {
    const categoryId = $(this).data("category-id") 

    callAjax(
      `admin/quan-ly-thuc-don/danh-muc/${categoryId}`, 
      (body) => {
        const { id, category_name: categoryName } = body
        currentCategory = { id, categoryName }
        $(".modal").modal("show")
      }
    )
  })

  $("#category__list").delegate(".category-delete-btn", "click", function() {
    const categoryId = $(this).data("category-id")
    callAjax(
      `admin/quan-ly-thuc-don/danh-muc/${categoryId}`, 
      (body) => {
        alert(`Xóa danh mục có mã ${categoryId} thành công`)
        setTimeout(() => { window.location.href = `${host}admin/quan-ly-thuc-don/danh-muc` }, 3000)
      },
      "DELETE"
    )
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

    const config = {
      ...(
        currentCategory ? 
        {
          url: `admin/quan-ly-thuc-don/danh-muc/${categoryId}`, 
          method: "PUT", 
          data: JSON.stringify({ categoryId, categoryName }) 
        } : 
        {
          url: "admin/quan-ly-thuc-don/danh-muc", 
          method: "POST", 
          data: { categoryId, categoryName } 
        }
      )
    }

    callAjax(
      config["url"], 
      (body) => {
        const { status, message } = body 
        $(".modal").modal("hide")
        callAjax(
           "admin/quan-ly-thuc-don/danh-muc?json_only=1",  
           (body) => {
              const { categories, current_page, total_pages } = body
              $("#category__list").html(`
                <tr class="table__fields">
                  <th></th>
                  <th>Mã danh mục</th>
                  <th>Tên danh mục</th>
                  <th>Thời gian tạo</th>
                  <th>Số sản phẩm áp dụng</th>
                  <th>Hành động</th>
                </tr>
                <tr class="table__row filters">
                    <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
                    <td><input type="text" placeholder="Mã danh mục"></td>
                    <td><input type="text" placeholder="Tên danh mục"></td>
                    <td><input type="date" placeholder="Thời gian tạo"></td>
                    <td><input type="text" placeholder="Số sản phẩm áp dụng"></td>
                    <td><button id="table__filter-btn">Tìm kiếm</button></td>
                </tr>
                ${categories.map((e) => `
                  <tr class="table__row">
                     <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;" data-category-id="${e["category_id"]}"></td>
                     <td>${e["category_id"]}</td>
                     <td>${e["category_name"]}</td>
                     <td>${e["created_at"]}</td>
                     <td>${e["total_products"]}</td>
                     <td>
                        <div class="table__actions">
                           <button class="category-update-btn table__action" data-category-id="${e["category_id"]}"><i class="bi bi-pencil-square"></i></button>
                           <button class="category-delete-btn table__action" data-category-id="${e["category_id"]}"><i class="bi bi-trash2-fill"></i></button>
                        </div>
                     </td>
                  </tr>
                `).join("")}
              `)
              if (current_page < total_pages) {
                $(".pages__list").html(`
                  <ul class="pagination">
                     <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                           <span aria-hidden="true">«</span>
                        </a>
                     </li>
                     ${new Array(total_pages).fill(0)
                        .map((e, i) => i)
                        .map((e) => `<li class="page-item"><a class="page-link" href="${host}admin/quan-ly-thuc-don/danh-muc?page=${e + 1}"${e === current_page - 1 ? ' style="background: rgb(220, 220, 220);"' : ""}>${e + 1}</a></li>`)
                        .join("")
                      }
                     <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                           <span aria-hidden="true">»</span>
                        </a>
                     </li>
                  </ul>
                `)
              }
              openSideMessage(status, message) 
            }
        )
      }, 
      config["method"],
      config["data"]
    )
  })
})