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
        aria-selected="true">Thông tin cơ bản về ưu đãi
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
        aria-selected="false">Điều kiện áp dụng
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button 
        class="nav-link" 
        id="discount-actions-tab" 
        data-bs-toggle="tab" 
        data-bs-target="#discount-actions" 
        type="button" 
        role="tab" 
        aria-controls="discount-actions" 
        aria-selected="false">Hành động áp dụng
      </button>
    </li>
  </ul>
  <div class="tab-content pt-2" id="myTabContent">
    <div class="tab-pane fade show active" id="discount-information" role="tabpanel" aria-labelledby="discount-information-tab">
      <div class="card discount-add-part">
        <div class="card-body">
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Mã ưu đãi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Tiêu đề ưu đãi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Mô tả ưu đãi</label>
            <div class="col-sm-10">
              <textarea class="form-control" style="height: 100px"></textarea>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Mã code</label>
            <div class="col-sm-10">
              <div class="input-group">
                <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <span class="input-group-text" id="basic-addon2">Tạo code</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="discount-conditions" role="tabpanel" aria-labelledby="discount-conditions-tab">
      <div class="card discount-add-part">
        <div class="card-body">
          <input class="form-control" type="date">
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="discount-actions" role="tabpanel" aria-labelledby="discount-actions-tab">
      
    </div>
  </div>
</section>