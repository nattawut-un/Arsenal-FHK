function renameTitle() {
  document.title = document.getElementById('foodname').innerHTML + " | Aresnal FHK";
}

function addMenu() {
  let params = new URLSearchParams(document.location.search);
  let menuID = params.get("id");
  let name = document.getElementById('foodname').innerHTML;
  let price = parseInt(document.getElementById('foodprice').innerHTML) * document.getElementById('amount').value;
  let amount = document.getElementById("amount").value;
  let info = document.getElementById("info").value;

  let cartList = JSON.parse(localStorage.getItem("cartList"));
  if (cartList == null) {
    cartList = {};
    cartList[menuID] = [amount, info, name, price];
    localStorage.setItem("cartList", JSON.stringify(cartList));
  }
  else {
    cartList[menuID] = [amount, info, name, price];
    localStorage.setItem("cartList", JSON.stringify(cartList));
  }

  alert("เพิ่มสินค้าลงตะกร้าแล้ว");
  history.back();
}
