$(document).ready(() => {
   $("#employee-list-tab").click(() => {
      $("#add-employee-btn").html('<i style="margin-right: 4px;" class="bi bi-plus-circle"></i>Thêm nhân viên')
      $("#add-employee-btn").click(() => {
         window.location.href = "http://localhost/pizza-complete-version/admin/quan-ly-nhan-vien/them-nhan-vien"
      })
   })

   $("#employee-roles-tab").click(() => {
      $("#add-employee-btn").html('<i style="margin-right: 4px;" class="bi bi-plus-circle"></i>Thêm bộ phận')
      $("#add-employee-btn").click(() => {
         window.location.href = "http://localhost/pizza-complete-version/admin/quan-ly-nhan-vien/them-bo-phan"
      })
   })

   $("#employee-roles").delegate(".remove-role-btn", "click", function() {
      const roleId = $(this).data("role-id")
      $(".modal-body").html(`<p>Bạn có chắc muốn xóa bộ phận ${roleId}</p>`)
      $("#confirm-btn").attr("data-role-id", roleId)
      $(".modal").modal("show")
   })

   $("#confirm-btn").click(function() {
      const roleId = $(this).data("role-id")
      $.ajax({
         url: `http://localhost/pizza-complete-version/admin/quan-ly-nhan-vien/bo-phan/${roleId}`,
         method: "DELETE"
      }).done((response) => {
         $(".modal").modal("hide")
      }).fail((jqXHR) => {
         console.log(jqXHR)
      })
   })
})