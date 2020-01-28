<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'upload_path' => './uploads/',
    'overwrite' => false,
    'encrypt_name' => true,
    'remove_spaces' => true,
    'allowed_types' => 'gif|jpg|png|jpeg',
    'max_size' => 2048000,
    'xss_clean' => true,
);