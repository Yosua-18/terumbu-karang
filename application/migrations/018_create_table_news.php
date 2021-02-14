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
class Migration_create_table_news extends CI_Migration {


	public function up()
	{ 
		$table = "news";
		$fields = array(
			'id'           => [
				'type'           => 'INT(11)',
				'auto_increment' => TRUE,
				'unsigned'       => TRUE,
			],
			'name'          => [
				'type' => 'VARCHAR(100)',
			], 
			'date'          => [
				'type' => 'DATE',
			], 
			'description'          => [
				'type' => 'TEXT',
			], 
			'photo'          => [
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
		$table = "news";
		$this->db->table_exists($table); 
	}

}