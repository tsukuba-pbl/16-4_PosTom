$.fn.goToVotePage = function(ev) {
	$(this).on(ev, function() {
		if (voter_param_flag === 0) {
			changePage("#votePage");
		}
		else if (voter_param_flag === 1) {
			alert ("配布されたQRコードをもう一度読み込んで下さい。");
		}
    });
}
