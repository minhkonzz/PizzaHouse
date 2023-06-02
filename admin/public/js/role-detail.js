$(document).ready(() => {
   const employeesSelected = {}
   const newEmployees = {}
   const roleId = $(".add-role").data("role-id")

   callAjax(
      `admin/quan-ly-nhan-vien/bo-phan/${roleId}/users`,
      (body) => {
         $(".role__employees").html(`
            <table>
               <tr class="table__fields">
                  <th></th>
                  <th>Mã nhân viên</th>
                  <th>Họ và tên</th>
                  <th>Thời gian tạo</th>
                  <th>Hành động</th>
               </tr>
               <tr class="table__row filters">
                  <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
                  <td><input type="text" placeholder="Mã nhân viên"></td>
                  <td><input type="text" placeholder="Họ và tên"></td>
                  <td><input type="date" placeholder="Thời gian tạo"></td>
                  <td><button id="employees__filter-btn">Tìm kiếm</button></td>
               </tr>
               ${ body.map((employee) => {
                  const { id, firstName, lastName, employeeNumber, created } = employee
                  employeesSelected[id] = {
                     firstName, 
                     lastName, 
                     employeeNumber, 
                     created, 
                     isRemove: false
                  }
                  return `
                     <tr class="table__row">
                        <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
                        <td>${employeeNumber}</td>
                        <td>${firstName + " " + lastName}</td> 
                        <td>${created}</td>
                        <td><button><i class="bi bi-three-dots-vertical"></i></button></td>
                     </tr>
                  `   
               }).join("")}
            </table>
            <div style="margin-top: 25px; height: 35px; text-align: center;">
               <button><i class="bi bi-caret-left-fill"></i></button>
               <button><i class="bi bi-caret-right-fill"></i></button>
            </div>
         `)
      }
   )

   $("#add-employee-btn").click(() => {
      $(".modal").modal("show")
      callAjax(
         "admin/quan-ly-nhan-vien/bo-phan/0", 
         (body) => {
            $(".add-role__dialog__employees").html("")
            Object.keys(employeesSelected).forEach((employeeId) => {
               const { firstName, lastName, employeeNumber } = employeesSelected[employeeId]
               $(".add-role__dialog__employees").append(` 
                  <div class="add-role__dialog__employee">
                     <p><i class="bi bi-person-fill"></i> ${firstName} ${lastName} - ${employeeNumber}</p>
                     <input type="checkbox" data-employee-number="${employeeId}">
                  </div>
               `)
               if (!employeesSelected[employeeId].isRemove) {
                  $(`input[data-employee-number=${employeeId}]`).prop("checked", true)
               }
               $(`input[data-employee-number=${employeeId}]`).change(function() {
                  if ($(this).is(":checked")) {
                     employeesSelected[employeeId].isRemove = false
                     // console.log("employeesSelected:", employeesSelected)
                     return
                  }
                  employeesSelected[employeeId].isRemove = true
                  console.log("employeesSelected:", employeesSelected)
               })
            })
            $.each(body, (i, employee) => {
               const { employeeNumber, firstName, lastName } = employee.profile
               $(".add-role__dialog__employees").append(` 
                  <div class="add-role__dialog__employee">
                     <p><i class="bi bi-person-fill"></i> ${firstName} ${lastName} - ${employeeNumber}</p>
                     <input type="checkbox" data-employee-number="${employee.id}">
                  </div>
               `)
               if (newEmployees[employee.id]) {
                  $(`input[data-employee-number=${employee.id}]`).prop("checked", true)
               }
               $(`input[data-employee-number=${employee.id}]`).change(function() {
                  if ($(this).is(":checked")) {
                     // convert "created" value to YY-MM-DD format
                     const date = new Date(employee.created);
                     const y = date.getUTCFullYear();
                     const m = ("0" + (date.getUTCMonth() + 1)).slice(-2);
                     const d = ("0" + date.getUTCDate()).slice(-2);
                     // add employee 
                     newEmployees[employee.id] = {
                        employeeNumber, 
                        firstName,
                        lastName,
                        created: `${y}-${m}-${d}` 
                     }
                     console.log("new employees:", newEmployees)
                     return
                  }
                  delete newEmployees[employee.id]
                  console.log("new employees:", newEmployees)
               })
            })     
         }
      )
   })

   $("#save-employee-list-btn").click(() => {
      $(".modal").modal("hide")
      $.each(Object.keys(employeesSelected), (i, employeeId) => {
         const { firstName, lastName, employeeNumber, created } = employeesSelected[employeeId]
         $("table").append(`
            <tr class="table__row">
               <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
               <td>${employeeNumber}</td>
               <td>${firstName + " " + lastName}</td> 
               <td>${created}</td>
               <td>
                  <button><i class="bi bi-pencil-square"></i></button>
                  <button><i class="bi bi-three-dots-vertical"></i></button>
               </td>
            </tr>
         `)
      })
   })
})