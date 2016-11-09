var count;

$("input[type='checkbox']").change(function () {
    if ($(this).is(":checked")) {
        count = $(this).attr('name');
        CandidateID[count] = $(this).val();
    }
    else {
        count = $(this).attr('name');
        delete CandidateID[count];
    }
    localStorage.setItem('Candidate_ID',JSON.stringify(CandidateID));
});
