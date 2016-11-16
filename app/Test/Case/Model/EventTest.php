<?php
App::uses('Event', 'Model');
class EventTest extends CakeTestCase {
	// EventFixtureのデータの取得
	public $fixtures = array('app.event');
	private $Event = null;

	//SetUp
	public function setUp() {
		// EventFixtureのテストデータをModelに挿入
		$this->Event = ClassRegistry::init('Event');
		parent::setUp();
	}
	//TearDown
	public function tearDown() {
		unset($this->Event);
		parent::tearDown();
	}

	// テストケース dayDiff(x, y)
	function testDayDiff() {
		$_SESSION['event_id'] = 1;
		$result = $this->Event->dayDiff();
		$this->assertEquals(2, $result);
	}

	//DBの内容が予想とあっているかどうか(idとイベント名のみ照合。必要に応じて変更すべきかな)
	public function testPublished(){
		$result = $this->Event->find('all', array('fields' => array('id', 'event_name')));
		$expected = array(
			array('Event' => array('id' => 1, 'event_name' => 'First Event')),
			array('Event' => array('id' => 2, 'event_name' => 'Second Article')),
			array('Event' => array('id' => 3, 'event_name' => 'Third Article')),
		);

		$this->assertEquals($expected, $result);
	}
}
?>
