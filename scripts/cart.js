

function showCartList() {
  let cartList = JSON.parse(localStorage.getItem("cartList"));
  if (cartList == null || Object.keys(cartList).length == 0) {
    document.getElementById('cartlist').innerHTML = `
    <div class="text-center">
    <i class="bi bi-cart-x" style="font-size:200px;"></i><br>
    <h1>คุณไม่มีสินค้าในตะกร้า</h1><br>
    <h3>คุณสามารถเพิ่มสินค้าได้โดยการเลือกจากหน้ารายการ</h3>
    </div>
    `;
    document.getElementById('clear').setAttribute("disabled", "true");
    document.getElementById('buy').setAttribute("disabled", "true");
  }
  else {
    let everything = "";
    let totalMoney = 0;
    everything += "<h4 class='text-center'>คลิกที่แต่ละเมนูเพื่อแก้ไข</h4>";
    for (let [key, value] of Object.entries(cartList)) {
      everything += `
      <ol class="list-group-item list-group-item-action d-flex justify-content-between align-items-start px-5 py-3 shadow-sm">
        <img src="./images/foods/${key}.jpg"
        class="rounded-circle" style="width:100px; height:100px; object-fit:cover;"
        onerror="this.src='images/not_found.png';">
        <div class="ms-2 me-auto">
          <div class="fw-bold"><a href="http://localhost/menu.php?id=${key}"><h3> ${value[2]} </h3></a></div>`;
          if (value[1] == "") {
            everything += `<p><i>ไม่มีข้อมูลเพิ่มเติม</i></p>`;
          }
          else {
            everything += `<p>${value[1]}</p>`;
          }
        everything += `
        </div>
        <span class="badge text-primary rounded-pill fs-5">x${value[0]}</span>
        <span class="badge bg-primary rounded-pill fs-5">${value[3]}.-</span>
        <button type="button" class="ms-1 btn btn-danger text-white text-bold rounded-pill" data-bs-toggle="modal" data-bs-target="#delmenu-${key}">
          <i class="bi bi-trash-fill"></i>
        </button>
      </ol>
      <div class="modal fade" id="delmenu-${key}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
              <h1 class="modal-title fs-5">ลบ "${value[2]}"</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">
              <p>คุณต้องการลบเมนู ${value[2]} หรือไม่</p>
            </div>
            <div class="modal-footer flex-column border-top-0">
              <button type="button" class="btn btn-lg btn-danger w-100 mx-0 mb-2" onclick="removeItem(${key}); location.reload();"><i class="bi bi-trash-fill me-2"></i>ลบ</button>
              <button type="button" class="btn btn-lg btn-light w-100 mx-0" data-bs-dismiss="modal"><i class="bi bi-backspace-fill me-2"></i>ไม่ลบ</button>
            </div>
          </div>
        </div>
      </div>
      `;
      totalMoney += parseInt(value[3]);
      document.getElementById('cartlist').innerHTML = everything;
    }
    document.getElementById('total').innerHTML = totalMoney;
  }
}

function removeItem(id) {
  let cartList = JSON.parse(localStorage.getItem("cartList"));
  delete cartList[id];
  localStorage.setItem("cartList", JSON.stringify(cartList));
}

function passTotalPrice() {
  document.getElementById('total2').innerHTML = document.getElementById('total').innerHTML;
}

function confirmBuy() {
  let formCorrect = true;

  let firstName = document.getElementById('firstName').value;
  let lastName = document.getElementById('lastName').value;
  let tel = document.getElementById('tel').value;
  let address = document.getElementById('address').value;
  let atm = document.getElementById('atm').value;
  let cvc = document.getElementById('atm-cvc').value;
  let ex_m = document.getElementById('atm-expire-month').value;
  let ex_y = document.getElementById('atm-expire-year').value;
  let totalPrice = document.getElementById('total').innerHTML;

  if (firstName.length < 3 || lastName.length < 3) {
    document.getElementById('err1').innerHTML = "ชื่อและนามสกุลจะต้อมมีอย่างน้อยอย่างละ 3 ตัวอักษร";
    formCorrect = false;
  }
  else {
    document.getElementById('err1').innerHTML = "";
  }

  if (firstName.length < 3) {
    document.getElementById('firstName').classList.add("border");
    document.getElementById('firstName').classList.add("border-danger");
    formCorrect = false;
  }
  else {
    document.getElementById('firstName').classList.remove("border");
    document.getElementById('firstName').classList.remove("border-danger");
  }

  if (lastName.length < 3) {
    document.getElementById('lastName').classList.add("border");
    document.getElementById('lastName').classList.add("border-danger");
    formCorrect = false;
  }
  else {
    document.getElementById('lastName').classList.remove("border");
    document.getElementById('lastName').classList.remove("border-danger");
  }

  if (tel.length != 10 || tel.charAt(0) != '0') {
    document.getElementById('tel').classList.add("border");
    document.getElementById('tel').classList.add("border-danger");
    document.getElementById('err2').innerHTML = "เบอร์โทรศัพท์เขียนไม่ถูกต้อง";
    formCorrect = false;
  }
  else {
    document.getElementById('tel').classList.remove("border");
    document.getElementById('tel').classList.remove("border-danger");
    document.getElementById('err2').innerHTML = "";
  }
  
  if (address.length < 10) {
    document.getElementById('address').classList.add("border");
    document.getElementById('address').classList.add("border-danger");
    document.getElementById('err3').innerHTML = "ที่อยู่ต้องมีอย่างน้อย 10 ตัวอักษร";
    formCorrect = false;
  }
  else {
    document.getElementById('address').classList.remove("border");
    document.getElementById('address').classList.remove("border-danger");
    document.getElementById('err3').innerHTML = "";
  }
  
  if ((atm.length != 16 || isNaN(atm)) || (cvc.length != 3 || isNaN(cvc))) {
    document.getElementById('err4').innerHTML = "รหัส ATM และ/หรือ รหัส CVC เขียนไม่ถูกต้อง";
    formCorrect = false;
  }
  else {
    document.getElementById('err4').innerHTML = "";
  }
  
  if (atm.length != 16 || isNaN(atm)) {
    document.getElementById('atm').classList.add("border");
    document.getElementById('atm').classList.add("border-danger");
  }
  else {
    document.getElementById('atm').classList.remove("border");
    document.getElementById('atm').classList.remove("border-danger");
  }

  if (cvc.length != 3 || isNaN(cvc)) {
    document.getElementById('atm-cvc').classList.add("border");
    document.getElementById('atm-cvc').classList.add("border-danger");
  }
  else {
    document.getElementById('atm-cvc').classList.remove("border");
    document.getElementById('atm-cvc').classList.remove("border-danger");
  }

  if ((ex_m.length != 2 || isNaN(ex_m) || ex_m > 12 || ex_m  < 1) || (ex_y.length != 2 || isNaN(ex_y))) {
    document.getElementById('err5').innerHTML = "เดือนและปีต้องเขียนเป็นตัวเลข 2 หลัก";
    formCorrect = false;
  }
  else {
    document.getElementById('err5').innerHTML = "";
  }

  if (ex_m.length != 2 || isNaN(ex_m) || ex_m > 12 || ex_m  < 1) {
    document.getElementById('atm-expire-month').classList.add("border");
    document.getElementById('atm-expire-month').classList.add("border-danger");
    formCorrect = false;
  }
  else {
    document.getElementById('atm-expire-month').classList.remove("border");
    document.getElementById('atm-expire-month').classList.remove("border-danger");
  }

  if (ex_y.length != 2 || isNaN(ex_y)) {
    document.getElementById('atm-expire-year').classList.add("border");
    document.getElementById('atm-expire-year').classList.add("border-danger");
    formCorrect = false;
  }
  else {
    document.getElementById('atm-expire-year').classList.remove("border");
    document.getElementById('atm-expire-year').classList.remove("border-danger");
  }

  if (formCorrect) {
    document.getElementById('foodlistpost').value = localStorage.getItem("cartList");
    document.getElementById('pricepost').value = totalPrice;

    // alert(
    //   "ชื่อ: " + firstName + " " + lastName + "\n" + 
    //   "เบอร์: " + tel + "\n" + 
    //   "ที่อยู่: " + address + "\n" + 
    //   "ATM: " + atm + "\n" + 
    //   "CVC: " + cvc + "\n" + 
    //   "วันหมดอายุ: " + ex_m + "-" + ex_y + "\n" + 
    //   "รายการอาหาร: " + localStorage.getItem("cartList") + "\n" + 
    //   "ราคารวม: " + totalPrice
    // );

    localStorage.clear();
  }

  return formCorrect;
}
