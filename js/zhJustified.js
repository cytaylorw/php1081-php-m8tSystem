let labels =  document.querySelectorAll(".zhJustified");
let max = 0;
labels.forEach(label => {
    max = (label.innerHTML.length > max)? label.innerHTML.length:max;
});
labels.forEach(label => {
    if(label.innerHTML.length < max){
        let space = (max-label.innerHTML.length)/(label.innerHTML.length-1);
        label.style="letter-spacing: "+space+"em; margin-right: -"+space+"em";
    }
});