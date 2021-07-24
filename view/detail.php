<?php
foreach ($currentVehicule as $value) : ?>

    <div class="card text-center text-muted fs-4 mt-4">
        <div class="card-header py-4 display-6 fw-normal">
            Votre réservation a bien été validée, <?= $_SESSION['membre']['prenom'] . " !"; ?>
        </div>
        <div class="card-body">
            <p class="fs-3 mt-4">Période du <?= $_GET['debut'] ?> au <?= $_GET['fin'] ?></p>
            <h5 style="font-family: 'Montserrat', sans-serif;" class="card-title fw-bold fs-1  pb- mb-0 mt-5"><?= $value['titre']; ?></h5>
            <div class="text-nd">
                <?= "<img src={$value['photo']} style='width: 500px' class='img-fluid'" ?>
                <!--ne pas effacer ce commentaire-->
            </div>
            <p class="card-text text-muted py-2">
                Montant total:
                <?= $value["prix_journalier"] * ((int)$_GET['fin'] - (int)$_GET['debut']); ?> € </p><br />
            <a href="http://127.0.0.1/Location_Veville/?route=accueil" class="btn btn-primary mb-3 py-2 fs-5 px-5">Retour à l'accueil</a>
        </div>
        <div class="card-footer text-muted py-4 display-6">
            Merci pour votre commande.
        </div>
    </div>
<?php endforeach;
