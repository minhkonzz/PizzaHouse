$(document).ready(() => {
   const employeeNumbersSelected = {}

   $("#add-employee-btn").click(() => {
      $(".modal").modal("show")

      callAjax(
         "admin/quan-ly-nhan-vien/bo-phan/0",
         (body) => {
            $(".add-role__dialog__employees").html("")
            $.each(body, (i, employee) => {
               const { employeeNumber, firstName, lastName } = employee.profile
               $(".add-role__dialog__employees").append(` 
                  <div class="add-role__dialog__employee">
                     <p><i class="bi bi-person-fill"></i> ${firstName} ${lastName} - ${employeeNumber}</p>
                     <input type="checkbox" data-employee-number="${employee.id}">
                  </div>
               `)
               if (employeeNumbersSelected[employee.id]) {
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
                     employeeNumbersSelected[employee.id] = {
                        employeeNumber, 
                        firstName,
                        lastName,
                        created: `${y}-${m}-${d}`
                     }
                     return
                  }
                  delete employeeNumbersSelected[employee.id]
               })
            })  
         }
      )
   //    $.ajax({
   //       url: "http://localhost/pizza-complete-version/admin/quan-ly-nhan-vien/bo-phan/0", 
   //       method: "GET"
   //    }).done((response) => {
   //       const { code, message, body } = JSON.parse(response) 
   //       if (code === 200 && message === "200 OK") {
   //          $(".add-role__dialog__employees").html("")
   //          $.each(body, (i, employee) => {
   //             const { employeeNumber, firstName, lastName } = employee.profile
   //             $(".add-role__dialog__employees").append(` 
   //                <div class="add-role__dialog__employee">
   //                   <p><i class="bi bi-person-fill"></i> ${firstName} ${lastName} - ${employeeNumber}</p>
   //                   <input type="checkbox" data-employee-number="${employee.id}">
   //                </div>
   //             `)
   //             if (employeeNumbersSelected[employee.id]) {
   //                $(`input[data-employee-number=${employee.id}]`).prop("checked", true)
   //             }
   //             $(`input[data-employee-number=${employee.id}]`).change(function() {
   //                if ($(this).is(":checked")) {
   //                   // convert "created" value to YY-MM-DD format
   //                   const date = new Date(employee.created);
   //                   const y = date.getUTCFullYear();
   //                   const m = ("0" + (date.getUTCMonth() + 1)).slice(-2);
   //                   const d = ("0" + date.getUTCDate()).slice(-2);
   //                   // add employee 
   //                   employeeNumbersSelected[employee.id] = {
   //                      employeeNumber, 
   //                      firstName,
   //                      lastName,
   //                      created: `${y}-${m}-${d}`
   //                   }
   //                   return
   //                }
   //                delete employeeNumbersSelected[employee.id]
   //             })
   //          })  
   //       }
   //    }).fail((jqXHR) => {
   //       console.log(jqXHR)
   //    })
   })

   $("#save-employee-list-btn").click(() => {
      $(".modal").modal("hide")
      $.each(Object.keys(employeeNumbersSelected), (i, employeeId) => {
         const { firstName, lastName, employeeNumber, created } = employeeNumbersSelected[employeeId]
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

   $(".create-role").click(() => {
      // $.ajax({
      //    url: "http://localhost/pizza-complete-version/admin/quan-ly-nhan-vien/bo-phan", 
      //    method: "POST", 
      //    data: {
      //       name: $('.field__wrapper[data-ident="role-name"] input').val(), 
      //       description: $('.field__wrapper[data-ident="role-desc"] input').val(), 
      //       employeeIds: Object.keys(employeeNumbersSelected)
      //    }
      // }).done((response) => {
      //    console.log(response)
      // }).fail((jqXHR) => {
      //    console.log(jqXHR)
      // })
      callAjax(
         "admin/quan-ly-nhan-vien/bo-phan", 
         null,
         "POST", 
         {
            name: $('.field__wrapper[data-ident="role-name"] input').val(), 
            description: $('.field__wrapper[data-ident="role-desc"] input').val(), 
            employeeIds: Object.keys(employeeNumbersSelected)
         }
      )
   })

   $(".refresh-role").click(() => {
      $(".custom__field").val("")
   })
})