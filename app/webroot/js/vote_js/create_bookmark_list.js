function create_bookmark_list() {
    var checkboxContents = "";
    var bookmark_list = localStorage.getItem("bookmarks");
    var CandidateId = JSON.parse(localStorage.getItem('Candidate_ID'));

    $(".print-vote-btn").removeClass("ui-btn-active");
    $(".b-list").addClass("ui-btn-active");
    var dataset = {};

    // 全て非表示し，
    var el = $('.candidate-item');
    for(var i = 0; i < el.length; i++){
        el.eq(i).hide();
        dataset[el.eq(i).data("candidate-id")] = { "el": el.eq(i), "id": el.eq(i).data("candidate-id") };
    }

    if (bookmark_list) { //bookmarksがあったら
        // 配列に変換
        bookmark_list = bookmark_list.split(",");

        // bookmarkのものだけ表示
        for (var i = 0; i < bookmark_list.length; i++) {
            // datasetのKeyにbookmarkのIDがあれば，ブックマークなので，表示
            if (dataset[bookmark_list[i]] != undefined) {
                dataset[bookmark_list[i]].el.show();
            }
        }
        // //bookmarkされてないlist-itemを非表示にする
        // $(".candidate-item").each(function(i) {
        //     var current_list = $(this);
        //     var ID = $(this).data("candidate-id");
        //     for(var j = 0; j < bookmark_list.length; j++){
        //         if (bookmark_list[j] === ID) {
        //             current_list.show();
        //             break;
        //         }
        //         else {
        //             current_list.hide();
        //         }
        //     }
        // });
    } else {
        console.log("empty_bookmarks");
        $('#my_checkbox').hide();
        $('#my_daylist').hide();
        $('#my_bookmark').show();
    }
}