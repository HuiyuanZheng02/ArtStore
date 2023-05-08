function addToCart(user_ID, item_ID){
    if(user_ID === null || user_ID === ''||user_ID === -1){
        alert("请先登陆！")
        event.preventDefault()
        return
    }
    let xmlHttp = new XMLHttpRequest();
    if (!xmlHttp && item_ID == null) {
        alert('系统错误')
        return;
    }
    let itemID = 'item_ID=' + item_ID;
    let userID = 'user_ID=' + user_ID;
    let url = 'includes/addToCart.php?' + itemID + '&' + userID;
    xmlHttp.open('POST', url, true);
    xmlHttp.onreadystatechange = function()
    {
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            confirm('添加成功！')
            location.reload()
            // document.getElementById('addToCart').style.display='none'
            // document.getElementById('deleteFromCart').style.display='block'
        }
    }
    xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlHttp.send(itemID);
}

function deleteFromCart(user_ID, item_ID){
    if(user_ID === null || user_ID === ''||user_ID === -1){
        alert("请先登陆！")
        return
    }
    let xmlHttp = new XMLHttpRequest();
    if (!xmlHttp && user_ID == null && item_ID == null) {
        alert('系统错误')
        return;
    }
    let itemID = 'item_ID=' + item_ID;
    let userID = 'user_ID=' + user_ID;
    let url = 'includes/deleteFromCart.php?' + itemID + '&' + userID;
    xmlHttp.open('POST', url, true);
    xmlHttp.onreadystatechange = function()
    {
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            alert('移除成功！')
            location.reload()
            // document.getElementById('deleteFromCart').style.display='none'
            // document.getElementById('addToCart').style.display='block'
        }
    }
    xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlHttp.send(itemID);
}