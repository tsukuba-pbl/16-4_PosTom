function vote_application() {
  if (already_voted == 1) {
  $.mobile.changePage("#AlreadyVotedPage", {
        changeHash: true
    });
  }

  else {
    $.mobile.changePage("#votePage", {
          changeHash: true
      });
  }
}
