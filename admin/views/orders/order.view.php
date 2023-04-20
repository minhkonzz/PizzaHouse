<?php 
  list("order" => $order, "order_states" => $order_states) = $response->getBody();
  list("meta" => $order_meta_data, "items" => $order_items) = $order; 
?>
<div class="pagetitle">
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT ?>">Bảng điều khiển</a></li>
      <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT . "/quan-ly-dat-hang" ?>">Quản lý đặt hàng</a></li>
      <li class="breadcrumb-item active"><a href="#">Đơn hàng chi tiết</a></li>
    </ol>
  </nav>
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Đơn hàng - <?= $order_meta_data["order_id"] ?></h1>
  </div>
</div>
<section class="section order">
  <div class="order-header">
    <div class="order-header__actions">
      <select name="" id="order__states-select">
        <?php 
          foreach ($order_states as $order_state) {
            echo $order_state["id"] === $order["order_state_id"] ? '<option value="' . $order_state["id"] . '" selected>' . $order_state["order_state"] . '</option>' : 
            '<option value="'. $order_state["id"] .'">' . $order_state["order_state"] .'</option>';
          }
        ?>
      </select>
      <button id="order__state-update-btn">Cập nhật trạng thái đơn</button>
      <button id="order__print">
        <i class="bi bi-printer-fill"></i>
        In đơn hàng
      </button>
    </div>
    <button id="order__remove-btn">Hủy đơn hàng</button>
  </div>
  <div class="order__main">
    <div>
      <div class="order__main__section">
        <div class="order__main__section__header">
          <p style="font-weight: 600;">Thông tin khách hàng</p>
        </div>
        <div class="order__main__section__main">
          <div class="order__main__customer__header">
            <div class="order__main__customer__header-left">
              <i class="bi bi-person-video"></i>
              <p><?= $order_meta_data["name"] ?></p>
              <p><?= $order_meta_data["customer_id"] ?></p>
            </div>  
            <a class="order__main__customer__header-right">Xem chi tiết</a>
          </div>
          <div style="display: grid; grid-template-columns: 1fr 1fr; column-gap: 3rem;">
            <div>
              <div style="margin-bottom: 12px;">
                <span style="display: block; font-weight: 600;">Tên người mua</span>
                <p><?= $order_meta_data["buyer_name"] ?></p>
              </div>
              <div style="margin-bottom: 12px;">
                <span style="display: block; font-weight: 600;">Số điện thoại người mua</span>
                <p><?= $order_meta_data["buyer_phone"] ?></p>
              </div>
              <div>
                <span style="display: block; font-weight: 600;">Email người mua</span>
                <p><?= $order_meta_data["buyer_email"] ?></p>
              </div>
            </div>
            <div>
              <div style="margin-bottom: 12px;">
                <span style="display: block; font-weight: 600;">Tên người nhận</span>
                <p><?= $order_meta_data["receiver_name"] ?></p>
              </div>
              <div>
                <span style="display: block; font-weight: 600;">Số điện thoại người nhận</span>
                <p><?= $order_meta_data["receiver_phone"] ?></p>
              </div>
            </div>
          </div>
          <div style="background: rgb(250, 250, 250); padding: 10px 12px;">
            <p style="font-weight: 600;">Địa chỉ nhận hàng</p>
            <p><?= $order_meta_data["receive_address"] ?>, phường <?= $order_meta_data["ward"] ?>, quận <?= $order_meta_data["district"] ?>, thành phố <?= $order_meta_data["city"]?></p>
          </div>
          <div style="background: rgb(250, 250, 250); padding: 10px 12px;">
            <p style="font-weight: 600;">Ghi chú đơn hàng</p>
            <p><?= $order_meta_data["note"] ?></p>
          </div>
        </div>
      </div>
    </div>
    <div>
      <div class="order__main__section">
        <div class="order__main__section__header">
          <p style="font-weight: 600;">Thông tin đơn hàng</p>
        </div>
        <div class="order__main__section__main">
          <table class="order__items">
            <tr class="table__fields">
              <th>Sản phẩm</th>
              <th>Đơn giá <p style="font-weight: 500;">không bao gồm tax</p></th>
              <th>Số lượng</th>
              <th>Tổng tiền <p style="font-weight: 500;">(không bao gồm tax)</p></th>
              <th>Mã hóa đơn</th>
            </tr>
            <?php 
              foreach ($order_items as $order_item): ?>
                <tr class="table__row">
                  <td>
                    <img src="<?= ROOT_CLIENT . "public/images/products/" . $order_item["order_product_image"] ?>" alt="">
                    <div style="margin-left: 10px;">
                      <p style="font-weight: 600;"><?= $order_item["order_product_name"] ?></p>
                      <p>Loại bánh mềm, cỡ vừa, gấp ba phô mai</p>
                    </div>
                  </td>
                  <td><?= $order_item["order_product_price"] ?>đ</td>
                  <td><?= $order_item["quantity"] ?></td>
                  <td><?= number_format($order_item["order_product_price"] * $order_item["quantity"]) ?>đ</td>
                  <td>#INVOICE20121</td>
                </tr>
            <?php endforeach ?>
          </table>
          <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
              <span>Số sản phẩm hiển thị</span>
              <select style="padding: 6px 8px; border: 1px solid rgb(190, 190, 190); margin-left: 6px; border-radius: 4px;" name="" id="">
                <option value="">6</option>
                <option value="">8</option>
                <option value="">12</option>
              </select>
            </div>
            <button style="padding: 6px 16px; border: .8px solid rgb(150, 150, 150); border-radius: 4px; font-weight: 600; color: rgb(150, 150, 150);">
              <i style="margin-right: 8px;" class="bi bi-ticket-perforated"></i>
              Thêm ưu đãi
            </button>
          </div>
          <div style="display: flex; align-items: center; padding: 24px 100px; justify-content: space-between; background: rgb(250, 250, 250);">
            <div style="text-align: center;">
              <p style="font-weight: 600; font-size: 14px; color: rgb(140, 140, 140);">Tổng đơn hàng</p>
              <p style="margin-top: 5px; font-weight: 600;"><?= $order_meta_data["total"] ?>đ</p>
            </div>
          </div>
        </div>
      </div>
      <div style="margin-top: 20px;" class="order__main__section">
        <div class="order__main__section__header">
          <p style="font-weight: 600;">Thông tin thanh toán</p>
        </div>
        <div class="order__main__section__main">
          <div style="margin-bottom: 12px;">
            <span style="display: block; font-weight: 600;">Phương thức thanh toán</span>
            <p style="font-style: italic;">Thanh toán khi nhận hàng</p>
          </div>
          <div>
            <span style="display: block; font-weight: 600; margin-bottom: 8px;">Trạng thái thanh toán</span>
            <span style="display: inline-block; padding: 7px 12px; border-radius: 4px; font-weight: 600; background: rgb(255, 220, 220); color: rgb(232, 113, 113);">Chưa thanh toán</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>