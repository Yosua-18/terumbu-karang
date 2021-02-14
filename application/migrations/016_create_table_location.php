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
class Migration_create_table_location extends CI_Migration {


	public function up()
	{ 
		$table = "location";
		$fields = array(
			'id'           => [
				'type'           => 'INT(11)',
				'auto_increment' => TRUE,
				'unsigned'       => TRUE,
			],
			'name'          => [
				'type' => 'VARCHAR(100)',
			],
			'description'      => [
				'type' => 'TEXT',
			],
			'lat'      => [
				'type' => 'TEXT',
			],
			'long'      => [
				'type' => 'TEXT',
			],
			'luas'      => [
				'type' => 'TEXT',
			],
			'kerusakan'      => [
				'type' => 'TEXT',
			],
			'is_deleted' => [
				'type' => 'TINYINT(4)',
			] 

		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($table);
	 
	}


	public function down()
	{
		$table = "location";
		$this->db->table_exists($table); 
	}

}