jQuery(function($) {
	$('.loadmore').click(function(){
 		var body = $('body');

 		if (body.hasClass('archive')) {
 			var button = $(this),
 			    data = {
 				'action': 'loadmore',
				'query': loadmore_params.posts,
				'page' : loadmore_params.current_page,
				'posts_per_page': 10 
 			};		
 		} else {
			var button = $(this),
			    data = {
				'action': 'loadmore',
				'query': posts_custom, 
				'page' : current_page_custom,
				'posts_per_page': 5
			};
		}
 
		$.ajax({ 
			url : loadmore_params.ajaxurl,
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Laddar...');
			},
			success : function( data ){
				if( data ) { 
					button.text( 'Visa mer' ).prev().before(data); // insert new posts
					$('.post-container').append(data);

					if (body.hasClass('archive')) {
						// if archive ( wp_query )
						loadmore_params.current_page++

						if (loadmore_params.current_page == loadmore_params.max_page) {
							button.remove(); 
						}
					} else {
						// If custom query
						current_page_custom++;	

						if ( current_page_custom == max_page_custom ) {
							button.remove(); 
						}
					}
 
					

				} else {
					button.remove(); // if no data, remove the button as well
				}
			}
		});
	});
});