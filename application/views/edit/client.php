<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/sidebar', array('client' => true));
$this->load->view('templates/toast');
?>
<main class="full-container" id="panel">
    <section class="row" id="menu">
        <h3>Clients</h3>
        <div class="row" id="options">
            <a href="../client" class="btn-flat waves-effect waves-light red white-text darken-4 back"><i class="material-icons left">keyboard_arrow_left</i>Back</a>
        </div>
        <form class="row" method="POST" action="<?= $client->id ?>">
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input id="name" type="text" name="name" class="validate" value="<?= $client->name ?>"  maxlength="60" required></textarea>
                    <label for="name">Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input id="phone" type="number" name="phone" class="validate" value="<?= $client->phone ?>"  maxlength="13" required></textarea>
                    <label for="phone">Phone</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input id="email" type="email" name="email" class="validate" value="<?= $client->email ?>"  maxlength="50" required></textarea>
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input id="password" type="password" name="password" class="validate"  maxlength="30"></textarea>
                    <label for="password">New password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input id="address" type="text" name="address" value="<?= $client->address ?>" class="validate"  maxlength="255"></textarea>
                    <label for="address">Complete address</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input class='validate datepicker' type='text' value="<?= $client->birth ?>" name='birth' id='birth'/>
                    <label for='birth'>Birth</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button class="btn waves-effect waves-light grey darken-4" type="submit" name="action">Edit
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </section>
</main>