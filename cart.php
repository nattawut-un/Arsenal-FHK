<!DOCTYPE html>
<html lang="en">

<head>
  <?php include './includes/website_head.html' ?>
  <script src="./scripts/cart.js"></script>
  <title>ตะกร้าสินค้า | Arsenal FHK</title>
</head>

<body onload="startTime(); getCartAmount(); showCartList();">

<?php include './includes/header.php' ?>

<div class="p-5">
  <div class="container text-black">
    <h1 class="text-center m-2">ตะกร้าสินค้า</h1>
    </div>
  </div>
</div>

<?php
class MyDB extends SQLite3 {
  function __construct() {
    $this->open('./db/foodlist.db');
  }
}
?>

<div class="text-black bg-white bg-opacity-75 p-5">
  <?php
  $db = new MyDB();
  ?>

  <div class="container p-4" style="max-width:850px;">
    <ol class="list-group list-group-numbered mb-5" id="cartlist">
      <div class="text-center mb-5">
        <div class="spinner-border" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </ol>
    <div class="text-center">
      <a class="btn btn-secondary btn-lg border border-0 text-white text-bold rounded-pill px-3 py-2" href="./list.php">
        <i class="bi bi-bag-fill me-1"></i>เพิ่มรายการ
      </a>
      <button class="btn btn-danger btn-lg border border-0 text-white text-bold rounded-pill px-3 py-2 mx-1" data-bs-toggle="modal" data-bs-target="#delall" id="clear">
        <i class="bi bi-trash-fill me-1"></i>ลบทั้งหมด
      </button>
      <button class="btn btn-primary btn-lg border border-0 text-white text-bold rounded-pill px-3 py-2" data-bs-toggle="modal" data-bs-target="#payment" id="buy" onclick="passTotalPrice()">
        <i class="bi bi-basket2-fill me-1"></i>สั่งซื้อ
        <span class="badge bg-white text-primary rounded-pill ms-1">
          <span id="total">
            0
          </span>
          .-
        </span>
      </button>
      <div class="modal fade shadow-lg text-start" id="payment" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
              <h1 class="modal-title fs-5">ข้อมูลการชำระเงิน</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">
              <p>โปรดกรอกรายละเอียดที่อยู่และข้อมูลการชำระเงินของคุณ</p>
            </div>
            <form method="post" action="finished.php" onsubmit="return confirmBuy()">
              <div class="mx-3">
                <div class="mb-3">
                  <label for="name" class="col-form-label">ชื่อ นามสกุล:</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="ชื่อ" autocomplete="off">
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="นามสกุล" autocomplete="off">
                  </div>
                  <figcaption class="figure-caption text-danger" id="err1"></figcaption>
                </div>
                <div class="mb-3">
                  <label for="tel" class="col-form-label">เบอร์โทรศัพท์:</label>
                  <input type="text" class="form-control" id="tel" name="tel" placeholder="เบอร์โทรศัพท์" autocomplete="off">
                  <figcaption class="figure-caption text-danger" id="err2"></figcaption>
                </div>
                <div class="mb-3">
                  <label for="address" class="col-form-label">ที่อยู่:</label>
                  <textarea class="form-control" id="address" name="address" placeholder="ที่อยู่" autocomplete="off"></textarea>
                  <figcaption class="figure-caption text-danger" id="err3"></figcaption>
                </div>
                <div class="mb-3">
                  <label for="atm" class="col-form-label">รหัส ATM:</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="atm" name="atm" placeholder="รหัส ATM" autocomplete="off">
                    <span class="input-group-text">CVC</span>
                    <input type="text" class="form-control" id="atm-cvc" name="atm-cvc" placeholder="CVC" autocomplete="off">
                  </div>
                  <figcaption class="figure-caption text-danger" id="err4"></figcaption>
                </div>
                <div class="mb-3">
                  <label for="atm-expire" class="col-form-label">วันหมดอายุของบัตร:</label>
                  <div class="input-group">
                    <span class="input-group-text">เดือน</span>
                    <input type="text" class="form-control" id="atm-expire-month" name="atm-expire-month" placeholder="xx" autocomplete="off">
                    <span class="input-group-text">ปี</span>
                    <input type="text" class="form-control" id="atm-expire-year" name="atm-expire-year" placeholder="xx" autocomplete="off">
                  </div>
                  <figcaption class="figure-caption text-danger" id="err5"></figcaption>
                </div>
              </div>
              <hr>
              <div class="modal-footer flex-column border-top-0">
                <h2>ราคาทั้งหมด: <b><span id="total2" class="text-primary">420</span></b> บาท</h2>
                <input type="submit" value="สั่งซื้อ" class="btn btn-lg btn-primary w-100 mx-0 mb-2"></input>
                <button type="button" class="btn btn-lg btn-light w-100 mx-0" data-bs-dismiss="modal"><i class="bi bi-backspace-fill me-2"></i>ยกเลิก</button>
              </div>
              <input type="text" id="foodlistpost" name="foodlistpost" placeholder="foodlist" style="visibility:hidden;">
              <input type="text" id="pricepost" name="pricepost" placeholder="price" style="visibility:hidden;">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="delall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header border-bottom-0">
        <h1 class="modal-title fs-5">ลบทั้งหมด</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body py-0">
        <p>คุณต้องการลบเมนูทั้งหมดหรือไม่</p>
      </div>
      <div class="modal-footer flex-column border-top-0">
        <button type="button" class="btn btn-lg btn-danger w-100 mx-0 mb-2" onclick="localStorage.clear(); location.reload();"><i class="bi bi-trash-fill me-2"></i>ลบ</button>
        <button type="button" class="btn btn-lg btn-light w-100 mx-0" data-bs-dismiss="modal"><i class="bi bi-backspace-fill me-2"></i>ไม่ลบ</button>
      </div>
    </div>
  </div>
</div>

<?php
$db->close();
?>

<?php include './includes/footer.html' ?>

</body>

</html>
