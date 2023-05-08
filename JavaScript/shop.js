document.write(`<script language=javascript src=".\\JavaScript\\like.js"></script>`)
// document.write(`<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>`)

let sortBy = ''
let pageNum = 0
searchItem()
document.onclick=function(div){
    if(div.target.name ==="sortBy" || div.target.id === "search-btn" || div.target.id === "search-btn-icon") {
        document.getElementsByName('sortBy').forEach( e =>{
            if(e.checked) sortBy = e.value
        })
        searchItem()
    }
}

document.getElementById("search").addEventListener("keypress",function(){
    if(window.event.keyCode === 13) searchItem()
})

function searchItem(){
    let searchInput = document.getElementById('search').value
    let xmlHttp = new XMLHttpRequest();
    if (!xmlHttp) {
        alert('系统错误')
        return;
    }
    if(searchInput !== '') document.getElementById('search-header').style.display ='none'
    else document.getElementById('search-header').style.display ='block'
    // let search = 'search=' + searchInput;
    let sort_by = 'sort_by=' + sortBy;
    // let url = 'includes/searchItem.php?' + search + '&' + sort_by;
    let url = 'includes/searchItem.php?' + sort_by;
    xmlHttp.open('GET', url, true);
    xmlHttp.onreadystatechange = function()
    {
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            let items = eval('('+xmlHttp.responseText+')')
                console.log(items)
            let filerItems = items.filter( d =>
                searchInput !== ''&&
                d.itemName.toLowerCase().includes(searchInput.toLowerCase()) ||
                d.authorName.toLowerCase().includes(searchInput.toLowerCase())
            )

            if(filerItems.length === 0){
                document.querySelector('.swiper-wrapper').innerHTML = `
             <div class="swiper-slide">
                <div class="row">
                    <div class="col">
                        <div class="product-card">
                            <div class="product-card-img">
                                <div class="ratio ratio-1-1">
                                    <img class="ratio-content bg-img" style="border: 1px solid var(--border_color)"/>
                                </div>
                            </div>
                            <div style="text-align: center;font-family: var(--font_chinese_family);margin: 40px auto;line-height: 30px">
                                <grey>暂无</grey>
                            </div>
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col"></div>
                </div>
            </div>`
            }else{
                let str = ''
                for(let i = 0; i < filerItems.length; i++){
                    if(i%9 === 0) str += `<div class="swiper-slide">`
                    if(i%3 === 0) str += `<div class="row">`
                    str += `
                <div class="col" style="margin-top: 0">
                    <a href="detail_product.php?item_ID=${filerItems[i].itemID}" style="color: black;text-decoration: none">
                    <div class="product-card">
                        <div class="product-card-img">
                            <div class="ratio ratio-1-1">
                                <div class="ratio-content bg-img" style="background-image:url(${filerItems[i].itemImg});"></div>
                            </div>
                        </div>
                        <div class="product-card-name">
                            <div class="product-name" style="font-size: 35px;">${(filerItems[i].itemName)?filerItems[i].itemName:'<grey>暂无</grey>'}</div>
                            <div class="text-right" style="margin-bottom: 5px;font-family: var(--font_chinese_family)">
                                <strong>作者</strong>&ensp;/&ensp;${(filerItems[i].authorName)?filerItems[i].authorName:'<grey>暂无</grey>'}
                            </div>
                        </div>
                        <div class="product-card-footer" style="margin: -10px 0 0 0">
                            <div class="product-card-footer__price price" style="margin-left: -10px">
                                &#165 <strong class="price" style="font-size: 23px">
                                    ${filerItems[i].price}</strong>
                            </div>`
                    if(filerItems[i].sold === true){
                        str += `<div><grey>已售</grey></div>`
                    }else{
                        if(filerItems[i].liked === 'unlike'){
                            str += `
                            <button class="product-card-btn" style="height: 20px;" onclick="addToCart(${filerItems[i].userID},${filerItems[i].itemID})">
                                <span class="material-icons-outlined">add_shopping_cart</span>
                            </button>
`
                        }else{
                            str += `
                            <button class="product-card-btn" style="height: 20px;" onclick="deleteFromCart(${filerItems[i].userID},${filerItems[i].itemID})">
                                <span class="material-icons-outlined">remove_shopping_cart</span>
                            </button>
                    `
                        }
                    }

                    str += `
                        </div>
                        <div class="itemDesc" style="margin: 5px 0;font-family: var(--font_chinese_family)">
                            &ensp;&ensp;${(filerItems[i].itemDesc)?filerItems[i].itemDesc:'<grey>暂无简介</grey>'}
                        </div>
                        <div class="remarks row" style="margin-top: 20px">
                            <div class="col">
                                <span class="remarks" style="font-family: var(--font_chinese_family);font-size: 10px">发布于&nbsp;</span>
                                <grey style="font-size: 19px">${(filerItems[i].publish_date)?filerItems[i].publish_date:'暂无发布日期'}</grey>
                            </div>
                            <div class="col  text-right">
                                <i class="fa-solid fa-eye"></i>  ${(filerItems[i].view)?filerItems[i].view:'0'}
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                `
                    if((i+1)%3 === 0) str += `</div>`
                    if((i+1)%9 === 0) str += `</div>`
                }
                if(filerItems.length%3 === 1) str += `<div class="col"></div><div class="col"></div></div></div>`
                if(filerItems.length%3 === 2) str += `<div class="col"></div></div></div>`
                if(filerItems.length%9 === 3 || filerItems.length%9 === 6) str += `</div>`
                pageNum = Math.trunc(filerItems.length/9 + 1)
                // console.log(pageNum)
                document.querySelector('.swiper-wrapper').innerHTML = str
            }

            $(".pagesDiv").createPage({
                pageCount: pageNum, //总页数
                current: 1, //当前页
                // turndown: 'true', //是否显示跳转框，显示为true，不现实为false,一定记得加上引号...
                backFn: function (p) {
                    mySwiper.slideTo(p - 1, 800, false);
                }
            });

        }else{
            document.querySelector('.swiper-wrapper').innerHTML = `
             <div class="swiper-slide">
                <div class="row">
                    <div class="col">
                        <div class="product-card">
                            <div class="product-card-img">
                                <div class="ratio ratio-1-1">
                                    <img class="ratio-content bg-img" style="border: 1px solid var(--border_color)"/>
                                </div>
                            </div>
                            <div style="text-align: center;font-family: var(--font_chinese_family);margin: 40px auto;line-height: 30px">
                                <grey>加载中</grey>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="product-card">
                            <div class="product-card-img">
                                <div class="ratio ratio-1-1">
                                    <img class="ratio-content bg-img" style="border: 1px solid var(--border_color)"/>
                                </div>
                            </div>
                            <div style="text-align: center;font-family: var(--font_chinese_family);margin: 40px auto;line-height: 30px">
                                <grey>加载中</grey>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="product-card">
                            <div class="product-card-img">
                                <div class="ratio ratio-1-1">
                                    <img class="ratio-content bg-img" style="border: 1px solid var(--border_color)"/>
                                </div>
                            </div>
                            <div style="text-align: center;font-family: var(--font_chinese_family);margin: 40px auto;line-height: 30px">
                                <grey>加载中</grey>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`
        }
    }
    xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlHttp.send();
}

$(function () {
    $(".itemDesc").dotdotdot({
        wrap: 'letter'//这里中文要用letter
    });
})

let ms = {
    init: function(obj, args) {
        return (function() {
            ms.fillHtml(obj, args);
            ms.bindEvent(obj, args);
        })();
    },
    fillHtml: function(obj, args) {
        return (function() {
            obj.empty();
            if (args.current > 1) {
                obj.append('<a href="javascript:;" class="prevPage"><span class="material-icons-outlined">keyboard_double_arrow_left</span></a>');
            } else {
                obj.remove('.prevPage');
                obj.append('<span class="disabled"><span class="material-icons-outlined">keyboard_double_arrow_left</span></span>');
            }
            if (args.current != 1 && args.current >= 4 && args.pageCount != 4) {
                obj.append('<a href="javascript:;" class="tcdNumber">' + 1 + '</a>');
            }
            if (args.current - 2 > 2 && args.current <= args.pageCount && args.pageCount > 5) {
                obj.append('<span>...</span>');
            }
            let start = args.current - 2,
                end = args.current + 2;
            if ((start > 1 && args.current < 4) || args.current == 1) {
                end++;
            }
            if (args.current > args.pageCount - 4 && args.current >= args.pageCount) {
                start--;
            }
            for (; start <= end; start++) {
                if (start <= args.pageCount && start >= 1) {
                    if (start != args.current) {
                        obj.append('<a href="javascript:;" class="tcdNumber">' + start + '</a>');
                    } else {
                        obj.append('<span class="current">' + start + '</span>');
                    }
                }
            }
            if (args.current + 2 < args.pageCount - 1 && args.current >= 1 && args.pageCount > 5) {
                obj.append('<span>...</span>');
            }
            if (args.current !== args.pageCount && args.current < args.pageCount - 2 && args.pageCount != 4) {
                obj.append('<a href="javascript:;" class="tcdNumber">' + args.pageCount + '</a>');
            }
            if (args.current < args.pageCount) {
                obj.append('<a href="javascript:;" class="nextPage"><span class="material-icons-outlined">keyboard_double_arrow_right</span></a>');
            } else {
                obj.remove('.nextPage');
                obj.append('<span class="disabled"><span class="material-icons-outlined">keyboard_double_arrow_right</span></span>');
            }
            // obj.append('<span class="pagecount">共' + args.pageCount + '页</span>');
            // if (args.turndown === 'true') {
            //     obj.append('<span class="countYe">到第<input type="text" maxlength=' + args.pageCount.toString().length + '>页<a href="javascript:;" class="turndown">确定</a><span>');
            // }
        })();
    },
    bindEvent: function(obj, args) {
        return (function() {
            obj.on("click", "a.tcdNumber",
                function() {
                    let current = parseInt($(this).text());
                    ms.fillHtml(obj, {
                        "current": current,
                        "pageCount": args.pageCount,
                        // "turndown": args.turndown
                    });
                    if (typeof(args.backFn) == "function") {
                        args.backFn(current);
                    }
                    smoothScrollToTop()
                });
            obj.on("click", "a.prevPage",
                function() {
                    let current = parseInt(obj.children("span.current").text());
                    ms.fillHtml(obj, {
                        "current": current - 1,
                        "pageCount": args.pageCount,
                        // "turndown": args.turndown
                    });
                    if (typeof(args.backFn) == "function") {
                        args.backFn(current - 1);
                    }
                    smoothScrollToTop()
                });
            obj.on("click", "a.nextPage",
                function() {
                    let current = parseInt(obj.children("span.current").text());
                    ms.fillHtml(obj, {
                        "current": current + 1,
                        "pageCount": args.pageCount,
                        // "turndown": args.turndown
                    });
                    if (typeof(args.backFn) == "function") {
                        args.backFn(current + 1);
                    }
                    smoothScrollToTop()
                });
            // obj.on("click", "a.turndown",
            //     function() {
            // let page = $("span.countYe input").val();
            // if (page > args.pageCount) {
            //     alert("您的输入有误，请重新输入！");
            // }
            // ms.fillHtml(obj, {
            //     "current": page,
            //     "pageCount": args.pageCount,
            // "turndown": args.turndown
            //     });
            // });
        })();
    }
}
$.fn.createPage = function(options) {
    let args = $.extend({
            pageCount: pageNum,
            current: 1,
            // turndown: true,
            backFn: function() {}
        },
        options);
    ms.init(this, args);
}
const mySwiper = new Swiper('.all-product-swiper-test',{
    autoplay: false,
    /*slidesPerView: "auto",*/
    on: {
        slideChangeTransitionEnd: function () {
            console.log(this.activeIndex);
            ms.fillHtml($('.pagesDiv'), {
                "current": this.activeIndex + 1,
                "pageCount": pageNum,
                // "turndown": true
            });
        }
    }
});

function smoothScrollToTop() {
    window.scrollTo({
        left: 0,
        top: 256,
        behavior: 'smooth'
    })
}

