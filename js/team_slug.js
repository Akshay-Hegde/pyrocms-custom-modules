(function ($) {
	
	$(function () {
		
		$("input[name=name]").on("keyup",function(e) {

		    pyro.generate_slug('input[name="name"]','input[name="slug"]');
        });
		
	});
})(jQuery);