<?php

class fpbt_five_star_wp_rate_notice{

	public function __construct(){
		add_action( 'wp_ajax_fpbt_five_star_wp_rate', array( $this, 'ajax_handle' ) );
		add_action( 'admin_init', array( $this, 'check_and_set_notice' ) );
	}
	
	public function check_and_set_notice(){
		$data = get_option("filter_page_by_template_data", array() );
		$notice_clicked = isset( $data['wp_rate_notice_clicked'] ) ? intval( $data['wp_rate_notice_clicked'] ) : 0;
		$filter_used = isset( $data['filter_used'] ) ? intval( $data['filter_used'] ) : 0;
		if( 1 != $notice_clicked && $filter_used > 4 )
		{
			add_action( 'admin_notices', array( $this, 'notice' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		}
		
	}

	public function notice(){

	?>
		<div class="fpbt-five-star-wp-rate-action notice notice-success">
			<span class="fpbt-slug"><b>FILTER PAGE BY TEMPLATE</b> <i>Plugin</i></span> 

			<div>
				<?php _e("Hey, You are using the template filter - that's awesome! Could you please do me a BIG favor and give it a 5-star rating on WordPress? Just to help us spread the word and boost our motivation.", "filter-page-by-template" ) ?>
				<br/><br/>
				<strong><em>~ oneTarek</em></strong>
			</div>
			<ul data-nonce="<?php echo wp_create_nonce( 'fpbt_five_star_wp_rate_action_nonce' ) ?>">
				<li><a data-rate-action="do-rate" target="_blank" href="https://wordpress.org/support/plugin/filter-page-by-template/reviews/?rate=5#postform"><?php _e( 'Ok, you deserve it', 'filter-page-by-template' ) ?></a></li>
				<li><a data-rate-action="done-rating" href="#"><?php _e( 'I already did', 'filter-page-by-template' ) ?></a></li>
				<li><a data-rate-action="not-enough" href="#"><?php _e( 'No, not good enough', 'filter-page-by-template' ) ?></a></li>
			</ul>
		</div>
	<?php 
	}


	function admin_enqueue_scripts()
	{
		wp_enqueue_script('fpbt_rate_notice', FPBT_EMBEDER_PLUGIN_URL.'js/five_star_wp_rate_notice.js', array('jquery') );
	}

	public function ajax_handle(){
	    // Continue only if the nonce is correct
	    check_admin_referer( 'fpbt_five_star_wp_rate_action_nonce', '_n' );
	    $data = get_option("filter_page_by_template_data", array() );
	    $data['wp_rate_notice_clicked'] = 1;
	    update_option("filter_page_by_template_data", $data );
	    echo  1 ;
	    exit;
	}
}// end class

new fpbt_five_star_wp_rate_notice();






