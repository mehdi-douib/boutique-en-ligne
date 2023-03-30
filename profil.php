<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil</title>
</head>
<header>
    <?php include 'include/header.php'?>
</header>
<body>

<center>
    <form id="login-form" class="container" method="post">
        <h2>Profil</h2>
        <p>Modifié vos informations !</p>
        <br>
        <div>
            <label for="login">Login</label>
            <input type="login" id="login" name="login" placeholder="Entre ton login" required>
        </div>

        <div>
            <label for="email">Adresse email:</label>
            <input type="email" id="email" name="email" placeholder="Entre ton email" required>
        </div>

        <div>
            <label for="adresse-liv">Adresse De Livraison:</label>
            <input type="text" id="livraison" name="livraison" placeholder="Entre ton adresse de livraison" required>
        </div>

        <div>
            <label for="adresse-fac">Adresse De Facturation:</label>
            <input type="text" id="Facturation" name="Facturation" placeholder="Entre ton adresse de facturation" required>
        </div>

        <div>
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" placeholder="Entre ton mots de passe" required>
        </div>

        <div>
            <label for="password">Confirmation du mot de passe:</label>
            <input type="confirpassword" id="confirmpassword" name="confirmpassword" placeholder="Retape ton mots de passe" required>

            <div><br>
                <button class="bouton-bleu" type="submit">Se connecter</button>
            </div>
    </form>
    <div id="error-message"></div>
</center>

</body>

<footer>
    <?php include 'include/footer.php'?>
</footer>
</html>