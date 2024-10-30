<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://ivalt.com/author/
 * @since      1.0.0
 *
 * @package    WebID
 * @subpackage WebID/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WebID
 * @subpackage WebID/admin
 * @author     Jaskaran Singh <jaskaran.singh@ivalt.com>
 */
class WebID_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $webIDUsersTable;


    private $wpdb;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
        global $wpdb;
		$this->plugin_name = $plugin_name;
		$this->version = $version;
        $this->wpdb = $wpdb;
        $this->webIDUsersTable = $wpdb->prefix . 'web_id_users';
	}



    public function setup_plugin_options_menu()
    {
        // WebID™
        $url = plugin_dir_url(__FILE__);
        add_menu_page(
            'iVALT',
            'iVALT',
            'read',
            'webID',
            array( $this, 'render_web_id_register_page_content'),
            $url.'/images/iVALT.png'
        );
    }

	/**
	 * Register the stylesheets for the admin area.
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url(__FILE__) . 'css/web-id-admin.css', array(), date("h:i:s"), 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url(__FILE__) . 'js/web-id-admin.js', array( 'jquery' ), date("h:i:s"), true );
	}

    public function render_web_id_register_page_content(): void
    {
        $url = plugin_dir_url(__FILE__);
        $userDetails = wp_get_current_user();
        $webIdUser = $this->get_web_id_user_by_username($userDetails->user_login);
        if($webIdUser == null){
            unset($_SESSION['web_id_username']);
        }else{
            $_SESSION['web_id_username'] = $userDetails->user_login;
	        $userMobile = $webIdUser->mobile;
            $countryCode = $webIdUser->country_code;
        }

        if(isset($_SESSION['web_id_username'])){
            if($userDetails->user_login == $_SESSION['web_id_username']){
                include_once( 'partials/success.php' );
            }else{
                include_once('partials/register-page.php');
            }
        }else{
            include_once('partials/register-page.php');
        }
    }


    public function render_web_id_success_page_content(): void
    {
        $url = plugin_dir_url(__FILE__);
	    $userDetails = wp_get_current_user();
        include_once( 'partials/success.php' );
    }

    public function admin_panel_initialization(){

        @session_start();

        if(isset($_POST['action']) && $_POST['action'] == 'put_session_in_options'){
            $_SESSION['web_id_session_token'] = sanitize_text_field($_POST['token']);
            $_SESSION['login_time'] = null;
        }

        if(isset($_POST['action']) && $_POST['action'] == 'logout_admin_panel'){
            $html = wp_loginout('/wp-admin/',false);
            $url = preg_match('/<a href="(.+)">/', $html, $match);
            $info = $match[1];
            echo $match[1];
            exit;
        }

        $userDetails = wp_get_current_user();
        $webIdUser = $this->get_web_id_user_by_username($userDetails->user_login);
        $stored_token = get_option('web_id_token_'.$userDetails->ID);

        if(is_null($webIdUser) && isset($_SESSION['web_id_username'])){
            unset($_SESSION['web_id_username']);
        }

        if(!isset($_SESSION['web_id_username']) && !is_null($webIdUser)){
            $_SESSION['web_id_username'] = $userDetails->user_login;
        }else{
            if(isset($_SESSION['web_id_username'])) {
                if ($userDetails->user_login != $_SESSION['web_id_username']) {
                    unset($_SESSION['web_id_username']);
                }
            }
        }

        if($stored_token != '' && $stored_token != null){
            $login_session = $_SESSION['web_id_session_token'] ?? null;
            if($login_session == null || $login_session == ''){
                if(!is_null($webIdUser)){
                    if(@$_SESSION['login_time'] == null){
                        $_SESSION['login_time'] = date('M d, Y H:i:s');
                    }
                    $url = plugin_dir_url( __FILE__ );
                    $userMobile = $webIdUser->mobile;
                    $countryCode = $webIdUser->country_code;
                    include_once ('partials/login-page.php');
                    wp_die();
                }
            }
        }
    }

    public function logout_admin_panel(){
        $html = wp_loginout('/wp-admin/',false);
        $url = preg_match('/<a href="(.+)">/', $html, $match);

        $info = $match[1];
        echo $match[1];
        exit;
    }

    /**
     * Remove iVault Session on logout admin user
     */
    public function webID_logout_session(){
        @session_start();
        $_SESSION['web_id_session_token'] = '';
    }

    /**
     * @param $username
     * @return array|object|stdClass|void|null
     */
    protected function get_web_id_user_by_username($username)
    {
        return $this->wpdb->get_row(
            $this->wpdb->prepare(
                "SELECT * FROM $this->webIDUsersTable WHERE username = %s AND is_active = %s",
                $username,
	            1
            )
        );
    }

    public function put_session_in_options(){
        @session_start();
        $_SESSION['web_id_session_token'] = $_POST['token'];
        $_SESSION['login_time'] = null;
    }

    public function register_web_id()
    {

        if(!isset($_POST['mobile']) || !isset($_POST['country_code'])){
            echo json_encode([
                'status' => false,
                'message' => 'Mobile and country code is requied',
                'debug' => time()
            ]);
            wp_die();
        }
        $wpdb = $this->wpdb;
        $current_user = wp_get_current_user();
        $mobile = sanitize_text_field($_POST['mobile']);
        $country_code = sanitize_text_field($_POST['country_code']);
        $is_active = 1;
        $wpTrackTable = $this->webIDUsersTable;
        // $wpTrackTable = $this->wpdb->$this->webIdUsersTable;
        

        // $sqlQuery = "SELECT * FROM `" . $wpTrackTable;
        // $sqlQuery .= "` WHERE `username` = '" . $current_user->user_login . "'";
        // $sqlQuery .= " AND `country_code`   = '" . $country_code . "'";
        // $sqlQuery .= " AND `mobile` = '" . $mobile . "'";

                        $sqlQuery = $this->wpdb->prepare(
                    "SELECT * FROM `%s` WHERE `username` = %s AND `country_code` = %s AND `mobile` = %s",
                    $wpTrackTable,
                    $current_user->user_login,
                    $country_code,
                    $mobile
                   );
        $userExist = $this->wpdb->get_row($sqlQuery, ARRAY_N);

        if(!is_null($userExist)){
            if(count($userExist) > 0){
                $wpdb->update($wpTrackTable, [
                    'is_active' => $is_active
                ], [
                    'user_id' => $current_user->ID
                ]);
                update_option('web_id_token_'.$current_user->ID,rand(1111111111,9999999999),'yes');
            }
        }else{
	        $insertResponse = $wpdb->insert(
	            $wpTrackTable,
	            [
	                'email' => $current_user->user_email,
	                'username' => $current_user->user_login,
	                'country_code' => $country_code,
	                'mobile' => $mobile,
	                'is_active' => $is_active,
	                'user_id' => $current_user->ID,
	                'created_at' => date('Y-m-d H:i:s')
	            ]
	        );

	        if($insertResponse){

		        add_option('web_id_token_'.$current_user->ID,rand(1111111111,9999999999),'','yes');
	            if(@$_SESSION['login_time'] == null){
	                $_SESSION['login_time'] = date('M d, Y H:i:s');
	            }
	            $_SESSION['web_id_session_token'] = date('M d, Y H:i:s');
	            $_SESSION['web_id_username'] = $current_user->user_login;

	            echo json_encode([
	                'status' => true,
	                'message' => 'Successfully Registered',
	                'username' => $current_user->user_login,
	                'debug' => time()
	            ]);
	        }
            wp_die();
		}

        echo json_encode([
            'status' => false,
            'message' => 'Something went wrong',
            'debug' => time()
        ]);

        wp_die();
    }

	public function disable_web_id(){
		$wpTrackTable = $this->webIDUsersTable;
		$wpdb = $this->wpdb;
		$current_user = wp_get_current_user();

		$isDeleted = $wpdb->delete($wpTrackTable,[
			'user_id' => $current_user->ID
		]);

		if($isDeleted){
			delete_option('web_id_token_'.$current_user->ID);
			echo json_encode([
				'status' => true,
				'message' => 'Successfully Disabled',
				'debug' => time()
			]);
		}else{
			echo json_encode([
				'status' => false,
				'message' => 'Something went wrong',
				'debug' => time()
			]);
		}
		wp_die();
	}

}
