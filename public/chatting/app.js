let menuIcon = document.querySelector(".options>.menu");
let container = document.querySelector('.opt-container');

menuIcon.addEventListener("click", () => {
    // Toggle the classes
    menuIcon.classList.toggle("bx-menu");
    container.classList.toggle('collapse')
    menuIcon.classList.toggle("bx-x");
    container.classList.toggle('active')

});
