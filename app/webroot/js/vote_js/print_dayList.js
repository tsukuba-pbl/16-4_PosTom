function print_dayList(today){
    $('.print-vote-btn').removeClass('ui-btn-active');
    $('day-'+today).addClass('ui-btn-active');
    $(".candidate-item").each(function(i) {
        var current_list = $(this);
        var DATE = $(this).data("candidate-date");
        if (DATE === today) {
            $('#my_checkbox').show();
            $('#my_bookmark').hide();
            current_list.show();
        }
        else {
            $('#my_checkbox').show();
            $('#my_bookmark').hide();
            current_list.hide();
        }
    });
}
