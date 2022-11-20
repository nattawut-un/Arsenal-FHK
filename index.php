<!DOCTYPE html>
<html lang="en">

<head>
  <?php include './includes/website_head.html' ?>
  <title>หน้าหลัก | Arsenal FHK</title>
</head>

<body onload="startTime(); getCartAmount();">

<?php include './includes/header.php' ?>

<div class="bg-black p-5">
  <div class="container text-white">
    <h1 class="mb-4">เมนูแนะนำ</h1>
    <div class="d-flex bg-secondary rounded p-4">

      <div id="carouselExampleCaptions" class="carousel slide w-100" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner w-100">
          <div class="carousel-item active">
            <img src="./images/foods/1.jpg" class="d-block w-100 rounded recommend-image">
            <div class="p-5 text-center">
              <a href="menu.php?id=1" class="btn bg-black rounded-pill px-4 fs-1 text-white">ก๋วยเตี๋ยวคั่วไก่</a>
            </div>
          </div>
          <div class="carousel-item">
            <img src="./images/foods/2.jpg" class="d-block w-100 rounded recommend-image">
            <div class="p-5 text-center">
              <a href="menu.php?id=2" class="btn bg-black rounded-pill px-4 fs-1 text-white">เส้นใหญ่เย็นตาโฟ</a>
            </div>
          </div>
          <div class="carousel-item">
            <img src="./images/foods/3.jpg" class="d-block w-100 rounded recommend-image">
            <div class="p-5 text-center">
              <a href="menu.php?id=3" class="btn bg-black rounded-pill px-4 fs-1 text-white">ผัดซีอิ๊ว</a>
            </div>
          </div>
          <div class="carousel-item">
            <img src="./images/foods/4.jpg" class="d-block w-100 rounded recommend-image">
            <div class="p-5 text-center">
              <a href="menu.php?id=4" class="btn bg-black rounded-pill px-4 fs-1 text-white">ราดหน้า</a>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>
</div>

<a href="./start.php" style="text-decoration:none;">
  <div class="container my-5 p-5">
    <div class="bg-primary bg-gradient shadow-lg text-white text-center rounded-pill p-5" style="backdrop-filter: blur(5px);">
      <h1 style="font-size:500%;">สั่งซื้อ</h1>
    </div>
  </div>
</a>

<div class="bg-white bg-opacity-75 p-5">
  <div class="container text-black">
    <h1 class="mb-4">เมนูยอดฮิต</h1>
    <div class="d-flex bg-white shadow-lg rounded p-4" id="hit-menu">
      <?php
      $foodlist_hit = array();
      for ($i=0; $i<10; $i++) {
        array_push($foodlist_hit, rand(1,80));
      }
      foreach ($foodlist_hit as $id) {
        echo <<<EOF
        <figure class="figure">
        <a href="./menu.php?id=$id"><img src="./images/foods/$id.jpg" class="rounded mx-2" style="height:300px;" onerror="this.src='images/not_found.png';"></a>
        <figcaption class="figure-caption mt-2 ms-2">#$id</figcaption>
        </figure>
        EOF;
      }
      ?>
    </div>
  </div>
</div>

<?php include './includes/footer.html' ?>

</body>

</html>