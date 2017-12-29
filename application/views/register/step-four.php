<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/loading');
?>

<main id="register" class="flex-container">
    <div class="progress-wrapper">
      <ul class="progressbar">
          <li></li>
          <li></li>
          <li></li>
          <li class="active"></li>
          <li></li>
        </ul>
    </div>
    <p class="grey-text text-darken-4 step-message">Nice, <b class="red-text text-darken-4"><?= $company->owner?></b>! Now you need to create an account to access our platform. Still you'll able to create others access.</p>
    <form id="register-four" class="row register-form">
        <div class="input-wrapper">
            <div class='input-field col s4'>
                <input class='validate' type='text' name='username' id='username' required/>
                <label for='username'>Username</label>
            </div>
            <div class='input-field col s4'>
                <input class='validate' type='password' name='password' id='password' required/>
                <label for='password'>Password</label>
            </div>
            <button type='submit' class='mt-20 btn-floating btn-large waves-effect waves-light grey darken-4 white-text'>
                <i class="material-icons left">navigate_next</i>
            </button>
        </div>
    </form>
</main>