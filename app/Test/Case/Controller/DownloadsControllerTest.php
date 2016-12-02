<?php
App::uses('AppController', 'Controller');

class EventsControllerTest extends ControllerTestCase {
	public $fixtures = array('app.user', 'app.editor', 'app.event', 'app.poster');

    protected $object;

	public function setUp(){
	}

    /**
     * ファイルのDLのテスト(最新の投票データを有効にする)
     */
    public function testDownloadNewVoteData(){
        // 出力のバッファを有効
        ob_start();
		$data = array(
			'Download' => array(
                'voteinfo' => 0,
                'android1.csv',
                'android2.csv',
			)
		);
        // ファイルのDL（リクエストの送信）
		$result = $this->testAction(
			'/downloads/fileDownload',
			array(
				'return' => 'result',
                'method' => 'post',
                'data' => $data
			)
		);
        // バッファリングの内容を取得
        $result = ob_get_contents();
        // バッファをきれいにする
        ob_end_clean();

        // 予期したデータかのテスト
        $this->assertEquals(
            $this->result,
            "hoge,2,5,6\nfoo,0,2,5\nbar,1,2,3\nferret,4,6,9\ntest,1,6,9\n"
        );
    }

    /**
     * ファイルのDLのテスト(最初の投票データを有効にする)
     */
    public function testDownloadOldVoteData(){
        // 出力のバッファを有効
        ob_start();
		$data = array(
			'Download' => array(
                'voteinfo' => 1,
                'android1.csv',
                'android2.csv',
			)
		);
        // ファイルのDL（リクエストの送信）
		$result = $this->testAction(
			'/downloads/fileDownload',
			array(
				'return' => 'result',
                'method' => 'post',
                'data' => $data
			)
		);
        // バッファリングの内容を取得
        $result = ob_get_contents();
        // バッファをきれいにする
        ob_end_clean();

        // 予期したデータかのテスト
        $this->assertEquals(
            $this->result,
            "hoge,0,1,2\nfoo,7,8,9\nbar,6,7,8\nferret,4,6,9\ntest,1,6,9\n"
        );
    }

	// public function testGetFileList(){
	// 	$this->testAction('/downloads');
	//     $this->assertInternalType('array', $this->vars['files']);
	// 	var_dump($this->vars['files']);
	// }
}
?>
