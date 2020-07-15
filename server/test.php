<?php
session_start();
include '../server/csrf.php';
$csrf = new csrf();
print_r($_POST);
echo '<hr>';
print_r($_SESSION);

$form_names = $csrf->form_names(array('user', 'password'), false);

echo '<hr>';
print_r($form_names);

echo '<hr>';

echo $form_names['user'];

$form_names = $csrf->form_names(array('user'), true);

echo '<hr>';

print_r($form_names);