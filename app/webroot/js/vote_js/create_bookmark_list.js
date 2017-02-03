function create_bookmark_list() {
    var checkboxContents = "";
    var bookmark_list = localStorage.getItem("bookmarks");
    var CandidateId = JSON.parse(localStorage.getItem('Candidate_ID'));

    $(".print-vote-btn").removeClass("ui-btn-active");
    $(".b-list").addClass("ui-btn-active");

    if (bookmark_list) {  //bookmarksがあったら
        if (bookmark_list.length > 1) {
            bookmark_list = bookmark_list.split(",");
        }
        //bookmarkされてないlist-itemを非表示にする
        $(".candidate-item").each(function(i) {
            var current_list = $(this);
            var ID = $(this).data("candidate-id");
            for(var j = 0; j < bookmark_list.length; j++){
                if (bookmark_list[j] === ID) {
                    current_list.show();
                    break;
                }
                else {
                    current_list.hide();
                }
            }
        });
    }
    else {
        console.log("empty_bookmarks");
        $('#my_checkbox').hide();
        $('#my_daylist').hide();
        $('#my_bookmark').show();
    }
 }
