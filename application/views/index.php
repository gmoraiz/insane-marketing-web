<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/sidebar', array('index' => true));
$this->load->view('templates/toast');
?>
<main class="full-container" id="panel">
    <section class="row" id="menu">
        <h3>Cashier</h3>
        <div class="row" id="options">
        </div>
        <form class="row" method="POST" action="score">
            <div class="row" id="user-search-input">
                <div class="input-field col xl5 l10 s12">
                    <input id="phone" type="tel" name="phone" class="validate"/>
                    <label for="phone">User Phone</label>
                </div>
            </div>
            <input id="user" type="hidden" name="user" id="user" class="validate" required/>
            <div class="row" id="user-selected-card">
                <div class="col xl5 l10 s12">
                    <div class="card white border grey-text text-darken-4">
                        <div class="card-content">
                            <span class="card-title" id="userName"></span>
                            <p class="valign-wrapper"><i class="material-icons left">mail</i><span id="userEmail"></span></p>
                            <p class="valign-wrapper"><i class="material-icons left">phone</i><span id="userPhone"></span></p>
                            <p class="valign-wrapper"><i class="material-icons left">map</i><span id="userAddress"></span></p>
                            <p class="valign-wrapper"><i class="material-icons left">today</i><span id="userBirth"></span></p>
                        </div>
                        <div class="card-action">
                            <a href="" id="undo-user" class="red-text text-darken-4"><i class="material-icons left">undo</i>Select Other</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($this->session->userdata('company')->type_fidelity == 'POUNDS'):?>
                <div class="row">
                    <div class="input-field col xl5 l10 s12">
                        <input class='validate money-input' type='text' name='amount' id='expenditure' required/>
                        <label for='expenditure'>Expenditure</label>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($this->session->userdata('company')->type_fidelity == 'POINTS'):?>
                <input type='hidden' name='amount' value="1" id='points' required/>
            <?php endif; ?>
            <div class="row">
                <div class="input-field col s12">
                    <button class="btn waves-effect waves-light grey darken-4" type="submit" name="action">Score
                        <i class="material-icons right">star</i>
                    </button>
                </div>
            </div>
        </form>
    </section>
    
    <section class="row" id="list">
        
        <?php if(empty($fidelities)): ?>
            <p>You haven't any fidelity with users.</p>
        <?php else: ?>
            <h5>Last users scored:</h5>
            <ul class="collection">
                <?php $this->load->view('lists/index') ?>
            </ul>
        <?php endif; ?>
        <?php $this->load->view('templates/loading-pagination') ?>
    </section>
    
</main>

<!-- GET JS OF THIS PAGE -->
<script src="<?= base_url() ?>assets/js/index.js?<?php echo rand() ?>"></script>