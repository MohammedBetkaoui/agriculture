<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- displays site properly based on user's device -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('Notifications-Page-Template-main/dist/styles.css')}}">

  
  <title>Notifications page</title>

  <!-- Feel free to remove these styles or customise in your own stylesheet 👍 -->
  <style>
    .attribution { font-size: 11px; text-align: center; }
    .attribution a { color: hsl(228, 45%, 44%); }
  </style>
</head>
<body>
  <div class="container notifications-container shadow">
    <div class="row header">
      <div class="col-7">
        <p class="title">
          Notifications
          <span class="unread-notifications-number">3</span>
        </p>
      </div>
      <div class="col-5 mark-as-read text-end">
        <a href="#" id="markAllAsRead" class="mark-as-read-button align-middle">Mark all as read</a>
      </div>
    </div>
    <div class="row notifications">
      <div class="col-12">

        <div class="row single-notification-box unread">
          <div class="col-1 profile-picture">
            <img src="{{ asset('Notifications-Page-Template-main/assets/images/avatar-mark-webber.webp') }}  " alt="profile picture" class="img-fluid">
          </div>
          <div class="col-11 notification-text">
            <p>
            <a href="#" class="link name">Mark Webber</a>
            <span class="description">reacted to your recent post</span>
            <a class="link" href="http://">My first tournament today!</a>
            <span class="unread-symbol">•</span>
            </p>
            <p class="time">1m ago</p>
          </div>
        </div>

      
        
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  <script src=" {{ asset('Notifications-Page-Template-main/App/js/unread.js') }} "></script>
</body>
</html>