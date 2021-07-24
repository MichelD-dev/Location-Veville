<?php
$selected = isset($_POST['id_agence']) ? $_POST['id_agence'] : "";
$selectedValue = 'selected="selected"';
?>

<form name="form" class="row g-5 lead fw-normal mt-5" name="select" method="post" onchange="submit()">
    <div class="col-4">
        <select id="agence" name="id_agence" class="form-select">
            <option value=0 <?php if ($selected == 0) echo $selectedValue ?>>Agences</option>
            <option value=1 <?php if ($selected == 1) echo $selectedValue ?>>Agence de Paris</option>
            <option value=2 <?php if ($selected == 2) echo $selectedValue ?>>Agence de Lyon</option>
            <option value=3 <?php if ($selected == 3) echo $selectedValue ?>>Agence de Bordeaux</option>
        </select>
    </div>
</form>

<?= "<h1 class='display-3 text-center my-5 text-muted pb-5' style='letter-spacing: 1.2rem'=>$title</h1>" ?>

<table class="table table-bordered align-middle lead">
    <thead class="table-secondary text-muted">
        <tr>
            <th scope="col" class="text-center px-4">Vehicule</th>
            <th scope="col" class="text-center px-4">Agence</th>
            <th scope="col" class="text-center px-4">Titre</th>
            <th scope="col" class="text-center px-4">Marque</th>
            <th scope="col" class="text-center px-4">Modèle</th>
            <th scope="col" class="text-center">Description</th>
            <th scope="col" class="text-center">Photo</th>
            <th scope="col" class="text-center px-4">Prix</th>
            <th scope="col" class="text-center px-4">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($allVehicules as $value) : ?>
            <tr>
                <td class="text-center"><?= $value['id_vehicule']; ?></td>
                <td class="text-center"><?= $value['ville']; ?></td>
                <td class="text-center"><?= $value['titre']; ?></td>
                <td class="text-center"><?= $value['marque']; ?></td>
                <td class="text-center"><?= $value['modele']; ?></td>
                <td class="text-center "><?= $value['description']; ?></td>
                <td class="text-center"> <?= "'<img src={$value['photo']} style='width: 250px''" ?> -</td>
                <td class="text-center"><?= "{$value['prix_journalier']} €"; ?></td>
                <td class="text-center"><i class="bi bi-search px-1"></i><i class="bi bi-pencil-square px-1 mx-1"></i><i class="bi bi-trash-fill px-1"></i></td>
            <?php endforeach;
            ?>
            </tr>
    </tbody>
</table>

<!----------------------------------------------------------------------------->
<!------------------------------------ FORM ----------------------------------->
<!----------------------------------------------------------------------------->

<form class="row g-5 lead fw-normal mt-5" method="POST" id="form" name="form">
    <div class="col-6">
        <label for="titre" class="form-label">Titre</label>
        <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre de l'annonce">
    </div>
    <div class="col-6">
        <label for="marque" class="form-label">Marque</label>
        <input type="text" class="form-control" name="marque" id="marque" placeholder="Marque">
    </div>
    <div class="col-6">
        <label for="modele" class="form-label">Modèle</label>
        <input type="text" class="form-control" name="modele" id="modele" placeholder="Modèle">
    </div>
    <div class="col-6">
        <label for="prix" class="form-label">Prix</label>
        <input type="text" class="form-control" name="prix_journalier" id="prix" placeholder="Prix journalier">
    </div>
    <div class="col-6">
        <label class="form-label" for="photo">Photo</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="bi bi-camera-fill"></i></span>
            </div>
            <input type="text" class="form-control" id="photo" name="photo" placeholder="URL de la photo" />
        </div>
    </div>
    <!-- <div class="col-md-6">
        <label class="form-label" for="photo">Photo</label>
        <input type="file" class="form-control" id="photo" name="photo"/>
    </div> -->
    <div class="col-4">
        <label for="agence" class="form-label">Agence</label>
        <select id="agence" name="id_agence" class="form-select" form="form">
            <option value="1">PARIS</option>
            <option value="2">LYON</option>
            <option value="3">BORDEAUX</option>
        </select>
    </div>
    <div class="col-6">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description" rows="8" cols="50" placeholder="Description de votre véhicule"></textarea>
    </div>
    <div class="text-center">
        <button class="btn btn-primary mb-5 py-2 px-5">Enregistrer</button>
    </div>
</form>