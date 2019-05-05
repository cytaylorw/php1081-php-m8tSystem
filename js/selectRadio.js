let radios = document.cud.tableRadio;

for(let i=0;i<radios.length;i++){
    radios[i].addEventListener('change', function(event) {
        if (radios.value != "") {
            document.cud.edit.disabled = false;
            document.cud.delete.disabled = false;
        }else{
            document.cud.edit.disabled = true;
            document.cud.delete.disabled = true;
        }
    });
}

if (radios.value != "") {
    document.cud.edit.disabled = false;
    document.cud.delete.disabled = false;
}else{
    document.cud.edit.disabled = true;
    document.cud.delete.disabled = true;
}

