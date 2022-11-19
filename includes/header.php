<!-- <div class="bg-secondary">
  <div class="container text-white py-5 px-4">
    <img src="./images/header-icon.png" class="rounded mb-3" style="filter:grayscale(0%);">
    <h1>Arsenal FHK</h1>
    <h4>Web Technology Project</h1>
  </div>
</div>  -->

<nav class="navbar navbar-expand-lg bg-opacity-75 p-0 sticky-top">
  <div class="container">
    <img src="./images/header-small.ico" class="me-3">
    <button class="btn btn-light navbar-brand text-black rounded-pill rounded-end px-3 my-2 me-0 border border-0" onclick="history.back()">
      <i class="bi bi-backspace-fill"></i>
    </button>
    <a class="btn btn-light navbar-brand text-black rounded-pill rounded-start px-3 border border-0" href="index.php" aria-current="page">
      <i class="bi bi-house-door-fill"></i>
    </a>
    <button class="navbar-toggler border-0 btn btn-light rounded-pill" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-bg-secondary rounded-pill px-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            รายการสินค้า
          </a>
          <ul class="dropdown-menu rounded-4 shadow">
            <li><a class="dropdown-item" href="./list.php">ทั้งหมด</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./list.php?foodtype=rice">ข้าว</a></li>
            <li><a class="dropdown-item" href="./list.php?foodtype=noodle">เส้น</a></li>
            <li><a class="dropdown-item" href="./list.php?foodtype=drink">เครื่องดื่ม</a></li>
            <li><a class="dropdown-item" href="./list.php?foodtype=icecream">ไอติม</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#footer">ติดต่อเรา</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="track.php">ติดตามการสั่งซื้อ</a>
        </li>
      </ul>
      <a id="clock" class="me-2 text-secondary"></a>
      <form class="d-flex" role="search" method="get" action="list.php">
        <input class="form-control btn btn-light text-start border border-1 rounded-pill rounded-end" type="search" placeholder="ค้นหา" aria-label="Search" name="search" autocomplete="off">
        <button class="btn btn-primary me-2 rounded-pill rounded-start" type="submit"><i class="bi bi-search"></i></button>
        <a class="btn btn-success rounded-pill" href="cart.php">
          <b class="bi bi-cart4 d-flex">&nbsp;<span id="cart">
            <div class="spinner-border spinner-border-sm" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
          </span></b>
        </a>
      </form>
    </div>
  </div>
</nav>