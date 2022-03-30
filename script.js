function showHide(pass,tgl) {
    const password = document.getElementById(pass);
    const toggle = document.getElementById(tgl);
    if (password.type === 'password') {
        password.setAttribute('type', 'text');
        toggle.classList.add('hide')
    }
    else {
        password.setAttribute('type', 'password');
        toggle.classList.remove('hide')
    }
}