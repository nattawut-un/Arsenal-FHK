<!DOCTYPE html>
<html lang="en">

<head>
  <?php include './includes/website_head.html' ?>
  <title>รายการอาหาร | Arsenal FHK</title>
</head>

<body onload="startTime(); getCartAmount();">

<?php include './includes/header.php' ?>

<div class="p-5" id="#top">
  <div class="container text-black">
    <h1 class="text-center m-2">รายการอาหาร</h1>
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

<div class="bg-secondary text-white p-2">
  <div class="container">
    <div class="row">
    <!-- javascript:removeQuery('foodtype'); removeQuery('search'); -->
      <a class="col btn btn-secondary text-white text-center fs-5 p-2 rounded-pill rounded-end <?php if (!isset($_GET['foodtype']) || strcmp($_GET['foodtype'], '') == 0) {echo 'bg-dark' ;} ?>" href="list.php">
        ทั้งหมด
      </a>
      <button onclick="addQuery('foodtype', 'rice')" class="col btn btn-secondary text-white text-center fs-5 p-2 rounded-0 <?php if (isset($_GET['foodtype']) && strcmp($_GET['foodtype'], 'rice') == 0) {echo 'bg-dark' ;} ?> ">
        ข้าว
      </button>
      <button onclick="addQuery('foodtype', 'noodle')" class="col btn btn-secondary text-white text-center fs-5 p-2 rounded-0 <?php if (isset($_GET['foodtype']) && strcmp($_GET['foodtype'], 'noodle') == 0) {echo 'bg-dark' ;} ?> ">
        เส้น
      </button>
      <button onclick="addQuery('foodtype', 'drink')" class="col btn btn-secondary text-white text-center fs-5 p-2 rounded-0 <?php if (isset($_GET['foodtype']) && strcmp($_GET['foodtype'], 'drink') == 0) {echo 'bg-dark' ;} ?> ">
        เครื่องดื่ม
      </button>
      <button onclick="addQuery('foodtype', 'icecream')" class="col btn btn-secondary text-white text-center fs-5 p-2 rounded-pill rounded-start <?php if (isset($_GET['foodtype']) && strcmp($_GET['foodtype'], 'icecream') == 0) {echo 'bg-dark' ;} ?> ">
        ไอติม
      </button>
    </div>
  </div>
</div>

<div class="text-black bg-white bg-opacity-75 p-5 pb-0">
  <h2 class='text-center'>
    <?php
    if (isset($_GET['search'])) {
      if (strcmp($_GET['search'], "") == 0) {
        echo "รายการทั้งหมด";
      }
      else {
        echo "ผลการค้นหา '".$_GET['search']."'";
      }
    }
    else if (isset($_GET['foodtype'])) {
      if (strcmp($_GET['foodtype'], 'rice') == 0) {
        echo "ข้าว";
      }
      else if (strcmp($_GET['foodtype'], 'noodle') == 0) {
        echo "เส้น";
      }
      else if (strcmp($_GET['foodtype'], 'drink') == 0) {
        echo "เครื่องดื่ม";
      }
      else if (strcmp($_GET['foodtype'], 'icecream') == 0) {
        echo "ไอติม";
      }
      else {
        echo "รายการทั้งหมด";
      }
    }
    else {
      echo "รายการทั้งหมด";
    }
    ?>
  </h2>



  <div class="position-relative" style="z-index:727;">
    <div class="position-absolute top-0 start-50 translate-middle-x">
      <button type="button" class="btn btn-secondary dropdown-toggle rounded-pill" data-bs-toggle="dropdown" aria-expanded="false">
        <?php
        if (isset($_GET['sort'])) {
          if (strcmp($_GET['sort'], 'id-desc') == 0) {
            echo "ล่าสุด";
          }
          else if (strcmp($_GET['sort'], 'id-asc') == 0) {
            echo "ปกติ";
          }
          else if (strcmp($_GET['sort'], 'name-asc') == 0) {
            echo "ชื่อ (ก->ฮ)";
          }
          else if (strcmp($_GET['sort'], 'name-desc') == 0) {
            echo "ชื่อ (ฮ->ก)";
          }
          else if (strcmp($_GET['sort'], 'price-asc') == 0) {
            echo "ราคา (น้อย->มาก)";
          }
          else if (strcmp($_GET['sort'], 'price-desc') == 0) {
            echo "ราคา (มาก->น้อย)";
          }
        }
        else {
          echo "จัดเรียงโดย";
        }
        ?>
      </button>
      <ul class="dropdown-menu rounded-4 shadow">
        <li><button class="dropdown-item" onclick="addQuery('sort', 'id-asc')">ปกติ</button></li>
        <li><button class="dropdown-item" onclick="addQuery('sort', 'id-desc')">ล่าสุด</button></li>
        <li><hr class="dropdown-divider"></li>
        <li><button class="dropdown-item" onclick="addQuery('sort', 'name-asc')">ชื่อ (ก->ฮ)</button></li>
        <li><button class="dropdown-item" onclick="addQuery('sort', 'name-desc')">ชื่อ (ฮ->ก)</button></li>
        <li><hr class="dropdown-divider"></li>
        <li><button class="dropdown-item" onclick="addQuery('sort', 'price-asc')">ราคา (น้อย->มาก)</button></li>
        <li><button class="dropdown-item" onclick="addQuery('sort', 'price-desc')">ราคา (มาก->น้อย)</button></li>
      </ul>
    </div>
  </div>

  <div class="offcanvas offcanvas-start shadow-5" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
    <form action="list.php">
      <div class="offcanvas-header">
        <h3 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">ตั้งค่า</h3>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <h4>คำค้นหา</h4>
        <input class="btn btn-light text-start border rounded-pill" type="search" placeholder="ค้นหา" aria-label="Search" name="search" autocomplete="off">
        <hr>
        <h4>ประเภทอาหาร</h4>
        <div>
          <input type="radio" class="btn-check" id="foodtype1" name="foodtype" value="" <?php if (!isset($_GET['foodtype']) || strcmp($_GET['foodtype'], '') == 0) {echo "checked";} ?>>
          <label class="btn btn-outline-secondary rounded-pill me-1" for="foodtype1">ทั้งหมด</label>
          <input type="radio" class="btn-check" id="foodtype2" name="foodtype" value="rice" <?php if (isset($_GET['foodtype']) && strcmp($_GET['foodtype'], 'rice') == 0) {echo "checked";} ?>>
          <label class="btn btn-outline-secondary rounded-pill me-1" for="foodtype2">ข้าว</label>
          <input type="radio" class="btn-check" id="foodtype3" name="foodtype" value="noodle" <?php if (isset($_GET['foodtype']) && strcmp($_GET['foodtype'], 'noodle') == 0) {echo "checked";} ?>>
          <label class="btn btn-outline-secondary rounded-pill me-1" for="foodtype3">เส้น</label>
          <input type="radio" class="btn-check" id="foodtype4" name="foodtype" value="drink" <?php if (isset($_GET['foodtype']) && strcmp($_GET['foodtype'], 'drink') == 0) {echo "checked";} ?>>
          <label class="btn btn-outline-secondary rounded-pill me-1" for="foodtype4">เครื่องดื่ม</label>
          <input type="radio" class="btn-check" id="foodtype5" name="foodtype" value="icecream" <?php if (isset($_GET['foodtype']) && strcmp($_GET['foodtype'], 'icecream') == 0) {echo "checked";} ?>>
          <label class="btn btn-outline-secondary rounded-pill me-1" for="foodtype5">ไอติม</label>
        </div>
        <hr>
        <h4>จัดเรียงโดย</h4>
        <div>
          <input type="radio" class="btn-check" id="sort1" name="sort" value="id-asc" <?php if (!isset($_GET['sort']) || (isset($_GET['sort']) && strcmp($_GET['sort'], 'id-asc') == 0)) {echo "checked";} ?>>
          <label class="btn btn-outline-secondary rounded-pill me-1" for="sort1">ปกติ</label>
          <input type="radio" class="btn-check" id="sort2" name="sort" value="id-desc" <?php if (isset($_GET['sort']) && strcmp($_GET['sort'], 'id-desc') == 0) {echo "checked";} ?>>
          <label class="btn btn-outline-secondary rounded-pill me-1" for="sort2">ล่าสุด</label>
          <input type="radio" class="btn-check" id="sort3" name="sort" value="name-asc" <?php if (isset($_GET['sort']) && strcmp($_GET['sort'], 'name-asc') == 0) {echo "checked";} ?>>
          <label class="btn btn-outline-secondary rounded-pill me-1" for="sort3">ชื่อ (ก->ฮ)</label>
          <input type="radio" class="btn-check" id="sort4" name="sort" value="name-desc" <?php if (isset($_GET['sort']) && strcmp($_GET['sort'], 'name-desc') == 0) {echo "checked";} ?>>
          <label class="btn btn-outline-secondary rounded-pill me-1" for="sort4">ชื่อ (ฮ->ก)</label>
          <input type="radio" class="btn-check" id="sort5" name="sort" value="price-asc" <?php if (isset($_GET['sort']) && strcmp($_GET['sort'], 'price-asc') == 0) {echo "checked";} ?>>
          <label class="btn btn-outline-secondary rounded-pill me-1" for="sort5">ราคา (น้อย->มาก)</label>
          <input type="radio" class="btn-check" id="sort6" name="sort" value="price-desc" <?php if (isset($_GET['sort']) && strcmp($_GET['sort'], 'price-desc') == 0) {echo "checked";} ?>>
          <label class="btn btn-outline-secondary rounded-pill me-1" for="sort6">ราคา (มาก->น้อย)</label>
        </div>
        <hr>
        <button class="btn btn-lg btn-primary rounded-pill">ค้นหา</button>
      </div>
    </form>
  </div>

  <div class="container d-flex p-4 mt-5">

    <?php
    $sql = "SELECT * FROM foodlist";

    if (isset($_GET['search']) && strcmp($_GET['search'], "") != 0) {
      $sql .= " WHERE name like '%".$_GET['search']."%'";
    }
    if (isset($_GET['foodtype']) && strcmp($_GET['foodtype'], "") != 0) {
      if (isset($_GET['search']) && strcmp($_GET['search'], "") != 0) {
        $sql .= " AND";
      }
      else {
        $sql .= " WHERE";
      }
      if (strcmp($_GET['foodtype'], 'rice') == 0) {
        $sql .= " foodType = 'rice'";
      }
      else if (strcmp($_GET['foodtype'], 'noodle') == 0) {
        $sql .= " foodType = 'noodle'";
      }
      else if (strcmp($_GET['foodtype'], 'drink') == 0) {
        $sql .= " foodType = 'drink'";
      }
      else if (strcmp($_GET['foodtype'], 'icecream') == 0) {
        $sql .= " foodType = 'icecream'";
      }
    }
    if (isset($_GET['sort'])) {
      if (strcmp($_GET['sort'], 'id-asc') == 0) {
        $sql .= " ORDER BY id ASC";
      }
      else if (strcmp($_GET['sort'], 'id-desc') == 0) {
        $sql .= " ORDER BY id DESC";
      }
      else if (strcmp($_GET['sort'], 'name-asc') == 0) {
        $sql .= " ORDER BY name ASC";
      }
      else if (strcmp($_GET['sort'], 'name-desc') == 0) {
        $sql .= " ORDER BY name DESC";
      }
      else if (strcmp($_GET['sort'], 'price-asc') == 0) {
        $sql .= " ORDER BY price ASC";
      }
      else if (strcmp($_GET['sort'], 'price-desc') == 0) {
        $sql .= " ORDER BY price DESC";
      }
    }

    $haveitem = false;

    $db = new MyDB();
    $ret = $db->query($sql);

    echo '<div class="row row-cols-4">';
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
      $haveitem = true;
      $name = $row['name'];
      $price = $row['price'];
      $food_id = $row['id'];
      $foodtype = $row['foodType'];

      echo <<<EOF
      <div class="card m-3 shadow rounded-4 popup-anim $foodtype" style="width: 18rem;">
      <img class="card-img-top mt-3 rounded-3 shadow-sm border border-1" 
      style="aspect-ratio: 4/3; object-fit: cover;" src="./images/foods/$food_id.jpg"
      onerror="this.src='images/not_found.png';">
      <div class="card-body">
      <h5 class="card-title">$name</h5>
      <p class="card-text">$price บาท</p>
      <a href="./menu.php?id=$food_id" class="btn btn-primary rounded-pill" style="transform:scale(1.2);">
      <i class="bi bi-plus-circle-fill me-1"></i>เพิ่ม</a>
      </div>
      </div>
      EOF;
    }
    echo '</div>';

    $db->close();

    if (!$haveitem) {
      echo <<<EOF
      <div class="text-center mx-auto">
      <i class="bi bi-slash-circle" style="font-size:200px;"></i><br>
      <h1>ไม่พบสินค้าที่ค้นหา</h1><br>
      <h3>ลงอค้นหาด้วยคำอื่น หรือในหมวดหมู่อื่น</h3>
      </div>
      EOF;
    }
    ?>

    <!-- <div class="card m-3" style="width: 18rem;">
      <img class="card-img-top" src="..." alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div> -->

  </div>
  <a class="btn btn-secondary rounded-bottom rounded-pill sticky-bottom fs-4 px-4 pt-2 me-1 shadow" type="button" href="#top">
    <i class="bi bi-chevron-up"></i>
  </a>
  <button class="btn btn-secondary rounded-bottom rounded-pill sticky-bottom fs-4 px-4 pt-2 shadow" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
    <i class="bi bi-list me-1"></i>จัดเรียงโดย
  </button>
</div>


<?php include './includes/footer.html' ?>

</body>

</html>