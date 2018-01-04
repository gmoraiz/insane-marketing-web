<?php foreach($fidelities as $fidelity): ?>
    <li class="collection-item">
        <span class="title"><b><?= $fidelity->name ?></b></span><br>
        <?= $fidelity->phone ?><br>
        <?php if($this->session->userdata('company')->type_fidelity == 'POUNDS'): ?>
            <b class="green-text text-darken-4"><?= $fidelity->amount ?></b>
        <?php endif; ?>
    </li>
<?php endforeach; ?>