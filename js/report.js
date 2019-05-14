let btn = document.getElementById("clearBtn");
btn.onclick = function(){
    let year = document.getElementById("year");
    let product = document.getElementById("product");
    let dept = document.getElementById("dept");
    let order = document.getElementById("order");
    let stotal = document.getElementById("stotal");

    if(year != undefined) {year.options[0].selected=true;console.log(year);}
    if(product != undefined) {product.options[0].setAttribute('selected',true);console.log(product);}
    if(dept != undefined) {dept.setAttribute('selectedIndex',0);console.log(dept);}
    if(order != undefined) {order.value='DESC';console.log(order);}
    if(stotal != undefined) stotal.setAttribute('value','');

}