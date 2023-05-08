function showImg(input) {
    if(input !== null ){
        document.getElementById('upload-icon').style.display='none'
    }
    let file = input.files[0];
    let reader = new FileReader()
    // 图片读取成功回调函数
    reader.onload = function(e) {
        document.getElementById('show').src=e.target.result
    }
    reader.readAsDataURL(file)
}

let product_form = document.querySelector('#productForm')
let product_btn = document.querySelector('#submit')

checkProductInput = (input) => {
    let err_span = product_form.querySelector(`span[data-err-for="${input.id}"]`)
    let val = input.value.trim()
    let form_group = input.parentElement

    switch(input.getAttribute('id')) {
        case 'itemName':
        case 'authorName':
        case 'genre':
        case 'itemYear':
            if (val.length >= 48) {
                form_group.classList.add('err')
                form_group.classList.remove('success')
                err_span.innerHTML = '长度过长'
                err_span.style.marginBottom='-10px'
                return false
            }
        case 'itemDesc':
            if (val.length > 200) {
                form_group.classList.add('err')
                form_group.classList.remove('success')
                err_span.innerHTML = '长度过长'
                err_span.style.marginBottom='-10px'
                return false
            }
            if (val === '') {
                form_group.classList.add('err')
                form_group.classList.remove('success')
                err_span.innerHTML = '请输入'
                err_span.style.marginBottom='-10px'
                return false
            }else {
                form_group.classList.add('success')
                form_group.classList.remove('err')
                err_span.innerHTML = ''
                err_span.style.marginBottom='0'
            }
            break;
        case 'size':
            if (val === ''||!/^[+]{0,1}(\d+)$|^[+]{0,1}(\d+\.\d+)/.test(val)) {
                form_group.classList.add('err')
                form_group.classList.remove('success')
                err_span.innerHTML = '尺寸必须为正数'
                err_span.style.marginBottom='-10px'
                return false
            }else if(val.length > 8){
                form_group.classList.add('err')
                form_group.classList.remove('success')
                err_span.innerHTML = '尺寸过大'
                err_span.style.marginBottom='-10px'
                return false
            } else {
                form_group.classList.add('success')
                form_group.classList.remove('err')
                err_span.innerHTML = ''
                err_span.style.marginBottom='0'
            }
            break;
        case 'price':
            if (val === ''||!/^[+]{0,1}(\d+)$/.test(val)) {
                form_group.classList.add('err')
                form_group.classList.remove('success')
                err_span.innerHTML = '价格必须为正整数'
                err_span.style.marginBottom='-10px'
                return false
            }else if(val.length > 9){
                form_group.classList.add('err')
                form_group.classList.remove('success')
                err_span.innerHTML = '价格过大'
                err_span.style.marginBottom='-10px'
                return false
            } else {
                form_group.classList.add('success')
                form_group.classList.remove('err')
                err_span.innerHTML = ''
                err_span.style.marginBottom='0'
            }
            break;
    }
    return true
}
checkProductForm = () => {
    let valid = true
    let inputs = product_form.querySelectorAll('.form-input')
    inputs.forEach(input => {
        if(!checkProductInput(input)) valid = false
    })
    return valid
}
product_btn.onclick = () => {
    checkProductForm()
}
function validItemForm(action){
    if(!checkProductForm()) {
        console.log(checkProductForm())
        return false
    }
    if(document.getElementById('upload-input').value === '' && !action){
        alert('请上传图片')
        return false
    }
    return true
}
let product_inputs = product_form.querySelectorAll('.form-input')
product_inputs.forEach(input => {
    input.addEventListener('focusout', () => {
        checkProductInput(input)
    })
})
function onf(action){
    console.log(action)
}