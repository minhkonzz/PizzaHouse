$(document).ready(() => {

   const requestedSignup = { state: false }
   const requestedSignin = { state: false }

   const loginFields = {
      "email-inp": {
         "varName": "customerEmail", 
         "value": "",
         "errors": {
            "empty": "Vui lòng nhập Email", 
            "invalidFormat": "Email không đúng định dạng"
         },
         "pattern:": /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/ig,
         "required": true
      }, 
      "pwd-inp": {
         "varName": "customerPassword", 
         "value": "",
         "errors": {
            "empty": "Vui lòng nhập mật khẩu", 
            "invalidFormat": "Mật khẩu phải tối thiểu 8 đến 16 ký tự, chứa ít nhất 1 ký tự đặc biệt và ít nhất 1 ký tự in hoa"
         },
         "pattern": /^(?=.*[A-Z])(?=.*[!@#$&*])(?=.{8,16}).*$/,
         "required": true
      }
   }

   const registerFields = {
      ...loginFields,
      "name-inp": {
         "varName": "customerName", 
         "value": "", 
         "pattern": /^[a-zA-ZÀ-ỹ\s]+$/ig,
         "errors": {
            "empty": "Họ và tên là bắt buộc", 
            "invalidFormat": "Họ tên không được chứa ký tự ngoài chữ"
         },
         "required": true
      }, 
      "phone-inp": {
         "varName": "customerPhone", 
         "value": "",
         "errors": {
            "empty": "Vui lòng nhập điện thoại", 
            "invalidFormat": "Số điện thoại không đúng định dạng"
         },
         "pattern": /^[0-9]+$/ig,
         "required": true
      }, 
      "address-inp": {
         "varName": "customerAddress", 
         "value": "",
         "errors": {
            "empty": "Vui lòng nhập địa chỉ", 
            "invalidFormat": "Địa chỉ không đúng định dạng"
         }, 
         "pattern": /^[a-zA-Z0-9À-ỹ\s]+$/ig,
         "required": true
      }, 
      "usr-inp": {
         "varName": "customerUsername", 
         "value": "",
         "errors": {
            "empty": "Vui lòng nhập tên đăng nhập",
            "invalidFormat": "Tên đăng nhập không đúng định dạng" 
         }, 
         "pattern": /^[a-zA-Z0-9\s]+$/ig,
         "required": true
      }, 
      "pwd-repeat-inp": {
         "varName": "", 
         "value": "",
         "errors": {
            "empty": "Vui lòng nhập mật khẩu", 
            "invalidFormat": "Mật khẩu phải tối thiểu 8 đến 16 ký tự, chứa ít nhất 1 ký tự đặc biệt và ít nhất 1 ký tự in hoa"
         },
         "pattern": /^(?=.*[A-Z])(?=.*[!@#$&*])(?=.{8,16}).*$/,
         "required": true
      }
   }

   function isFieldError(authFields, fieldValue, fieldName) {
      const correctFormat = fieldValue.match(authFields[fieldName]["pattern"])
      const empty = fieldValue.length === 0
      if (!correctFormat || (authFields[fieldName]["required"] && empty)) {
         $(`input[name=${fieldName}] + .error__title`).css("display", "block")
         $(`input[name=${fieldName}] + .error__title`).html(((empty &&  authFields[fieldName]["errors"]["empty"]) || !correctFormat && authFields[fieldName]["errors"]["invalidFormat"]))
         return true
      }
      $(`input[name=${fieldName}] + .error__title`).css("display", "none")
      return false
   }

   function setupFieldListeners(authFields, requestState) {
      Object.keys(authFields).forEach((e) => {
         if (requestState["state"]) {
            requestState["state"] = false
            $(".error__title").css("display", "none")
         }
         $(`input[name=${e}]`).on("input", function() {
            authFields[e]["value"] = $(this).val()
            isFieldError(authFields, authFields[e]["value"], e)
         })
      })
   }

   function sendAuthRequest(authFields, requestState, ajaxConfig) {
      requestState["state"] = true
      const fieldNames = Object.keys(authFields)
      let errorExists = false
      for (let i = 0; i < fieldNames.length; i++) {
         const fieldName = fieldNames[i]
         if (isFieldError(authFields, $(`input[name=${fieldName}]`).val(), fieldName) && !errorExists) errorExists = true
      }
      if (!errorExists) {
         if ($("input[name=pwd-repeat-inp]").length > 0 && $("input[name=pwd-repeat-inp]").val() !== $("input[name=pwd-inp]").val()) {
            $("input[name=pwd-repeat-inp] + .error__title").css("display", "block")
            $("input[name=pwd-repeat-inp] + .error__title").html("Mật khẩu phải trùng khớp với mật khẩu đã nhập")
            return
         }
         callAjax(
            ajaxConfig["url"],
            ajaxConfig["successCallback"], 
            "POST",
            {
               ...Object.keys(authFields)
                  .reduce((acc, cur) => {
                     if (!authFields[cur]["varName"]) return acc
                     const { varName, value } = authFields[cur]
                     return {
                        ...acc, 
                        [varName]: value 
                     }
                  }, {})
            }
         )    
      }
   }

   setupFieldListeners(loginFields, requestedSignin)
   setupFieldListeners(registerFields, requestedSignup)

   $(".auth__req__btn.refresh").click(() => {
      Object.keys(authFields).forEach((e) => {
         $(`.auth__requires input[name=${e}]`).val("")
      })
   })

   $(".auth__req__btn.signin").click(() => {
      console.log("okela1")
      $("#dialog").fadeIn(230)
      sendAuthRequest(loginFields, requestedSignin, {
         url: "dang-nhap", 
         successCallback: (body) => {
            console.log("eheh1")
            $("#dialog__title").html("Đăng nhập thành công")
            $("#dialog-redirect-btn a").html("Đến trang chủ") 
            $("#dialog-redirect-btn a").attr("href", host) 
            $("body").css("overflow-y", "hidden")
            $("#spinner").css("display", "none")
            $("#dialog__main").css("display", "initial")
            setTimeout(() => {
               window.location.href = host
            }, 2000)
         }
      })
   })

   $(".auth__req__btn.signup").click(() => {
      console.log("ahahkkas")
      $("#dialog").fadeIn(230)
      sendAuthRequest(registerFields, requestedSignup, {
         url: "dang-ky", 
         successCallback: (body) => {
            $("#dialog__title").html("Đã đăng ký tài khoản thành công")
            $("#dialog-redirect-btn a").html("Chuyển đăng nhập") 
            $("#dialog-redirect-btn a").attr("href", `${host}dang-nhap`) 
            $("body").css("overflow-y", "hidden")
            $("#spinner").css("display", "none")
            $("#dialog__main").css("display", "initial")
         }
      })
   })
})