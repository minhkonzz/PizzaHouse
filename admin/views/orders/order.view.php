<div class="pagetitle">
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT ?>">Bảng điều khiển</a></li>
      <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT . "/quan-ly-dat-hang" ?>">Quản lý đặt hàng</a></li>
      <li class="breadcrumb-item active"><a href="#">Đơn hàng chi tiết</a></li>
    </ol>
  </nav>
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Đơn hàng chi tiết</h1>
  </div>
</div>
<section class="section order">
  <div class="order-header">
    <div class="order-header__actions">
      <select name="" id="order__states-select">
        <option value="">Chờ tiếp nhận</option>
        <option value="">Đang xử lý</option>
        <option value="">Giao thành công</option>
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
              <p>Anh Hoàng Công Thái</p>
              <p>#KH010239</p>
            </div>  
            <a class="order__main__customer__header-right">Xem chi tiết</a>
          </div>
          <div style="display: grid; grid-template-columns: 1fr 1fr; column-gap: 3rem;">
            <div>
              <div style="margin-bottom: 12px;">
                <span style="display: block; font-weight: 600;">Tên người mua</span>
                <p>Phạm Quang Minh</p>
              </div>
              <div style="margin-bottom: 12px;">
                <span style="display: block; font-weight: 600;">Số điện thoại người mua</span>
                <p>0967105498</p>
              </div>
              <div>
                <span style="display: block; font-weight: 600;">Email người mua</span>
                <p>minhphm37@gmail.com</p>
              </div>
            </div>
            <div>
              <div style="margin-bottom: 12px;">
                <span style="display: block; font-weight: 600;">Tên người nhận</span>
                <p>Trần Hoàng Bách</p>
              </div>
              <div>
                <span style="display: block; font-weight: 600;">Số điện thoại người nhận</span>
                <p>09232323334</p>
              </div>
            </div>
          </div>
          <div style="background: rgb(250, 250, 250); padding: 10px 12px;">
            <p style="font-weight: 600;">Địa chỉ nhận hàng</p>
            <p>Số 94 ngõ 73 Nguyễn Lương Bằng, quận Đống Đa, Hà Nội</p>
          </div>
          <div style="background: rgb(250, 250, 250); padding: 10px 12px;">
            <p style="font-weight: 600;">Ghi chú đơn hàng</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vitae vero saepe officiis optio laboriosam eaque perspiciatis sequi beatae eveniet, consequatur sapiente! Ea corrupti laudantium dolorem quas iste eaque neque facilis.</p>
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
            <tr class="table__row">
              <td>
                <img src="https://img.dominos.vn/Veggie-mania-Pizza-Rau-Cu-Thap-Cam.jpg" alt="">
                <div style="margin-left: 10px;">
                  <p style="font-weight: 600;">Pizza hải sản thập cẩm</p>
                  <p>Loại bánh mềm, cỡ vừa, gấp ba phô mai</p>
                </div>
              </td>
              <td>239.000đ</td>
              <td>2</td>
              <td>435.000đ</td>
              <td>#INVOICE20121</td>
            </tr>
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
              <p style="font-weight: 600; font-size: 14px; color: rgb(140, 140, 140);">Sản phẩm</p>
              <p style="margin-top: 5px; font-weight: 600;">439.000đ</p>
            </div>
            <div style="text-align: center;">
              <p style="font-weight: 600; font-size: 14px; color: rgb(140, 140, 140);">Phí giao hàng</p>
              <p style="margin-top: 5px; font-weight: 600;">439.000đ</p>
            </div>
            <div style="text-align: center;">
              <p style="font-weight: 600; font-size: 14px; color: rgb(140, 140, 140);">Tổng đơn hàng</p>
              <p style="margin-top: 5px; font-weight: 600;">439.000đ</p>
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
          <div style="mar">
            <span style="display: block; font-weight: 600; margin-bottom: 8px;">Trạng thái thanh toán</span>
            <span style="display: inline-block; padding: 7px 12px; border-radius: 4px; font-weight: 600; background: rgb(255, 220, 220); color: rgb(232, 113, 113);">Chưa thanh toán</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>