<?php
require_once (__DIR__ . "/style-only.php");

final class Zalo_Chat_Box {

	protected static $instance = null;

	public $style;

	public static function instance() {
		if (self::$instance == null){
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init_hooks') );
		$this->style = new Style();
	}

	public function init_hooks() {
		add_action ('admin_menu', array( $this, 'menu') );
		add_action ( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ));
		add_action ( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ));
		add_action ( 'wp_footer', array( $this, 'frontend'));

		if ( isset( $_REQUEST['page'] ) && 'zalo-chat-box' == $_REQUEST['page'] ) {
			$this->save();
		}

	}

	public function menu() {
		if ( current_user_can( 'manage_options' ))
		{
			$title = esc_html( 'Zalo Chat Box' );
			$cap = 'manage_options';
			$slug = 'zalo-chat-box';
			$callback = array( $this, 'backend' );
			$icon = ZCB_ASSETS_URL . 'images/zalo-icon.png';
			$position = 600;

			add_menu_page( $title, $title, $cap, $slug, $callback, $icon, $position );
		}
	}

	public function enqueue_scripts(){
		//Enqueue Fontawesome
		wp_enqueue_style( 'font-awesome-free', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
		wp_enqueue_style( 'zcb_fe_style', ZCB_ASSETS_URL . '/fe-style.css', array(), ZCB_VERSION);
		$data = $this->data();
		
		$this->style->addStyle( $data );
        
	}

	public function admin_enqueue_scripts(){
		wp_enqueue_style( 'zcb_admin_style', ZCB_ASSETS_URL . '/admin-style.css', array(), ZCB_VERSION);
		wp_enqueue_style( 'bs3', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css', array(), ZCB_VERSION);
		wp_enqueue_style( 'colorpicker-css', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.css', array(), ZCB_VERSION);

		wp_deregister_script('jquery');
		wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-2.2.2.min.js', array(), null, true);
		wp_register_script('colorpicker-js', "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.js", array('jquery'), null, true);
		wp_enqueue_script( 'colorpicker-js' );

	}

	public function data()
	{
		$defaults = array(
			'zalo-oaid' => '2141059439702029370',
			'data-welcome-message' => 'Hello World',
			'right' =>'-2',
			'bottom' => '108',
			'tel'	=> '0964507845',
			'bg-color'	=> '#1f2628ff',
			'fb' => 'https://www.facebook.com/groups/wpbeginner'
		);

		$data = get_option( 'zcb_options', false );

		if ( empty( $data ) || $this->emptyArray($data) == true )
		{	
			return $defaults;
		} 
		else 
		{
			return $data;
		}
	}	

	public function form_action()
	{
		return admin_url( '/admin.php?page=zalo-chat-box');
	}

	public function save()
	{	
		if ( ! isset( $_POST['zcb-settings-nonce'] ) || ! wp_verify_nonce( $_POST['zcb-settings-nonce'], 'zcb-settings' ) ) {
			return;
		}

		$data = $this->data();

		$data['zalo-oaid'] = isset( $_POST['zcb_options']['zalo-oaid'] ) ? sanitize_text_field($_POST['zcb_options']['zalo-oaid']) : "";
		$data['data-welcome-message'] = isset( $_POST['zcb_options']['data-welcome-message'] ) ? sanitize_text_field($_POST['zcb_options']['data-welcome-message']) : "";
		$data['right'] = isset( $_POST['zcb_options']['right'] ) ? sanitize_text_field($_POST['zcb_options']['right']) : "";
		$data['bottom'] = isset( $_POST['zcb_options']['bottom'] ) ? sanitize_text_field($_POST['zcb_options']['bottom']) : "";
		$data['tel'] = isset( $_POST['zcb_options']['tel'] ) ? sanitize_text_field($_POST['zcb_options']['tel']) : "";
		$data['bg-color'] = isset( $_POST['zcb_options']['bg-color'] ) ? sanitize_text_field($_POST['zcb_options']['bg-color']) : "";
		$data['fb'] = isset( $_POST['zcb_options']['fb'] ) ? sanitize_text_field($_POST['zcb_options']['fb']) : "";

		$update_option = update_option( 'zcb_options', $data );

		// if ( $update_option ){
		// 	$_SESSION['success'] =  '<div class="alert alert-success"><p>' . esc_html('Setting Updated') . '</p></div>';var_dump($_SESSION['success']);
		// }
	}

	public function message()
	{
		if ( !empty( $_POST ) )
			echo '<div class="alert alert-success"><p>' . esc_html('Setting Updated') . '</p></div>';
	}

	public function backend() 
	{	
		require_once ('backend.php');
	}

	public function frontend() 
	{
		$data = $this->data();

		$zalo_oaid = $data['zalo-oaid'];
		$data_welcome_message = $data['data-welcome-message'];
		$fb =  $data['fb'];
		$fb_m = substr($fb, strrpos($fb, '/') + 1);
		ob_start();
		//echo '<link rel="stylesheet" href="' . ZCB_URL .  'assets/fe-style.css" type="text/css" media="all" />';
		return require_once( plugin_dir_path( __FILE__ ) . "pages/front-end.php" );

		//return ob_get_clean();


	}	

	//check if all values in multidimensional array are empty
	function emptyArray($array) {

	  $empty = TRUE;

	  if ( is_array($array) ) {
	    foreach ( $array as $value ) {
	      if ( !empty($value) ) {
	        $empty = FALSE;
	      }
	    }
	  }
	  elseif ( !empty($array) ) {
	    $empty = FALSE;
	  }

	  return $empty;
	}


}
