function create_bookmark_list(json_file) {
    var data = {};

    $.getJSON(json_file , function(data, status) {
        var checkboxContents = "";
        var ID, NAME, TITLE;

        checkboxContents += "<div data-role='controlgroup' style='overflow-y:scroll;height:70vh'>";

        var bookmark_list = localStorage.getItem("bookmarks");
        var CandidateId = JSON.parse(localStorage.getItem('Candidate_ID'));

        if (bookmark_list != null) { console.log(bookmark_list);//bookmarksがあったら 
            if (bookmark_list.length > 1) {
                bookmark_list = bookmark_list.split(",");
            }
            $.each(data.author, function(i, item1) {
                ID = item1.presenid,
                NAME = item1.name;

                $.each (data.presen, function(j, item2) {
                  if ( item1.first === "1" && item1.presenid === item2.presenid) {
                      //console.log("item2.presenid="+item2.presenid);
                      $.each (bookmark_list, function(k, item3){
                          if(item2.presenid === bookmark_list[k]) {
                              TITLE = item2.title;
                              checkboxContents += '<li><input type="checkbox" ';
                              for (key in CandidateId) {
                                  if (CandidateId[key] === item2.presenid) {
                                      checkboxContents += 'checked="checked"';
                                  }
                              }
                              checkboxContents += 'data-theme="c" id="jsform_checkbox'  + i + '" name="contender'+(i+1)+'"'+' value="'+ID+'"/></li>'
                              checkboxContents += '<label for="jsform_checkbox' + i +'">★' + 'ID: ' + ID + '</br>' + ' Name: ' + NAME + '</br>' + ' Title: ' + TITLE + '</label>';
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
    }).fail(function() {
      console.log("failed_read_json");
      $("#my_checkbox").empty().append("<a>読み込みError</a>");
    });
  }
