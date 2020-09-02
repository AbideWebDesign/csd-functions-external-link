jQuery(function ($) {	
	// External Link Pop-up with domains to whitelist
	var domains = ['csd509j.net', 'https://teachcorvallis.org', 'https://www.parentsquare.com'];

	$('a[href^="http"]').on('click', function (e) {
		
		var link = $(this).attr('href');
		
		var external = domains.find( function (domain) {
			var reg = new RegExp( domain );
			
			return link.match(reg) !== null;		
		});
	
		if ( external === undefined ) {
			e.preventDefault();
			$('#externalLink').attr('href', $(this).attr('href'));
			$('#modalNotification').modal('show');
		}
				
	});
});