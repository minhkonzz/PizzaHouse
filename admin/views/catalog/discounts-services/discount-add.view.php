<div class="pagetitle">
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT ?>">Bảng điều khiển</a></li>
      <li class="breadcrumb-item">Quản lý ưu đãi - dịch vụ</li>
      <li class="breadcrumb-item active"><a href="#">Tạo ưu đãi</a></li>
    </ol>
  </nav>
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Tạo ưu đãi</h1>
  </div>
</div>
<section class="section add-discount">  
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button 
        class="nav-link active" 
        id="discount-information-tab" 
        data-bs-toggle="tab" 
        data-bs-target="#discount-information" 
        type="button" 
        role="tab" 
        aria-controls="discount-information" 
        aria-selected="true">Thông tin cơ bản
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button 
        class="nav-link" 
        id="discount-conditions-tab" 
        data-bs-toggle="tab" 
        data-bs-target="#discount-conditions" 
        type="button" 
        role="tab" 
        aria-controls="discount-conditions" 
        aria-selected="false">Thông tin nâng cao
      </button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="discount-information" role="tabpanel" aria-labelledby="discount-information-tab">
      <div class="discount-add-part">
        <div style="display: flex; align-items: center; column-gap: 1.5rem;">
          <label class="discount__lb" for="discount__id"><span style="color: red;">*</span>Mã ưu đãi</label>
          <input class="discount__inp" id="discount__id" type="text">
        </div>
        <div style="display: flex; align-items: center; column-gap: 1.5rem; margin-top: 20px;">
          <label class="discount__lb" for="discount__name"><span style="color: red;">*</span>Tiêu đề ưu đãi</label>
          <input class="discount__inp" id="discount__name" type="text">
        </div>
        <div style="display: flex; align-items: center; column-gap: 1.5rem; margin-top: 20px;">
          <label class="discount__lb" for="discount__description">Mô tả ưu đãi</label>
          <textarea class="discount__inp" id="discount__description"></textarea>
        </div>
        <div style="display: flex; align-items: center; column-gap: 1.5rem; margin-top: 20px;">
          <label class="discount__lb" for="discount__code">Code</label>
          <div style="display: flex;">
            <input class="discount__inp" id="discount__code" type="text">
            <button id="discount__code-generate">Tạo code</button>
          </div>
        </div>
        <div style="display: flex; align-items: center; column-gap: 1.5rem; margin-top: 20px;">
          <label class="discount__lb" for="discount__priority">Độ ưu tiên</label>
          <input style="padding: 8px 12px; width: 120px;" class="discount__inp" id="discount__priority" type="number" min="1" max="3" value="1">
        </div>
        <div style="display: flex; column-gap: 1.5rem; margin-top: 20px;">
          <label class="discount__lb" for="discount__thumbnail">Hình ảnh ưu đãi</label>
          <div style="border-radius: 5px; display: flex; flex-direction: column; padding: 0 14px; justify-content: center; align-items: center; border: .8px dashed gray; height: 150px;">
            <i style="font-size: 28px; color: gray;" class="bi bi-camera"></i>
            <p style="margin-top: 10px; borde">Upload ảnh tại đây (Chỉ chấp nhận định dạng PNG, JPEG)</p>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="discount-conditions" role="tabpanel" aria-labelledby="discount-conditions-tab">
      <div class="discount-add-part">
        <div style="display: flex; align-items: center; column-gap: 1.5rem;">
          <label class="discount__lb"">Thời gian hiệu lực</label>
          <div>
            <input class="discount__datetime-picker" type="datetime-local" style="padding: 8px; width: 250px;">
            <input class="discount__datetime-picker" type="datetime-local" style="margin-left: 8px; padding: 8px; width: 250px;">
          </div>
        </div>
        <div style="display: flex; align-items: center; column-gap: 1.5rem; margin-top: 20px;">
          <label class="discount__lb">Tổng đơn hàng tối thiểu</label>
          <div style="display: flex; column-gap: .5rem;">
            <input class="discount__inp" type="text" value="0">
            <select class="discount__select" name="" id="">
              <option value="">EUR</option>
              <option value="">USD</option>
              <option value="">VND</option>
            </select>
            <select class="discount__select" name="" id="">
              <option value="">Đã bao gồm thuế</option>
              <option value="">Chưa bao gồm thuế</option>
            </select>
            <select class="discount__select" name="" id="">
              <option value="">Đã bao gồm phí ship</option>
              <option value="">Chưa bao gồm phí ship</option>
            </select>
          </div>
        </div>
        <div style="display: flex; align-items: center; column-gap: 1.5rem; margin-top: 20px;">
          <label class="discount__lb" for="discount__total-avaliable">Số lần hiệu lực</label>
          <input class="discount__inp" id="discount__total-avaliable" type="text">
        </div>
        <div style="display: flex; align-items: center; column-gap: 1.5rem; margin-top: 20px;">
          <label class="discount__lb" for="discount__total-avaliable__per-user">Số lần hiệu lực với mỗi khách hàng</label>
          <input class="discount__inp" id="discount__total-avaliable__per-user" type="text">
        </div>
        <div style="display: flex; column-gap: 1.5rem; margin-top: 20px;">
          <label>Miễn phí giao hàng</label>
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
          </div>
        </div>
        <div style="display: flex; column-gap: 1.5rem; margin-top: 20px;">
          <label>Ưu đãi tính theo</label>
          <div>
            <div style="display: flex; align-items: center; column-gap: .5rem;">
              <input type="radio" id="discount__by-percent" name="discount__value-method">
              <label>Phần trăm (%)</label>
            </div>
            <div style="display: flex; align-items: center; column-gap: .5rem; margin-top: 8px;">
              <input type="radio" id="discount__by-amount" name="discount__value-method">
              <label>Số tiền chỉ định</label>
            </div>
          </div>
        </div>
        <div class="c1">
          <label>Phần trăm ưu đãi</label>
          <div>
            <div style="display: flex;">
              <div style="display: flex; justify-content: center; align-items: center; padding: 8px 16px; border: .7px solid rgb(190, 190, 190); border-top-left-radius: 5px; border-bottom-left-radius: 5px; background: rgb(240, 240, 240);">%</div>
              <input style="border-top-left-radius: 0; border-bottom-left-radius: 0; border-left: none;" class="discount__inp" type="text">
            </div>
            <p style="margin-top: 7px; font-style: italic; font-size: 12px; color: gray;">Không áp dụng với phí ship</p>
          </div>
        </div>
        <div class="c2">
          <label>Số tiền giảm giá</label>
          <div style="display: flex; column-gap: .5rem;">
            <input class="discount__inp" type="text">
            <select class="discount__select" name="" id="">
              <option value="">EUR</option>
              <option value="">USD</option>
              <option value="">VND</option>
            </select>
            <select class="discount__select" name="" id="">
              <option value="">Đã bao gồm thuế</option>
              <option value="">Chưa bao gồm thuế</option>
            </select>
          </div>
        </div>
        <div style="display: flex; column-gap: 1.5rem; margin-top: 20px;">
          <label>Ưu đãi áp dụng cho</label>
          <div>
            <div style="display: flex; align-items: center; column-gap: .5rem;">
              <input type="radio" id="discount__apply-order" name="discount__apply-method">
              <label>Đơn hàng (chưa bao gồm phí ship)</label>
            </div>
            <div style="display: flex; align-items: center; column-gap: .5rem; margin-top: 8px;">
              <input type="radio" id="discount__apply-products" name="discount__apply-method">
              <label>Các sản phẩm cụ thể</label>
            </div>
            <div style="margin-top: 20px;">
              <div> <!-- List -->
                <div style="display: flex; align-items: center;">
                  <button style="padding: 5px 9px; border-radius: 4px; font-size: 12px; border: 1px solid rgb(120, 120, 120); font-weight: bold;"><i class="bi bi-x"></i></button>
                  <div style="margin-left: 25px;">
                    <div style="display: flex; align-items: center; column-gap: 1.5rem;">
                      <label class="discount__lb">Số lượng đặt yêu cầu để áp dụng ưu đãi</label>
                      <input class="discount__inp" type="text">
                    </div>
                    <div style="display: flex; align-items: center; column-gap: 1.5rem; margin-top: 20px;">
                      <label class="discount__lb">Tùy chọn sản phẩm được áp dụng ưu đãi</label>
                      <div style="display: flex; column-gap: .5rem;">
                        <select style="width: 350px;" class="discount__select" name="" id="">
                          <option value="">Sản phẩm</option>
                          <option value="">Danh mục</option>
                          <option value="">Thuộc tính</option>
                        </select>
                        <button style="padding: 8px 14px; border: 1px solid rgb(120, 120, 120); color: rgb(120, 120, 120); border-radius: 5px; font-size: 11px; font-weight: 600;">Thêm tùy chọn</button>
                      </div>
                    </div>
                    <div style="margin-top: 20px; width: 800px;">
                      <p style="margin-bottom: 6px;">Áp dụng với các sản phẩm khớp thông tin dưới đây</p>
                      <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; background: rgb(230, 230, 230); border: .8px solid rgb(190, 190, 190);">
                          <p>Danh mục</p>
                          <div>
                            <input style="width: 400px;" class="discount__inp" type="text" disabled value="0">
                            <button style="padding: 8px 16px; border: .8px solid gray; background: #fff; border-radius: 4px;">Chọn</button>
                          </div>
                          <button style="padding: 5px 9px; border-radius: 4px; font-size: 12px; border: 1px solid rgb(120, 120, 120); font-weight: bold; background: #fff;"><i class="bi bi-x"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button style="padding: 8px 14px; border: 1px solid rgb(120,120, 120); color: rgb(120, 120, 120); border-radius: 5px; font-size: 11px; font-weight: 600; margin-top: 12px;">Chọn sản phẩm</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="add-discount__actions">
    <button id="save-new-discount">Lưu</button>
    <button id="cancel-add-discount">Hủy</button>
  </div>
</section>
<script>
  $(document).ready(() => {
    $('input[type="radio"][name="discount__value-method"]').change(() => {
      if ($("#discount__by-percent").is(":checked")) {
        $(".c1").fadeIn()
        $(".c1").css("display", "flex")
        $(".c2").fadeOut()
        return; 
      }
      if ($("#discount__by-amount").is(":checked")) {
        $(".c2").fadeIn()
        $(".c2").css("display", "flex")
        $(".c1").fadeOut()
      }
    })
  })
</script>