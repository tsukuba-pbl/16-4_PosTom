function vote_application() {
  if (already_voted == false) {
  $.mobile.changePage("#votePage", {
        changeHash: true
    });
  }

  else {
    $.mobile.changePage("#AlreadyVotedPage", {
          changeHash: true
      });
  }
}
