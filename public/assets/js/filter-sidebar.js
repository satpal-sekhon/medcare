/**=====================
    Filter Sidebar js
==========================**/
$(document).on('click', '.filter-button', function () {
    $(".bg-overlay, .left-box").addClass("show");
});

$(document).on('click', '.back-button, .bg-overlay', function () {
    $(".bg-overlay, .left-box").removeClass("show");
});

$(document).on('click', '.sort-by-button', function () {
    $(".top-filter-menu").toggleClass("show");
});
