<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/loading');
?>

<main id="register" class="flex-container">
    <div class="progress-wrapper">
      <ul class="progressbar">
          <li class="active"></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
        </ul>
    </div>
    <p class="grey-text text-darken-4 step-message">Let's go init the register of your <b class="red-text text-darken-4">company</b> with informations below</p>
    <form id="register-one" class="row register-form" enctype="multpart/form-data">
        <div class="input-wrapper">
            <div class='input-field col s8'>
                <input class='validate' type='text' name='name' id='name' required/>
                <label for='name'>Name</label>
            </div>
            <div class='input-field col s8'>
                <input class='validate' type='text' name='owner' id='owner' required/>
                <label for='owner'>Owner</label>
            </div>
            <div class='input-field col s8'>
                <input class='validate' type='text' name='address' id='address' required/>
                <label for='address'>Complete address</label>
            </div>
            <div class='input-field col s8'>
                <input class='validate' type='email' name='email' id='email' required/>
                <label for='email'>Email for contact</label>
            </div>
            <div class="file-field input-field col s8">
                <div class="btn file white grey-text text-darken-4 border">
                    <span>Logo</span>
                <input type="file" name="picture" required>
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" value="We need full quality if possible">
                </div>
            </div>
            <button type='submit' class='mt-20 btn-floating btn-large waves-effect waves-light grey darken-4 white-text'>
                <i class="material-icons left">navigate_next</i>
            </button>
        </div>
    </form>
</main>