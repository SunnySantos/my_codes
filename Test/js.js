window.addEventListener('load', () => {
    const queryString = window.location.search
    const shareBtns = document.querySelectorAll('.share-btn')

    shareBtns.forEach(shareBtn => {
        var textbox = document.createElement('input')
        const btn = shareBtn.querySelector('[data-link]')

        btn.addEventListener('click', (e) => {
            e.preventDefault()
            navigator.clipboard.writeText(btn.getAttribute('data-link'))
            btn.querySelector('.elementor-icon-list-text').textContent = 'Copied!'
            shareBtn.querySelector('li:first-child').style.display = 'block'
        })

        var li = shareBtn.querySelector('li:first-child')
        li.append(textbox)
        textbox.value = li.querySelector('span').textContent
        li.querySelector('span').remove()

    })

    if (queryString && shareBtns.length > 0) {
        document.querySelector(`.share-btn [data-link='${window.location}']`).parentElement.nextElementSibling.querySelector('a').click()
    }
})


