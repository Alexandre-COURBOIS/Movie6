<?php
session_start();

include('inc/pdo.php');
include('inc/functions.php');

if(!empty($_GET['id']) && is_numeric($_GET['id']) && is_logged()) {

}