<style><?php include "cart.css"; ?></style>
<div style="height: auto;">
  <?php 
    require_once "./views/header/header.php"; 
    require_once "./views/short_banner/short_banner.php";
  ?>
  <main class="cart">
    <div class="cart-main">
      <form class="cart__items">
        <table class="cart__table">
          <tr class="cart__table__fields">
            <th></th>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
          </tr>
          <tr class="cart__table__item">
            <td class="cart__table__item__remove"><a href="#">x</a></td>
            <td class="cart__table__item__product">
              <img class="cart__table__item__image" width="80" height="80" src="https://pizzahouse.themerex.net/wp-content/uploads/2016/08/product-6.png" alt="">
              <a class="cart__table__item__options" href="#">Burrata - American style, Medium</a>
            </td>
            <td class="cart__table__item__price">$25.00</td>
            <td class="cart__table__item__qty"><input class="cart__table__item__qty-input" type="number" min="1" value="1"></td>
            <td class="cart__table__item__subtotal">$50.00</td>
          </tr>
        </table>
      </form>
      <div class="cart__total">
        <h3 class="cart__total__title">Cart totals</h3>
        <div class="cart__total-detail">
          <div class="cart__total-part">
            <span class="cart__total-part__title">Subtotal</span>
            <span class="cart__total-part__value">$60.00</span>
          </div>
          <div class="cart__total-part">
            <span class="cart__total-part__title">Total</span>
            <span class="cart__total-part__value">$100.00</span>
          </div>
        </div>
        <a class="cart__total__checkout-button">PROCEED TO CHECKOUT</a>
      </div>
    </div>
  </main>
  <?php require_once "./views/footer/footer.php"; ?>
</div>