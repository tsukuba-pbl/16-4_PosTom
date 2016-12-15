function create_list() {
    var checkboxContents = "";
    var ID, NAME, TITLE;
    var correct_json_flag = 0;
    var bookmark_list = localStorage.getItem("bookmarks");
    if (bookmark_list != null && bookmark_list.length > 1) {
        bookmark_list = bookmark_list.split(",");
    }
    var CandidateId = JSON.parse(localStorage.getItem('Candidate_ID'));
    checkboxContents += "<div data-role='controlgroup' class='candidate_list'>";

    $.each(author, function(i) {
        ID = author[i].presenid,
        NAME = author[i].name;

        $.each (presen, function(j) {
            if ( author[i].first === "1" && author[i].presenid === presen[j].presenid) {
                TITLE = presen[j].title;
                checkboxContents += '<li><input type="checkbox" ';
                for (key in CandidateId) {
                    if (CandidateId[key] === presen[j].presenid) {
                      checkboxContents += 'checked="checked"';
                    }
                }
                checkboxContents += 'data-theme="c" id="jsform_checkbox'  + i + '" name="contender'+(i+1)+'"'+' value="'+ID+'"/>'
                checkboxContents += '<label for="jsform_checkbox' + i +'">';
                if (bookmark_list != null) {
                    $.each (bookmark_list, function(k){
                        if(presen[j].presenid === bookmark_list[k]) {
                            TITLE =　"★" + TITLE;
                        }
                    });
                }
                //checkboxContents +='ID: ' + ID + '</br>' + ' Name: ' + NAME + '</br>' + ' Title: ' + TITLE + '</label></li>';
                checkboxContents += '<div style="font-weight:normal">' + ID + '</div>';
                checkboxContents += '<strong>' + TITLE + '</strong><hr>';
                checkboxContents += '<div class="authors-on-list" style="text-align:right">' + NAME + '</div></label></li>';
            }
        });
    });
    checkboxContents += "</div>";
    $("#my_checkbox").empty().append(checkboxContents).trigger("create");
}
