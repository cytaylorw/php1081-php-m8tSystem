

let btn = document.getElementById("clearBtn");
btn.onclick = function(){
    let inputs = document.querySelectorAll(".filterRow input[type='text'");
    for(let i=0;i<inputs.length;i++){
        inputs[i].value='';
    }
}