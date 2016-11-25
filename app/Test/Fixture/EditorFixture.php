<?php
class EditorFixture extends CakeTestFixture {

	// 任意。
	// 異なるテスト用データソースにフィクスチャを読み込む時にこのプロパティを指定してください。
	public $useDbConfig = 'test';

	public $fields = array(
		'account_id' => array('type' => 'integer', 'key' => 'primary'),
		'event_id' => array('type' => 'integer', 'key' => 'primary')
	);

	public $records = array(
		array(
			'account_id' => 1,
			'event_id' => 1,
		),
		array(
			'account_id' => 1,
			'event_id' => 2,
		),
		array(
			'account_id' => 2,
			'event_id' => 3,
		),
	);
}
?>
