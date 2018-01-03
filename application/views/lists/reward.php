<?php foreach($rewards as $reward): ?>
    <li class="collection-item avatar">
        <img src="assets/img/reward/<?= $reward->picture?>" alt="" class=" circle materialboxed responsive-img">
        <span class="title"><?= $reward->description ?></span>
        <p>
            <?php if($this->session->userdata('company')->type_fidelity == 'POINTS'): ?>
                <b class="yellow-text text-darken-3"><?= $reward->required ?> Points</b>
            <?php else: ?>
                <b class="green-text"><?= $reward->required ?></b>
            <?php endif; ?>
        </p>
        <a href="reward/<?=$reward->id?>" class="primary-content tooltipped" data-position="right" data-delay="100" data-tooltip="View/Update it">
            <i class="material-icons small blue-text">subject</i>
        </a>
        <a href="#delete-dialog" class="primary-content delete-reward modal-trigger tooltipped" data-position="right" data-delay="100" data-tooltip="Delete it" data-id="<?=$reward->id?>">
            <i class="material-icons small red-text">delete</i>
        </a>
    </li>
<?php endforeach; ?>