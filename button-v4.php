<?php

class acf_field_button extends acf_field
{
	// vars
	var $settings,
			$defaults;
		
	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function __construct()
	{
		// vars
		$this->name = 'button';
		$this->label = __('Button');
		$this->category = __("Basic",'acf'); // Basic, Content, Choice, etc
		$this->defaults = array();
		
		// do not delete!
    parent::__construct();
    	
    	
    // settings
		$this->settings = array(
			'path' => apply_filters('acf/helpers/get_path', __FILE__),
			'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
			'version' => '1.0.0'
		);

		// $this->settings = array(
		// 	'path' => acf_get_path(__DIR__),
		// 	'dir' => plugin_dir_url(__FILE__),
		// 	'version' => '1.0.0'


		// );

	}
	
	
	/*
	*  create_options()
	*
	*  Create extra options for your field. This is rendered when editing a field.
	*  The value of $field['name'] can be used (like bellow) to save extra data to the $field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field	- an array holding all the field's data
	*/
	
	function create_options( $field )
	{
		// defaults?
		$field = array_merge($this->defaults, $field);
		
		// // key is needed in the field names to correctly save the data
		$key = $field['name'];
	
		
		// Create Field Options HTML
			?>
	<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e( "Button Text", 'acf' ); ?></label>

				<p><?php _e( "he text that will appear on the button", 'acf' ) ?></p>
			</td>
			<td>

		<?php		
		do_action( 'acf/create_field', array(
			// 'label'			=> __('Button Text','acf-button'),
			// 'instructions'	=> __('The text that will appear on the button','acf-button'),
			'value'	        => $field['text'],
			'type'			=> 'text',
			'name'			=> 'fields[' . $key . '][text]'
		));	
		?>
	        </td>
			</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e( "Button Action", 'acf' ); ?></label>

				<p><?php _e( "What happens when you click the button?", 'acf' ) ?></p>
			</td>
			<td>

		<?php
		do_action( 'acf/create_field', array(
			// 'label'			=> __('Button Action','acf'),
			// 'instructions'	=> __('What happens when you click the button?','acf'),
			'type'		=>	'select',
			'name'		=>	'fields[' . $key . '][button_action]',
			'choices' 	=>	[
				'ajax_get'	=> 'AJAX GET Request',
				'open_url'	=> 'Open a URL'
			]
		)); 
		?>

			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e( "URL", 'acf' ); ?></label>
				<p><?php _e( "Inject ACF vars by using their form name in {brackets}. IE /wp-admin/admin-ajax.php?action=some_action&var={acf[field_5691f90569c3a]}", 'acf' ) ?></p>
			</td>
			<td>
		<?php
		do_action( 'acf/create_field', array(
			// 'label'			=> __('URL','acf-button'),
			// 'instructions'	=> __('Inject ACF vars by using their form name in {brackets}. IE /wp-admin/admin-ajax.php?action=some_action&var={acf[field_5691f90569c3a]}','acf-button'),
			'value'			=> $field['url'],
			'type'			=> 'text',
			'name'			=> 'fields[' . $key . '][url]'
		));
		?>
		</td>
		</tr>

		<?php

	}


	/*  create_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field - an array holding all the field's data
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function create_field( $field )
	{

		//print_r($field);

		
		$field = array_merge($this->defaults, $field); 
		$field_name = esc_attr( $field['name'] );
		$uid = uniqid();

		/*
		
		Array
		(
			[ID] => 190
			[key] => field_56922b4273fff
			[label] => Initialization
			[name] => acf[field_56922b4273fff]
			[prefix] => acf
			[type] => button
			[value] => 
			[menu_order] => 2
			[instructions] => Sends codes necessary to reprogram the tracker to use this system.
			[required] => 0
			[id] => acf-field_56922b4273fff
			[class] => 
			[conditional_logic] => 0
			[parent] => 182
			[wrapper] => Array
				(
					[width] => 
					[class] => 
					[id] => 
				)

			[_name] => initialize_btn
			[_input] => acf[field_56922b4273fff]
			[_valid] => 1
			[text] => Reprogram Tracker Now
			[button_action] => ajax_get
			[url] => /controller/pub/Device/initialize
		)
		 */
		

		?>

		<script type="text/javascript">
		jQuery(function($)
		{
			var uid = <?=json_encode($uid)?>;
			var field = <?=json_encode($field)?>;
			var btn = $('#' + uid);
			var submitting = false;
			btn.click(function()
			{
				if(submitting) {
					return false;
				}
				var url = injectVarsIntoURL(field.url);
				var btn_txt = btn.val();
				if( field.button_action == 'ajax_get' ) 
				{
					submitting = true;
					btn.val('Please Wait...');
					$.get(url, {}, function(res)
					{
						submitting = false;
						alert(res);
						btn.val(btn_txt);
					});
				}
				else if( field.button_action == 'open_url' ) {
					window.open(url)
				}
			});
			function injectVarsIntoURL(url)
			{
				var vars = url.match(/{.*?}/g);
				var vals = _.each(vars, function(placeholder)
				{
					var name = placeholder.substr(1, placeholder.length-2); // ignore opening and closing {brackets}
					var val = $('input[name=' + name + ']').val();
					url = url.replace(placeholder, val);
				});
				return url;
			}
		});
		</script>

		<input id="<?=$uid?>" type="button" class="button button-primary button-large" value="<?=$field['text']?>">

		<?php
	}
	
	
	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add css + javascript to assist your create_field() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_enqueue_scripts()
	{
		// Note: This function can be removed if not used
		
		
		// register acf scripts
		wp_register_script( 'acf-input-button', $this->settings['dir'] . 'js/input.js', array('acf-input'), $this->settings['version'] );
		wp_register_style( 'acf-input-button', $this->settings['dir'] . 'css/input.css', array('acf-input'), $this->settings['version'] ); 
		
		
		// scripts
		wp_enqueue_script(array(
			'acf-input-button',	
		));

		// styles
		wp_enqueue_style(array(
			'acf-input-button',	
		));
		
		
	}
	
	/*
	*  format_value_for_api()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is passed back to the api functions such as the_field
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/
	
	function format_value_for_api( $value, $post_id, $field )
	{

	}
	
}

new acf_field_button();
