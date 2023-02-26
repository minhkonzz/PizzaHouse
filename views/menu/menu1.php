<style><?php include "menu1.css"; ?></style>
<div style="height: 0;">
  <?php 
    require_once "./views/header/header.php";
    require_once "./views/short_banner/short_banner.php";
  ?>
  <div style="padding: 40px 140px; display: grid; grid-template-columns: 1fr 3fr; column-gap: 1.5rem;">
    <aside>
      <div style="margin-bottom: 20px;">
        <div style="background-color: var(--primary-color); padding: 16px 12px;">
          <p style="color: #fff; text-transform: uppercase; font-size: 16px; font-weight: 700;">DANH MỤC SẢN PHẨM</p>  
        </div>
        <ul style="list-style: none; background-color: rgb(235, 235, 235);">
          <?php 
            foreach ($data["categories"] as $category): ?>
              <li style="font-size: 14px; padding: 16px 12px; text-transform: uppercase; font-weight: 600;"><a style="text-decoration: none; color: #000;" href="#"><?= $category["category_name"] ?></a></li>
          <?php endforeach ?>
        </ul>
      </div>
      <div style="margin-bottom: 20px;">
        <div style="background-color: var(--primary-color); padding: 16px 12px;">
          <p style="color: #fff; text-transform: uppercase; font-size: 16px; font-weight: 700;">GIÁ SẢN PHẨM</p>  
        </div>
      </div>
      <div style="margin-bottom: 20px;">
        <div style="background-color: var(--primary-color); padding: 16px 12px;">
          <p style="color: #fff; text-transform: uppercase; font-size: 16px; font-weight: 700;">TÍNH NĂNG SẢN PHẨM</p>  
        </div>
        <div style="padding: 12px;">
          <div style="margin-bottom: 20px;">
            <p>Kích cỡ</p>
            <div style="display: flex; align-items: center; margin-top: 8px;">
              <input style="width: 20px; height: 20px;" type="checkbox" name="" id="_c">
              <label style="margin-left: 10px; font-size: 14px;" for="_c">Nhỏ</label>
            </div>
            <div style="display: flex; align-items: center; margin-top: 8px;">
              <input style="width: 20px; height: 20px;"type="checkbox" name="" id="_d">
              <label style="margin-left: 10px; font-size: 14px;" for="_d">Vừa</label>
            </div>
            <div style="display: flex; align-items: center; margin-top: 8px;">
              <input style="width: 20px; height: 20px;" type="checkbox" name="" id="_e">
              <label style="margin-left: 10px; font-size: 14px;" for="_e">Lớn</label>
            </div>
          </div>
          <div>
            <p>Loại bánh</p>
            <div style="display: flex; align-items: center; margin-top: 8px;">
              <input style="width: 20px; height: 20px;" type="checkbox" name="" id="_g">
              <label style="margin-left: 10px; font-size: 14px;" for="_g">Cứng</label>
            </div>
            <div style="display: flex; align-items: center; margin-top: 8px;">
              <input style="width: 20px; height: 20px;" type="checkbox" name="" id="_h">
              <label style="margin-left: 10px; font-size: 14px;" for="_h">Mềm</label>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div style="background-color: var(--primary-color); padding: 16px 12px;">
          <p style="color: #fff; text-transform: uppercase; font-size: 16px; font-weight: 700;">TAGS</p>  
        </div>
        <ul style="padding: 12px; display: flex; list-style: none; flex-wrap: wrap; column-gap: 12px; row-gap: .8rem;">
          <li style="border: .8px solid #000;"><a style="display: inline-block; padding: 12px; font-size: 13px; color: #000;" href="#">Pizza</a></li>
          <li style="border: .8px solid #000;"><a style="display: inline-block; padding: 12px; font-size: 13px; color: #000;" href="#">Pizza hải sản thượng hạng</a></li>
          <li style="border: .8px solid #000;"><a style="display: inline-block; padding: 12px; font-size: 13px; color: #000;" href="#">Thức uống</a></li>
        </ul>
      </div>
    </aside>
    <main>
      <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
          <label style="font-size: 14px; font-weight: 500;" for="_a">Hiển thị</label>
          <select style="border: 1px solid #000; margin-left: 12px; height: 40px;" id="_a" name="menu_size_display">
            <option value="">Mặc định</option>
            <option value="">12</option>
            <option value="">24</option>
          </select>
        </div>
        <div>
          <label style="margin-right: 12px; font-size: 14px; font-weight: 500;" for="_b">Sắp xếp theo</label>
          <select style="border: 1px solid #000; height: 40px;" id="_b" name="menu_arrange_type">
            <option value="">Mặc định</option>
            <option value="">Sắp xếp theo tên (A-Z)</option>
          </select>
        </div>
      </div>
      <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.2rem; margin-top: 20px;">
        <!-- menu item -->
        <?php 
        foreach ($data["products"] as $product): ?>
          <div style="border: .8px solid #000; text-align: center;">   
            <div style="position: relative; ">
              <a href="">
                <img width="200" height="200" src="<?= __DIR_ROOT__ ?>/public/images/products/<?= $product["image"] ?>" alt="">
                <div style="display: flex; position: absolute; bottom: 10%; left: 50%; transform: translateX(-50%); column-gap: .5rem;">
                  <span style="display: flex; justify-content: center; align-items: center; color: #fff; width: 30px; height: 30px; background-color: var(--primary-color);"><ion-icon name="bag-add-outline"></ion-icon></span>
                  <span style="display: flex; justify-content: center; align-items: center; color: #fff; width: 30px; height: 30px; background-color: var(--primary-color);"><ion-icon name="search-outline"></ion-icon></span>
                  <span style="display: flex; justify-content: center; align-items: center; color: #fff; width: 30px; height: 30px; background-color: var(--primary-color);"><ion-icon name="heart-outline"></ion-icon></span>
                </div>
              </a>
            </div>
            <p style="font-size: 16px; font-weight: 500; margin-bottom: 14px;"><?= $product["product_name"] ?></p>
            <p style="font-weight: 500; margin-bottom: 14px; color: var(--primary-color);"><?= $product["price"] ?></p>
            <p style="font-weight: 500; font-size: 12px; line-height: 1.5; margin-bottom: 14px; opacity: .8;"><?= $product["description"] ?></p>
            <button style="margin-bottom: 14px;"><a style="font-weight: 600; display: inline-block; padding: 12px 18px; background-color: var(--primary-color); color: #fff;" href="#">Xem chi tiết</a></button>
          </div>
        <?php endforeach ?>
      </div>
      <div style="display: flex; justify-content: center; margin-top: 20px;">
        <ul style="list-style: none; display: flex; column-gap: .5rem;">
          <li><button style="width: 30px; height: 30px; border: .8px solid #000;"><a style="color: #000; font-weight: 500;" href="#"><ion-icon name="chevron-back-sharp"></ion-icon><ion-icon name="chevron-back-sharp"></ion-icon></a></li>
          <li><button style="width: 30px; height: 30px; border: .8px solid #000;"><a style="color: #000; font-weight: 500;" href="#"><ion-icon name="chevron-back-sharp"></a></button></li>
          <li><button style="width: 30px; height: 30px; border: .8px solid #000;"><a style="color: #000; font-weight: 500;" href="#">1</a></button></li>
          <li><button style="width: 30px; height: 30px; border: .8px solid #000;"><a style="color: #000; font-weight: 500;" href="#">2</a></button></li>
          <li><button style="width: 30px; height: 30px; border: .8px solid #000;"><a style="color: #000; font-weight: 500;" href="#">3</a></button></li>
          <li><button style="width: 30px; height: 30px; border: .8px solid #000;"><a style="color: #000; font-weight: 500;" href="#"><ion-icon name="chevron-forward-sharp"></a></button></li>
          <li><button style="width: 30px; height: 30px; border: .8px solid #000;"><a style="color: #000; font-weight: 500;" href="#"><ion-icon name="chevron-forward-sharp"></ion-icon><ion-icon name="chevron-forward-sharp"></ion-icon></a></button></li>
        </ul>
      </div>
    </main>
  </div>
  <?php require_once "./views/footer/footer.php"; ?>
</div>