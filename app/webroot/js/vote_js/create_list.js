function create_list() {
    var checkboxContents = "";
    var ID = new Array();
    var NAME = new Array();
    var TITLE = new Array();
    var correct_json_flag = 0;
    var bookmark_list = localStorage.getItem("bookmarks");
    if (bookmark_list != null && bookmark_list.length > 1) {
        bookmark_list = bookmark_list.split(",");
    }
    var CandidateId = JSON.parse(localStorage.getItem('Candidate_ID'));
    checkboxContents += "<div data-role='controlgroup' class='candidate_list'>";

    $(".c-list").addClass("ui-btn-active");
    $(".b-list").removeClass("ui-btn-active");
    $('#my_checkbox').show();
    $('#my_bookmark').empty();

    /*
        poster[{"presenid","posterid","star","date"}]
        presen[{"presenid","name","affiliation","first"}]
        author[{"presenid","title","abstract","bookmark"}]
    */
    $.each(poster, function(i) {
        $.each (presen, function(j) {
            if (poster[i].presenid === presen[j].presenid) {
                ID[i] = presen[j].presenid;
                TITLE[i] = presen[j].title;
            }
        });
        $.each (author, function(j) {
            if (poster[i].presenid === author[j].presenid && author[j].first === "1") {
                NAME[i] = author[j].name;
            }
        });
        checkboxContents += '<div class="candidate-item" data-candidate-id="'+ID[i]+'">';
        checkboxContents += '<li><input type="checkbox" ';
        for (key in CandidateId) {
            if (CandidateId[key] === ID[i]) {
              checkboxContents += 'checked="checked"';
            }
        }
        checkboxContents += 'data-theme="c" id="jsform_checkbox'  + i + '" name="contender'+(i+1)+'"'+' data-candidate-id="'+ID[i]+'" data-candidate-title="'+TITLE[i]+'" data-candidate-name="'+NAME[i]+'"/>'
        checkboxContents += '<label for="jsform_checkbox' + i +'">';
        checkboxContents += '<div style="font-weight:normal">' + ID[i] + '</div>';
        checkboxContents += '<strong>';
        if (bookmark_list != null) {
            for (var j=0; j<bookmark_list.length; j++) {
                if (ID[i] === bookmark_list[j]) {
                    checkboxContents += '★ ';
                }
            }
        }
        checkboxContents += TITLE[i];
        checkboxContents += '</strong><hr>';
        checkboxContents += '<div class="authors-on-list" style="text-align:right">' + NAME[i] + '</div></label></li></div>';
    });
    checkboxContents += "</div>";
    $("#my_checkbox").empty().append(checkboxContents).trigger("create");

    //ポスターセッションが無いときはIDは空
    if (ID.length === 0) {
        $('#my_checkbox').empty().append('<a>ポスターセッションはありません</a>');
    }

    //AND検索できるようにするやつ
    var qs = $("input#searchlist").quicksearch("ul#listdata li");
    qs.cache();
}
