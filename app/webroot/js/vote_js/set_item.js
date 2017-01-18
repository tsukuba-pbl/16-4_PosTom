//テキストフォームから入力されたデータを取得する
function set_item(){
    var N = 3;  //投票する人数
    var candidateId = {};
    var selected_id_json = {};
    var error = "";
    var data = {};
    //var checkId = $('#checkvote').val();
    var count = 0;

    //現在選択している候補者リストを取得
    candidateId = JSON.parse(localStorage.getItem('Candidate_ID'));

    //現在チェックしている候補者数のカウント
    for (key in candidateId) {
      selected_id_json["name_"+(count+1)] = candidateId[key];
      count++;
    }

    // QRcodeが入力されていない場合、エラー
    /*
    if (checkId === "0") {
      console.log("data = null");
      alert("正しいIDをQRコードから入力してください。");
      return;
    }
    */

    //voter_infoはGETパラメータで受け取ったものが格納される
    //data.jsでデータ格納処理
    var obj = JSON.parse(localStorage.getItem('voter_info'));
    if (obj && obj.voter_id) {
        data['voter_id'] = obj.voter_id.toString();
    }
    else {
        console.log("get-param is error");
        error = "投票用紙のQRコードを再度読み込んで下さい";
        alert(error);
        return;
    }

    // count数を見て候補者の選択数をチェック
    if(count < 3){
        console.log("count < 3");
        error = "候補者を3名未満選んでます。候補者は3名選んでください";
    }else if(count > 3){
        console.log("count > 3");
        error = "候補者を4名以上選んでます。候補者は3名選んでください";
    }

    //エラーがあったらalertして終了
    if(error !== ""){
        alert(error);
        return;
    }

    /*
    ** dataにevent_strを保存する。これによってevent毎に投票結果を仕分けすることが可能。
    ** event_strはグローバル変数で、data.jsで定義されている。
    */
    data['event_id'] = event_str;

    //voterのデータと投票のデータのマージ
    var newdata = $.extend(data,selected_id_json);

    //LocalStorageに投票者と候補者リストを'Vote_Info'の名前で保存
    localStorage.setItem('Vote_Info',JSON.stringify(newdata));

    var VoteInfo = JSON.parse(localStorage.getItem('Vote_Info'));

    //QRコード表示ページに遷移
    $.mobile.changePage("#ConfirmPage", {
        changeHash: true
    });

    //QRCodeに入れたい中身を引数に入れる。引数の型はString
    (function(){
        $('#qrcode').empty();
        new QRCode(document.getElementById('qrcode'),JSON.stringify(VoteInfo));
	})();

    $("#confirm_candidates_voted").append(localStorage.getItem('Candidate_ID') + '<br>');
}
