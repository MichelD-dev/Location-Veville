<?= "<h1 class='display-3 text-center my-5 text-muted pb-5' style='letter-spacing: 1.2rem'=>$title</h1>" ?>

<table class="table table-bordered align-middle lead">
    <thead class="table-secondary text-muted">
        <tr>
            <th scope="col" class="text-center">Agence</th>
            <th scope="col" class="text-center px-3">Titre</th>
            <th scope="col" class="text-center px-5">Adresse</th>
            <th scope="col" class="text-center px-3">Ville</th>
            <th scope="col" class="text-center px-5">CP</th>
            <th scope="col" class="text-center px-5">Description</th>
            <th scope="col" class="text-center px-5">Photo</th>
            <th scope="col" class="text-center px-4">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($allAgences as $value) : ?>
            <tr>
                <td class="text-center"><?= $value['id_agence']; ?></td>
                <td class="text-center"><?= $value['titre']; ?></td>
                <td class="text-center"><?= $value['adresse']; ?></td>
                <td class="text-center"><?= $value['ville']; ?></td>
                <td class="text-center"><?= $value['cp']; ?></td>
                <td class="text-center"><?= $value['description']; ?></td>
                <td class="text-center"> <?= "<img src={$value['photo']} style='width: 250px''" ?></td>
                <td class="text-center"><i class="bi bi-search px-1"></i><i class="bi bi-pencil-square px-1 mx-1"></i><i class="bi bi-trash-fill px-1"></i></td>
            <?php endforeach;
            ?>
            </tr>
    </tbody>
</table>

<!----------------------------------------------------------------------------->
<!------------------------------------ FORM ----------------------------------->
<!----------------------------------------------------------------------------->

<form class="row g-5 lead fw-normal mt-5" method="POST">
    <div class="col-6">
        <label for="titre" class="form-label">Titre</label>
        <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre de l'agence">
    </div>
    <div class="col-6">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description" rows="8" cols="50" placeholder="Description de votre agence"></textarea>
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
    <div class="col-6">
        <label for="adresse" class="form-label">Adresse</label>
        <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse">
    </div>
    <div class="col-6">
        <label for="ville" class="form-label">Ville</label>
        <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville">
    </div>
    <div class="col-6">
        <label for="cp" class="form-label">Code postal</label>
        <input type="number" class="form-control" name="cp" id="cp" placeholder="Code postal">
    </div>
    <div class="text-center">
        <button class="btn btn-primary mb-5 py-2 px-5">Enregistrer</button>
    </div>
</form>