


window.addEventListener('load', function () {
    var breadcrumbs = document.querySelector('#breadcrumbs h5');
    if (breadcrumbs) {
        var home = document.createElement('a');
        home.innerText = 'Home';
        breadcrumbs.prepend(home);
    }
});