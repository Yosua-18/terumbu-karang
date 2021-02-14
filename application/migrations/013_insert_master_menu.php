<?php
/**
 * @author   Natan Felles <natanfelles@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_create_table_api_limits
 *
 * @property CI_DB_forge         $dbforge
 * @property CI_DB_query_builder $db
 */
class Migration_insert_master_menu extends CI_Migration {


	public function up()
	{ 
		// insert function value
		 $data_menu = array(
            array('id'=>1,'module_id'=>1, 'name'=>'root', 'url'=>'#', 'parent_id'=>0, 'icon'=>" ", 'sequence'	=>0),
            array('id'=>2,'module_id'=>1, 'name'=>'Dashboard', 'url'=>'dashboard', 'parent_id'=>1, 'icon'=>"fa fa-dashboard", 'sequence'=>1),
            array('id'=>3,'module_id'=>1, 'name'=>'System Access', 'url'=>'#', 'parent_id'=>1, 'icon'=>"fa fa-gear", 'sequence'=>2), 
            array('id'=>4,'module_id'=>1, 'name'=>'Role', 'url'=>'role', 'parent_id'=>3, 'icon'=>"fa fa-circle-o", 'sequence'=>1),
            array('id'=>5,'module_id'=>1, 'name'=>'Privileges', 'url'=>'privileges', 'parent_id'=>3, 'icon'=>"fa fa-circle-o", 'sequence'=>2),
            array('id'=>6,'module_id'=>1, 'name'=>'Manage Akun', 'url'=>'#', 'parent_id'=>1, 'icon'=>"fa fa-users", 'sequence'	=>3), 
            array('id'=>7,'module_id'=>1, 'name'=>'User', 'url'=>'user', 'parent_id'=>6, 'icon'=>"fa fa-circle-o", 'sequence'=>1), 
            array('id'=>8,'module_id'=>1, 'name'=>'Lokasi', 'url'=>'location', 'parent_id'=>1, 'icon'=>"fa fa-map-marker", 'sequence'   =>4), 
            array('id'=>9,'module_id'=>1, 'name'=>'Unit', 'url'=>'products', 'parent_id'=>1, 'icon'=>"fa fa-cubes", 'sequence'=>5), 
            array('id'=>10,'module_id'=>1, 'name'=>'Permintaan', 'url'=>'order', 'parent_id'=>1, 'icon'=>"fa fa-bar-chart", 'sequence'=>6), 
            array('id'=>11,'module_id'=>1, 'name'=>'News', 'url'=>'news', 'parent_id'=>1, 'icon'=>"fa fa-newspaper-o", 'sequence'=>7), 
        );
        $this->db->insert_batch('menu', $data_menu); 
	} 

	public function down()
	{
		
	}

}