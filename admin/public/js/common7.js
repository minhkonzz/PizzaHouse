const localEnv = ["localhost", "127.0.0.1"];
const host = localEnv.includes(window.location.hostname) && "http://localhost/pizza-complete-version/" || `${window.location.hostname}/`

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