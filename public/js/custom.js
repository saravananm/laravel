
$(function() {
	$('.header-banner a').first().addClass('active')
	$('.header-banner a').each(function(i) {
		if(i != 0)
			this.style.display = "none"; 
	});
	setTimeout(changeBannerImage, 3000);
});


function changeBannerImage(){
    $curr = $(".header-banner .active");
    $next = $(".header-banner .active").next();

    if($next[0] === undefined)
        $next = $(".header-banner a").eq(0);

    $curr.fadeOut(2000, function(){
        $next.fadeIn(2000, function(){
            $curr.removeClass("active");
            $next.addClass("active");
            setTimeout(changeBannerImage, 3000);  //change image every 4 seconds
        });   
    });                 
}


function leftPanelTab(index)
{
    $( ".leftpaneltab1" ).removeClass( "active" );
    $( ".leftpaneltab2" ).removeClass( "active" );
    $( ".leftpaneltab3" ).removeClass( "active" );
    $( ".leftpaneltab"+index ).addClass( "active" );

    $( ".leftpanelcontent1" ).css("display", "none");
    $( ".leftpanelcontent2" ).css("display", "none");
    $( ".leftpanelcontent3" ).css("display", "none");
    $( ".leftpanelcontent"+index ).css("display", "block");
}
leftPanelTab(1)