const localEnv = ["localhost", "127.0.0.1"];
const host = localEnv.includes(window.location.hostname) && "http://localhost/pizza-complete-version/" || "/"

function callAjax(
   url, 
   successCallback, 
   method = "GET", 
   data = null, 
   failureCallback = null, 
   options = {}
) 
{
   $.ajax({
      url: host + url, 
      method, 
      data, 
      ...options
   }).done((response) => {
      if (!successCallback) {
         console.log("response:", response)
         return 
      }
      const { code, message, body } = JSON.parse(response) 
      if (code === 200 && message === "200 OK") successCallback(body)
   }).fail((jqXHR) => {
      if (!failureCallback) {
         console.log(jqXHR)
         return
      }
      failureCallback()
   })
} 

function openSideMessage(status, message) {
   switch (status.toUpperCase()) {
      case "SUCCESS": {
         $("#side__message").html(`
            <i class="bi bi-check-circle-fill"></i>
            ${message}
         `)
         break
      }
      case "WARN": {
         $("#side__message").html(`
            <i class="bi bi-exclamation-diamond-fill"></i>
            ${message}
         `)
         break
      }
      case "FAILED": {
         $("#side__message").html(`
            <i class="bi bi-x-circle-fill"></i>
            ${message}
         `)
         break
      }
   }
   $("#side__message").css("display", "flex")
   $("#side__message").animate({
      right: "1%", 
      opacity: 1
   }, 500, () => {
      setTimeout(() => {
         $("#side__message").animate({
            right: "-1000px", 
            opacity: 0
         }, 500, () => {
            $("#side__message").fadeOut()
         })
      }, 2000)
   })
}