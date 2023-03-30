<head>
    <link rel="stylesheet" href="../src/css/style.css">
</head>

<header>
    <div class="nav">
        <?php
        // test si l'utilisateur est connecté
        if (isset($_GET['deconnexion'])){
            if($_GET['deconnexion']==true){
                session_unset();
                session_destroy();
                header('Location: index.php');
            }
        }
        else if(isset($_SESSION['login'])){
            $login = $_SESSION['login'];
            echo "<div>
<nav>
<img src='../src/img/logo.png' class='logo'>
<a href='./'>Accueil</a>
<a href='../profil.php'>Profil</a>
<a href='#'>Boutique</a>
<a href='#'>Pannier</a>
<a href='../deconnexion.php'>Déconnexion</a>
</nav>";
            if ($login) {}
        }
        else{
            echo "<nav>
<img src='../src/img/logo.png' class='logo'>
<a href='./'>Accueil</a>
<a href='../connexion.php'>Connexion</a>
<a href='../inscription.php'>Inscription</a>
</nav>";
        }
        ?>
    </div>
</header>