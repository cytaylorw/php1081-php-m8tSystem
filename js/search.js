let inputs = document.querySelectorAll(".filterRow input[type='text'");
for(let i=0;i<inputs.length;i++){
    inputs[i].addEventListener('keypress', function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            document.querySelector(".filterRow input[type='submit'").click();
        }
    });
}