<?php
class Timezone_Search_ManageScripts {

  private $pluginUrl;

  public function __construct($pluginUrl)
  {
      $this->pluginUrl = $pluginUrl;
  }

  public function enqueueD2LJS($hook) {
		$d2l_gm_tz_options = get_option('my_option_name');
		$gmap_api_key = $d2l_gm_tz_options["d2l_gmtz_api_key"];
		$gm_tz_active_page = $d2l_gm_tz_options["d2l_gmtz_active_page"];


		if (is_page($gm_tz_active_page)) {
			//enqueue JQuery script
			wp_enqueue_script( 'jquery' );
			$gmaps_api_url = '';
			$gmaps_api_url .= 'https://maps.googleapis.com/maps/api/js?key=';
			$gmaps_api_url .= $gmap_api_key;
			wp_register_script (
				'd2l-gmaps-js', 
				$gmaps_api_url,
				array( 'jquery' ),
				'',
				true
			);
		  wp_enqueue_script('d2l-gmaps-js');

			wp_register_script (
				'd2l-gm-tz-js', 
				$this->pluginUrl . 'js/d2l-gm-tz.js',
				array( 'jquery' ),
				'',
				true
			);
		  wp_enqueue_script('d2l-gm-tz-js');

			wp_localize_script( 'd2l-gm-tz-js', 'd2l_gm_tz_ajax', array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' )
			));
		}
	}
}