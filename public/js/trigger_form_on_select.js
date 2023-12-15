var stateForm = document.querySelector('#state-form')
var stateSelect = document.querySelector('#state-select')

if(stateSelect){
    stateSelect.addEventListener('change', function(){
        stateForm.submit()
    })
}
