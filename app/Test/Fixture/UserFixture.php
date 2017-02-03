<?php
class UserFixture extends CakeTestFixture {

	// 任意。
	// 異なるテスト用データソースにフィクスチャを読み込む時にこのプロパティを指定してください。
	public $useDbConfig = 'test';

	public $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'username' => array(
			'type' => 'string',
			'length' => 100
		),
		'email' => array(
			'type' => 'string',
			'length' => 200
		),
		'password' => array(
			'type' => 'string',
			'length' => 100
		),
		'active' => array(
			'type' => 'integer'
		),
		'modified' => array(
			'type' => 'datetime'
		),
	);

	public $records = array(
		array(
			'id' => 1,
			'username' => "test1",
			'email' => "test1@example.com",
			'password' => "2149c91e74cb2bf3c2beeb1e757ba0054641af3e",
			'active' => 1,
			'modified' => '2014-01-01 12:00:00',
		),
		array(
			'id' => 2,
			'username' => "test2",
			'email' => "test2@example.com",
			'password' => "2149c91e74cb2bf3c2beeb1e757ba0054641af3e",
			'active' => 1,
			'modified' => '2014-01-01 12:00:00',
		),
	);
}
?>
