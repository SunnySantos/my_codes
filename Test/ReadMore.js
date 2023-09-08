document.querySelectorAll('#custom-testimonials .elementor-widget-text-editor .elementor-widget-container').forEach(text => {
    const maxHeight = 235
    if(text.getBoundingClientRect().height > maxHeight + 50) {
        text.style.maxHeight = `${maxHeight}px`
        let readmore = document.createElement('a')
        readmore.href = '#'
        readmore.textContent = 'Read more'
        readmore.addEventListener('click', (e) => {
            e.preventDefault()
            readmore.classList.toggle('active')
            if(readmore.classList.contains('active')) {
                readmore.textContent = 'Hide'
                text.style.maxHeight = 'initial'
            }else {
                readmore.textContent = 'Read more'
                text.style.maxHeight = `${maxHeight}px`
            }
        })
        text.parentElement.append(readmore)
    }
})


