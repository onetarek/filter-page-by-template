(function($) {
	$(document).ready(function() {
		var container = $('.fpbt-five-star-wp-rate-action');
		if (container.length) {
			container.find('a').click(function() {
				container.remove();
				
				var rateAction = $(this).attr('data-rate-action');
				$.post(
					ajaxurl,
					{
						action: 'fpbt_five_star_wp_rate',
						rate_action: rateAction,
						_n: container.find('ul:first').attr('data-nonce')
					},
					function(result) {}
				);
		
				if ('do-rate' !== rateAction) {
					return false;
				}
			});
		}
	});
})(jQuery);