function clear_candidate_data() {
    /*
        Candidate_ID = {contender0 : A-1, contender1: A-2, contender2: A-3};
    */
    var candidate_id = JSON.parse(localStorage.getItem('Candidate_ID'));

    //checkされてるものをクリアする
    for (key in candidate_id) {
        var tmp, tmp_id;
        tmp = parseInt(key.split('contender')[1])-1;
        tmp_id = "#jsform_checkbox"+ tmp;
        $(tmp_id).prop("checked", false);
    }

    //リストの更新
    $('#my_checkbox').trigger("create");

    // チェックされた投票者をクリア
    localStorage.removeItem('Candidate_ID')

}
