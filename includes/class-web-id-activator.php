<?php

/**
 * Fired during plugin activation
 *
 * @link       https://ivalt.com/author/
 * @since      1.0.0
 *
 * @package    Ivalt
 * @subpackage Ivalt/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ivalt
 * @subpackage Ivalt/includes
 * @author     Jaskaran Singh <jaskaran.singh@ivalt.com>
 */
class WebID_Activator extends WebID_Tables_Generator{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        $self = new self();
        $self->create_web_id_users_table();
	}

}
