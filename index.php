<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->


<?php
require_once(__DIR__.'/vendor/sendpulse/rest-api/src/ApiInterface.php');
require_once(__DIR__.'/vendor/sendpulse/rest-api/src/ApiClient.php');
// https://login.sendpulse.com/settings/#api
define('API_USER_ID', '');
define('API_SECRET', '');
define('ADDRESSBOOK_ID', '');
define('TOKEN_STORAGE', 'file');
if (isset($_POST['email']))  {
	
	# Добавляем в базу данных подписавшегося пользователя
	$connect=mysqli_connect("localhost","root","","subscribers");
	mysqli_query($connect,"INSERT INTO `subscribers`(`email`) VALUES ('{$_POST['email']}')");

	
    $variables = array();
    $variables['Name'] = 'Client';
    
    $emails = array(
        array(
            'email' => $_POST['email'],
            'variables' => $variables
        )
    );
    $SPApiProxy = new SendpulseApi(API_USER_ID, API_SECRET, TOKEN_STORAGE);
    $res = $SPApiProxy->addEmails(ADDRESSBOOK_ID, $emails);
    header('Content-Type: application/json');
    echo json_encode($res);
}

?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Newsletter Sign Up Form</title>
  <link rel="stylesheet" href="css/style.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <section class="subscribe">
    <div class="subscribe-pitch">
      <h3>Subscribe</h3>
      <p>Subscribe to our newsletter to get the latest scoop right to your inbox.<p>
    </div>
    <form action="" method="post" class="subscribe-form">
      <input type="email" name="email" class="subscribe-input" placeholder="Email address" autofocus>
      <button type="submit" class="subscribe-submit">Subscribe</button>
    </form>
  </section>

  <section class="about">
    <p class="about-links">
      <a href="http://www.cssflow.com/snippets/newsletter-sign-up-form" target="_parent">View Article</a>
      <a href="http://www.cssflow.com/snippets/newsletter-sign-up-form.zip" target="_parent">Download</a>
    </p>
    <p class="about-author">
      &copy; 2012&ndash;2013 <a href="http://thibaut.me" target="_blank">Thibaut Courouble</a> -
      <a href="http://www.cssflow.com/mit-license" target="_blank">MIT License</a><br>
      Original PSD by <a href="http://365psd.com/day/281/" target="_blank">Farzad Ban</a>
    </p>
  </section>
</body>
</html>
