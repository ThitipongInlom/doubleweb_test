<?php
$csrf = new csrf();

// Generate Token Id and Valid Register
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

// Generate Random Form Register
$register = array('username',
                  'password',
                  'fristname',
                  'lastname',
                  'phone'
            );

$form_names = $csrf->form_names($register, false);