　function print_dayList(today){
    var count = 0;
    var flag = 0;

    $('.print-vote-btn').removeClass('ui-btn-active');
    $('day-'+today).addClass('ui-btn-active');

    $('#my_daylist').hide();

    $(".candidate-item").each(function(i) {
        var current_list = $(this);
        var DATE = $(this).data("candidate-date");
        if (DATE === today) {
            current_list.show();
            $('#my_checkbox').show();
        }
        else {
            current_list.hide();
            count++;console.log(count+','+i);
            //もしその日のポスターセッションが存在しないならば
            if ((i+1) === count) {
                $('#my_daylist').empty().append("<a>day"+today+"のポスターセッションはありません</a>");
                $('#my_checkbox').hide();
                $('#my_bookmark').hide();
                $('#my_daylist').show();
            }
        }
    });
}
