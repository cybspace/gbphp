<?php
/************************
    GLOBAL_VARIABLES
*************************/

//DIRECTORIES
    $ROOT_DIR = $_SERVER['DOCUMENT_ROOT'] . '/L5/';
    $CONFIG_DIR = $ROOT_DIR . 'config/';
    $UPLOADS_DIR = $ROOT_DIR . 'uploads/';
    $PRIVATE_DIR = $ROOT_DIR . 'private/';
    $TEMPLATES_DIR = $ROOT_DIR . 'templates/';
    $WWWROOT_DIR = $ROOT_DIR . 'wwwroot/';

//OTHER
    $IMG_MAX_SIZE = 1000000; //in bytes
    $IMG_THUMBNAILS_WIDTH = 150; //in px
    $IMG_VALID_EXTENSIONS = ['jpg', 'png', 'jpeg'];

?>