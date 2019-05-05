let btn =document.cud.cancel;
btn.onclick = function(){
    let inputs = document.querySelectorAll("#cud input");
    for(let i=0;i<inputs.length;i++){
        inputs[i].required=false;
    }
}