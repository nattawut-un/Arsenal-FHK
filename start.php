<!DOCTYPE html>
<html lang="en">

<head>
  <?php include './includes/website_head.html' ?>
  <title>หน้าหลัก | Arsenal FHK</title>
</head>

<body onload="startTime(); getCartAmount();">

<?php include './includes/header.php' ?>

<div class="p-5">
  <div class="container text-black">
    <h1 class="mb-4 text-center mb-5">โปรดเลือกเมนูที่ท่านต้องการ</h1>
    <div class="bg-white shadow-lg rounded p-3">
      <div class="row">
        <a
        href="./list.php"
        class="col rounded obj-cover text-white text-center m-3 popup-anim"
        style="background:linear-gradient(to top, rgba(0, 0, 0, .7), rgba(0, 0, 0, .4)), url('./images/start/all.png') center; height:130px;"
        >
          <div class="position-relative top-50">
            <h1>ทั้งหมด</h1>
          </div>
        </a>
      </div>
      <div class="row">
        <a
        href="./list.php?foodtype=rice"
        class="col rounded obj-cover text-white text-center m-3 popup-anim"
        style="background:linear-gradient(to top, rgba(0, 0, 0, .7), rgba(0, 0, 0, .4)), url('./images/start/rice.png') center;"
        >
          <div class="position-relative top-50">
            <h1>กับข้าว</h1>
          </div>
        </a>
        <a
        href="./list.php?foodtype=noodle"
        class="col rounded obj-cover text-white text-center m-3 popup-anim"
        style="background:linear-gradient(to top, rgba(0, 0, 0, .7), rgba(0, 0, 0, .4)), url('./images/start/noodle.png') center;"
        >
          <div class="position-relative top-50">
            <h1>ก๋วยเตี๋ยว</h1>
          </div>
        </a>
      </div>
      <div class="row">
        <a
        href="./list.php?foodtype=drink"
        class="col rounded obj-cover text-white text-center m-3 popup-anim"
        style="background:linear-gradient(to top, rgba(0, 0, 0, .7), rgba(0, 0, 0, .4)), url('./images/start/drink.png') center;"
        >
          <div class="position-relative top-50">
            <h1>เครื่องดื่ม</h1>
          </div>
        </a>
        <a
        href="./list.php?foodtype=icecream"
        class="col rounded obj-cover text-white text-center m-3 popup-anim"
        style="background:linear-gradient(to top, rgba(0, 0, 0, .7), rgba(0, 0, 0, .4)), url('./images/start/icecream.png') center;"
        >
          <div class="position-relative top-50">
            <h1>ไอติม</h1>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>

<?php include './includes/footer.html' ?>

</body>

</html>