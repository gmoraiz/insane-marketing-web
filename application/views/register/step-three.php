<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/loading');
?>

<main id="register" class="flex-container">
    <div class="progress-wrapper">
      <ul class="progressbar">
          <li></li>
          <li></li>
          <li class="active"></li>
          <li></li>
          <li></li>
        </ul>
    </div>
    <p class="grey-text text-darken-4 step-message">We've sent you an email for <b class="red-text text-darken-4"><?= $email ?></b></p>
    <p class="step-message white-text grey darken-4">Confirm your account to generate a login</p>
</main>