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
class Migration_create_table_orders extends CI_Migration {


	public function up()
	{ 
		$table = "orders";
		$fields = array(
			'id'           => [
				'type'           => 'INT(11)',
				'auto_increment' => TRUE,
				'unsigned'       => TRUE,
			],
			'user_id'          => [
				'type' => 'INT(11)',
			], 
			'location_id'          => [
				'type' => 'INT(11)',
			], 
			'note'          => [
				'type' => 'TEXT',
			],  
			'tanggal_order'          => [
				'type' => 'DATETIME',
			],  
			'tanggal_bayar'          => [
				'type' => 'DATETIME',
			], 
			'status_order'          => [
				'type' => 'INT(11)',
			],  
			'status_bayar'          => [
				'type' => 'INT(11)',
			] ,  
			'created_at'          => [
				'type' => 'DATETIME',
			],  
			'created_by'          => [
				'type' => 'INT(11)',
			] 

		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($table);
	 
	}


	public function down()
	{
		$table = "orders";
		$this->db->table_exists($table); 
	}

}