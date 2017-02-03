<?php
class EventFixture extends CakeTestFixture {

	// 任意。
	// 異なるテスト用データソースにフィクスチャを読み込む時にこのプロパティを指定してください。
	public $useDbConfig = 'test';

	public $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'event_name' => array(
			'type' => 'string',
			'length' => 100
		),
		'event_location' => array(
			'type' => 'string',
			'length' => 100
		),
		'event_begin_date' => 'date',
		'event_begin_time' => 'time',
		'event_end_date' => 'date',
		'event_end_time' => 'time',
		'event_vote_app' => array(
			'type' => 'integer',
			'length' => 4,
			'default' => 0,
			'null' => false
		),
		'event_vote_valid' => array(
			'type' => 'integer',
			'length' => 4,
			'default' => 0,
			'null' => false
		),
		'unique_str' => array(
			'type' => 'string',
			'length' => 8
		)
	);

	public $records = array(
		array(
			'id' => 1,
			'event_name' => 'First Event',
			'event_location' => 'First Event Location',
			'event_begin_date' => '2015-01-01',
			'event_begin_time' => '12:00:00',
			'event_end_date' => '2015-01-02',
			'event_end_time' => '12:00:00',
			'event_vote_app' => 0,
			'event_vote_valid' => 0,
			'unique_str' => 'abcdefgh'
		),
		array(
			'id' => 2,
			'event_name' => 'Second Article',
			'event_location' => 'Second Article Body',
			'event_begin_date' => '2015-02-01',
			'event_begin_time' => '12:00:00',
			'event_end_date' => '2015-02-03',
			'event_end_time' => '12:00:00',
			'event_vote_app' => 0,
			'event_vote_valid' => 1,
			'unique_str' => 'aabbccdd'
		),
		array(
			'id' => 3,
			'event_name' => 'Third Article',
			'event_location' => 'Third Article Body',
			'event_begin_date' => '2015-03-01',
			'event_begin_time' => '12:00:00',
			'event_end_date' => '2015-03-05',
			'event_end_time' => '12:00:00',
			'event_vote_app' => 1,
			'event_vote_valid' => 0,
			'unique_str' => 'aaaabbbb'
		)
	);
}
?>
