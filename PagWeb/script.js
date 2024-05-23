document.addEventListener("DOMContentLoaded", () => {
    const button = document.querySelector(".themeButton");
    button.style.cursor = "pointer";
    button.addEventListener("click", clickThemeHandler, false);
    let body = document.querySelector("body");
    const mainBanner = document.querySelector(".mainBanner");
    const bar = document.querySelector(".bar");

    let theme = 0;

    function clickThemeHandler() {
        if (theme == 0) {
            theme++;
            cambiarColorFons("black", "white", "#403938");
        } else {
            theme--;
            cambiarColorFons("whitesmoke", "black", "white");
        }
    }

    function cambiarColorFons(color, colortext, colorbar) {
        document.body.style.backgroundColor = color;
        mainBanner.style.color = colortext;
        bar.style.backgroundColor = colorbar;
        bar.style.color = colortext;
    }
});
