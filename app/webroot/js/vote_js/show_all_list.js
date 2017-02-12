function show_all_list() {

    $(".print-vote-btn").removeClass("ui-btn-active");
    $(".c-list").addClass("ui-btn-active");
    $('#my_checkbox').show();
    $('#my_bookmark').hide();
    $('#my_daylist').hide();

    //全件表示
    console.log('all-list');
    $(".candidate-item").each(function() {
        $(this).show();
    });
}
