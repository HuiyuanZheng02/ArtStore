const hidden = document.getElementById('hidden')
const overlay = document.getElementById('overlay')
const jumbotron = document.getElementById("jumbotron-ol");


window.onscroll = function () {
    overlay.style.top = (document.documentElement.scrollTop + 75) + 'px'
    if(document.documentElement.scrollTop === 0){
        jumbotron.style.top = '65px'
        jumbotron.style.height = '191px'
    }else{
        jumbotron.style.top = '0'
        jumbotron.style.height = '256px'
    }
}

function overlayDisable(){
    hidden.style.display = 'none'
    overlay.style.display = 'none'
}

function checkEdit(item_ID, edit_time){
    let result = false
    let xmlHttp = new XMLHttpRequest();
    if (!xmlHttp && edit_time == null && item_ID == null) {
        alert('系统错误')
        return;
    }
    let itemID = 'item_ID=' + item_ID;
    let editTime = 'edit_time=' + edit_time;
    let url = 'includes/checkOut.php?' + itemID + '&' + editTime;
    xmlHttp.open('GET', url, true);
    xmlHttp.onreadystatechange = function()
    {
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            if(xmlHttp.responseText != 1){
                document.querySelector(`span[data-err-for="checkItem${item_ID}"]`).innerHTML = '该商品信息发生变化'
            }
        }
    }
    xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlHttp.send(itemID);
    return result;
}

function handlePurchase(cost){
    let xmlHttp = new XMLHttpRequest();
    if (!xmlHttp && cost === null) {
        alert('系统错误')
        return;
    }
    let Cost = 'cost=' + cost;
    let url = 'includes/purchase.php?' + Cost;
    xmlHttp.open('POST', url, true);
    xmlHttp.onreadystatechange = function()
    {
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            console.log(xmlHttp.responseText)
            switch(xmlHttp.responseText) {
                case '交易失败':
                case '价格有变动或有艺术品被删除':
                case '交易部分成功':
                    alert(xmlHttp.responseText)
                    location.reload()
                    break;
                case '交易成功':
                    confirm('交易成功!')
                    location.reload()
                    break;
                default:
                    alert('系统错误!')
                    location.reload()
                    break;
            }
        }
    }
    xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlHttp.send(null);
}