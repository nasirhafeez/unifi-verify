<?php

require 'header.php';

$sid = $_SERVER['SID'];
$token = $_SERVER['TOKEN'];
$serviceid = $_SERVER['SERVICEID'];

use Twilio\Rest\Client;

$twilio = new Client($sid, $token);

if (!isset($_POST['verify'])) {
  $_SESSION['fname'] = $_POST['fname'];
  $_SESSION['lname'] = $_POST['lname'];
  $_SESSION['email'] = $_POST['email'];
  //  $phone = $_POST['country_code'].$_POST['phone_number'];
  $phone = $_POST['full_phone'];
  $_SESSION['phone'] = trim($phone);

  $verification = $twilio->verify->v2->services($serviceid)
    ->verifications
    ->create($_SESSION['phone'], "sms");
} else {
  $_SESSION['code'] = trim($_POST['code']);
  $_SESSION['result'] = false;

  $verification_check = $twilio->verify->v2->services($serviceid)
    ->verificationChecks
    ->create(
      [
        "to" => $_SESSION['phone'],
        "code" => $_SESSION['code']
      ]
    );

  if ($verification_check->status == "approved") {
    $_SESSION['result'] = true;
  }
  header("Location: verify_result.php");
}

?>

<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title><?php echo htmlspecialchars($business_name); ?> WiFi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="../assets/styles/bulma.min.css" />
  <link rel="stylesheet" href="../vendor/fortawesome/font-awesome/css/all.css" />
  <link rel="icon" type="image/png" href="../assets/images/favicomatic/favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="../assets/images/favicomatic/favicon-16x16.png" sizes="16x16" />
  <link rel="stylesheet" href="../assets/styles/style.css" />
</head>

<body>
<div class="page">

  <div class="head">
    <br>
    <figure id="logo">
      <img src="../assets/images/logo.png">
    </figure>
  </div>

  <div class="main">
    <seection class="section">
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div id="margin_zero" class="content has-text-centered is-size-6">Por favor insira o código</div>
        <div id="margin_zero" class="content has-text-centered is-size-6">de 4 dígitos recebido</div>
        <div id="gap" class="content is-size-6"></div>
        <div class="field">
          <div class="control has-icons-left">
            <input class="input" type="number" name="code" id="code" placeholder="Code" minlength="4" maxlength="4" required>
            <span class="icon is-small is-left">
                <i class="fas fa-comment"></i>
              </span>
          </div>
        </div>
        <div class="buttons is-centered">
          <input class="button is-dark" type="submit" name="verify" value="Verify">
        </div>
      </form>
    </seection>
  </div>

</div>
</body>

</html>