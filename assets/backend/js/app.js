const mobile = window.matchMedia("(max-width: 992px )");

$(document).ready(function(){
    $(".sidebar-dropdown-toggle").click(function(){
        $(this).closest(".sidebar-dropdown")
            .toggleClass("show")
            .find(".sidebar-dropdown")
            .removeClass("show");

        $(this).parent()
            .siblings()
            .removeClass("show");
    });

    $(".menu-toggle").click(function(){
        if (mobile.matches) {
            $(".sidebar").toggleClass("mobile-show");
        } else {
            $(".dash").toggleClass("dash-compact");
        }
    });

    $(".searchbox-toggle").click(function(){
        $(".searchbox").toggleClass("show");
    });
});