<!DOCTYPE html>
<html lang="en">

<head>
  <?php include './includes/website_head.html' ?>
  <script src="./scripts/menu.js"></script>
  <title>รายละเอียด | Arsenal FHK</title>
</head>

<body onload="startTime(); getCartAmount(); renameTitle();">

<?php include './includes/header.php' ?>

<div class="pt-5">
  <div class="text-black">
    <h1 class="text-center">เมนูอาหาร</h1>
  </div>
</div>

<br>

<?php
class MyDB extends SQLite3 {
  function __construct() {
    $this->open('./db/foodlist.db');
  }
}
?>

<div class="text-black bg-white bg-opacity-75 p-5">
  <div class="container"></div>
    <div class="row">
      <div class="col-sm">
          <?php
          $db = new MyDB();
          $sql = "SELECT * FROM foodlist WHERE id =".$_GET['id'];
          $ret = $db->query($sql);
          $row = $ret->fetchArray(SQLITE3_ASSOC);
          $db->close();
          ?>
        <figure class="figure" style="width:100%; object-fit:cover;">
          <img src="./images/foods/<?php echo $row['id']; ?>.jpg"
          class="rounded shadow-lg" style="width:100%; object-fit:cover;"
          onerror="this.src='images/not_found.png';">
          <figcaption class="figure-caption mt-2">ภาพประกอบเพื่อการโฆษณาเท่านั้น</figcaption>
        </figure>
      </div>
      <div class="col">
        <div class="p-3">
          <form name="moreinfo">
            <h1 id="foodname"><?php echo $row['name']; ?></h1>
            <h2><span id="foodprice"><?php echo $row['price']; ?></span> บาท</h2>
            <br><hr><br>
            <p>
              - เลือกจำนวนที่ต้องการสั่ง<br>
              - ระบุสิ่งที่ต้องการเพิ่มเติ่มเกี๋ยวกับเมนูนี้ด้านล่างหากท่านต้องการ<br>
              - ปุ่ม "กลับ" จะนำท่านไปยังหน้ก่อนหน้า<br>
              - ปุ่ม "เพิ่มลงตะกร้า" จะเพิ่มสินค้านั้นลงตะกร้า
            </p>
            <br><hr><br>
            <label>จำนวน : </label><input type="number" name="amount" id="amount" class="btn btn-light mx-2 mb-2 border border-1 shadow-sm text-start" min="1" value="1" style="width:70px;"></input><br>
            <label>เพิ่มเติม : </label><textarea type="text" name="info" id="info" class="btn btn-light mx-2 border border-1 shadow-sm text-start" style="width:300px; height:100px;"></textarea>
            <br><br><br>
            <div>
              <button type="button" onclick="history.back()" class="btn btn-lg btn-secondary rounded-pill me-1 mb-1"><i class="bi bi-backspace-fill me-2"></i>กลับ</button>
              <button type="button" class="btn btn-lg btn-primary rounded-pill mb-1" onclick="addMenu()" id="addmenu">
                <span id="addtxt"></span>
                <i class="bi bi-bag-fill me-0"></i>
                <span class="badge bg-white text-primary rounded-pill ms-1">
                  <span id="will-add">
                    -
                  </span>
                  .-
                </span>
              </button>
              <script>
                let params = new URLSearchParams(document.location.search);
                let price = parseInt(document.getElementById('foodprice').innerHTML);
                document.getElementById('will-add').innerHTML = price;

                document.getElementById('amount').addEventListener('change', (event) => {
                  document.getElementById('will-add').innerHTML = event.target.value * price;
                });

                let menuID = params.get("id");
                let cartList = JSON.parse(localStorage.getItem("cartList"));
                if (cartList == null) {cartList = {};}
                if (menuID in cartList) {
                  document.getElementById("amount").value = parseInt(cartList[menuID][0]);
                  document.getElementById("info").value = cartList[menuID][1];
                  document.getElementById("will-add").innerHTML = cartList[menuID][3];
                  document.getElementById("addmenu").classList.add('btn-warning');
                  document.getElementById("addtxt").innerHTML = "แก้ไข";
                }
                else {
                  document.getElementById("addmenu").classList.add('btn-primary');
                  document.getElementById("addtxt").innerHTML = "เพิ่มลงตะกร้า";
                }
              </script>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>

<?php include './includes/footer.html' ?>

</body>

</html>