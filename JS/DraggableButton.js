document.querySelectorAll('.elementor-widget-button').forEach(button => {
    button.setAttribute('draggable', true);
    button.setAttribute('id', button.getAttribute('data-id'));

    button.addEventListener('dragstart', function (e) {
        e.dataTransfer.setData('text', e.target.id)
    })

    button.addEventListener('dragover', function (e) {
        e.preventDefault();
    });

    button.addEventListener('drop', function (e) {
        var data = e.dataTransfer.getData('text')
        this.parentNode.insertBefore(document.getElementById(data), this);
    })
});

['.elementor-element-c954b23', '.elementor-element-78d9ba8'].forEach(c => {
    document.querySelector(c).addEventListener('drop', function (e) {
        var data = e.dataTransfer.getData('text')
        if (e.target.classList.contains('e-con')) {
            e.target.appendChild(document.getElementById(data));
        }
    })

    document.querySelector(c).addEventListener('dragover', function (e) {
        e.preventDefault();
    })
})