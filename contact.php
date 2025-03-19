<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;

require_once './kontakt/PHPMailer.php';
require_once './kontakt/Exception.php';
require_once './kontakt/SMTP.php';

require './db/Db.php';

Db::connect('studmysql01.fhict.local', 'dbi525769', 'dbi525769', '1234');

$faq = Db::queryAll("SELECT * FROM `faq`;");

$chyba = '';

if (isset($_POST['contactt'])) {

  if ($_POST['name'] && $_POST['email'] && $_POST['message']) {

    $name = $_POST['name'];
    $email = trim($_POST['email']);
    $message = $_POST['message'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

      $mail = new PHPMailer(true);
      try {
        //server setup
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->Username = 'api';
        $mail->Password = '95b8bd80361c7139099597641d790224';

        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress($email);
        $mail->addReplyTo($email, $name);

        //fill this
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";                            //email format setup
        $mail->Subject = 'Nová Správa z webu: ';
        $mail->Body    = "<span>From: {$email}</span><br><br><span>Username: {$name}</span><br><p>Message: {$message}</p>";

        $mail->send();
        $success =  'Your message has been sent successfully!';
      } catch (Exception $e) {
        $error = 'Error: ' . $e->getMessage();
      }
    } else {
      $chyba = 'E-mail is not valid';
    }
  } else {
    $chyba = 'All fields must be filled out';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  
  <?php require_once "./includes/head.php" ?>
</head>

<body>
  <div class="header">
    <div class="container">
      <?php require_once "./includes/header.php" ?>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-2 faq">
        <h2>Often asked questions</h2>

        <div style="visibility: hidden; position: absolute; width: 0px; height: 0px;">
          <svg xmlns="http://www.w3.org/2000/svg">
            <symbol viewBox="0 0 24 24" id="expand-more">
              <path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z" />
              <path d="M0 0h24v24H0z" fill="none" />
            </symbol>
            <symbol viewBox="0 0 24 24" id="close">
              <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
              <path d="M0 0h24v24H0z" fill="none" />
            </symbol>
          </svg>
        </div>

        <?php foreach ($faq as $item) : ?>
        <details>
            <summary>
              <h4><?= $item['questions'] ?></h4>
              <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" />
              </svg>
              <svg class="control-icon control-icon-close" width="24" height="24" role="presentation">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" />
              </svg>
            </summary>
            <p><?= $item['answers'] ?></p>
        </details>
        <?php endforeach; ?>
      </div>

      <div class="col-2">
        <div class="wrapper">
          <form class="form" method="POST" action="contact.php">
            <div class="pageTitle title">Contact us! </div>
            <div class="secondaryTitle title">Please fill in this form</div>
            <input type="text" name="name" class="name formEntry" placeholder="Name">
            <input type="text" name="email" class="email formEntry" placeholder="Email">
            <textarea id="message" name="message" class="message formEntry" placeholder="Message"></textarea>
            <button class="submit formEntry" type="submit" name="contactt">Submit</button>
          </form>
        </div>
      </div>

    </div>
  </div>

  <?php require_once "./includes/footer.php" ?>


  <script src="js/toggleMenu.js"></script>
</body>

</html>