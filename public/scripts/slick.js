$(document).ready(() => {
   // const containerHorzMargin = 25

   const gap = 20
   const itemsShow = 3
   // let currentWindowWidth = $(window).width

   $(".home__menu-main .items").css("column-gap", gap)

   function calculate() {
      containerWidth = $(".home__menu-main .items-container").width()
      itemWidth = (containerWidth - ((itemsShow - 1) * gap)) / itemsShow
      $(".item").css("width", itemWidth)

      let translateX = 0

      $(".home__menu-nav-button#next").click(() => {
         translateX -= itemWidth + gap
         $(".home__menu-main .items").css("transform", `translateX(${translateX}px)`)
      })

      $(".home__menu-nav-button#prev").click(() => {
         translateX += itemWidth + gap
         $(".home__menu-main .items").css("transform", `translateX(${translateX}px)`)
      })
   }

   $(window).resize(() => {
      // translateX = translateX * $(window).width() / currentWindowWidth 
      // currentWindowWidth = $(window).width
      // $(".home__menu-main .items").css("transform", `translateX(${translateX}px)`)
      calculate()
   }) 

   calculate()

   // handle data 
   $(".home__menu-tabs").delegate(".home__menu-tab button", "click", function() {
      const categoryId = $(this).data("category-id")
      console.log("hey hey2")
      $.ajax({
         url: `http://localhost/pizza-complete-version/thuc-don/danh-muc/${categoryId}/san-pham`,
         method: "GET"
      }).done((response) => {
         const { code, message, body } = JSON.parse(response) 
         console.log(response)
         if (code === 200 && message === "200 OK") {
            $(".home__menu-main .items").html("")
            $.each(body, (i, product) => {
               const { id, product_name, price, image, description } = product
               $(".home__menu-main .items").append(`
                  <div class="item">
                     <div class="item__image">
                        <img src="/pizza-complete-version/public/images/products/${image}" alt="">
                     </div>
                     <p class="item__name">${product_name}</p>
                     <p class="item__price">${price}đ</p>
                     <p class="item__desc">${description}</p>
                     <button class="item__detail-button"><a href="/pizza-complete-version/thuc-don/${id}">Xem chi tiết</a></button>
                  </div>
               `)
            })
            calculate()
         }
      })
   })
})