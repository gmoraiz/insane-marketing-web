<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/sidebar', array('administrator' => true));
$this->load->view('templates/delete-dialog', array('description' => "Are you sure want to delete this administrator?"));
$this->load->view('templates/toast');
?>
<main class="full-container" id="panel">
    <section class="row" id="menu">
        <h3>Administrators</h3>
        <div class="row" id="options">
            <a class="btn-flat waves-effect waves-light red white-text darken-4 dynamic-form-trigger">New</a>
        </div>
        <form class="row dynamic-form" method="POST" action="administrator">
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input id="name" type="text" name="name" class="validate" required></input>
                    <label for="name">Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input id="user" type="text" name="username" class="validate" required></input>
                    <label for="user">User</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input id="password" type="password" name="password" class="validate" required></input>
                    <label for="password">Password</label>
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
        <?php if(empty($administrators)): ?>
            <p>You haven't any administrator.</p>
        <?php else: ?>
            <ul class="collection">
                <?php $this->load->view('lists/administrator') ?>
            </ul>
        <?php endif; ?>
        <?php $this->load->view('templates/loading-pagination') ?>
    </section>
    
</main>

<!-- GET JS OF THIS PAGE -->
<script src="<?php echo base_url()?>assets/js/message.js?<?php echo rand() ?>"></script>