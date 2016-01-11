(function($){
	
	
	/*
	*  acf/setup_fields
	*
	*  This event is triggered when ACF adds any new elements to the DOM. 
	*
	*  @type	function
	*  @since	1.0.0
	*  @date	01/01/12
	*
	*  @param	event		e: an event object. This can be ignored
	*  @param	Element		postbox: An element which contains the new HTML
	*
	*  @return	N/A
	*/
	
	$(document).live('acf/setup_fields', function(e, postbox){
		
		$(postbox).find('.field_type-button').each(function(){
			
			// initiate JS on my field!
			// $(this).add_awesome_stuff();
			
			var $this = $(this),
					$internal = $this.find('td.internal'),
					$external = $this.find('td.external'),
					$hidden = $this.find('.use_internal'),
					new_text;

			/**
			 * Deal with the switch
			 */

			$this.find('.switch a').on('click', function(e){

				e.preventDefault();

				$this.find('td.internal, td.external').toggleClass('hidden');

				if($hidden.val() == 'false'){
					$hidden.val('true');
					new_text = 'external';
				}else{
					$hidden.val('false');
					new_text = 'internal';
				}

				$(this).find('span').text(new_text);

			});

		});
	
	});

})(jQuery);
