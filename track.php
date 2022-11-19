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
    <h1 class="text-center m-2">ติดตามการสั่งซื้อ</h1>
    </div>
  </div>
</div>

<?php
class MyDB extends SQLite3 {
  function __construct() {
    $this->open('./db/orderlist.db');
  }
}

if (isset($_GET['order']) && strcmp($_GET['order'], "") != 0) {
  $db = new MyDB();
  $sql = "SELECT * FROM orderlist WHERE tel = '".$_GET['order']."';";
  $ret = $db->query($sql);
  $row = $ret->fetchArray(SQLITE3_ASSOC);
  $db->close();

  if (is_array($row) == '1') {
    $name = $row['name'];
    $tel = $row['tel'];
    $address = $row['address'];
    $time = $row['time'];
    $foods = $row['foods'];
    $price = $row['price_total'];

    if ($row['finished'] == '1') {
      $status = '<i class="bi bi-check2-circle" style="font-size:200px;"></i><br>
      <h1>อาหารส่งเรีบยร้อย</h1><br>
      <h3>ขอบคุณที่ใช้บริการ</h3>';
    }
    else {
      $status = '<i class="bi bi-clipboard-check-fill" style="font-size:200px;"></i><br>
      <h1>รับคำสั่งซื้อแล้ว</h1><br>
      <h3>เรากำลังประกอบอาหารและจัดส่งอาหาร</h3>';
    }
  }
  else {
    $name = "-";
    $tel = "-";
    $address = "-";
    $time = "-";
    $foods = "-";
    $price = "-";
    $status = '<i class="bi bi-x-circle" style="font-size:200px;"></i><br>
    <h1>ไม่พบข้อมูลในระบบ</h1><br>
    <h3>โปรดตรวจสอบว่าคุณพิมพ์ถูกหรือไม่</h3>';
  }
}
else {
  $name = "-";
  $tel = "-";
  $address = "-";
  $time = "-";
  $foods = "-";
  $price = "-";
  $status = '<i class="bi bi-search" style="font-size:200px;"></i><br>
  <h1>โปรดกรอกหมายเลข</h1><br>
  <h3>เพื่อตรวจสอบการสั่งซื้อของคุณ</h3>';
}
?>

<div class="text-black bg-white bg-opacity-75 p-5">
  <div class="container p-4 mb-5" style="max-width:850px;">
    <div class="text-center mb-5">
      <form action="">
      <div class="input-group input-group-lg">
        <span class="input-group-text" id="inputGroup-sizing-lg">เบอร์โทรศัพท์</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"
        placeholder="เบอร์โทรศัพท์" autocomplete="off" name="order" value="<?php if (isset($_GET['order'])) {echo $_GET['order'];} ?>">
        <input class="btn btn-outline-secondary" type="submit" value="ตรวจสอบ" id="button-addon2"></input>
      </div>
      </form>
      <div class="text-center">
        <?php
        echo $status;
        ?>
      </div>
      <?php ?>
    </div>
    <div class="bg-white rounded-4 shadow-lg p-5 mb-5">
      <h4>ชื่อ นามสกุล</h4><?php echo $name; ?><br><br>
      <h4>เบอร์โทรศัพท์</h4><?php echo $tel; ?><br><br>
      <h4>ที่อยู่</h4><?php echo $address; ?><br><br>
      <hr>
      <h4>เวลาที่สั่ง</h4><?php echo $time; ?><br><br>

      <h4>รายการอาหาร</h4>
      <ul class="list-group list-group-numbered">
      <?php
      if ((isset($_GET['order']) && strcmp($_GET['order'], "") != 0) && is_array($row) == '1') {
        $foodlist_json = json_decode($foods);
        foreach ($foodlist_json as $food) {
          echo '<li class="list-group-item">'.$food[2]
          .'&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge bg-white text-primary border border-1 rounded-pill">x'.$food[0]
          .'</span>&nbsp;<span class="badge bg-primary rounded-pill">'.$food[3].'.-</span></li>';
        }
      }
      else {
        echo "-";
      }
      ?>
      </ul><br>
      <h2>ราคารวม</h2><h1 class="text-primary"><b><?php echo $price; ?> บาท</b></h1>
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
