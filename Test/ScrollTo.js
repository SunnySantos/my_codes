const hashValue = window.location.hash

if (hashValue) {
    setTimeout(() => {
        const section = document.getElementById(hashValue.slice(1));
        if (section) {
            section.scrollIntoView({ behavior: 'smooth' });
        }
    }, 1000)
}