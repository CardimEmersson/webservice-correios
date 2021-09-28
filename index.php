<?php
  ob_start();
  session_start();
  require __DIR__ . "/vendor/autoload.php";
  use League\OAuth2\Client\Provider\Google;

  if (empty($_SESSION["loginGoogle"])) {
    $googleData = new Google([
      'clientId'     => '646872545514-kbr9okrht0pjsh1rlq7fp6egdmbk627r.apps.googleusercontent.com',
      'clientSecret' => 'qR5I2i7M-2Wcl8ZoG2XwJdXc',
      'redirectUri'  => 'http://localhost/webservice-correios',
    ]);
    $authUrl = $googleData->getAuthorizationUrl();
    $error = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRING);
    $code = filter_input(INPUT_GET, "code", FILTER_SANITIZE_STRING);

    if ($code) {
      $token = $googleData->getAccessToken("authorization_code", [
        "code" => $code
      ]);
      
      $_SESSION["loginGoogle"] = serialize($googleData->getResourceOwner($token));
      header("Location: http://localhost/webservice-correios");
      exit();
    }
  } else {
    $user = unserialize($_SESSION["loginGoogle"]);
  }
  ob_end_flush();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Webservice Correios</title>

  <link rel="stylesheet" href="styles/style.css">
</head>

<body>
  <?php if(!empty($user)) { ?>
  <header>
    <div class="user-container">
      <img class="user-profile" src='<?php echo $user->getAvatar(); ?>' alt='<?php echo $user->getFirstName() ?>' />
      <h2 class="user-name"><?php echo $user->getName() ?></h2>
    </div>
    <a href="http://localhost/webservice-correios/source/logout.php" class="logout-button">Sair</a>
  </header>
  <?php } ?>
  <main>

    <?php 
      if (empty($_SESSION["loginGoogle"])) {
    ?>
    <div class="login-container">
      <h1 class="title">Webservice Rastreio - Login</h1>

      <a href="<?php echo $authUrl; ?>" class="login-button">
        <img class="google-logo"
          src="https://cdn-0.imagensemoldes.com.br/wp-content/uploads/2020/04/imagem-google-logo-com-fundo-transparente-1.png"
          alt="Google logo">

        <span class="login-button-text">Logar com o Google</span>
      </a>

      <?php if(isset($error)) { ?>
      <span class="error-message">Você precisa realizar o login!</span>
      <?php } ?>
    </div>
    <?php } else { 
        require('formRastreio.php');
      } 
    ?>
  </main>
</body>

</html>