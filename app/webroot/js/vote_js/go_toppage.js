function go_toppage(){
    $.mobile.changePage("#topPage", {
        changeHash: true
    });
    voteDay2 = d.getDate();
    if (voteDay === voteDay2) {
      already_voted = 1;
    }
    
    voter_param_flag = 2;
}
