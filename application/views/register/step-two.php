<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/loading');
?>

<main id="register" class="flex-container">
    <div class="progress-wrapper">
      <ul class="progressbar">
          <li></li>
          <li class="active"></li>
          <li></li>
          <li></li>
          <li></li>
        </ul>
    </div>
    <p class="grey-text text-darken-4 step-message">Nice! Your informations are valids. Before completing register, we provide you an application preview. Are you sure?</p>
    <form id="register-two" class="row register-form" enctype="multpart/form-data">
        <div class="input-wrapper">
            <img src="assets/img/template.png" width="200px" class="materialboxed responsive-img img-border"  alt="Previous"/>
            <button type='submit' class='mt-20 btn-floating btn-large waves-effect waves-light grey darken-4 white-text'>
                <i class="material-icons left">navigate_next</i>
            </button>
        </div>
    </form>
</main>