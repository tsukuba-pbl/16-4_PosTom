<?php
	// パラメータの受け取り
	$event_str = $this->params['pass'][0];
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>PosMApp</title>
	<!-- metaで文字コードを指定しないと文字化けする -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Expires" content="Thu, 01 Dec 1994 16:00:00 GMT">
	<link rel="shortcut icon" href="<?php echo $this->Html->webroot;?>favicon.ico" />

	<link rel="stylesheet" type="text/css" href="<?php echo $this->Html->webroot;?>css/jquery.mobile.flatui.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->Html->webroot;?>css/lib/jquery-ui-1.11.2.custom.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->Html->webroot;?>css/lib/jquery.mobile-1.4.5.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->Html->webroot;?>css/button-icon.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->Html->webroot;?>css/map.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->Html->webroot;?>css/topmenu.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->Html->webroot;?>css/list.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->Html->webroot;?>css/taparea.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->Html->webroot;?>css/sessiontable.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->Html->webroot;?>css/modify_navbar.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->Html->webroot;?>css/vote_css.css" />

	<script>
		var webroot="<?php echo $this->Html->webroot;?>";
	</script>

	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/lib/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/lib/jquery-ui-1.11.2.custom.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/lib/jquery.mobile-1.4.5.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/lib/hammer.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/lib/jquery.hammer.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/lib/md5.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/lib/jquery.xpost.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/lib/knockout-3.4.0.js"></script>

	<!-- WebDBF program -->
	<script type="text/javascript" charset="utf-8" src="http://db-event.jpn.org/webdbf2015/data_forum.js"></script>

	<!-- DB用発表データ -->
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/data.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/logdata-function.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/toppage-function.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/postermap-function.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/postermap-function-download.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/postermap-function-ui.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/presenlist-function.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/bookmarklist-function.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/detail-function.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/sessiontable-function.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/postermap-function-hammer.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/timetable-function.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $this->Html->webroot;?>js/index.js"></script>

	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">

</head>

<body>
	<!-- Vote Application -->
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>js/vote_js/count_checked.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>js/vote_js/create_bookmark_list.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>js/vote_js/create_list.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>js/vote_js/encoding.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>js/vote_js/go_back.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>js/vote_js/go_toppage.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>js/vote_js/jquery.searcher.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>js/vote_js/qrcode.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>js/vote_js/qrcodereader.js"></script>
	<script tyep="text/javascript" src="<?php echo $this->Html->webroot;?>js/vote_js/read_candidateid_QR.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>js/vote_js/set_item.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>js/vote_js/confirm.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>js/vote_js/vote_application.js"></script>

	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>jsqrcode-master/src/grid.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>jsqrcode-master/src/version.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>jsqrcode-master/src/detector.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>jsqrcode-master/src/formatinf.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>jsqrcode-master/src/errorlevel.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>jsqrcode-master/src/bitmat.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>jsqrcode-master/src/datablock.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>jsqrcode-master/src/qrcode.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>jsqrcode-master/src/bmparser.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>jsqrcode-master/src/datamask.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>jsqrcode-master/src/rsdecoder.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>jsqrcode-master/src/gf256poly.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>jsqrcode-master/src/gf256.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>jsqrcode-master/src/decoder.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>jsqrcode-master/src/findpat.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>jsqrcode-master/src/alignpat.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->webroot;?>jsqrcode-master/src/databr.js"></script>

<!-- ローディング画面 -->
<div id="loading">
	<img src="<?php echo $this->Html->webroot;?>img/loading.gif">
</div>

<!-- トップメニュー画面 -->
<div data-role="page" id="topPage">
	<!-- 背景画像 -->
	<img id="topPageBackground" src="<?php echo $this->Html->webroot;?>img/toppage.png"/>
	<!-- コンテンツ -->
	<div id="eventBasicInfo"></div>
	<div id="topPageContent">
		<!--
		<div id="reDownloadDIV" class="reDownloadDIV" align="center">
			<img src="img/gif-load.gif" class="downloading" style="zoom: 25%;"><font class="downloadMsg"></font>
		</div>
		-->
		<button id="reDownloadDIV" class="reDownloadDIVCLS"><img src="<?php echo $this->Html->webroot;?>img/loading.gif" style="zoom: 18%;">DownLoad Data</button>
		<!--
		<div class="ui-grid-solo">
			<div class="ui-block-a">
				<div id="selectLocale">Japanese | <span style="text-decoration:line-through;color:lightgray;">English</span></div>
			</div>
		</div>
		-->

		<div id="event-webpage" align="center"></div>
		<div class="ui-grid-solo">
			<div class ="ui-block-a">
				<button id="vote_application" class="ui-btn" onclick="vote _application()">Vote Application</button>
			</div>
		</div>
		<div class="ui-grid-a">
			<div class="ui-block-a">
				<div align="center">
					<img id="goToInformation" class="topmenuicon" src="<?php echo $this->Html->webroot;?>img/topmenu/schedule.png"/>
					<div class="topMenuIconLabel">Time Table</div>
				</div>
			</div>
			<div class="ui-block-b">
				<div align="center">
					<img id="goToVenue" class="topmenuicon" src="<?php echo $this->Html->webroot;?>img/topmenu/venue.png"/>
					<div class="topMenuIconLabel">Floor Map</div>
				</div>
			</div>
		</div>
		<div class="ui-grid-a">
			<div class="ui-block-a">
				<div align="center">
					<img id="goToList" class="topmenuicon" src="<?php echo $this->Html->webroot;?>img/topmenu/list.png"/>
					<div class="topMenuIconLabel">Presentation List</div>
				</div>
			</div>
			<div class="ui-block-b">
				<div align="center">
					<img id="goToMap" class="topmenuicon" src="<?php echo $this->Html->webroot;?>img/topmenu/map.png"></img>
					<div class="topMenuIconLabel">Poster Map</div>
				</div>
			</div>
		</div>
		<div class="ui-grid-solo">
			<div class="ui-block-a">
				<div id="copyright">
					<br />
					<span style="font-size:smaller;">Copyright &copy; <a href="http://www.cs.tsukuba.ac.jp/ITsoft/">Tsukuba University.Department of Computer Science</a></span><br />
					<span style="font-size:smaller;"><a href="https://github.com/Tsukuba-SAY/PosMApp">GitHub</a></span>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- ポスターマップ画面 -->
<div data-role="page" id="posterMapPage">
	<div id="menuPanel" data-display="overlay" data-role="panel" data-position="right">
		<!-- <div id="changelabel" data-position="fixed" style="border: 2px;">
			<a data-role="button" href="#changeLabelDialog"
					data-inline="true" data-rel="dialog"
					data-transition="pop">Change Label</a>
		</div> -->
		<div style="text-align: center;">
			Change the poster's label display.
		</div>
		<a class="changelabel" id="label-presenid"
			href="#posterMapPage" data-role="button">Orator NO.</a>
		<a class="changelabel" id="label-title"
			href="#posterMapPage" data-role="button">Title</a>
		<a class="changelabel" id="label-authorname"
			href="#posterMapPage" data-role="button">Orator</a>
		<a class="changelabel" id="label-authorbelongs"
			href="#posterMapPage" data-role="button">Belong</a>
	</div>
	<div data-role="header"　data-tap-toggle="false" data-position="fixed" style="z-index: 200;">
		<div class="ui-grid-b">
			<div class="ui-block-a" style="width: 70%;">
				<input type="search" id="search-bar-title"
				placeholder="検索" data-inline="true" style="width:75%;" onchange="searchChanged(this)"/>
			</div>
			<div class="ui-block-b" style="width: 25%;">
				<div id="searchResult"></div>
			</div>
			<div class="ui-block-c" style="width: 5%;">
				<a href="#menuPanel" style="top:12.5px"
				class="ui-btn ui-btn-right ui-icon-bars ui-btn-icon-notext ui-corner-all"></a>
			</div>
		</div>
	</div>
	<div style="position: relative;">
			<a data-role="button" class="ReDownloadBtn">Download Data</a>
		<div id="subheader" style="top: 0px;">
			<!-- 検索結果件数 -->
			<!--<div id="searchResult"
				style="position: fixed; z-index: 100;">
			</div>-->
			<!-- エリアタップ後のズームアウトボタン -->
			<div id="resetScaleButtonFrame" data-position="fixed" style="border: 2px;">
				<a id="resetScaleButton" data-role="button"
					data-inline="true">Back</a>
			</div>
		</div>
		<!-- ポスターマップ本体 -->
		<div id="mapFrame" style="z-index: 255;background-color:#FFFFFF">
			<div id="mapMain">
				<!-- ポスターマップ表示 -->
				<img id="mapImg" src="<?php echo $this->Html->webroot;?>img/bg/<?php echo $event_str; ?>_1.png" border="0"
					style="position: relative; z-index: 1;"></img>
				<!-- ポスターアイコン -->
				<div id="posters"></div>
				<!-- ポスターエリア -->
				<div id="posterArea"></div>
			</div>
			<!-- 前の日 -->
			<img id="prevDayButton" src="<?php echo $this->Html->webroot;?>img/prevday.png"></img>
			<!-- 次の日 -->
			<img id="nextDayButton" src="<?php echo $this->Html->webroot;?>img/nextday.png"></img>
		</div>
		<!-- 基本情報パネル -->
		<div style="position: relative;">
			<div id="basicinfopanel" style="display:none;">
				<div id="basicinfo"></div>
				<!-- ブックマークボタン -->
				<!-- アイコンの切り替えはpostermap.jsで行う -->
				<img id="bookmarkbutton">
				<!-- 詳細情報ボタン -->
				<img id="detailinfobutton" src="<?php echo $this->Html->webroot;?>img/detail.png"></img>
			</div>
		</div>
	</div>

	<!-- タブバー -->
	<!-- <div class="tabbar"></div> -->
	<div data-role="footer" data-position="fixed" data-tap-toggle="false" class="nav-tabicon" style="position:fixed; bottom:0px">
	</div>
</div>

<!-- 詳細情報画面 -->
<div data-role="page" id="detailPage">
	<div data-role="header">
		<h1 style="text-align:center"　></h1>
		<a href="#" class="ui-btn-left"  data-icon="carat-l" id="detailBackButton" >Back</a>
	</div>
	<div data-role="content">
	<div id="detail-presenid"></div>
		<h3 style="margin-left:2.5%; margin-right:2.5%;">
			<span id="detail-title"></span>
		</h3>
			<div id="detail-authors"></div>
		<p>
			<span id="detail-abstract"></span>
		</p>
		<p>キーワード：<br /><span id="detail-keywords"></span></p>

	</div>
	<!-- タブバー -->
	<!-- <div class="tabbar"></div> -->
	<div data-role="footer" data-position="fixed" data-tap-toggle="false" class="nav-tabicon" style="position:fixed; bottom:0px">
	</div>
</div>

<!-- 発表リスト画面 -->
<div data-role="page" id="presenListPage">
	<!-- 検索のTIPS-->
	<div data-role="popup" data-position-to="window" id="search-tips">
		<a href="#" data-rel="back" data-role="button" data-icon="delete" data-iconpos="notext" class="ui-btn-right">閉じる</a>
		<div data-role="header">
			<h1>検索のヒント</h1>
		</div>
		<div data-role="main">
			<p style="padding: 0.5em;">Please use the browser search <br />if you want to search from all<br /></p>
			<p style="padding: 0.5em;">If you use the Google Chrome ,please touch the [Menu]<br /> button,then you can use the [search in the page] to search</p>
		</div>
	</div>
	<div id="presenHeader" data-role="header" data-position="fixed" data-tap-toggle="false">
		<h1 style="text-align:center">Presentation List</h1>
		<a href="#search-tips" data-rel="popup" data-transition="pop" class="ui-btn ui-btn-icon-notext ui-btn-right ui-icon-search ui-corner-all"></a>
		<div data-role="controlgroup" data-type="horizontal" class="ui-btn-left" style="top: 3px;">
			<a id="listIconAll" class="ui-btn
			ui-corner-all ui-btn-active" data-mini="true">All</a>
			<a id="listIconStar" class="ui-btn ui-corner-all" data-mini="true" >★</a>
		</div>
	</div>
	<div data-role="content">
			<a data-role="button" class="ReDownloadBtn">Download Data</a>
		<div style="overflow:auto; height:100%;">
			<!-- 発表リスト -->
			<div id="presenList" class="listcolor"></div>
			<div id="bookmarkList" class="listcolor"></div>
		</div>
	</div>
	<!-- タブバー -->
	<!-- <div class="tabbar"></div> -->
	<div data-role="footer" data-position="fixed" data-tap-toggle="false" class="nav-tabicon" style="position:fixed; bottom:0px">
	</div>
</div>

<!-- 会場マップ画面 -->
<div data-role="page" id="venuePage">
	<div data-role="header" data-position="fixed">
		<h1 style="text-align:center"　>Floor Map</h1>
	</div>
	<div align="center">
			        <br/><br/><br/>
					<img id="floormap"  style="width:100%"; src="<?php echo $this->Html->webroot;?>img/room.svgz"></img>

	</div>
	<!-- タブバー -->
	<!-- <div class="tabbar"></div> -->
	<div data-role="footer" data-position="fixed" data-tap-toggle="false" class="nav-tabicon" style="position:fixed; bottom:0px">
	</div>
</div>


<!-- 表示切替ボタンのダイアログ -->
<div data-role="page" id="changeLabelDialog">
	<div data-role="header">
		<h1>Change Label</h1>
	</div>
	<div data-role="content">
		<a class="changelabel" id="label-presenid"
			href="#posterMapPage" data-role="button">Orator NO.</a>
		<a class="changelabel" id="label-title"
			href="#posterMapPage" data-role="button">Title</a>
		<a class="changelabel" id="label-authorname"
			href="#posterMapPage" data-role="button">Orator</a>
		<a class="changelabel" id="label-authoraffiliation"
			href="#posterMapPage" data-role="button">Belong</a>
	</div>
</div>

<!-- セッションテーブル -->
<!-- DEIM2014のセッションテーブルの内容 -->
<div data-role="page" id="informationPage">
  <div data-role="header" data-position="fixed">
	<h1 id="sessionHyou" style="text-align:center">プログラム</h1>
  </div>
  <div data-role="content" id="timeTable">

  </div>
	<!-- タブバー -->
	<!-- <div class="tabbar"></div> -->
	<div data-role="footer" data-position="fixed" data-tap-toggle="false" class="nav-tabicon" style="position:fixed; bottom:0px">
	</div>
</div>

<!-- kaishi -->
<!-- Vote Application -->
<div data-role="page" id="votePage">
		<div data-role="panel" id="panel" data-position="right" data-theme="a" data-display="push">
				<h2>Ts_Quartetto</h2>
				<br>
				<p>Du Yan</p>
				<p>Suzuki Kentaro</p>
				<p>Tsuruda Tomohiro</p>
				<p>Zhong Yuran</p>
				<br>
				<a href="#votePage" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-a ui-icon-delete ui-btn-icon-left ui-btn-inline">Close</a>
		</div>
		<div data-role="header">
				<a data-iconpos="notext" data-role="button" data-icon="home" title="Home">Home</a>
				<h1>Vote Appication</h1>
				<a data-iconpos="notext" href="#panel" data-role="button" data-icon="flat-menu"></a>
		</div>
		<!-- カメラで投票者ID入力 -->
		<div data-role="content" class="ui-content">
			<input type="file" accept="image/*" capture="camera" name="upfile" id="upfile" style="display:none" >
			<label for="upfile">
				<div style="display:table; widht:100%; margin:5px auto;">
					<div class="up_qr">投票者 ： 未登録</div>
					<div class="regist-vote ui-btn ui-btn-j ui-shadow ui-corner-all">登録</div>
				</div>
			</label>
			<input type="hidden" name="voterid" id="voterid" value="">
			<input type="hidden" name="checkvote" id="checkvote" value="0">
			<!--ID表示 -->
			<div id="YourID"></div>
			<div data-role="header" data-theme="b"><h4>候補者リスト</h4></div>
			<div data-role="controlgroup" data-type="horizontal">
				<button onclick="create_list()">全件表示</button>
				<button onclick="create_bookmark_list()">ブックマークリスト</button>
			</div>
			<!-- 検索 -->
			<input id="listsearchinput" type="text" placeholder="キーワード検索"/>
			<ul id="listdata" data-role="listview" data-inset="true">
				<!-- JSONファイルの候補者をリスト表示 -->
				<fieldset data-role="content" id="my_controlgroup">
					<div id="my_checkbox"></div>
				</fieldset>
			</ul>
			<fieldset class="ui-grid-a">
				<button data-icon="flat-checkround" data-theme="e" onclick="set_item()">投票する</button>
			</fieldset>
		</div>

		<canvas id="qr-canvas" width="640" height="480" hidden></canvas>

		<!-- タブバー -->
		<!-- <div class="tabbar"></div> -->
		<div data-role="footer" data-position="fixed" data-tap-toggle="false" class="nav-tabicon" style="position:fixed; bottom:0px">
		</div>
</div>

<!-- 投票確認ページ -->
<div data-role="page" id="ConfirmPage">
	<div data-role="header">
	  <h1>投票確認</h1>
	</div>
	<div id="confirm"></div>
	<div data-role="header" data-theme="b"><h4>選択した候補者</h4></div>
	<div id="confirm_candidates"></div>
	<div id="permit_revoting"></div>
	<fieldset class="ui-grid-a">
		<button data-icon="flat-checkround" data-theme="e" onclick="confirm()">投票する</button>
		<button data-icon="flat-cross" data-theme="a" onclick="vote_application()">選択しなおす</button>
	</fieldset>
</div>


<!-- ALREADY VOTED -->
<div data-role="page" id="AlreadyVotedPage">
	<div data-role="header">
	  <h1>投票情報の確認</h1>
	</div>
	<p>あなたが投票したデータは以下の通りです。</p></br>
	<h4投票者</h4></br>
	<div id="confirm_voted"></div>
	<h4>選択した候補者</h4></br>
	<div id="confirm_candidates_voted"></div>
	<fieldset class="ui-grid-a">
		<button data-icon="flat-cross" data-theme="a" onclick="go_toppage()">ホームに戻す</button>
	</fieldset>
</div>

<!-- QRCodeを表示するページ -->
<div data-role="page" id="QRPage">

		<div data-role="header">
			<h1>QR Code</h1>
		</div>

		<div data-role="content" class="ui-content">
				<div class="example" align="center">
						<div id="qrcode" align="center">
						</div>
						<!-- 候補者を選択しなおす -->
							<!-- <div class="ui-block-b"><button data-icon="back" data-theme="a" onclick="go_back()">選択しなおす</button></div> -->
						<div id="re_select"></div>
						<div id="complete_voting"></div>
				</div>
		</div>

		<div data-role="footer">
				<h1>Ts_Quartetto</h1>
		</div>
</div>

<script>
    $(document).on('pageshow', '#votePage', function(e, d) {
        create_list();
    });

    $(document).ready(function() {
        $("#listdata").searcher({
            itemSelector: "li",
            textSelector: "",
            inputSelector: "#listsearchinput"
        });
    });
</script>

<!-- 利用ログデータ回収許諾ダイアログ  -->
<div data-role="dialog" data-close-btn="none" id="checkCollectLogDialog">
	<div data-role="header">
		<h1>ログ送信に関するお願い</h1>
	</div>
	<div data-role="content">
		筑波大学高度ITコース・チームS.A.Y.では、ユーザの行動分析を行いアプリの改善をする研究を行っております。つきましては、本アプリの利用ログの回収にご協力頂きたいと考えております。利用ログには個人を特定できる情報は含まれず、統計的な分析のみに使用します。ご協力頂ける場合は、[はい]ボタンを押して下さい。<br />
		<a data-role="button" id="acceptCollectLog">Yes</a>
		<a data-role="button" id="denyCollectLog">No</a>
	</div>
</div>

<!-- ユーザカテゴリ選択ダイアログ -->
<div data-role="dialog" data-close-btn="none" id="selectUserCategoryDialog">
	<div data-role="header">
		<h1>Chose User Type</h1>
	</div>
	<div data-role="content">
		Please select the one what you are<br />
		<a data-role="button" class="selectUserCategoryButton" id="usercat-1">Orator</a>
		<a data-role="button" class="selectUserCategoryButton" id="usercat-2">Komennteetaa</a>
		<a data-role="button" class="selectUserCategoryButton" id="usercat-3">Other Orator</a>
		<a data-role="button" class="selectUserCategoryButton" id="usercat-4">other</a>
	</div>
</div>

<!-- ダウンロード失敗したダイアログ  -->
<div data-role="dialog" data-close-btn="none" id="downloadFailDialog">
	<div data-role="header">
		<h1>Load Failed</h1>
	</div>
	<div data-role="content">
		Load Failed<br />
		Try Again?<br />
		<a data-role="button" id="ReDownload">Yes</a>
		<a data-role="button" id="CancelDownload">No</a>
	</div>
</div>

<!-- 文字の大きさを調べる用div -->
<div id="emScale"></div>

</body>
</html>
