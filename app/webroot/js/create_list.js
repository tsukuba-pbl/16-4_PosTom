function create_list(json_file) {
    var data = {};

    $.getJSON(json_file , function(data, status) {
        var checkboxContents = "";
        var ID, NAME, TITLE;
        var correct_json_flag = 0;
        var bookmark_list = localStorage.getItem("bookmarks");
        if (bookmark_list != null && bookmark_list.length > 1) {
            bookmark_list = bookmark_list.split(",");
        }
        var CandidateId = JSON.parse(localStorage.getItem('Candidate_ID'));
        checkboxContents += "<div data-role='controlgroup' style='overflow-y:scroll;height:45vh'>";

        $.each(data.author, function(i, item1) {
            ID = item1.presenid,
            NAME = item1.name;

            $.each (data.presen, function(j, item2) {
              if ( item1.first === "1" && item1.presenid === item2.presenid) {
                  TITLE = item2.title;
                  checkboxContents += '<li><input type="checkbox" ';
                  for (key in CandidateId) {
                      if (CandidateId[key] === item2.presenid) {
                          checkboxContents += 'checked="checked"';
                      }
                  }
                  checkboxContents += 'data-theme="c" id="jsform_checkbox'  + i + '" name="contender'+(i+1)+'"'+' value="'+ID+'"/></li>'
                  checkboxContents += '<label for="jsform_checkbox' + i +'">';
                  if (bookmark_list != null) {
                    $.each (bookmark_list, function(k, item3){
                        if(item2.presenid === bookmark_list[k]) {
                            checkboxContents +="★";
                        }
                    });
                  }
                  checkboxContents +='ID: ' + ID + '</br>' + ' Name: ' + NAME + '</br>' + ' Title: ' + TITLE + '</label>';
              }
            });
        });

        checkboxContents += "</div>";
        $("#my_checkbox").empty().append(checkboxContents).trigger("create");
    })
    .fail(function() {
      $("#my_checkbox").empty().append("<a>読み込みError</a>");
      return false;
    });
}
