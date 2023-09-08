window.addEventListener("scroll", () => {
    document.querySelectorAll(".to-dark").forEach(toDark => {
        if (toDark.querySelector(".elementor-motion-effects-layer").style.opacity == "1") {
            toDark.querySelectorAll(".elementor-heading-title").forEach(heading => heading.classList.add("white"))
            toDark.querySelectorAll(".elementor-widget-text-editor").forEach(text => text.classList.add("white"))
            toDark.querySelectorAll(".elementor-widget-text-editor").forEach(text => text.classList.add("to-light-btn"))
        } else {
            toDark.querySelectorAll(".elementor-heading-title").forEach(heading => heading.classList.remove("white"))
            toDark.querySelectorAll(".elementor-widget-text-editor").forEach(text => text.classList.remove("white"))
            toDark.querySelectorAll(".elementor-widget-text-editor").forEach(text => text.classList.remove("to-light-btn"))
        }
    })
});