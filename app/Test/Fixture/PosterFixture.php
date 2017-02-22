<?php
class PosterFixture extends CakeTestFixture {

	// 任意。
	// 異なるテスト用データソースにフィクスチャを読み込む時にこのプロパティを指定してください。
	public $useDbConfig = 'test';

	public $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'presentation_id' => array(
			'type' => 'integer'
		),
		'width' => array(
			'type' => 'integer'
		),
		'height' => array(
			'type' => 'integer'
		),
		'x' => array(
			'type' => 'integer'
		),
		'y' => array(
			'type' => 'integer'
		),
		'color' => array(
			'type' => 'string',
			'length' => 10
		),
		'area_id' => array(
			'type' => 'integer'
		),
		'date' => array(
			'type' => 'integer'
		),
		'event_id' => array(
			'type' => 'integer'
		),
	);

	public $records = array(
	);
}
?>
