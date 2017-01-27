function create_list() {
    var checkboxContents = "";
    var ID, NAME, TITLE;
    var vote_data = [];
    var correct_json_flag = 0;
    var count_list = 0;
    var bookmark_list = localStorage.getItem("bookmarks");
    if (bookmark_list != null && bookmark_list.length > 1) {
        bookmark_list = bookmark_list.split(",");
    }
    var CandidateId = JSON.parse(localStorage.getItem('Candidate_ID'));
    // Objectソート
    // 第1引数：検索したいkey  第2引数：true -> 昇順  false -> 降順
    var sort_by = function(field, reverse, primer){
        reverse = (reverse) ? -1 : 1;
        return function(a,b){
            a = a[field];
            b = b[field];
            if (typeof(primer) != 'undefined'){
                a = primer(a);
                b = primer(b);
            }
            if (a<b) return reverse * -1;
            if (a>b) return reverse * 1;
            return 0;
        }
    }

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
                ID = presen[j].presenid;
                TITLE = presen[j].title;
                return true;
            }
        });
        $.each (author, function(k) {
            if (poster[i].presenid === author[k].presenid && author[k].first === "1") {
                NAME = author[k].name;
                return true;
            }
        });
        vote_data[i] = { 'id' : ID, 'title' : TITLE, 'name' : NAME };
        console.log(vote_data[i].id+','+vote_data[i].title+','+vote_data[i].name);
        count_list = i;
    });

    //ポスターセッションが無いときはIDは空
    if (vote_data.length === 0) {
        $('#my_checkbox').empty().append('<a>ポスターセッションはありません</a>');
        return;
    }

    vote_data.sort(sort_by('id', false, function(a){return a.toUpperCase()}));

    checkboxContents += "<div data-role='controlgroup' class='candidate_list'>";
    for (var i=0; i<count_list+1; i++) {
        checkboxContents += '<div class="candidate-item" data-candidate-id="'+vote_data[i].id+'">';
        checkboxContents += '<li><input type="checkbox" ';
        for (key in CandidateId) {
            if (CandidateId[key] === vote_data[i].id) {
              checkboxContents += 'checked="checked"';
            }
        }
        checkboxContents += 'data-theme="c" id="jsform_checkbox'  + i + '" name="contender'+(i+1)+'"'+' data-candidate-id="'+vote_data[i].id+'" data-candidate-title="'+vote_data[i].title+'" data-candidate-name="'+vote_data[i].name+'"/>'
        checkboxContents += '<label for="jsform_checkbox' + i +'">';
        checkboxContents += '<div style="font-weight:normal">' + vote_data[i].id + '</div>';
        checkboxContents += '<strong>';
        if (bookmark_list != null) {
            for (var j=0; j<bookmark_list.length; j++) {
                if (vote_data[i].id === bookmark_list[j]) {
                    checkboxContents += '★ ';
                }
            }
        }
        checkboxContents += vote_data[i].title;
        checkboxContents += '</strong><hr>';
        checkboxContents += '<div class="authors-on-list" style="text-align:right">' + vote_data[i].name + '</div></label></li></div>';
    }
    checkboxContents += "</div>";

    $("#my_checkbox").empty().append(checkboxContents).trigger("create");

    //AND検索できるようにするやつ
    var qs = $("input#searchlist").quicksearch("ul#listdata li");
    qs.cache();
}
