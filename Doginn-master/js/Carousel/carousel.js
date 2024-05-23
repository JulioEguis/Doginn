$(document).ready(function() {
    const carousel = $(".carousel");
    const prevButton = $(".prev");
    const nextButton = $(".next");
    const imgWidth = $(".carousel img").outerWidth(true);
    let currentIndex = 0;

    prevButton.click(function() {
        if (currentIndex > 0) {
            currentIndex--;
            carousel.css("transform", `translateX(-${currentIndex * imgWidth}px)`);
        }
    });

    nextButton.click(function() {
        if (currentIndex < carousel.children().length - 3) {
            currentIndex++;
            carousel.css("transform", `translateX(-${currentIndex * imgWidth}px)`);
        }
    });
});