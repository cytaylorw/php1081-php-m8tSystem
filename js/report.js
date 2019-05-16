let desc = document.getElementById("totalDesc");
let order = document.getElementById("order");
totalDesc();

order.onchange = totalDesc;


let btn = document.getElementById("clearBtn");
btn.onclick = function(){
    let year = document.getElementById("year");
    let product = document.getElementById("product");
    let dept = document.getElementById("dept");
    let stotal = document.getElementById("stotal");

    if(year != undefined) {
        year.options[year.options.selectedIndex].removeAttribute('selected');
        year.options[0].selected=true;
    }
    if(product != undefined) {
        product.options[product.options.selectedIndex].removeAttribute('selected');
        product.options[0].setAttribute('selected',"");
    }
    if(dept != undefined) {
        dept.options[dept.options.selectedIndex].removeAttribute('selected');
        dept.setAttribute('selectedIndex',0);
    }
    if(order != undefined) {
        order.options[order.options.selectedIndex].removeAttribute('selected');
        order.selectedIndex=0;
    }
    if(stotal != undefined) stotal.setAttribute('value','');

}

window.onscroll = function(){
    let headerR = document.querySelector(".resultHeader");
    let headers = document.querySelectorAll(".resultHeader .tableCell");
    let rows = document.querySelectorAll(".resultRow .tableCell");
    let top = document.querySelector(".topBtn");
    let menus = document.querySelectorAll(".menu");
    if(document.documentElement.scrollTop > 110){
        headerR.classList.add("fixedHeader");
        for(let i=0;i<headers.length;i++){
            headers[i].style.width=rows[i].offsetWidth+"px";
            headers[i].style.height=rows[i].offsetHeight+"px";
        }
        top.style.display = "block";
        for(let i=0;i<menus.length;i++){
            menus[i].classList.add("deactive");
        }
    }else{
        headerR.classList.remove("fixedHeader");
        for(let i=0;i<headers.length;i++){
            headers[i].removeAttribute("style");
        }
        top.removeAttribute("style");
        for(let i=0;i<menus.length;i++){
            menus[i].classList.remove("deactive");
        }
    }
}

function totalDesc(){
    if(order.value == "DESC"){
        desc.innerText = "(大於)";
    }else if (order.value == "ASC"){
        desc.innerText = "(小於)";
    }
}