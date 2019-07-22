
$(function(){

	/* Collapse all on load */ 

	$('.collapse').collapse();

	/* Make farmers list visible */

	$("#farmers").removeClass("d-none");

	$("#spinner").addClass("d-none");

	/* Delete farmer action */

	$("#farmers").on("click", ".delete-farmer", function(){

		$(this).closest(".card").remove();
	})

	$(".page-item .page-link").click(function(e){

		$('#accordion').addClass("d-none");
		
		$("#spinner").removeClass("d-none");

		e.preventDefault();

		$("html, body").animate({ scrollTop: 0 }, 2000);

		var page = $(this).attr("data-page");

		$.get("/ajax?page=" + page, function(data){

			$('#accordion').html(data);
			
			$('.collapse').collapse();

			$('#accordion').removeClass("d-none");

			$("#spinner").addClass("d-none");

			$('.page-item').removeClass('active');

			$('.page-link[data-page="'+page+'"]:not(.prev, .next)').parent().addClass('active');

			$('.prev').attr("data-page", page);

			$('.next').attr("data-page", ((page == "75") ? 75 : Number(page) + 1));


		}).fail(function(){
              
           alert("Unable to process your request");
                
         });

	});
}); 