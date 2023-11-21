var signInBtn = document.querySelector("#sign-in")
var registerBtn = document.querySelector("#register")

var signInForm = document.querySelector('[data-form-type="signin"]')
var registerForm = document.querySelector('[data-form-type="register"]')

signInBtn.addEventListener('click', function(){
    registerForm.classList.add('hidden')
    signInForm.classList.remove('hidden')
})

registerBtn.addEventListener('click', function(){
    signInForm.classList.add('hidden')
    registerForm.classList.remove('hidden')
})
