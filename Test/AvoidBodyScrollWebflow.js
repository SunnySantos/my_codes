// JQUERY
$(document).ready(() => {
    let isMenuAlreadyOpen = false;
    $('.menu-button').on('click', () => {
        $('body').css("overflow", isMenuAlreadyOpen ? "auto" : "hidden")
        isMenuAlreadyOpen = !isMenuAlreadyOpen
    })
})

// Native JS
window.addEventListener("load", () => {
    document.querySelector(".mobile_nav").addEventListener("click", () => {
        if(document.querySelector(".mobile_nav").classList.contains("opened")) {
            document.body.style.overflowY = "hidden";
        }else {
            document.body.style.overflowY = "auto";
        }
    });
});