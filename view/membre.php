<?= "<h1 class='display-3 text-center my-5 text-muted pb-5' style='letter-spacing: 1.2rem'=>$title</h1>" ?>

<table class="table table-bordered align-middle lead">
    <thead class="table-secondary text-muted">
    
        
        <tr class="px-4">
            <th scope="col" class="text-center">Id membre</th>
            <th scope="col" class="text-center">Pseudo</th>
            <th scope="col" class="text-center">Nom</th>
            <th scope="col" class="text-center">Prénom</th>
            <th scope="col" class="text-center">Email</th>
            <th scope="col" class="text-center">Civilité</th>
            <th scope="col" class="text-center">Statut</th>
            <th scope="col" class="text-center">Date_enregistrement</th>
            <th scope="col" class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($allMembres as $value) : ?>
            <tr>
                <td class="text-center"><?= $value['id_membre']; ?></td>
                <td class="text-center"><?= $value['pseudo']; ?></td>
                <td class="text-center"><?= $value['nom']; ?></td>
                <td class="text-center"><?= $value['prenom']; ?></td>
                <td class="text-center"><?= $value['email']; ?></td>
                <td class="text-center"><?= $value['civilite']; ?></td>
                <td class="text-center"><?= $value['statut']; ?></td>
                <td class="text-center"><?= $value['date']; ?></td>
                <td class="text-center"><i class="bi bi-search px-1"></i><i class="bi bi-pencil-square px-1 mx-1"></i><i class="bi bi-trash-fill px-1"></i></td>
            <?php endforeach;
            ?>
            </tr>
    </tbody>
</table>

<!----------------------------------------------------------------------------->
<!------------------------------------ FORM ----------------------------------->
<!----------------------------------------------------------------------------->

<form class="row g-5 lead fw-normal mt-5" method="post" id="form">
    <div class="col-6">
        <label for="pseudo" class="form-label">Pseudo</label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
            <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Pseudo">
        </div>
    </div>
    <div class="col-6">
        <label for="mdp" class="form-label">Mot de passe</label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
            <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Mot de passe">
        </div>
    </div>
    <div class="col-6">
        <label for="nom" class="form-label">Nom</label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-pencil-fill"></i></div>
            <input type="text" class="form-control" name="nom" id="nom" placeholder="Votre nom">
        </div>
    </div>
    <div class="col-6">
        <label for="prenom" class="form-label">Prénom</label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-pencil-fill"></i></div>
            <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Votre prénom">
        </div>
    </div>
    <div class="col-6">
        <label for="email" class="form-label">Email</label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-envelope-fill"></i></div>
            <input type="email" class="form-control" name="email" id="email" placeholder="Votre email">
        </div>
    </div>
    <div class="col-2">
        <label for="civilite" class="form-label">Civilité</label>
        <select id="civilite" name="civilite" class="form-select" form="form">
            <option value=1>Homme</option>
            <option value=2>Femme</option>
        </select>
    </div>
    <div class="col-2">
        <label for="statut" class="form-label">Statut</label>
        <select id="statut" name="statut" class="form-select" form="form">
            <option value=1>Admin</option>
            <option value=2>Membre</option>
        </select>
    </div>
    <div class="text-center">
        <button class="btn btn-primary mb-5 py-2 px-5">Enregistrer</button>
    </div>
</form>