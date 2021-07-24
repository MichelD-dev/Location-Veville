<!----------------------------------------------------------------------------->
<!------------------------------------ FORM ----------------------------------->
<!----------------------------------------------------------------------------->

<?php
$selected = isset($_POST['id_agence']) ? $_POST['id_agence'] : "";
$selectedValue = 'selected="selected"';
?>

<form name="form" class="row g-5 lead fw-normal mt-5" method="post" onchange="submit();">
    <div class="col-4">
        <select id="agence" name="id_agence" class="form-select">
            <option value=0 <?php if ($selected == 0) echo $selectedValue ?>>Agences</option>
            <option value=1 <?php if ($selected == 1) echo $selectedValue ?>>Agence de Paris</option>
            <option value=2 <?php if ($selected == 2) echo $selectedValue ?>>Agence de Lyon</option>
            <option value=3 <?php if ($selected == 3) echo $selectedValue ?>>Agence de Bordeaux</option>
        </select>
    </div>
</form>

<!----------------------------------------------------------------------------->
<!------------------------------------ TABLEAU ----------------------------------->
<!----------------------------------------------------------------------------->

<?= "<h1 class='display-3 text-center my-5 text-muted pb-5' style='letter-spacing: 1.2rem'=>$title</h1>" ?>

<table class="table table-bordered align-middle lead">
    <thead class="table-secondary text-muted">
        <tr>
            <th scope="col" class="text-center px-4">Commande</th>
            <th scope="col" class="text-center px-4">Membre</th>
            <th scope="col" class="text-center px-4">Véhicule</th>
            <th scope="col" class="text-center px-4">Agence</th>
            <th scope="col" class="text-center px-4">Date et heure de départ</th>
            <th scope="col" class="text-center px-4">Date et heure de fin</th>
            <th scope="col" class="text-center px-4">Prix total</th>
            <th scope="col" class="text-center px-4">Date et heure d'enregistrement</th>
            <th scope="col" class="text-center px-4">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($allCommandes as $value) : ?>
            <tr>
                <td class="text-center"><?= $value['id_commande']; ?></td>
                <td class="text-center px-4"><?= "{$value['statut']}<br/>{$value['prenom']} {$value['nom']}<br/>{$value['email']}"; ?></td>
                <td class="text-center"><?= "-{$value['id_vehicule']}-<br/>{$value['vehicule_titre']}"; ?></td>
                <td class="text-center px-4"><?= "-{$value['id_agence']}-</br>{$value['agences_titre']}"; ?></td>
                <td class="text-center px-4"><?= $value['date_depart']; ?></td>
                <td class="text-center px-4"><?= $value['date_fin']; ?></td>
                <td class="text-center"><?= "{$value['prix_journalier']}" * "{$value['nbr_jours']}" . " €"; ?></td>
                <td class="text-center"><?= $value['date_enregistrement']; ?></td>
                <td class="text-center"><i class="bi bi-search px-1"></i><i class="bi bi-pencil-square px-1 mx-1"></i><i class="bi bi-trash-fill px-1"></i></td>
            <?php endforeach;
            ?>
            </tr>
    </tbody>
</table>