let intros = {
    "pReport":["依產品為主類別，再依年度、總額產生銷售狀況。"],
    "dReport":["依業務部門為主類別，再依年度、總額產生銷售狀況。"],
    "pManage":["可新增／修改／刪除公司產品資料。"],
    "eManage":["可新增／修改／刪除公司員工資料。"],
    "cManage":["可新增／修改／刪除公司客戶資料。"],
    "uManage":["可新增／修改／刪除系統帳號資料。"]};

let links = document.querySelectorAll(".menuList a");
let wrap = document.querySelector(".introWrap");

links.forEach(link => {
    if(intros[link.id] != undefined){
        let box = document.createElement("DIV");
        box.classList.add("introBox");
        box.classList.add((link.id.includes("Report")?"reportBox":link.id.includes("Manage")?"manageBox":"otherBox"));
        let clink = link.cloneNode(true);
        clink.classList.add("introLink");
        let name = clink.innerText;
        clink.innerText = "";
        clink.insertAdjacentHTML("beforeend",`<div class="introTitle">${name}</div>`);
        clink.insertAdjacentHTML("beforeend",`<div class="introDesc">${intros[link.id]}</div>`);
        box.insertAdjacentElement("afterbegin",clink);
        wrap.insertAdjacentElement("beforeend",box);
    }
});

