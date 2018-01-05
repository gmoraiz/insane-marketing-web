<?php foreach($administrators as $administrator): ?>
    <li class="collection-item">
        <span class="title"><b><?= $administrator->name ?></b></span><br>
        <?= $administrator->username ?></br>
        <a href="administrator/<?=$administrator->id?>" class="primary-content tooltipped" data-position="right" data-delay="100" data-tooltip="View/Update it">
            <i class="material-icons small blue-text">subject</i>
        </a>
        <a href="#delete-dialog" class="primary-content delete-administrator modal-trigger tooltipped" data-position="right" data-delay="100" data-tooltip="Delete it" data-id="<?=$administrator->id?>">
            <i class="material-icons small red-text">delete</i>
        </a>
    </li>
<?php endforeach; ?>