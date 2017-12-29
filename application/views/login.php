<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main class="flex-container">
    <form class="row" action="login-admin" method="POST">
        <div class='input-field col s12'>
            <input class='validate' type='text' name='username' id='username' required/>
            <label for='username'>Username</label>
        </div>
            <div class='input-field col s12'>
            <input class='validate' type='password' name='password' id='password' required/>
            <label for='passowrd'>Password</label>
        </div>
        <div class='row'>
            <button type='submit' class='col s12 btn-large waves-effect waves-light grey darken-4 white-text'>Enter</button>
        </div>
    </form>
    <a class="waves-effect waves-darken white red-text text-darken-4 btn-flat btn-large">I forgot my password ):</a>
    <a href="register" class="waves-effect waves-darken white btn-flat btn-large">Don't have an account?</a>
</main>