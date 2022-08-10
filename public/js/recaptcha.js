//Enable button if recaptcha is valid
function recaptchaCallback(){
    const btn = document.querySelector('#btnProceed');
    btn.removeAttribute('disabled');
}
//Disable button if recaptcha is expired
function recaptchaExpired(){
    const btn = document.querySelector('#btnProceed');
    btn.setAttribute('disabled', '');
}