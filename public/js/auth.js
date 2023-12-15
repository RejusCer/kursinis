var signInBtn = document.querySelector("#sign-in")
var registerBtn = document.querySelector("#register")

var signInForm = document.querySelector('[data-form-type="signin"]')
var registerForm = document.querySelector('[data-form-type="register"]')

if (signInBtn){
    signInBtn.addEventListener('click', function(){
        registerForm.classList.add('hidden')
        signInForm.classList.remove('hidden')
    })
}

if(registerBtn){
    registerBtn.addEventListener('click', function(){
        signInForm.classList.add('hidden')
        registerForm.classList.remove('hidden')
    })
}
