<!DOCTYPE html>
<html lang="en">

<head>
  <?php include './includes/website_head.html' ?>
  <title>หน้า Admin | Arsenal FHK</title>
</head>

<body onload="">

<?php
class MyDB extends SQLite3 {
  function __construct() {
    $this->open('./db/orderlist.db');
  }
}
$db = new MyDB();

if (isset($_POST['finish'])) {
  $sql = "UPDATE orderlist SET finished = '1' WHERE id = '".$_POST['finish']."'";
  $ret = $db->exec($sql);
}
else if (isset($_POST['delete'])) {
  $sql = "DELETE FROM orderlist WHERE id = (SELECT MAX(id) FROM orderlist)";
  $ret = $db->exec($sql);
}
else if (isset($_POST['delete_all'])) {
  $sql = "DELETE FROM orderlist";
  $ret = $db->exec($sql);
}
?>

<div class="p-3 bg-secondary text-white d-flex">
  <h5>Admin Panel</h5>
  <!-- &nbsp;&nbsp;>>>&nbsp;&nbsp;
  <h5><a href="index.php" class="text-white">Home</a></h5>&nbsp;&nbsp;|&nbsp;&nbsp;
  <h5><a href="admin.php" class="text-white">Admin</a></h5> -->
</div>

<div class="text-black bg-white bg-opacity-75 p-5">
  <h1 class="text-center">ORDER HISTORY</h1>
  <div class="position-relative">
    <div class="position-absolute top-0 start-50 translate-middle-x">
      <a href="admin.php" class="btn btn-secondary rounded-pill">Refresh</a>
    </div>
  </div><br><br><hr>

  <h2 class="text-center">Active</h2>
  <table class="table table-striped table-hover">
    <thead>
      <tr class="table-primary">
        <td><b>#</b></td>
        <td><b>เวลา</b></td>
        <td><b>ชื่อ</b></td>
        <td><b>เบอร์</b></td>
        <td><b>ที่อยู่</b></td>
        <td><b>รายการอาหาร</b></td>
        <td><b>ราคาทั้งหมด</b></td>
        <td><b>เสร็จแล้ว</b></td>
      </tr>
    </thead>
    <tbody class="bg-white">
      <?php
      $sql = "SELECT * FROM orderlist WHERE finished = '0' ORDER BY id DESC;";
      $ret = $db->query($sql);
      while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
        echo '<tr>';
        echo '<td><b>'.$row['id'].'</b></td>';
        echo '<td>'.$row['time'].'</td>';
        echo '<td><b>'.$row['name'].'</b></td>';
        echo '<td>'.$row['tel'].'</td>';
        echo '<td>'.$row['address'].'</td>';
        echo '<td>';
        $json = json_decode($row['foods']);
        foreach ($json as $food) {
          echo '<li class="list-group-item">'.$food[2]
          .'&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge bg-white text-primary border border-1 rounded-pill">x'.$food[0]
          .'</span>&nbsp;<span class="badge bg-primary rounded-pill">'.$food[3].'.-</span><br>
          <span class="text-black-50"><i>'.$food[1].'</i></span></li>';
        }
        echo '</td>';
        echo '<td><b>'.$row['price_total'].'</b></td>';
        echo '<form method="post" action="">';
        echo '<td><button type="submit" class="btn btn-sm btn-primary rounded-pill m-0" name="finish" value="'.$row['id'].'">เสร็จแล้ว</button></td>';
        echo '</form">';
        echo '</tr>';
      }
      ?>
    </tbody>
  </table><hr>

  <h2 class="text-center">Finished</h2>
  <div class="position-relative">
    <div class="position-absolute top-0 start-50 translate-middle-x">
      <form method="post" action="">
        <button type="submit" class="btn btn-danger rounded-pill" name="delete" value="delete">DELETE LAST ROW</button>
        <button type="submit" class="btn btn-danger rounded-pill" name="delete_all" value="delete_all">DELETE EVERYTHING</button>
      </form>
    </div>
  </div>
  <br><br>
  <table class="table table-striped table-hover">
    <thead>
      <tr class="table-success">
        <td><b>#</b></td>
        <td><b>เวลา</b></td>
        <td><b>ชื่อ</b></td>
        <td><b>เบอร์</b></td>
        <td><b>ที่อยู่</b></td>
        <td><b>รายการอาหาร</b></td>
        <td><b>ราคาทั้งหมด</b></td>
      </tr>
    </thead>
    <tbody class="bg-white">
      <?php
      $sql = "SELECT * FROM orderlist WHERE finished = '1' ORDER BY id DESC;";
      $ret = $db->query($sql);
      while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
        echo '<tr>';
        echo '<td><b>'.$row['id'].'</b></td>';
        echo '<td>'.$row['time'].'</td>';
        echo '<td><b>'.$row['name'].'</b></td>';
        echo '<td>'.$row['tel'].'</td>';
        echo '<td>'.$row['address'].'</td>';
        echo '<td>';
        $json = json_decode($row['foods']);
        foreach ($json as $food) {
          echo '<li class="list-group-item">'.$food[2]
          .'&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge bg-white text-primary border border-1 rounded-pill">x'.$food[0]
          .'</span>&nbsp;<span class="badge bg-primary rounded-pill">'.$food[3].'.-</span><br>
          <span class="text-black-50"><i>'.$food[1].'</i></span></li>';
        }
        echo '</td>';
        echo '<td><b>'.$row['price_total'].'</b></td>';
        echo '</tr>';
      }
      $db->close();
      ?>
    </tbody>
  </table>
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