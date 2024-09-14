
function toggleProfileMenu() {
  var profMenu = document.getElementById('prof-menu');
  profMenu.style.display = (profMenu.style.display === 'flex') ? 'none' : 'flex';
}

function toggleCommentSection() {
  var commentSecDiv = document.getElementById("comment-sec-div");
  commentSecDiv.classList.toggle("show");
}

function redirectToEvent(eventid) {
  window.location = 'event2.php?eventid=' + eventid + '&showCommentSection=true';
}