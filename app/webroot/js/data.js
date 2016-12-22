// 共通のデータを格納するグローバル変数
var poster 			= [],
    basic_info      = null,
	author 			= null,
	keyword 		= null,
	presen 			= null,
	presents 		= null,
	session 		= null,
	session_map     = {},
	timetable		= null,
	commentator 	= [],
//	position_map 	= null,
	position 		= null,
	taparea 		= null,
	venuemap		= null,
	toppage_img		= null,
	posmapp_bg		= [],
	poster_days		= null,
	STATIC_WIDTH 	= null,
	STATIC_HEIGHT 	= null,
	MAP_AREA_WIDTH 	= null,
	MAP_AREA_HEIGHT = null,
	INIT_SCALE 		= null,
	SCALE_BY 		= null,
    CandidateID     = {},
    voter_info      = null;


// json ファイルの置き場所（URL, 仮）
//var posMAppDataURL = "http://localhost:63342/PosMApp2/PosMApp/www/api/webdb2015.json";
//var posMAppDataVersionURL = "http://localhost:63342/PosMApp2/PosMApp/www/api/webdb2015_version.json";

//var posMAppDataURL = "../../json/webdb2015.json";


var url= window.location.href;
var voter_param = window.location.search.substring(1);  //URLについてるパラメータ受取。?より先を取りたいのでsubstring(1)
// http://localhost/hogehoge#nekoからhogehoge#nekoを取得
var event_str_all = url.substring(url.lastIndexOf('/')+1, url.length);
// hogehoge#nekoからhogehogeを取得
event_str = event_str_all.split('?')[0];
var posMAppDataURL = "../../json/"+event_str+".json";
var posMAppDataVersionURL = "../../json/"+event_str+"_version.json";
var event_vote_app = null;
var event_vote_valid = null;
if (voter_param != null) {
    var get_voter_id   = voter_param.split('&')[0];  get_voter_id   = get_voter_id.split('=')[1];   //voter_id=hoge

    voter_info = '{"voter_id" : "' + get_voter_id + '"}';
    localStorage.setItem('voter_info',JSON.stringify(voter_info));
}

function ViewModel(){
	this.forum = forum;
}

function initData() {
	if(localStorage.getItem("downloadSuccess")){
		poster 			= JSON.parse(localStorage.getItem("poster"));
		author 			= JSON.parse(localStorage.getItem("author"));
		keyword 		= JSON.parse(localStorage.getItem("keyword"));
		presen 			= JSON.parse(localStorage.getItem("presen"));
		presents 		= JSON.parse(localStorage.getItem("presents"));
		session 		= JSON.parse(localStorage.getItem("session"));
        commentator     = JSON.parse(localStorage.getItem("commentator"));
//		position_map 	= JSON.parse(localStorage.getItem("position_map"));
		position 		= JSON.parse(localStorage.getItem("position"));
		taparea 		= JSON.parse(localStorage.getItem("taparea"));
		toppage_img		= JSON.parse(localStorage.getItem("toppage_img"));
		posmapp_bg		= JSON.parse(localStorage.getItem("posmapp_bg"));
		STATIC_WIDTH 	= parseInt(localStorage.getItem("STATIC_WIDTH"));
		STATIC_HEIGHT 	= parseInt(localStorage.getItem("STATIC_HEIGHT"));
//		poster_days 	= Math.ceil(poster.length/position.length);
		poster_days		= posmapp_bg.length;
		timetable 		= JSON.parse(localStorage.getItem("timetable"));
		venuemap		= JSON.parse(localStorage.getItem("venuemap"));
	    basic_info      = JSON.parse(localStorage.getItem("basic_info"));

        event_vote_app = basic_info['event_vote_app'];

		makeSessionMap();
        makeVoteApplication();
        create_navbar();
	}
    event_vote_valid = basic_info['event_vote_valid'];

    if (event_vote_valid === '0') {
		$('#permit_revoting').empty().append('投票後，投票内容を変更し再投票可能です．');
	}

	else if (event_vote_valid === '1') {
		$('#permit_revoting').empty().append('「投票する」を押すとQRコードが表示されます．<br>');
		$('#permit_revoting').empty().append('集計機にQRコードを読み込ませた後は<strong>再投票不可</strong>です．投票しますか？');
	}

	// BlockFinderにかけた画像の幅
	STATIC_WIDTH =  720;
	STATIC_HEIGHT = 960;

	setMapSize();

	ko.applyBindings(new ViewModel());

}

function makeSessionMap(){
	for(var s in session){
		session_map[session[s].sessionid] = session[s];
	}
}

function makeVoteApplication() {
  if (event_vote_app === '0') {
  }

  else if (event_vote_app === '1') {
    $('#vote_app_page').remove();
  }
}
// ポスターマップの大きさに関するデータを計算して格納
function setMapSize() {
	// マップエリアの幅
	MAP_AREA_WIDTH = screen.width;
	// マップエリアの高さ（55がヘッダー、68がフッター分）
	MAP_AREA_HEIGHT = screen.height - 55 - 68 - 68;

	// マップのスケールを決定
	INIT_SCALE = MAP_AREA_WIDTH / STATIC_WIDTH;
	SCALE_BY = "width";
	if (STATIC_HEIGHT * INIT_SCALE > MAP_AREA_HEIGHT) {
	    INIT_SCALE = MAP_AREA_HEIGHT / STATIC_HEIGHT;
	    SCALE_BY = "height";
	}
}

function create_navbar() {
  var list = "";

  list += '<li><a class="topPageButton" id="totoppage" data-icon="toppage">Top</a></li>';
  list += '<li><a class="informationPageButton" id="information" data-icon="informationgray">TimeTable</a></li>';
  list += '<li><a class="venuePageButton"  id="venue"  data-icon="venue" >Floor Map</a></li>';
  list += '<li><a class="presenListPageButton" id="list" data-icon="list">Presentation List</a></li>';
  list += '<li><a class="posterMapPageButton" id="map" data-icon="map">Poster Map</a></li>';

  if (event_vote_app === '0') { //voteON
    list += '<li><a class="votePageButton" id="vote" href="#votePage">Vote</a></li>'
    $('[class="nav-tabicon"]').append('<div data-role="navbar" height="100%" class="nav-tabicon footbar" data-grid="d"><ul>'+list+'</ul></div>');
    $('[data-role="navbar"]').navbar();
  }

  else if (event_vote_app === '1') {  //voteOFF
    $('[class="nav-tabicon"]').append('<div data-role="navbar" height="100%" class="nav-tabicon" data-grid="d"><ul>'+list+'</ul></div>');
    $('[data-role="navbar"]').navbar();
  }
}
