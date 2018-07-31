<?php
//message variables
$msg = '';
$msgClass = '';
//Check for submit
  if (filter_has_var(INPUT_POST, 'submit')) {
    //Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    //check required fields
    if (!empty($email) && !empty($name) && !empty($message)) {
      //passed
      //check email
      if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        //failed
        $msg = 'Please use a valid email';
        $msgClass = 'alert-danger';
      } else {
        //passed
        //Recipient Email
        $toEmail = 'csanchez@proformllc.com';
        $subject = 'Contact Request From ' . $name;
        $body = '<h2>Contact Request</h2>
          <h4>Name</h4><p>' . $name .'</p>
          <h4>Email</h4><p>' . $email .'</p>
          <h4>Phone</h4><p>' . $phone .'</p>
          <h4>Message</h4><p>' . $message .'</p>';

        //Email Headers
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";

        //Additional Headers
        $headers .= "From: " . $name . "<" . $email . ">" . "\r\n";

        if (mail($toEmail, $subject, $body, $headers)) {
          //Email Sent
          $msg = 'Your email has been sent';
          $msgClass = 'alert-success';
        } else {
          $msg = 'Your email was not sent';
          $msgClass = 'alert-danger';
        }
  
      }
    } else {
      //failed
      $msg = 'Please fill in fields';
      $msgClass = 'alert-danger';
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Expires" content="30" />
  <title>Pro-Form Construction LLC</title>
  <link rel="icon" href="img/favicon.png" type="image/png" sizes="32x32">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  
  <nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <img class="navbar-logo" src="img/logo/hex-logo.jpg" alt=""> 
    <span class="navbar-pro">PRO-FORM</span>
    <span class="navbar-con">CONSTRUCTION LLC</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto"> 
        <li class="nav-item">
          <a class="nav-link" href="index.html">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.html">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="services.html">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-under" href="#">Contact</a>
        </li>
      </ul>
    </div>
  </nav>

  <section id="contact-form">
    <div class="container-fluid contact-image">
      <div class="row">
        <div class="col-lg-6 col-sm-12 contact-background">
          <h2 class="text-light text-center">Contact Us</h2>
          <div class="social-bottom">
            <i class="fa fa-phone icon-phone-contact" aria-hidden="true"> (914) 882-0968</i> 
            <i class="fa fa-envelope-o icon-envelope-contact" aria-hidden="true"> csanchez@proformllc.com</i> 
            <a href="https://www.facebook.com/proformconstructionllc" class="link-tag" target="_blank"> <i class="fa fa-facebook-official icon-facebook-contact" aria-hidden="true"></i></a>
            <a href="https://www.instagram.com/proform_construction/" class="link-tag" target="_blank"><i class="fa fa-instagram icon-instagram-contact" aria-hidden="true"></i></a>
            <a href="https://www.youtube.com/channel/UCYfWUdBLZpKs5XWdRqCl0Pg?view_as=subscriber" class="link-tag" target="_blank"><i class="fa fa-youtube icon-youtube-contact" aria-hidden="true"></i></a>  
          </div>

          <?php if($msg != ''): ?>
            <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
          <?php endif; ?>

          <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>"
            id="contactForm">
            <div class="form-group">
              <label for="name"></label>
              <input type="text" id="name" name="name" class="form-control form-control-sm" placeholder="Name" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
            </div>
            <div class="form-group">
              <label for="email"></label>
              <input type="email" id="email" name="email" class="form-control form-control-sm" placeholder="Enter Email" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
            </div>
            <div class="form-group">
              <label for="phone"></label>
              <input type="text" id="phone" name="phone" class="form-control form-control-sm" placeholder="Enter Phone Number" value=<?php echo isset($_POST['phone']) ? $phone : ''; ?>>
            </div>
            <div class="form-group">
              <label for="message"></label>
              <textarea name="message" id="message" name="message" class="form-control" placeholder="Enter Message" cols="30" rows="5"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-block d-block" type="submit" name="submit">Submit</button>
            </div>
          </form>

        </div> <!--col-->
      </div> <!--row-->
    </div> <!--container-->
  </section>

    <!--Footer-->
  <footer class="footer">
    <img src="img/logo/businesscard1.jpg" class="footer-logo" alt="">
    <div class="copyright">
      &copy; Pro-Form Construction LLC 2018
    </div>
  </footer>
</body>
</html>