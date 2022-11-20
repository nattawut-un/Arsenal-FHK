<?php
if (!isset($_POST['firstName'])) {
  header("location: index.php");
  exit(0);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include './includes/website_head.html' ?>
  <script src="./scripts/cart.js"></script>
  <title>สั่งซื้อสำเร็จ | Arsenal FHK</title>
</head>

<body onload="startTime(); getCartAmount();">

<?php include './includes/header.php' ?>

<div class="p-5">
  <div class="container text-black">
    <h1 class="text-center m-2">ตะกร้าสินค้า</h1>
    </div>
  </div>
</div>

<div class="text-black bg-white bg-opacity-75 p-5">
  <div class="container p-4 mb-5" style="max-width:850px;">
    <div class="text-center mb-5">
      <div class="text-center text-success">
        <i class="bi bi-check2-circle" style="font-size:200px;"></i><br>
        <h1>การสั่งซื้อสำเร็จ</h1><br>
        <h3>ขอบคุณที่ใช้บริการ</h3>
      </div>
    </div>
    <div class="bg-white rounded-4 shadow-lg p-5 mb-5">
      <?php
      class MyDB extends SQLite3 {
        function __construct() {
          $this->open('./db/orderlist.db');
        }
      }

      date_default_timezone_set("Asia/Bangkok");
      $time = date("Y-m-d h:i:sa");
      $first_name = $_POST['firstName'];
      $last_name = $_POST['lastName'];
      $tel = $_POST['tel'];
      $address = $_POST['address'];
      $atm = $_POST['atm'];
      $atm_cvc = $_POST['atm-cvc'];
      $atm_expire_month = $_POST['atm-expire-month'];
      $atm_expire_year = $_POST['atm-expire-year'];
      $foodlist = $_POST['foodlistpost'];
      $total_price = $_POST['pricepost'];

      $foodlist_json = json_decode($foodlist);

      echo "<h4>ชื่อ นามสกุล</h4>" . $first_name . " " . $last_name . "<br><br>";
      echo "<h4>เบอร์โทรศัพท์</h4>" . $tel . "<br><br>";
      echo "<h4>ที่อยู่</h4>" . $address . "<br><br>";
      echo "<h4>หมายเลข ATM</h4>" . $atm . "<br><br>";
      echo "<h4>หมายเลข CVC</h4>" . $atm_cvc . "<br><br>";
      echo "<h4>วันหมดอายุ ATM</h4>" . $atm_expire_month . "-" . $atm_expire_year;
      echo "<hr>";
      echo "<h4>เวลาที่สั่ง</h4>" . $time . "<br><br>";
      echo "<h4>รายการอาหาร</h4>";
      ?>

      <ul class="list-group list-group-numbered">
      <?php
      foreach ($foodlist_json as $food) {
        echo '<li class="list-group-item">'.$food[2]
        .'&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge bg-white text-primary border border-1 rounded-pill">x'.$food[0]
        .'</span>&nbsp;<span class="badge bg-primary rounded-pill">'.$food[3].'.-</span><br><i>'.$food[1].'</i></li>';
      }
      ?>
      </ul><br>
      <h2>ราคารวม</h2><h1 class="text-primary"><b><?php echo $total_price; ?> บาท</b></h1>

      <?php
        $db = new MyDB();

        $sql = <<<EOF
          INSERT INTO
          orderlist (time, name, tel, address, atm, atm_cvc, atm_expire_month, atm_expire_year, foods, price_total, finished)
          VALUES ('$time', '$first_name $last_name', '$tel', '$address', '$atm', '$atm_cvc', '$atm_expire_month', '$atm_expire_year', '$foodlist', '$total_price', '0');
        EOF;
        $ret = $db->exec($sql);
        $db->changes();

        $db->close();
      ?>
    </div>
    <div class="text-center">
      <a class="btn btn-primary btn-lg border border-0 text-white text-bold rounded-pill px-3 py-2" href="index.php">
        <i class="bi bi-house-door-fill me-2"></i>กลับสู่หน้าหลัก
      </a>
    </div>
  </div>
</div>

<!-- prevent form resubmitting upon page refresh -->
<script>
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
</script>

<?php include './includes/footer.html' ?>

</body>

</html>
