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
    <div class="flex-center">
      <p class="grey-text text-darken-4 step-message email-sent-p">We've sent you an email for <b class="red-text text-darken-4"><?= $email ?></b></p>
      <p class="step-message white-text grey darken-4 confirm-account-p">Confirm your account to generate a login</p>
    </div>
</main>