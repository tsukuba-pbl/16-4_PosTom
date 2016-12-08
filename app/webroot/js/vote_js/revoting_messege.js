
    if (event_vote_valid === '0') {
        $('#permit_revoting').empty().append('投票後，投票内容を変更し再投票可能です．')
    }

    else if (event_vote_valid === '1') {
        $('#permit_revoting').empty().append('「投票する」を押すとQRコードが表示されます．<br>')
        $('#permit_revoting').empty().append('集計機にQRコードを読み込ませた後は<strong>再投票不可</strong>です．投票しますか？')
    }
