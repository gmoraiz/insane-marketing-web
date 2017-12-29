<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/sidebar', array('reward' => true));
$this->load->view('templates/delete-dialog', array('description' => "Are you sure want to delete this reward?"));
$this->load->view('templates/toast');
?>
<main class="full-container" id="panel">
    <section class="row" id="menu">
        <h3>Rewards</h3>
        <a class="btn-flat waves-effect waves-light red white-text darken-4 dynamic-form-trigger">New</a>
        <form class="row dynamic-form" method="POST" action="reward" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <textarea id="description" name="description" class="materialize-textarea" required></textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <?php if($this->session->userdata('company')->type_fidelity == 'POUNDS'):?>
                <div class="row">
                    <div class="input-field col xl5 l10 s12">
                        <input class='validate money-input' type='text' name='required' id='pounds' required/>
                        <label for='pounds'>Pounds</label>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($this->session->userdata('company')->type_fidelity == 'POINTS'):?>
                <div class="row">
                    <div class="input-field col xl5 l10 s12">
                        <select name="required">
                            <option value="" disabled selected>Choose...</option>
                            <option value="2">2</option>
                            <option value="4">4</option>
                            <option value="6">6</option>
                            <option value="8">8</option>
                            <option value="10">10</option>
                            <option value="12">12</option>
                            <option value="24">24</option>
                        </select>
                        <label>Points</label>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="file-field input-field col xl5 l10 s12">
                    <div class="btn border white grey-text text-darken-4">
                        <span>Picture</span>
                        <input type="file" name="picture">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" value="Choose...">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button class="btn waves-effect waves-light grey darken-4" type="submit" name="action">Confirm
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </section>
    
    <section class="row" id="result">
        <?php if(empty($rewards)): ?>
            <p>You haven't any rewards.</p>
        <?php else: ?>
            <ul class="collection">
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
                        <a href="#delete-dialog" class="primary-content delete-reward modal-trigger" data-id="<?=$reward->id?>">
                            <i class="material-icons small red-text">delete</i>
                        </a>
                        <a href="reward/<?=$reward->id?>" class="primary-content">
                            <i class="material-icons small blue-text">refresh</i>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </section>
    
</main>