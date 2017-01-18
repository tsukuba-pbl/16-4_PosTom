function go_toppage(){
    already_voted = true;
    $.mobile.changePage("#topPage", {
        changeHash: true
    });
}
