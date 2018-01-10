<?php foreach($clients as $client): ?>
    <li class="collection-item">
        <span class="title"><b><?= $client->name ?></b></span><br>
        <?= $client->email ?></br>
        <?= $client->phone ?></br>
        <a href="client/<?=$client->id?>" class="primary-content tooltipped" data-position="right" data-delay="100" data-tooltip="View/Update it">
            <i class="material-icons small blue-text">subject</i>
        </a>
        <a href="#delete-dialog" class="primary-content delete-client modal-trigger tooltipped" data-position="right" data-delay="100" data-tooltip="Delete it" data-id="<?=$client->id?>">
            <i class="material-icons small red-text">delete</i>
        </a>
    </li>
<?php endforeach; ?>