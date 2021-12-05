<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">

    <title>Veville<?= " | $title" ?></title>
</head>

<body>
    <div id="main">
        <header>
            <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary lead fs-4">
                <div class="container-fluid d-flex justify-content-between">
                    <a style='letter-spacing: .5rem;' class="navbar-brand py-2 ms-5 fs-3" href="?route=accueil"><span style="font-family: 'Montserrat'" class="display-3 ms-4">VEVILLE</span> Location</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <?php if (!isset($_SESSION['membre'])) : ?>
                                <li class="nav-item mx-5">
                                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#signup">S'inscrire</a>
                                </li>
                                <li class="nav-item mx-5">
                                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#connection">Se connecter</a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item mx-5">
                                <a class="nav-link" href="#">Mon compte</a>
                            </li>
                            <li class="nav-item mx-5">
                                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#contact">Contactez-nous</a>
                            </li>
                            <?php if (isset($_SESSION['membre'])) : ?>
                                <li class="nav-item mx-5">
                                    <a class="nav-link" href="?route=logout">Deconnexion</a>
                                </li>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == "Admin") : ?>
                                <li class="nav-item dropdown mx-5">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Dashboard
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="?route=vehicules">Véhicules</a></li>
                                        <li><a class="dropdown-item" href="?route=agences">Agences</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>




        <!-- Form modal sign-up -->
        <?php require_once './view/modals/sign-up.php'; ?>
        <!-- Form modal sign -->
        <?php require_once './view/modals/sign.php'; ?>
        <!-- Form modal contact -->
        <?php require_once './view/modals/contact.php'; ?>

        <main class="container"> <?= $content ?></main>

        <footer>
            <nav style="margin-top: 200px;" class="navbar navbar-expand-lg bg-primary lead py-5 ">
                <div class="container-fluid f-flex justify-content-center">
                    <ul class="navbar-nav list-unstyled  ">
                        <li class="disabled px-5">
                            <a class="link-light text-decoration-none mx-5" href="#">
                                Mentions légales
                            </a>
                        </li class="disabled px-5">
                        <li><a class="link-light text-decoration-none mx-5" href="#">
                                Conditions générales de vente
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </footer>
    </div>
</body>

</html>