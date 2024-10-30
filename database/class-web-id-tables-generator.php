<?php
/**
 * 
 * Include upgrade file to run MySQL queries
 * 
 */
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

/**
 * Class is responsible for create plugins table 
 * 
 * and also check for table existence
 * 
 */
class WebID_Tables_Generator {
    
    /**
     * Instance of wordPress global DB object
     *
     * @var object
     */
    private $wpdb;

    /**
     * 
     * List of the doctors with basic details
     * 
     * @var string
     */
    private $webIdUsersTable = 'web_id_users';


    /**
     * 
     * Initialize database object and include file to
     * 
     */
    public function __construct(){

        global $wpdb;

        $this->wpdb = $wpdb;
    }


    /**
     * To create a doctors table
     *
     * @return void
     */
    public function create_web_id_users_table(): void
    {

        $wpTrackTable = $this->wpdb->prefix.$this->webIdUsersTable;

        if($this->is_table_already_exist($wpTrackTable))
            return;

        $sqlQuery = "CREATE TABLE `{$wpTrackTable}` (";
        $sqlQuery .= "`id` BIGINT(20) NOT NULL AUTO_INCREMENT,";
        $sqlQuery .= "`email` VARCHAR(100) NOT NULL,";
        $sqlQuery .= "`username` VARCHAR(50) NOT NULL,";
        $sqlQuery .= "`country_code` VARCHAR(10) NULL,";
        $sqlQuery .= "`mobile` VARCHAR(50) NOT NULL,";
        $sqlQuery .= "`is_active` BOOLEAN NOT NULL DEFAULT TRUE,";
        $sqlQuery .= "`user_id` BIGINT(20) NULL,";
        $sqlQuery .= "`created_at` TIMESTAMP NULL DEFAULT NULL,";
        $sqlQuery .= "`updated_at` TIMESTAMP NULL DEFAULT NULL,";
        $sqlQuery .= "PRIMARY KEY(`id`)";
        $sqlQuery .= ") ENGINE = InnoDB";

        // SQL Query to create table
        dbDelta($sqlQuery);
    }

    /**
     * @param $mobile
     * @return array|object|stdClass|void|null
     */
    public function get_web_id_user_by_mobile($mobile)
    { 
        $wpTrackTable = $this->wpdb->prefix.$this->webIdUsersTable;

        // $sqlQuery = "SELECT * FROM `{$wpTrackTable}` WHERE `mobile` = '{$mobile}'";
        $sqlQuery = $this->wpdb->prepare("SELECT * FROM '%S' WHERE 'mobile' = %s",$wpTrackTable,$mobile);
        return $this->wpdb->get_row($sqlQuery);
    }

    /**
     * @param $id
     * @return array|object|stdClass|void|null
     */
    public function get_web_id_user_by_id($id)
    {
        $wpTrackTable = $this->wpdb->prefix.$this->webIdUsersTable;

        // $sqlQuery = "SELECT * FROM `{$wpTrackTable}` WHERE `id` = '{$id}'";
        $sqlQuery = $this->wpdb->prepare("SELECT * FROM '%S' WHERE 'id'= %s",$wpTrackTable,$id);

        return $this->wpdb->get_row($sqlQuery);
    }

    /**
     * @param $username
     * @return array|object|stdClass|void|null
     */
    public function get_web_id_user_by_username($username)
    {
        $wpTrackTable = $this->wpdb->prefix.$this->webIdUsersTable;

        // $sqlQuery = "SELECT * FROM `{$wpTrackTable}` WHERE `username` = '{$username}'";
         $sqlQuery = $this->wpdb->prepare("SELECT * FROM '%S' WHERE 'username'= %s",$wpTrackTable,$username);


        return $this->wpdb->get_row($sqlQuery);
    }

    /**
     * @param $data
     * @return bool|int|mysqli_result|resource|null
     */
    public function save_web_id_user($data)
    {
        $wpTrackTable = $this->wpdb->prefix.$this->webIdUsersTable;

        // $sqlQuery = "INSERT INTO `{$wpTrackTable}` (`username`, `mobile`, `is_active`, `created_at`, `updated_at`, `email`) VALUES ('{$data['username']}', '{$data['mobile']}', '{$data['is_active']}', '{$data['created_at']}', '{$data['updated_at']}', '{$data['email']}')";
        //   return $this->wpdb->query($sqlQuery);
       $insert_data = array(
        'username' => $data['username'],
        'mobile' => $data['mobile'],
        'is_active' => $data['is_active'],
        'created_at' => $data['created_at'],
        'updated_at' => $data['updated_at'],
        'email' => $data['email']
    );

    $data_formats = array('%s', '%s', '%d', '%s', '%s', '%s');

    // Use $wpdb->insert to insert the data
    $result = $this->wpdb->insert($wpTrackTable, $insert_data, $data_formats);

    return $result;
}
    

    /**
     * To check if same table already exits
     *
     * @param [string] $wpTrackTable
     * @return boolean
     */
    private function is_table_already_exist($wpTrackTable){

        return $this->wpdb->get_var( "show tables like '$wpTrackTable'" ) == $wpTrackTable;
    }

}