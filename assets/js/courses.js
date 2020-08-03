$(document).ready(function() {
	// https://codepen.io/jakestuts/pen/nEFyw
	$("#dropdown").on("click", function(e){
		e.preventDefault();
		e.stopPropagation();
		if($(this).hasClass("open")) {
			$(this).removeClass("open");
			$(this).children("ul").slideUp("fast");
		} else {
			$(this).addClass("open");
			$(this).children("ul").slideDown("fast");
		}
	});

	$(document).on("click", function(event){
		if (this.id != 'dropdown') {
			var thi = $("#dropdown");
			if (thi.hasClass("open")) {
				thi.removeClass("open");
				thi.children("ul").slideUp("fast");
			}
		}
    });

	$('.page-file').on('click', function(e) {
		e.preventDefault();
		var page = $(this).attr('href');
		// var arr = page.split("/");
		// page = arr.filter(item => item);
		// console.log(page);
		window.location.href = page;
		return false;
	});
});
