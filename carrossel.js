var contador = 1;

setInterval(function(){
    document.getElementById('slide' + contador).checked = true;
    contador ++;

    if(contador > 1){
        contador = 1;
    }
}, 3000)