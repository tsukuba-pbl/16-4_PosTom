<?php
//改行コードを正しく読み込むための設定
ini_set('auto_detect_line_endings', true);
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
 * 投票結果をDLするページに関するController
 */
class VotesController extends AppController {
	public $helpers = array('Html', 'Form', 'Text');
	public $uses = array('Event', 'Poster', 'Editor');

	//初期値の読み込み
	function beforeFilter(){
		// uploadメソッドだけ認証を不要にした。
		// 複数のAndroidからデータを受け取るため
	    $this->Auth->allow('upload');
	}

	// 基本的なページの表示
	public function index(){
		$dir = new Folder(WWW_ROOT.'csv/');
		// イベントのUniqueIDの取得
		$event_id = $_SESSION['event_str'];
		// イベントに対応するファイルの検索
		$files = $dir->find($event_id.'_[0-9a-zA-Z]*_[0-9]*\.csv', true);
		// ファイル名からファイル名、イベントID、Macアドレス、日時、UNIXタイムを取得し、配列に入れ直す
		$data = $this->analyzeFileName($files);

		// unixタイムで降順ソート
		$sort = array();
		foreach ($data as $key => $value) {
			$sort[$key] = $value[unixtime];
		}
		array_multisort($sort, SORT_DESC, $data);

		$this->set('files', $data);
		//TODO 最新の投票を有効にするかそうではないかの情報をViewに渡す
	}

	/**
	 * Androidからの投票結果のファイルを保存するメソッド
	 */
	public function upload(){
		//保存先のディレクトリ
	    $target_dir = WWW_ROOT."csv/";
	    //保存先のパス(ファイル名含む)
	    $target_path = $target_dir.basename($_FILES['file']['name']);
	    //保存する際に日本語であると文字化けするのでその対処
	    $target_path = mb_convert_encoding($target_path, "UTF-8", "AUTO");
	    //tmp_nameの場所から保存先のパスにファイルを移動(アップロード)
	    if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)){
	        echo "The file ". basename($_FILES['file']['name']). " has been uploaded";
	    }else{
	        echo "error";
	    }
	}

	// ファイルのDL
	public function fileDownload(){
		// 最新or最古のユーザの投票データを保持する
        $usersData = array();
		// ファイルの中身が追加されていく(1次元配列)
        $fileData = array();
		$dir = new Folder(WWW_ROOT.'csv/');
		// 選択されたファイルの中身をそれぞれ取得
		foreach($this->request->data["Vote"] as $file){
			// 選択されたファイルの検索
			$target = $dir->find($file, true);
			// ファイルがあるときは、ファイルの中身を$fileDataに入れていく
			if(isset($target[0])){
				// ファイルのデータを取得
				$fileData = array_merge($fileData, $this->readline(WWW_ROOT.'csv/'.$target[0]));
			}
		}
		// 取得したファイルの内容から最新のユーザの情報を反映している
		$usersData = $this->processFiledata($fileData, (int)$this->request->data["Vote"]["voteinfo"]);
		// ファイルの作成
		// $targetFile = new File(WWW_ROOT.'csv/target.csv', true);
		// $targetFile->write($this->makeFileContent($usersData));
		// $this->autoRender = false;
		// $this->response->file(
		// 	WWW_ROOT.'csv/target.csv',
		// 	[
		// 		'name' => "投票結果.csv",
		// 		'download' => true,
		// 	]
		// );
		$this->autoRender = false;
		$this->response->type('csv');
		$this->response->download('投票結果.csv');
		$this->response->body($this->makeFileContent($usersData));
	}

	/*
	 * ファイル名からイベントID、MACアドレス、日時の取得
	 */
	private function analyzeFileName($files){
		$result = array();
		foreach($files as $file){
			// ファイルごとのデータを作成
			$result[] = array(
				'filename' => $file,
				'event_id' => $this->getEventID($file),
				'mac_addr' => $this->getMacAddr($file),
				'datetime' => $this->getDateTime($file),
				'unixtime' => $this->getUnixTime($file)
			);
		}
		return $result;
	}

  	/*
  	 * ファイル名からイベントID取得
  	 */
 	private function getEventID($filename){
		$tmp = explode("_", $filename);
 		return $tmp[0];
 	}

 	/*
 	 * ファイル名からMACアドレス取得
 	 */
	private function getMacAddr($filename){
		$tmp = explode("_", $filename);
		return $tmp[1];
	}

 	/*
 	 * ファイル名から日時取得
 	 */
	private function getDateTime($filename){
		$tmp = explode("_", $filename);
		return date('Y/m/d H:i:s', (int)$tmp[2]);
	}

 	/*
 	 * ファイル名からUNIXタイム取得
 	 */
	private function getUnixTime($filename){
		return (int)explode("_", $filename)[2];
	}

	/**
	 * ファイルの内容を配列で取得する関数
	 */
	private function readline($filepath){
        $fileData = array(); //ファイルのデータを1行ごとに保持する配列
		try{
			$this->filehandler = fopen($filepath, "r");
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		//ファイルの内容を1行ずつ配列に格納
		while($line = fgets($this->filehandler)){
			//改行を削除して格納
			$fileData[] = str_replace(array("\r\n", "\n"), '', $line);
		}
		fclose($this->filehandler);
		return $fileData;
	}

    /*
     * ユーザ毎のデータをファイルに書き込む用に、1つの変数にまとめる
     */
	private function makeFileContent($usersData){
	    $content = "";
	    foreach ($usersData as $key => $value) {
	        $content .= $value["user"] . "," . $value["vote1"] . "," . $value["vote2"] . "," . $value["vote3"] . "\n";
	    }
	    return $content;
	}

	/**
	 * ファイルのデータを成型する
	 * 最新の情報ユーザの方法を反映させる
	 * @param $fileData: Array, $firstOrOld: 0→first, 1→old
	 * @return Array
 	 *	array(3) {
 	 *		["test"]=> array(5) {
 	 *		["user"]=> string(4) "test"
 	 *		["vote1"]=> string(3) "a-1"
 	 * 		["vote2"]=> string(3) "b-2"
 	 * 		["vote3"]=> string(3) "f-4"
 	 * 		["date"]=> string(19) "2016/01/01 12:00:00"
 	 * 	}
 	 * 	["hoge"]=> array(5) {
 	 *		["user"]=> string(4) "hoge"
 	 * 		["vote1"]=> string(3) "b-2"
 	 * 		["vote2"]=> string(3) "b-6"
 	 * 		["vote3"]=> string(3) "f-3"
 	 * 		["date"]=> string(19) "2016/01/01 13:00:00"
 	 *	}
	 */
	private function processFiledata($fileData, $firstOrOld){
		$usersData = array();
		foreach ($fileData as $k => $value) {
			list($user, $vote1, $vote2, $vote3, $date) = explode(",", $value);
			if($firstOrOld === 0){
				//ユーザのデータがなければデータを挿入 OR ユーザの投票データがあって、今回のデータの方が最新の場合、データの更新
				if(!isset($usersData[$user]) || (isset($usersData[$user]) && strtotime($date) > strtotime($usersData[$user]["date"]))){
					$usersData[$user] =  array("user" => $user, "vote1" => $vote1, "vote2" => $vote2, "vote3" => $vote3, "date" => $date);
				}
			} else if ($firstOrOld === 1){
				//ユーザのデータがなければデータを挿入 OR ユーザの投票データがあって、今回のデータの方が最新の場合、データの更新
				if(!isset($usersData[$user]) || (isset($usersData[$user]) && strtotime($date) < strtotime($usersData[$user]["date"]))){
					$usersData[$user] =  array("user" => $user, "vote1" => $vote1, "vote2" => $vote2, "vote3" => $vote3, "date" => $date);
				}
			}
		}
		return $usersData;
	}
}
?>
