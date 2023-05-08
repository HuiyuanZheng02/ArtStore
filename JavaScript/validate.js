validateEmail = (email) => {
    const re = /^[A-Za-z0-9\u4e00-\u9fa5_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/
    let errMsg = ''
    if(email.length === 0) errMsg = '邮箱不得为空'
    else if(email.length > 45) errMsg = '邮箱过长'
    else if(!re.test(String(email).toLowerCase())) errMsg = '请输入有效的邮箱'
    return errMsg
}
validateuserName = (userName) => {
    const re = /^[A-Za-z0-9_-]+$/
    let errMsg = ''
    if(userName.length === 0) errMsg = '用户名不得为空'
    else if(userName.length > 20) errMsg = '用户名过长'
    else if(!re.test(String(userName))) errMsg = '用户名只能包含大小写字母、数字、"_"、"-"'
    return errMsg
}
validatePhoneNumber = (phoneNumber) => {
    const re = /^1[345678]\d{9}$/
    let errMsg = '';
    if(phoneNumber.length === 0) errMsg = '手机号不得为空'
    else if (phoneNumber.length !== 11) errMsg = '手机号必须为 11 位'
    else if (!re.test((String(phoneNumber)))) errMsg = '请输入正确的手机号'
    return errMsg;
}
validatePassword = (password) => {
    let modes = 0;
    let Msg = '';
    if(password.length === 0) Msg = '密码不得为空'
    else if (password.length < 6) Msg = '密码不得少于六位';
    else if (password.length > 48) Msg = '密码过长';
    else{
        /** 强度规则
         + ------------------------------------------------------- +
         1) 任何字符数的同类字符组合，弱；
         2) 任何字符数的两类字符组合，中；
         3) 任何字符数的三类字符组合，强；
         + ------------------------------------------------------- +
         **/
        if (/[0-9]/.test(password)) modes++; //数字
        if (/[a-z]/.test(password)) modes++; //小写
        if (/[A-Z]/.test(password)) modes++; //大写
        if (/[-*/+.~`!@#$%^&*(){}「」]/.test(password)) modes++; //特殊字符
        switch (modes) {
            case 0:
            case 1:
                Msg = 'weak'
                break;
            case 2:
                Msg = 'medium'
                break;
            default:
                Msg = 'strong'
                break;
        }
    }
   return Msg
}