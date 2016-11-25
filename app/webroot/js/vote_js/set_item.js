//テキストフォームから入力されたデータを取得する
function set_item(){
    var N = 3;  //投票する人数
    var candidateId = {};
    var selected_id_json = {};
    var error = "";
    var data = {};
    var checkId = $('#checkvote').val();
    var count = 0;

    //現在選択している候補者リストを取得
    candidateId = JSON.parse(localStorage.getItem('Candidate_ID'));

    //現在チェックしている候補者数のカウント
    for (key in candidateId) {
      selected_id_json["name_"+(count+1)] = candidateId[key];
      count++;
    }

    // QRcodeが入力されていない場合、エラー
    if (checkId === "0") {
      console.log("data = null");
      alert("正しいIDをQRコードから入力してください。");
      return;
    }

    // count数を見て候補者の選択数をチェック
    if(count < 3){
        console.log("count < 3");
        error = "候補者を3名未満選んでます。候補者は3名まで選んでください";
    }else if(count > 3){
        console.log("count > 3");
        error = "候補者を4名以上選んでます。候補者は3名選んでください";
    }

    //エラーがあったらalertして終了
    if(error !== ""){
        alert(error);
        return;
    }

    var voterinfo = $("#voterid").val();
    var obj = JSON.parse(voterinfo);

    data['voter_id'] = obj.voter_id.toString();
    data['voter_name'] = obj.voter_name.toString();

    //voterのデータと投票のデータのマージ
    var newdata = $.extend(data,selected_id_json);

    //LocalStorageに投票者と候補者リストを'Vote_Info'の名前で保存
    localStorage.setItem('Vote_Info',JSON.stringify(newdata));

    var VoteInfo = JSON.parse(localStorage.getItem('Vote_Info'));

    //QRコード表示ページに遷移
    $.mobile.changePage("#QRPage", {
        changeHash: true
    });

    //QRCodeに入れたい中身を引数に入れる。引数の型はString
    (function(){
        $('#qrcode').empty();
            new QRCode(document.getElementById('qrcode'),JSON.stringify(VoteInfo));
	})();
}
