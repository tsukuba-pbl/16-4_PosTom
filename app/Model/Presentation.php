<?php
ini_set('auto_detect_line_endings', true);
class Presentation extends AppModel {
	public function loadCSV($filename){
			$this->begin();
			try{
				// ä¸?åº¦ããã¹ã¦ã®ã?ã¼ã¿ãåé¤ããåã«å¯¾è±¡ã¨ãªãã?ã¬ã¼ã³ã?ã¼ã·ã§ã³ãé¢é£ä»ãããã¦ã?ãã?ã¹ã¿ã¼ã®ã?ã¼ã¿ãå?æåãã?
				self::checkRelatedPoster();
				$handle = fopen($filename,"r");
				while(($row = fgetcsv($handle, 1000, ",")) !== FALSE){
				mb_convert_variables("UTF-8","auto", $row);
					$presenData = array(
						'room' => $row[0],
						'session_order' => $row[1],
						'presentation_order' => $row[2],
						'date' => $row[3],
						'title' => $row[4],
						'abstract' => $row[5],
						'keyword' =>  $row[6],
						'authors_name' => $row[7],
						'authors_affiliation' => $row[8],
						'event_id' => $_SESSION['event_id']
					);
					if($row[0] != "room") {
							$this->create($presenData);
							$this->save();
					}
				}
				$this->commit();
			}catch(Exception $e){
				$this->rollback();
			}
	}

	// é¢é£æ¸ã¿ãã¬ã¼ã³ã?ã¼ã·ã§ã³ãåé¤ããã?ã¨ããã¨ãã?ãããåç?§ãããã¹ã¿ã¼ãããå?´åã?ã?ã¹ã¿ã¼ã®æ?å ±ãå¤æ´ããå¦ç?
	public function checkRelatedPoster(){
		// ç¾æç¹ã§ã¯ãä¸?åº¦ãã¹ã¦ã®ãã¬ã¼ã³ã?ã¼ã·ã§ã³ã®ã?ã¼ã¿ãåé¤ããããããã¹ã¦ã®ã?ã¼ã¿ãåå¾ãã?
		$presentations = $this->requestAction('/presentations/getall');
		// åé¤å¯¾è±¡ãã¬ã¼ã³ã?ã¼ã·ã§ã³ãã?ã¹ã¿ã¼ã?ã¼ã¿ã§é¢é£ä»ãããã¦ã?ããã©ã?ããã§ã?ã¯
		foreach($presentations as $id => $presentation){
			// åé¤å¯¾è±¡ãã¬ã¼ã³ã?ã¼ã·ã§ã³ã®IDãå¤æ°ã«æ ¼ç´?
			$target_id = $presentation['Presentation']['id'];
			// åé¤å¯¾è±¡ãã¬ã¼ã³ã?ã¼ã·ã§ã³ãé¢é£ä»ãIDã¨ãã¦ã?ãã?ã¹ã¿ã¼ã®æ?å ±ãæ´æ°ãã
			self::updateRelatedPoster($target_id);
		}
	}

	// å¼æ°ã®IDãé¢é£ä»ãIDã¨ãã¦ä¿æãã¦ã?ãã?ã¹ã¿ã¼ã®æ?å ±ãæ´æ°ãã
	public function updateRelatedPoster($target_id){
		// å¯¾è±¡IDãé¢é£ä»ãIDã¨ãã¦ä¿æãã¦ã?ãã?ã¹ã¿ã¼ãåå¾?
		$posters = $this->requestAction('/posters/getRelatedPoster/'.$target_id);
		foreach($posters as $id => $poster){
			// é¢é£ä»ãIDã®é ?ç®ãå?æåï¼?0?¼ã«ãã
			$this->requestAction('/posters/initRelatedPoster/'.$poster['Poster']['id']);
		}
	}
}
?>
