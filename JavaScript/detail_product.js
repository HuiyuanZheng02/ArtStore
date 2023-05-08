let detail_img = document.getElementsByClassName("detail-img_col")[0];
let original = detail_img.firstElementChild || detail_img.firstChild;
let original_img = document.getElementsByClassName('detail-img')[0]
let enlarge = detail_img.children[1];
let brush = detail_img.children[0].children[1]
let enlarge_img = enlarge.children[0]


enlarge.style.left = (original_img.offsetWidth + original_img.offsetLeft + 10)+'px'
enlarge.style.top = original_img.offsetTop+'px'

function show(ele){  ele.style.display = 'block';  }
function hide(ele){  ele.style.display = 'none';  }

original.onmouseenter = function (){
    show(brush);show(enlarge);
}
original.onmouseleave = function (){
    hide(brush);hide(enlarge);
}
original.onmousemove = function (event){
    event = event || window.event;
    //鼠标的位置。
    // let pageX = event.pageX || e.clientX + getScroll().scrollLeft;
    // let pageY = event.pageY || e.clientY + getScroll().scrollTop;
    let pageX = event.pageX || event.clientX + document.documentElement.scrollLeft
    let pageY = event.pageY || event.clientY + document.documentElement.scrollTop

    const top = document.getElementsByClassName('detail-container')[0].offsetTop
    const left = document.getElementsByClassName('detail-container')[0].offsetLeft
    //x：brush的left值，y：brush的top值。
    let x = pageX - left - brush.offsetWidth / 2; //除以2，可以保证鼠标brush的中间
    let y = pageY - top - brush.offsetHeight / 2;

    if(x < original_img.offsetLeft - brush.offsetWidth/2) x = original_img.offsetLeft - brush.offsetWidth/2
    if(x > original_img.offsetWidth + original_img.offsetLeft - brush.offsetWidth/2) x = original_img.offsetWidth + original_img.offsetLeft - brush.offsetWidth/2
    if(y < original_img.offsetTop - brush.offsetHeight/2) y = original_img.offsetTop - brush.offsetHeight/2
    if(y > original_img.offsetTop + original_img.offsetHeight - brush.offsetHeight/2) y = original_img.offsetHeight + original_img.offsetTop - brush.offsetHeight/2

    //移动盒子
    brush.style.left = x + "px";
    brush.style.top = y + "px";

    //大图片走的距离/brush盒子都的距离 = 大图片/小图片

    let scale = enlarge.offsetWidth / brush.offsetWidth
    enlarge_img.style.width = (original_img.offsetWidth * scale)+'px'

    scale = enlarge_img.offsetWidth / original_img.offsetWidth;

    let x0 = x - original_img.offsetLeft
    let y0 = y - original_img.offsetTop

    let xx = scale * x0;  //知道比例，移动大图片
    let yy = scale * y0;

    enlarge_img.style.marginTop = -yy + 'px';
    enlarge_img.style.marginLeft = -(xx + 150) + 'px';

}

function setFoot(item_ID,user_ID){
    if(user_ID == null ||user_ID === ''||user_ID === 'none') return
    let xmlHttp = new XMLHttpRequest();
    if (!xmlHttp || item_ID == null) {
        alert('系统错误')
        return;
    }
    let itemID = 'item_ID=' + item_ID;
    let userID = 'user_ID=' + user_ID;
    let url = 'includes/footPrint.php?' + itemID + '&' + userID;
    xmlHttp.open('POST', url, true);
    xmlHttp.onreadystatechange = function()
    {
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            console.log(xmlHttp.responseText)
            if(xmlHttp.responseText !== ''){
                alert('系统错误')
            }
        }
    }
    xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlHttp.send(itemID);
}

function leaveComment(item_ID){
    let commentInput = document.getElementById('comment').value
    if(commentInput.length > 200){
        alert('评论不能多于200字')
        return
    }
    if(commentInput.length === 0){
        alert('评论不得为空')
        return
    }
    let xmlHttp = new XMLHttpRequest();
    if (!xmlHttp) {
        alert('系统错误')
        return;
    }
    let itemID = 'item_ID=' + item_ID;
    let comment = 'comment=' + commentInput;
    let url = 'includes/commentOn.php?' + comment + '&' + itemID;
    xmlHttp.open('POST', url, true);
    xmlHttp.onreadystatechange = function()
    {
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            if(xmlHttp.responseText === '') {
                alert('添加成功！')
                location.reload()
            }
        }
    }
    xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlHttp.send(itemID);
}

function unlikeCommend(comment_ID){
    let like_num = document.querySelector(`div[like-num-for="${comment_ID}"]`).innerHTML - 1
    document.querySelector(`div[like-num-for="${comment_ID}"]`).innerHTML = ''+ like_num
    console.log(document.querySelector(`button[like-btn-for="${comment_ID}"]`))
    console.log(document.querySelector(`button[unlike-btn-for="${comment_ID}"]`))
    document.querySelector(`button[like-btn-for="${comment_ID}"]`).style.display = 'none'
    document.querySelector(`button[unlike-btn-for="${comment_ID}"]`).style.display = 'inline'
    let xmlHttp = new XMLHttpRequest();
    if (!xmlHttp) {
        alert('系统错误')
        return;
    }
    let commentID = 'comment_ID=' + comment_ID;
    let url = 'includes/unlikeComment.php?' + commentID ;
    xmlHttp.open('POST', url, true);
    xmlHttp.onreadystatechange = function()
    {
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            console.log(xmlHttp.responseText)
            if(xmlHttp.responseText !== '') {
                alert('操作失败，请重试')
                location.reload()
            }
        }
    }
    xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlHttp.send(null);
}

function likeCommend(comment_ID){
    let like_num = parseInt(document.querySelector(`div[like-num-for="${comment_ID}"]`).innerHTML) + 1
    document.querySelector(`div[like-num-for="${comment_ID}"]`).innerHTML = ''+ like_num
    document.querySelector(`button[like-btn-for="${comment_ID}"]`).style.display = 'inline'
    document.querySelector(`button[unlike-btn-for="${comment_ID}"]`).style.display = 'none'
    let xmlHttp = new XMLHttpRequest();
    if (!xmlHttp) {
        alert('系统错误')
        return;
    }
    let commentID = 'comment_ID=' + comment_ID;
    let url = 'includes/likeComment.php?' + commentID ;
    xmlHttp.open('POST', url, true);
    xmlHttp.onreadystatechange = function()
    {
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            console.log(xmlHttp.responseText)
            if(xmlHttp.responseText !== '') {
                alert('操作失败，请重试')
                location.reload()
            }
        }
    }
    xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlHttp.send(null);
}

function deleteCommend(comment_ID){
    if(confirm("确认删除评论吗？") === true){
        let xmlHttp = new XMLHttpRequest();
        if (!xmlHttp) {
            alert('系统错误')
            return;
        }
        let commentID = 'comment_ID=' + comment_ID;
        let url = 'includes/deleteComment.php?' + commentID ;
        xmlHttp.open('POST', url, true);
        xmlHttp.onreadystatechange = function()
        {
            if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                console.log(xmlHttp.responseText)
                if(xmlHttp.responseText === '不是您的评论，不能删除！' ||xmlHttp.responseText === '删除成功') {
                    alert(xmlHttp.responseText)
                }else alert('系统错误！')
                location.reload()
            }
        }
        xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xmlHttp.send(null);
    }

}
