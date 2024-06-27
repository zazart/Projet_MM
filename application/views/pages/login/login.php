<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Login</title>
    <link href="<?php echo (base_url("assets/css/itu.css")) ?>" rel="stylesheet">
</head>
<body>
    <div class="boite-login">
        <div class="section-img-login">
            <img src="<?php echo (base_url("assets/img/login.svg")) ?>" alt="image-login">
        </div>
        <div class="section-form-login">
            <h1>Projet MM ...</h1>
            <?php echo form_open('login/auth/login'); ?>
                <input type="email" name="email" id="email" class="insertion-donnees-login" placeholder="Email ..." value="Belouh@wukeys.com">
                <input type="password" name="password" id="password" class="insertion-donnees-login"  placeholder="Mot de passe" value="Belouh@wukeys.com">
                <?php echo validation_errors('<div style="margin-top:5px;margin-bottom:5px;color:#011103;">', '</div>'); ?>
                <?php echo isset($error) ? '<div margin-bottom:5px;color:#011103;>'.$error.'</div>' : ''; ?>
                <input type="submit" value="Connexion" class="btn-donnees-login">
            </form>
        </div>
    </div>
</body>
</html>
