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
})