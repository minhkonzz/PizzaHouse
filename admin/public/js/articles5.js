$(document).ready(() => {
   $("#add-article-btn").click(() => {
      window.location.href = `${host}admin/quan-ly-bai-viet/them-bai-viet`;
   })

   $(".articles").delegate(".remove-btn", "click", function() {
      const articleId = $(this).data("article-id"); 
      // $.ajax({
      //    url: `http://localhost/pizza-complete-version/admin/quan-ly-bai-viet/${articleId}`, 
      //    method: "DELETE"
      // }).done((response) => {
      //    const { code, message, body } = JSON.parse(response) 
      //    if (code === 200 && message === "200 OK") {
      //       alert("delete success")
      //    }
      // }).fail((jqXHR) => {
      //    console.log(jqXHR)
      // })
      callAjax(
         `admin/quan-ly-bai-viet/${articleId}`, 
         (body) => {
            alert("delete success")
         }, 
         "DELETE"
      )
   })
})