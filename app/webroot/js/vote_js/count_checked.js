/*
**候補者をチェックボックスでチェックしたときに、そのチェックボックスに応じて
**ローカルストレージに保存する処理
**動的に追加したcheckboxは、.changeメソッドでは発火しないので、$(document).on を使う。
*/
$(document).on('change', 'input[type="checkbox"]',function () {
  var count;

  //検索ボタンを押した状態でチェックボックスを押すと非フォーカスにならないのを修正
  $('#searchlist').blur();

  if ($(this).is(":checked")) {
      count = $(this).attr('name');
      CandidateID[count] = $(this).data('candidate-id');
      $("#confirm_candidates").append('<div id="div' + count + '"><p>'+$(this).parent().text()+'</p></div>');
  }
  else {
      count = $(this).attr('name');
      delete CandidateID[count];
      $("#div"+count).remove();
  }
  localStorage.setItem('Candidate_ID',JSON.stringify(CandidateID));
});
