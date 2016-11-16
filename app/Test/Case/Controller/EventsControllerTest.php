<?php
App::uses('AppController', 'Controller');

class EventsControllerTest extends ControllerTestCase {
	public $fixtures = array('app.user', 'app.editor', 'app.event', 'app.poster');

	public function setUp(){
		// parent::setUp();
		// $testUser = array(
		// 	'User' => array(
		// 		'username' => 'ferret',
		// 		'password' => '12345678'
		// 	)
		// );
		// $this->testAction('/users/login', array('data' => $testUser, 'method' => 'post'));
	}

	// public function tearDown(){
	// 	$this->testAction('/users/logout');
	// 	parent::tearDown();
	// }

	// viewテスト
	public function testView(){
		$expected = array(
			'event' => array(
				'Event' => array(
					'id' => '1',
					'event_name' => 'First Event',
					'event_location' => 'First Event Location',
					'event_begin_date' => '2015-01-01',
					'event_begin_time' => '12:00:00',
					'event_end_date' => '2015-01-02',
					'event_end_time' => '12:00:00',
					'event_vote_app' => 0,
					'event_vote_valid' => 0,
					'unique_str' => 'abcdefgh'
				)
			),
			'posters' => array()
		);
		$result = $this->testAction(
			'/events/view/abcdefgh',
			array(
				'return' => 'vars'
			)
		);
		$this->assertEquals($expected, $this->vars);
	}

	// addEventのテスト
	// public function testAddEvent(){
	// 	$expected = array(
	// 		'Event' => array(
	// 			'event_name' => 'testEvent1',
	// 			'event_location' => 'Japan',
	// 			'event_begin_date' => '2015-01-01',
	// 			'event_begin_time' => '12:00:00',
	// 			'event_end_date' => '2015-01-02',
	// 			'event_end_time' => '12:00:00',
	// 			'event_vote_app' => 0,
	// 			'event_vote_valid' => 0,
	// 		)
	// 	);
	// 	$result = $this->testAction(
	// 		'/events/add',
	// 		array(
	// 			'data' => $expected, 'method' => 'post'
	// 		)
	// 	);
	// 	var_dump($result);
	// }
}
?>
