<script type="text/javascript">
 $(function(){
	$(document).ready(function(){
		// cakeのtimeフォームは要素が変だから変更
		for (var i = 13; i < 25; i++) {
			$("#EventEventBeginTimeHour").append($("<option>").val(i).text(i));
			$("#EventEventEndTimeHour").append($("<option>").val(i).text(i));
		};
		$('#EventEventBeginTimeMeridian').remove();
		$('#EventEventEndTimeMeridian').remove();
        //RadioボタンのUIの調節
        //Labelのdisplay:inline-blockを無効にされてたので、上書きして整形
        $('label[for="EventIsusedVoteFunction0"]').attr('style','display:inline-block !important');
        $('label[for="EventIsusedVoteFunction1"]').attr('style','display:inline-block !important');
        $('label[for="EventValidOlddestOrLastestVote0"]').attr('style', 'display:inline-block !important');
        $('label[for="EventValidOlddestOrLastestVote1"]').attr('style', 'display:inline-block !important');

        //投票するかのRadioボタンの<legend>タグを他のinputと同様である<label>に変更
        $('input.vote').parent().children('legend').replaceWith('<label>Is Used Vote App</label>');
        $('input.vaildVote').parent().children('legend').replaceWith('<label>Valid Oldest or Latest Vote</label>');
    });

    //投票アプリを使用する場合のみ、最新 or 最古のどちらを有効投票とするのかを選択できるようにした。
    $('input[name="data[Event][isused_vote_function]"]').change(function(){
        //投票アプリ有効の場合は、最新 or 最古のradioボタンをabled
        if($(this).val() === '0'){
            $('input[name="data[Event][valid_olddest_or_lastest_vote]"]').prop('disabled', false);
        //投票アプリ無効の場合は、最新 or 最古のradioボタンをdisabled
        } else if($(this).val() === '1'){
            $('input[name="data[Event][valid_olddest_or_lastest_vote]"]').prop('disabled', true);
        }
    });
	$('#EventAddForm').submit(function(){
		// イベント名
		var eventName = $('#EventEventName').val();
		// 開始日付
		var startYear = $('#EventEventBeginDateYear').val();
		var startMonth = $('#EventEventBeginDateMonth').val();
		var startDay = $('#EventEventBeginDateDay').val();
		var startdate = new Date( startYear + "/" + startMonth + "/" + startDay );
		// 終了日付
		var endYear = $('#EventEventEndDateYear').val();
		var endMonth = $('#EventEventEndDateMonth').val();
		var endDay = $('#EventEventEndDateDay').val();
		var enddate = new Date( endYear + "/" + endMonth + "/" + endDay );

		var daysDiff = getDiff(startdate, enddate);

		var starttime = parseInt($('#EventEventBeginTimeHour').val()*60) + parseInt($('#EventEventBeginTimeMin').val());
		var endtime = parseInt($('#EventEventEndTimeHour').val()*60) + parseInt($('#EventEventEndTimeMin').val());

		// エラーフラグ
		var errFlg = false;
		// エラーメッセージを空に
		err_box = $('.error-messages');
		err_box.empty();

		if(eventName == '' || eventName == undefined || eventName == null){
			// イベント名が空の場合
			err_elm = $('<p>').text("Event Name is required.");
			err_box.append(err_elm);
			errFlg = true;
		}

		if(!dateValidate(startYear, startMonth, startDay)){
			// 開始日が存在しない日付の場合
			err_elm = $('<p>').text("Event Start Date ("+startYear+"/"+startMonth+"/"+startDay+") is not exist.");
			err_box.append(err_elm);
			errFlg = true;
		}
		if(!dateValidate(endYear, endMonth, endDay)){
			// 終了日が存在しない日付の場合
			err_elm = $('<p>').text("Event End Date ("+endYear+"/"+endMonth+"/"+endDay+") is not exist.");
			err_box.append(err_elm);
			errFlg = true;
		}

		if(daysDiff == 1){
			if(endtime<=starttime){
			//イベントが一日の時、開始日時が終了日時より遅い場合
				err_elm = $('<p>').text("Event Begin Time must be earlier than Event End Time.");
				err_box.append(err_elm);
				errFlg = true;
			}
		}
		if(daysDiff < 1){
			// 開始日時の方が小さい場合
			err_elm = $('<p>').text("Event Begin Date must be earlier than Event End Date.");
			err_box.append(err_elm);
			errFlg = true;
		}else if(daysDiff > 10){
			// 開催日数が10日を超える場合
			err_elm = $('<p>').text("Event Days must be 10 days or less.");
			err_box.append(err_elm);
			errFlg = true;
		}

		// エラーが１つでもあればエラーメッセージを表示する
		if(errFlg){
			slideDown(err_box);
			return false;
		}
	})

	// 開始日と終了日の差の日数を算出する処理
	function getDiff(startdate, enddate){
		var msDiff = enddate.getTime() - startdate.getTime();
		var daysDiff = Math.floor(msDiff / (1000 * 60 * 60 * 24));
		return ++daysDiff;
	}

	// エラーメッセージをスライドで表示させる
	function slideDown(slideEle){
		slideEle.slideDown(300).removeClass('disno');
	}

	// 存在する日かどうかチェック
	function dateValidate(y, m, d){
		var date = new Date(y, (m-1), d);
		return(date.getFullYear() == y && date.getMonth() == (m-1) && date.getDate() == d);
	}
})

function changedDate(){
	var month = parseInt($('select#EventEventBeginDateMonth > option[selected="selected"]').attr('value'));
	var day = parseInt($('select#EventEventBeginDateDay > option[selected="selected"]').attr('value'));
}
</script>
<style>
    .vote{
    }
</style>
<h2>Add event</h2>
<p class="attention">* : Required</p>
<div class="error-messages disno"></div>
<?php
echo $this->Form->create('Event');
echo $this->Form->input('event_name', array('class'=>'form-control required', 'required' => false));
echo $this->Form->input('event_location', array('class'=>'form-control'));
echo $this->Form->input('event_begin_date', array('class'=>'form-control', 'onChange' => 'changedDate()'));
echo $this->Form->input('event_begin_time', array('class'=>'form-control', 'value' => '00:00:00', 'interval' => 10));
echo $this->Form->input('event_end_date', array('class'=>'form-control'));
echo $this->Form->input('event_end_time', array('class'=>'form-control', 'value' => '00:00:00', 'interval' => 10));
echo $this->Form->radio('isused_vote_function', array('0' => 'On', '1' => 'Off'), array('value'=>0, 'separator'=>'&nbsp;&nbsp;&nbsp;', 'class'=>'vote'));
echo $this->Form->radio('valid_olddest_or_lastest_vote', array('0' => 'Oldest', '1' => 'Latest'), array('value'=>0, 'separator'=>'&nbsp;&nbsp;&nbsp;', 'class'=>'vaildVote'));
echo $this->Form->submit('Create', array('class'=>'btn btn-custom'));
?>
