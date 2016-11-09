function checked_checkbox () {
    console.log("test");
    var candidate = JSON.parse(localStorage.getItem('Candidate_ID'));

    for (key in candidate) {
        console.log(key);
        console.log('input[name="'+key+'"]');
        $('input[name="'+key+'"]').attr('checked', true).checkboxradio('refresh');
    }
}
