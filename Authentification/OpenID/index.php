<html>
  <head><title>Exemple PHP OpenID</title></head>
  <body>
    <h1>Exemple PHP OpenID</h1>

    <?php if (isset($msg)) { print "<div class=\"alert\">$msg</div>"; } ?>
    <?php if (isset($error)) { print "<div class=\"error\">$error</div>"; } ?>
    <?php if (isset($success)) { print "<div class=\"success\">$success</div>"; } ?>

    <div id="formulaire">
      <form method="get" action="authentification.php">
        URL d'identité OpenID :
        <input type="text" name="identifiant_openid" value="" />
        <input type="submit" value="Se connecter" />
      </form>
    </div>
  </body>
</html>
