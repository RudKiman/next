<?php
require(__DIR__ . '/libs/rb-mysql.php');

R::setup( 'mysql:host=localhost;dbname=altyncms',
        'ligro', 'ocksrbZ98W' );
if(!R::testConnection()) die('No DB connection!');

session_start();
?>
