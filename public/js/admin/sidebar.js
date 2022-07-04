$(".menuBtn").click(() => {
    $(".sidemenu").hasClass("show") ? $(".sidemenu").removeClass('show') : $(".sidemenu").addClass("show");
});

$(".sidemenu-link").click(() => {
    console.log("link clicked");
});

$(".logout").click((e) => {
    e.preventDefault();
    console.log("logout");
    $("#logout-form").submit();
});