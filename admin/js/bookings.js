let price = 0;

document.getElementById('showtime-select').addEventListener('change', function () {
    var theaterId = this.value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
             price = xhr.responseText;
        }
    };
    xhr.open('GET', 'exec/get_price_booking.php?showtime_id=' + theaterId, true);
    xhr.send();
    priceUpdate(price)
    console.log("price: "+ price)
});

document.getElementById('total-seat').addEventListener('keyup', function () {
    priceUpdate(price)
});

function priceUpdate(price) {
    var totalseatInput = document.getElementById("total-seat");
    var priceInput = document.getElementById("price");

    console.log(price);

    if (!isNaN(totalseatInput.value) && price !== null) {
        var totalPrice = parseInt(totalseatInput.value) * parseInt(price);
        priceInput.value = totalPrice;
    }
}