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
          <li></li>
          <li class="active"></li>
        </ul>
    </div>
    <p class="grey-text text-darken-4 step-message">Congratulations! To finish we need you manage settings below.</p>
    <form id="register-five" class="row register-form">
        <div class="input-wrapper">
            <p class="red-text text-darken-4 label-p">Choose one layout:</p>
            <div class='input-field layout-wrapper'>
                <input name="layout" type="radio" id="layout1" value="ONE" />
                <label for="layout1"><img width="300px" class="responsive-img" src="assets/img/template.png" alt="Template"/></label>
                
                <input name="layout" type="radio" id="layout2" value="TWO" />
                <label for="layout2"><img width="300px" class="responsive-img" src="assets/img/template.png" alt="Template"/></label>
                
                <input name="layout" type="radio" id="layout3" value="THREE" />
                <label for="layout3"><img width="300px" class="responsive-img" src="assets/img/template.png" alt="Template"/></label>
            </div>
            <p class="red-text text-darken-4 label-p">Choose type fidelity:</p>
            <div class='input-field center-align type-fidelity'>
                <input name="type_fidelity" type="radio" id="pounds" value="POUNDS" required />
                <label for="pounds">Pounds</label>
                
                <input name="type_fidelity" type="radio" id="points" value="POINTS" required/>
                <label for="points">Points</label>
            </div>
            <div class="input-field col s5">
                <textarea id="rule" name="rule" class="materialize-textarea"></textarea>
                <label for="rule">Rule (Optional)</label>
            </div>
            <button type='submit' class='mt-20 btn-floating btn-large waves-effect waves-light grey darken-4 white-text'>
                <i class="material-icons left">navigate_next</i>
            </button>
        </div>
    </form>
</main>