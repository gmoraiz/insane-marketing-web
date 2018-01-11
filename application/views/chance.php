<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main class="flex-container">
    <p class="grey-text text-darken-4 step-message">This user has reached points to rewards below.</p>
    <form id="change" action="to_reward" method="POST" class="row">
        <input type="hidden" name="user" value="<?= $user ?>">
        <div>
            <div class="input-field col s12 m12">
                <select name="reward">
                    <?php foreach($rewards as $reward): ?>
                        <option value="<?= $reward->id ?>" data-icon="<?= 'assets/img/reward/' . $reward->picture ?>" class="circle"><?= $reward->description ?></option>
                    <?php endforeach; ?>
                </select>
                <label>Choose one reward</label>
            </div>
            <div class="row">
                <button type='submit' class='mt-20 btn-large waves-effect waves-light grey darken-4 white-text'>
                    Reward him<i class="material-icons right">star</i>
                </button>
                <a href="/" class="btn-large mt-20 waves-effect waves-light red white-text darken-4 back"><i class="material-icons left">keyboard_arrow_left</i>Back</a>
            </div>
        </div>
    </form>
</main>