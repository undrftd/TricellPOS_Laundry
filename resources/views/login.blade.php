<html>
<head>
  <title>LOGIN</title>
  <meta name="viewport" content="width=device-width", initial-scale="1.0">

  <link rel="stylesheet" type="text/css" href="imports/css/main.css"/>

  <!-- bootstrap -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body class="login_bg">

<div class ="container"><!---first cont div-->
  <div class ="col-md-8 col-md-offset-2">
        <p class="text-center logo_hp">TricellPOS</p>
<!---<div class="row">-->
  <div class="col-md-8 col-md-offset-2">
  <form action="/verify" method="post" id="submit_form">
    @csrf


      <span class="glyphicon glyphicon-user"></span>
      <input type="text" class="form-control" id="log_user_form" name="username" placeholder="Username" required="">

      <span class="glyphicon glyphicon-lock"></span>
      <input type="password" class="form-control" name="password" id="log_pass_form" placeholder="Password" required>

       <center><button class="btn-hover color-8 jquery" type="submit">LOGIN</button></center>

</form>
</div>
</div>
</div><!---end first cont div-->




<!---script---->

<script>

 // $("#log_pass_form").after('<span class="error">helloooooo</span>');
        //$(".error").animate({left: '100px'}, "slow");
        //$(".error").animate({fontSize: '3em'}, "slow");

        //$(".error").animate({
        //  left: '+=100px',
          //color: "#fff"
        //  opacity: 0.18});
        //  });-->



  // $("#log_pass_form").after('<p class="error">Error whatever love u</p>')
  // $(".error").animate({left: '+=100px', color: "#000"});

@if (Session::has('message'))
  $("#log_pass_form").after('<p class="error">{{ session('message') }}</p>')
  $(".error").animate({left: '+=100px', color: "#000"});
@endif
</script>
</body>
</html>