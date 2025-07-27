const toastClose = document.querySelector(".toast-close");
if (toastClose) {
    toastClose.addEventListener("click", () => {
        const toast = document.querySelector(".toast");
        if (toast) toast.classList.add("hide");
    });
}
