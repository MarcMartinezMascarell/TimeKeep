import * as alpine from 'alpinejs/dist/cdn';


export { alpine };


//Ajax call on read all notification
var badge = $('#badge-notifications');
document.getElementById('read-all-notifications').addEventListener('click', function(e) {
    e.preventDefault();
    console.log('click');
    $.ajax({
      url: window.location.origin + "/read-all-notifications",
      type: "GET",
      success: function(data) {
        if (data.status == 'success') {
          badge.text('0');
          badge.removeClass('bg-danger').addClass('bg-primary');
        }
      }
    });
  });
  //Ajax call on read single notification
  let notifications = $('.dropdown-notifications-read');
  if(notifications) {
    notifications.on('click', function(e) {
    e.preventDefault();
    console.log('Click notification');
    let id = e.target.parentElement.getAttribute('data-id');
    let parent = e.target.closest('.dropdown-notifications-item');
    console.log(parent);
    $.ajax({
      url: window.location.origin + "/read-notification/" + id,
      type: "GET",
      success: function(data) {
        console.log(data);
        if (data.status == 'success') {
          let currentValue = parseInt(badge.html());
          parent.remove();
          badge.html(currentValue - 1);
          if (currentValue <= 1) {
            $('#badge-notifications').removeClass('bg-danger').addClass('bg-primary');
          }
        }
      }
    });
  });
}
