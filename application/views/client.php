<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/sidebar', array('client' => true));
$this->load->view('templates/delete-dialog', array('description' => "Are you sure want to delete this client?"));
$this->load->view('templates/toast');
?>
<main class="full-container" id="panel">
    <section class="row" id="menu">
        <h3>Clients</h3>
        <div class="row" id="options">
            <a class="btn-flat waves-effect waves-light red white-text darken-4 dynamic-form-trigger">New</a>
        </div>
        <form class="row dynamic-form" method="POST" action="client">
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input id="name" type="text" name="name" class="validate"  maxlength="60" required></textarea>
                    <label for="name">Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input id="phone" type="number" name="phone" class="validate"  maxlength="13" required></textarea>
                    <label for="phone">Phone</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input id="email" type="email" name="email" class="validate"  maxlength="50" required></textarea>
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input id="password" type="password" name="password" class="validate"  maxlength="30" required></textarea>
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input id="address" type="text" name="address" class="validate"  maxlength="255"></textarea>
                    <label for="address">Complete address</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input class='validate datepicker' type='text' name='birth' id='birth'/>
                    <label for='birth'>Birth</label>
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
    
    <section class="row" id="list">
        <?php if(empty($clients)): ?>
            <p>You haven't any client.</p>
        <?php else: ?>
            <ul class="collection">
                <?php $this->load->view('lists/client') ?>
            </ul>
        <?php endif; ?>
        <?php $this->load->view('templates/loading-pagination') ?>
    </section>
    
</main>

<!-- GET JS OF THIS PAGE -->
<script src="<?php echo base_url()?>assets/js/client.js?<?php echo rand() ?>"></script>