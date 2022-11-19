function startTime() {
  const today = new Date();
  let h = today.getHours();
  let m = today.getMinutes();
  let s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('clock').innerHTML =  h + ":" + m + ":" + s;
  setTimeout(startTime, 1000);
}

function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}

function getCartAmount() {
  let cartList = JSON.parse(localStorage.getItem("cartList"));
  if (cartList == null) {
    document.getElementById('cart').innerHTML = "0";
  }
  else {
    document.getElementById('cart').innerHTML = Object.keys(cartList).length;
  }
}

// list page
function addQuery(key, value) {
  let currentURL = window.location.href;
  let query = "";

  if (currentURL.indexOf(key) == -1) {
    if (currentURL.indexOf('?') == -1) {
      query += '?';
    }
    else {
      query += '&';
    }
    query += key + '=' + value;
    newURL = currentURL + query;
  }
  else {
    let start = currentURL.indexOf('=', currentURL.indexOf(key));
    let end = currentURL.indexOf('&', start);
    currentURL = replaceSubStr(currentURL, start - key.length, end, key + '=' + value);
    newURL = currentURL;
  }

  window.location.href = newURL;
}

function removeQuery(key) {
  let currentURL = window.location.href;

  start = currentURL.indexOf(key) - 1;
  end = currentURL.indexOf('&', currentURL.indexOf(key));

  // alert(start + "\n" + currentURL.substring(0, start) + "\n" + end + "\n" + currentURL.substring(end));
  currentURL = replaceSubStr(currentURL, start, end, '');

  if (currentURL.indexOf('?') == -1) {
    currentURL = currentURL.replace('&', '?');
  }

  window.location.href = currentURL;
}

// misc functions to use with other functions above
function replaceSubStr(str, from, to, txt) {
  if (to == -1) {
    return str.substring(0, from) + txt;
  }
  return str.substring(0, from) + txt + str.substring(to);
}

