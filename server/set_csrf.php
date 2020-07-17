<?php
include 'server/csrf.php';
$csrf = new csrf();

// Generate Token Id and Valid 
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

// Generate Random Form Register
$register = array(
      'player_id',
      'username',
      'password',
      'fristname',
      'lastname',
      'phone',
      'note'
);
            
$form_names = $csrf->form_names($register, false);