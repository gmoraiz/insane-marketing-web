<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<ul id="slide-out" class="side-nav fixed">
     <li>
        <div class="user-view">
            <div class="background">
                <img width="300px" src="<?= base_url() . 'assets/img/wallpaper.png' ?>">
            </div>
            <a href="#!user"><span class="white-text name" style="margin:0">Hi, <?= $this->session->userdata('company')->admin ?></span></a>
            <a href="#!user"><img class="circle" src="<?= base_url() . 'assets/img/company/' . $this->session->userdata('company')->picture ?>"></a>
            <a href="#!name"><span class="white-text name"><?= $this->session->userdata('company')->name ?></span></a>
            <a href="#!email"><span class="white-text email"><?= $this->session->userdata('company')->email ?></span></a>
        </div>
    </li>
    <li <?php if(isset($index)) echo 'class="active"'; ?>>
        <a href="<?= base_url() ?>">
            <i class="material-icons">add_shopping_cart</i>Cashier
        </a>
    </li>
    <li <?php if(isset($message)) echo 'class="active"'; ?>>
        <a href="<?= base_url() ?>message">
            <i class="material-icons">message</i>Messages
        </a>
    </li>
    <li <?php if(isset($reward)) echo 'class="active"'; ?>>
        <a href="<?= base_url() ?>reward">
            <i class="material-icons">star_border</i>Rewards
        </a>
    </li>
    <?php if($this->session->userdata('company')->master): ?>
        <li <?php if(isset($administrator)) echo 'class="active"'; ?>>
            <a href="<?= base_url() ?>administrator">
                <i class="material-icons">person</i>Administrators
            </a>
        </li>
    <?php endif; ?>
    
    <li>
        <div class="divider"></div>
    </li>
    <li>
        <a class="subheader">Settings</a>
    </li>
    <?php if($this->session->userdata('company')->master): ?>
    <li <?php if(isset($salao)) echo 'class="active"'; ?>>
        <a href="<? echo base_url() ?>edit">
            <i class="material-icons">home</i>Edit
        </a>
    </li>
    <?php endif; ?>
    <li>
        <a href="#">
            <form method="post" id="logout" action="logout">
                <input type="submit" class="btn btn-link logout grey-text text-darken-4 white border" value="Logout"/>
            </form>
        </a>
    </li>
</ul>
<header>
    <nav class="grey darken-4">
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
    </nav>
</header>