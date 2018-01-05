<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/sidebar', array('administrator' => true));
$this->load->view('templates/toast');
?>
<main class="full-container" id="panel">
    <section class="row" id="menu">
        <h3>Administrators</h3>
        <div class="row" id="options">
            <a href="../administrator" class="btn-flat waves-effect waves-light red white-text darken-4 back"><i class="material-icons left">keyboard_arrow_left</i>Back</a>
        </div>
        <form class="row" method="POST" action="<?= $administrator->id ?>">
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input id="name" type="text" name="name" class="validate" value="<?= $administrator->name ?>" required></input>
                    <label for="name">Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input id="user" type="text" name="username" class="validate" value="<?= $administrator->username ?>" required></input>
                    <label for="user">User</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input id="password" type="password" name="password" class="validate"></input>
                    <label for="password">New Password</label>
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
    
</main>