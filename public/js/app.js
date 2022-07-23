/* Scroll back to top */
const scrollBtn = document.querySelector(".scroll");
scrollBtn.addEventListener("click", () => {
    document.documentElement.scrollTop = 0; //for Chrome, Firefox, IE and Opera
    document.body.scrollTop = 0; //for Safari
});

