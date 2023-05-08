//for the popup slider(SignIN/SignUP overlay)
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('popup-container');

signUpButton.addEventListener('click',() => container.classList.add('right-panel-active'));
signInButton.addEventListener('click',() => container.classList.remove('right-panel-active'));

//for displaying the popup 
function signin(){
    document.querySelector(".popup-container").style.display="flex"
    document.querySelector("#hidden").style.display="block"
    history.pushState(null,null,location.origin+location.pathname+'?action=signin')
}
function signup(){
    document.querySelector(".popup-container").style.display="flex"
    container.classList.add('right-panel-active')
    document.querySelector("#hidden").style.display="block"
    history.pushState(null,null,location.origin+location.pathname+'?action=signup')
}

// document.getElementById("SignInVis").addEventListener("click",function(){
//     // if(container.classList.contains('right-panel-active')){
//     //     container.classList.remove('right-panel-active')
//     // }
//     document.querySelector(".popup-container").style.display="flex"
//     document.querySelector("#hidden").style.display="block"
//     // console.log(container.classList);
// 	// document.querySelector(".content").style.opacity="0.2";
// 	// document.querySelector(".content").style.zIndex="-1";
// })

// document.getElementById("SignUpVis").addEventListener("click",function(){
// 	document.querySelector(".popup-container").style.display="flex";
//     container.classList.add('right-panel-active')
//     document.querySelector("#hidden").style.display="block"
//     // console.log(container.classList);
// 	// document.querySelector(".content").style.opacity="0.2";
// 	// document.querySelector(".content").style.zIndex="-1";
// })

//for closing the popup when pressed anywhere else but the vital sections.

// var hidepopUp=document.getElementById("popup-container");
//
document.onclick=function(div){
    if(div.target.id ==="hidden") {
        document.querySelector(".popup-container").style.display="none";
        document.querySelector("#hidden").style.display="none";
    }else if(div.target.id ==="SignInVis") signin();
    else if(div.target.id ==="SignUpVis") signup();
}

//signin
let signin_form = document.querySelector('#signin-form')
let signin_btn = document.querySelector('#login')

checkSigninInput = (input) => {
    let err_span = signin_form.querySelector(`span[data-err-for="${input.id}"]`)
    let val = input.value.trim()
    let form_group = input.parentElement

    switch(input.getAttribute('name')) {
        case 'password':
            if (val.length < 6) {
                form_group.classList.add('err')
                form_group.classList.remove('success')
                err_span.innerHTML = '密码长度不得小于6位'
                return false
            } else {
                form_group.classList.add('success')
                form_group.classList.remove('err')
                err_span.innerHTML = ''
            }
            break;
        case 'nameOrEmail':
            if (val.length === 0) {
                form_group.classList.add('err')
                form_group.classList.remove('success')
                err_span.innerHTML = '用户名/邮箱不得为空'
                return false
            } else {
                form_group.classList.add('success')
                form_group.classList.remove('err')
                err_span.innerHTML = ''
            }
            break;
        case 'verify':
            form_group = input.parentElement.parentElement.parentElement
            if(verifyCode.validate(val)){
                form_group.classList.add('success')
                form_group.classList.remove('err')
                err_span.innerHTML = ''
            }else{
                form_group.classList.add('err')
                form_group.classList.remove('success')
                err_span.innerHTML = '验证码错误'
                return false
            }
            break;
    }
    return true
}

//初始化验证码
let verifyCode = new GVerify({
    id : "verify",
    type : "blend"
});

checkSigninForm = () => {
    let check = true
    let inputs = signin_form.querySelectorAll('.form-input')
    inputs.forEach(input => {
        if(!checkSigninInput(input)){
            check = false
        }
    })
    return check
}
signin_btn.onclick = () => {
    checkSigninForm()
}
let signin_inputs = signin_form.querySelectorAll('.form-input')
signin_inputs.forEach(input => {
    input.addEventListener('focusout', () => {
        checkSigninInput(input)
    })
})

//Signup
let signup_form = document.querySelector('#signup-form')
let signup_btn = document.querySelector('#register')

checkSignupInput = (input) => {
    let err_span = signup_form.querySelector(`span[data-err-for="${input.id}"]`)
    let val = input.value.trim()
    let form_group = input.parentElement

    switch(input.getAttribute('name')) {
        case 'userName':
            if (validateuserName(val) !== '') {
                form_group.classList.add('err')
                form_group.classList.remove('success')
                err_span.innerHTML = validateuserName(val)
                return  false
            } else {
                form_group.classList.add('success')
                form_group.classList.remove('err')
                err_span.innerHTML = ''
            }
            break;
        case 'phoneNumber':
            if (validatePhoneNumber(val) !== '') {
                form_group.classList.add('err')
                form_group.classList.remove('success')
                err_span.innerHTML = validatePhoneNumber(val)
                return false
            } else {
                form_group.classList.add('success')
                form_group.classList.remove('err')
                err_span.innerHTML = ''
            }
            break;
        case 'email':
            if (validateEmail(val) !== '') {
                form_group.classList.add('err')
                form_group.classList.remove('success')
                err_span.innerHTML = validateEmail(val)
                return false
            } else {
                form_group.classList.add('success')
                form_group.classList.remove('err')
                err_span.innerHTML = ''
            }
            break;
        case 'address':
            if (val.length === 0) {
                form_group.classList.add('err')
                form_group.classList.remove('success')
                err_span.innerHTML = '地址不得为空'
                return  false
            }else if (val.length > 190) {
                form_group.classList.add('err')
                form_group.classList.remove('success')
                err_span.innerHTML = '地址过长'
                return  false
            } else {
                form_group.classList.add('success')
                form_group.classList.remove('err')
                err_span.innerHTML = ''
            }
            break;
        case 'password':
            document.getElementById("tips").style.display = 'none';
            if (validatePassword(val) === 'medium'||validatePassword(val) === 'strong') {
                form_group.classList.add('success')
                form_group.classList.remove('err')
                err_span.innerHTML = ''
            } else {
                form_group.classList.add('err')
                form_group.classList.remove('success')
                if(validatePassword(val) === 'weak'){
                    err_span.innerHTML = '密码必须由字母，数字或者特殊字符组成且⾄少包含两种'
                }else err_span.innerHTML = validatePassword(val)
                return  false
            }
            break;
        case 'chkPsw':
            let pwd = document.getElementById('signup-password').value.trim()
            if (val !== pwd) {
                form_group.classList.add('err')
                form_group.classList.remove('success')
                err_span.innerHTML = '两次输入的密码必须相同'
                return false
            } else {
                form_group.classList.add('success')
                form_group.classList.remove('err')
                err_span.innerHTML = ''
            }
            break;
    }
    return true
}
realTimeChkSignupInput = (input) => {
    let err_span = signup_form.querySelector(`span[data-err-for="${input.id}"]`)
    let val = input.value.trim()
    let form_group = input.parentElement

    switch(input.getAttribute('name')) {
        case 'password':
            let Tips = document.getElementById("tips");
            let Span = Tips.getElementsByTagName("span");
            if (validatePassword(val) === 'medium'||validatePassword(val) === 'strong') {
                form_group.classList.add('success')
                form_group.classList.remove('err')
                err_span.innerHTML = ''
                Tips.className = validatePassword(val)
                Tips.style.display = 'block'
                for (let i = 0; i < Span.length; i++) Span[i].className = Span[i].innerHTML = '';
                let index = validatePassword(val) === 'medium'? 1 : 2
                Span[index].className = "active"
                Span[index].innerHTML = validatePassword(val)
            } else {
                form_group.classList.add('err')
                form_group.classList.remove('success')
                Tips.style.display = 'none'
                if(validatePassword(val) === 'weak'){
                    err_span.innerHTML = ''
                    Tips.className = validatePassword(val)
                    Tips.style.display = 'block'
                    Span[0].className = "active"
                    Span[0].innerHTML = validatePassword(val)
                    Span[1].className = Span[1].innerHTML =  Span[2].className = Span[2].innerHTML =''
                }else err_span.innerHTML = validatePassword(val)
            }
            break;
        case 'chkPsw':
            let pwd = document.getElementById('signup-password').value.trim()
            if (val !== pwd) {
                form_group.classList.add('err')
                form_group.classList.remove('success')
                err_span.innerHTML = ''
            } else {
                form_group.classList.add('success')
                form_group.classList.remove('err')
                err_span.innerHTML = ''
            }
            break;
    }
}
checkSignupForm = () => {
    let inputs = signup_form.querySelectorAll('.form-input')
    let checkSignup = true
    inputs.forEach(input => {
        if(!checkSignupInput(input)){
            checkSignup = false
        }
    })
    return checkSignup
}
signup_btn.onclick = () => {
    checkSignupForm()
}
let signup_inputs = signup_form.querySelectorAll('.form-input')
signup_inputs.forEach(input => {
    input.addEventListener('focusout', () => {
        checkSignupInput(input)
    })
    input.addEventListener('input', () => {
        realTimeChkSignupInput(input)
    })
})