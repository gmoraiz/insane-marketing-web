<?php foreach($messages as $message): ?>
    <li class="collection-item">
        <span class="title"><b><?= $message->title ?></b></span><br>
        <?= $message->description ?><br>
            <?php if($message->activated): ?>
                <b class="green-text">Activated</b>
            <?php else: ?>
                <b class="red-text">Disabled</b>
            <?php endif; ?><br>
        <a href="message/<?=$message->id?>" class="primary-content tooltipped" data-position="right" data-delay="100" data-tooltip="View/Update it">
            <i class="material-icons small blue-text">subject</i>
        </a>
        <a href="#delete-dialog" class="primary-content delete-message modal-trigger tooltipped" data-position="right" data-delay="100" data-tooltip="Delete it" data-id="<?=$message->id?>">
            <i class="material-icons small red-text">delete</i>
        </a>
        <?php if($message->type == 'MONTHLY' || $message->type == 'ANUALLY'): ?>
            <span class="badge white-text grey darken-4 btn"><i class="material-icons small left">access_alarm</i><?= $message->type ?> everyday <?= $message->period ?></span>
        <?php elseif($message->type == 'WEEKLY'): ?>
            <span class="badge white-text grey darken-4 btn "><i class="material-icons small left">access_alarm</i><?= $message->type ?> every <?= $message->period ?></span>
        <?php elseif($message->type == 'SPECIFIC'): ?>
            <span class="badge white-text grey darken-4 btn "><i class="material-icons small left">access_alarm</i><?= $message->period ?></span>
        <?php elseif($message->type == 'BIRTHDAY'): ?>
            <span class="badge white-text grey darken-4 btn "><i class="material-icons small left">access_alarm</i>Everybody's <?= $message->type ?></span>
        <?php else: ?>
            <span class="badge white-text grey darken-4 btn "><i class="material-icons small left">access_alarm</i><?= $message->type ?></span>
        <?php endif; ?>
    </li>
<?php endforeach; ?>