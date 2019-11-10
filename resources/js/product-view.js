// View Product Page
$("ul.menu-items > li").on("click",function(){
    $("ul.menu-items > li").removeClass("active");
    $(this).addClass("active");
})

$(".attr, .attr2").on("click",function(){
    var clase = $(this).attr("class");

    $("." + clase).removeClass("active");
    $(this).addClass("active");
})