function isentitycheck() {
    isentity = document.getElementById('isentcheck')
    isentity1 = document.getElementById('entname')
    isentity2 = document.getElementById('bin')
    isentity3 = document.getElementById('bik')
    isentity4 = document.getElementById('intadress')


    if (document.getElementById('yes').checked) {
        isentcheck.style.display = 'block';

    } else {
        isentcheck.style.display = 'none';
        isentity1.value = isentity2.value = isentity3.value = isentity4.value ='';
    }
}
