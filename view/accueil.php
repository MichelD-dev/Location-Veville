  <!-- Form modal checkout -->
  <?php require_once './view/modals/checkout.php'; ?>


<!------------------------------- IMAGE DE FOND ---------------------------------->

<div class="jumbotron jumbotron-fluid">
    <?php
    if (isset($_SESSION['membre'])) { ?><div class="welc_pos fs-3">
            <p>Bienvenue, <?= $_SESSION['membre']['prenom'] . " !"; ?></p>
        </div><?php
            } else {
                NULL;
            } ?>
    <div style='top: 15%' class="container text-center ">
        <h1 class="display-4">Bienvenue à bord</h1>
        <p class="fs-5">Location de voiture 24h/24 et 7j/7</p>
    </div>
</div>

<!-------------------------------------------------------------------------------->
<!---------------------------------- FORMULAIRE ---------------------------------->
<!-------------------------------------------------------------------------------->

<?php
$selected = isset($_POST['id_agence']) ? $_POST['id_agence'] : "";
$selectedValue = 'selected="selected"';
?>

<form name="form" class="form-accueil row fs-6 container justify-content-center" method="POST">
    <div style='background-color: #fff;' class="col-2 px-0 ">
        <div class="input-group justify-content-center ">
            <label for="pseudo" class="form-label py-0 mt-2">Adresse de départ</label>

            <!---------------------------------------------------------------->

        </div>
        <select id="agence" name="id_agence" class="form-select py-1">
            <option value=1 <?php if ($selected == 1) echo $selectedValue ?>>Paris (75)</option>
            <option value=2 <?php if ($selected == 2) echo $selectedValue ?>>Lyon (69)</option>
            <option value=3 <?php if ($selected == 3) echo $selectedValue ?>>Bordeaux (33)</option>
        </select>
    </div>

    <!-------------------------------------------------------------------------------->

    <div style='background-color: #fff;' class="col-2 px-0">
        <div class="input-group justify-content-center ">
            <label for="date_debut" class="form-label py-0 mt-2">Début de location</label>
        </div>
        <input class="form-control py-1" type="datetime-local" name="date_debut" id="date_debut">
    </div>

    <!-------------------------------------------------------------------------------->

    <div style='background-color: #fff;' class="col-2 px-0">
        <div class="input-group justify-content-center">
            <label for="date_fin" class="form-label py-0 mt-2">Fin de location</label>
        </div>
        <input class="form-control py-1" type="datetime-local" name="date_fin" id="date_fin">
    </div>
    <button class="btn btn-success  px-5 col-2">Valider un véhicule</button>
</form>

<!-------------------------------------------------------------------------------->
<!-------------------NBR RESULTATS + TRI PAR ODRE DE PRIX------------------------->
<!-------------------------------------------------------------------------------->


<div class="nav_prix">

    <?php
    $selected = isset($_POST['prix_journalier']) ? $_POST['prix_journalier'] : "";
    $selectedValue = 'selected="selected"';
    ?>

    <form id="form" class="d-flex justify-content-around fs-3 f" method="POST" onchange="submit();">
        <p> <?= count($allVehicules); ?> résultats </p>

        <div class="col-1">
            <select id="prix" name="prix_journalier" class="form-select">
                <option value=1 <?php if ($selected == 1) echo $selectedValue ?>>Prix croissant</option>
                <option value=2 <?php if ($selected == 2) echo $selectedValue ?>>Prix décroissant</option>
            </select>
        </div>
    </form>
</div>

<!-------------------------------------------------------------------------------->
<!------------------------------------- CARDS ------------------------------------>
<!-------------------------------------------------------------------------------->

<?php
foreach ($allVehicules as $value) : ?>
    <div class="card my-5 justify-content-center border-0 mx-auto " style="max-width: 40%;">
        <div class="row g-5">
            <div class="col-6 text-end">
                <?= "<img src={$value['photo']} style='width: 300px' class='img-fluid'" ?>
                <!--ne pas effacer ce commentaire-->
            </div>

            <!-------------------------------------------------------------------------------->

            <div style="font-family: 'Montserrat'" class="col-6 mt-4 fw-bold">
                <div class="card-body ms-5 my-4">
                    <h5 style="font-family: 'Montserrat', sans-serif;" class="card-title fw-bold fs-2"><?= $value['titre']; ?></h5>
                    <p class="card-text text-muted"><?= "{$value['description']}<br/>{$value['prix_journalier']} € - {$value['agences_titre']}" ?></p>
                    <a type="button " class="btn btn-success px-3 py-1" data-bs-toggle="modal" data-bs-target="#checkout"
                    <?php  
                    if ($_SESSION) { ?>
                    href="http://127.0.0.1/Location_Veville/?route=reservation&id_vehicule=
                   <?= $value['id_vehicule']; ?>&id_membre=<?=
                    $_SESSION['membre']['id_membre']; ?>&debut=<?=
                    date('d-m-Y', strtotime($_POST['date_debut'])); ?>&fin=<?=
                    date('d-m-Y', strtotime($_POST['date_fin'])); 
                    } else { ?> data-bs-toggle="modal" data-bs-target="#checkout"<?php }  
                    ?>">Réserver et payer</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;
?>