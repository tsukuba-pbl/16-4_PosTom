function create_bookmark_list() {
    var checkboxContents = "";
    var ID, NAME, TITLE;
    var bookmark_list = localStorage.getItem("bookmarks");
    var CandidateId = JSON.parse(localStorage.getItem('Candidate_ID'));

    $(".c-list").removeClass("ui-btn-active");
    $(".b-list").addClass("ui-btn-active");

    checkboxContents += "<div data-role='controlgroup' class='candidate_list'>";

    if (bookmark_list) {  //bookmarksがあったら
        if (bookmark_list.length > 1) {
            bookmark_list = bookmark_list.split(",");
        }
        $.each(author, function(i) {
            ID = author[i].presenid,
            NAME = author[i].name;

            $.each (presen, function(j) {
                if ( author[i].first === "1" && author[i].presenid === presen[j].presenid) {
                    //console.log("presen[j].presenid="+presen[j].presenid);
                    $.each (bookmark_list, function(k) {
                        if(presen[j].presenid === bookmark_list[k]) {
                            TITLE = presen[j].title;
                            checkboxContents += '<li><input type="checkbox" ';
                            for (key in CandidateId) {
                              if (CandidateId[key] === presen[j].presenid) {
                                  checkboxContents += 'checked="checked"';
                              }
                            }
                            checkboxContents += 'data-theme="c" id="jsform_checkbox'  + i + '" name="contender'+(i+1)+'"'+' value="'+ID+'"/></li>'
                            checkboxContents += '<label for="jsform_checkbox' + i +'">';
                            checkboxContents += '<div style="font-weight:normal">' + ID + '</div>';
                            checkboxContents += '★<strong>' + TITLE + '</strong><hr>';
                            checkboxContents += '<div class="authors-on-list" style="text-align:right">' + NAME + '</div></label>';
                        }
                    });
                }
            });
        });

        checkboxContents += "</div>";
        $("#my_checkbox").empty().append(checkboxContents).trigger("create");
    }
    else {
        console.log("empty_bookmarks");
        $('#my_checkbox').empty().append("<a>ブックマークされていません</a>");
    }

    //AND検索できるようにするやつ
    var qs = $("input#searchlist").quicksearch("ul#listdata li");
    qs.cache();
 }
