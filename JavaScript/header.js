// const jumbotron = document.getElementById("jumbotron-ol");
//
// window.onscroll = function () {
//     if(document.documentElement.scrollTop === 0){
//         jumbotron.style.top = '65px'
//         jumbotron.style.height = '191px'
//     }else{
//         jumbotron.style.top = '0'
//         jumbotron.style.height = '256px'
//     }
// }
const header = document.getElementById("header");
if(document.documentElement.scrollTop === 0) header.style.background = 'rgba(255,255,255,0)'
// console.log(header.style.background)
window.onscroll = function () {
    if(document.documentElement.scrollTop === 0){
        header.style.background = 'rgba(255,255,255,0)'
    }else{
        header.style.background = 'rgba(0,0,0,0.5)'
    }
}

