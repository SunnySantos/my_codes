let x = 0;

const container = document.querySelector('#h-scroll .swiper-wrapper')

function horizontalScoll(e) {
    e.preventDefault();
    const { left } = container.getBoundingClientRect();
    const deltaY = e.deltaY || e.wheelDelta;

    if (deltaY > 0 && left > -container.scrollWidth + container.clientWidth) {
        x -= 10
    }

    if (deltaY < 0 && left < 0) {
        x += 10
    }

    container.style.transform = `translate3d(${x}%,0,0)`

    if(left === 0 || left === -container.scrollWidth + container.clientWidth) {
        container.removeEventListener('wheel', horizontalScoll)
    }
}


window.addEventListener('scroll', function (e) {
    const { top } = container.getBoundingClientRect();

    if (top < 150) {
        container.addEventListener('wheel', horizontalScoll);
    }
})