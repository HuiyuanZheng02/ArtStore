let order_img = document.getElementsByClassName('order-img')
// let container = order-img-container
for(let i = 0; i < order_img.length; i++){
    if(i === 0) order_img[i].parentElement.style.marginTop = '0'
    if(order_img[i].offsetWidth > order_img[i].offsetHeight){
        order_img[i].style.height = '100%'
        let x =  (order_img[i].offsetWidth - order_img[i].parentElement.offsetWidth)/2
        order_img[i].style.marginLeft = -x + 'px'
    }else {
        order_img[i].style.width = '100%'
        let y =  (order_img[i].offsetHeight - order_img[i].parentElement.offsetHeight)/2
        order_img[i].style.marginTop = -y + 'px'
    }
}


function recharge(){
    document.getElementById('handleRecharge').style.display = 'inline'
    document.getElementById('recharge').style.display = 'inline'
    document.getElementById('toRecharge').style.display = 'none'
}

function handleRecharge(){
    const value = document.getElementById('recharge').value
    if(!/^[+]{0,1}(\d+)$/.test(value)) {
        alert('充值金额必须为正整数')
        return
    }
    if(value.length > 10){
        alert('充值金额过大')
        return
    }
    let xmlHttp = new XMLHttpRequest();
    if (!xmlHttp) {
        alert('系统错误')
        return;
    }
    let recharge = 'recharge=' + value;
    let url = 'includes/recharge.php?' + recharge;
    xmlHttp.open('POST', url, true);
    xmlHttp.onreadystatechange = function()
    {
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            if(xmlHttp.responseText === '账户金额已充足，充值失败！'){
                alert('账户金额已充足，充值失败！')
            }else if(xmlHttp.responseText === '充值成功！'){
                alert('充值成功！')
            }else alert('系统错误！')
            location.reload()
        }
    }
    xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlHttp.send(recharge);
}

function handleDelete(item_ID){
    if(confirm("确认删除商品吗？") === true){
        deleteProduct(item_ID)
        // console.log(item_ID)
        // event.preventDefault()
    }
    // else event.preventDefault()
}

function deleteProduct(item_ID){
    let xmlHttp = new XMLHttpRequest();
    if (!xmlHttp && item_ID === null) {
        alert('系统错误')
        return;
    }
    let itemID = 'item_ID=' + item_ID;
    let url = 'includes/deleteProduct.php?' + itemID;
    xmlHttp.open('POST', url, true);
    xmlHttp.onreadystatechange = function()
    {
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            if(xmlHttp.responseText === '该商品已被购买'){
                alert('该商品已被购买！')
            }else if(xmlHttp.responseText === '删除成功'){
                alert('删除成功！')
            }else alert('系统错误！')
            location.reload()
        }
    }
    xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlHttp.send(recharge);
}

function editProduct(item_ID){
    // event.preventDefault()
    let url = 'myProduct.php?item_ID=' + item_ID
    location=url
}