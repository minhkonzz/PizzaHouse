<?php 
  list(
    "id" => $product_id, 
    "product_name" => $product_name, 
    "category_name" => $category_name, 
    "price" => $product_price, 
    "image" => $product_image, 
    "description" => $product_description, 
    "currency" => $product_currency, 
    "addons" => $product_addons
  ) = $data["product"]; 
?>
<img width="200" src="<?= "/pizza-complete-version/public/images/products/" . $product_image ?>" alt="product-image">
<p>Tên sản phẩm: <?= $product_name ?></p>
<p>Mô tả sản phẩm: <?= $product_description ?></p>
<p>----------------------</p>
<?php 
  foreach ($product_addons as $addon_id => $addon): ?>
    <div>
      <p><?= $addon["addon_name"] ?></p>
      <div id="addon-<?= $addon_id ?>" style="display: flex;">
      <?php 
        foreach ($addon["addon_options"] as $addon_val_id => $addon_val_detail): 
          list("addon_val" => $addon_val, "addon_val_price" => $addon_val_price) = $addon_val_detail; ?>
          <div style="margin: 0 10px;">
            <input type="radio" name="addon-<?= strtolower($addon_id) ?>-radio" value="<?= $addon_val_id ?>">
            <label><?= $addon_val ?></label>
          </div>
      <?php endforeach ?>
      </div>
    </div>
  <?php endforeach ?>
<p class="product-price">Giá: <?= $product_price ?>đ</p>
<div>
  <button>-</button>
  <span id="qty-add">1</span>
  <button>+</button>
</div>
<button id="add-cart-btn">Thêm giỏ hàng</button>
<button><a href="/pizza-complete-version/views/cart/cart.php">Xem giỏ hàng</a></button>

<script>
  $(document).ready(() => {

    $("#add-cart-btn").click(() => {
      const qtyAdd = Number($("#qty-add").html()) || 1
      const productId = "<?= $product_id ?>"
      const productName = "<?= $product_name ?>"
      const productImage = "<?= $product_image ?>"
      const productPrice = Number("<?= $product_price ?>") || 0
      const productAddons = JSON.parse('<?= json_encode($product_addons) ?>')
      const cartItemAddons = Object.keys(productAddons).map((addonId) => {
        const addonOptionIdSelected = $(`#addon-${addonId} input[name=addon-${addonId.toLowerCase()}-radio]:checked`).val()
        return addonOptionIdSelected ? {
          "addon_val_id": addonOptionIdSelected,  
          "addon_val": productAddons[addonId]["addon_options"][addonOptionIdSelected]["addon_val"],
          "addon_val_price": Number(productAddons[addonId]["addon_options"][addonOptionIdSelected]["addon_val_price"]) || 0
        } : null
      }).filter((e) => !!e);

      const cartItemTotalPrice = cartItemAddons.map((e) => e["addon_val_price"]).reduce((a, b) => a + (b >= productPrice ? b - productPrice : b), productPrice)

      $.ajax({
        url: "http://localhost/pizza-complete-version/cart/add",
        method: "POST", 
        data: {
          "product_id": productId, 
          "product_name": productName, 
          "product_image": productImage, 
          "addons": cartItemAddons, 
          "total_price": cartItemTotalPrice, 
          "qty_add": qtyAdd
        }
      }).done((response) => {
        alert("Add cart OK")
        console.log("response:", response)
      }).fail((jqXHR) => {
        alert("Add cart failed")
      })
    })
  })
</script>
