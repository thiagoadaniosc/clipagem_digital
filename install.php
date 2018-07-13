<?php 
require_once "bootstrap.php";
require_once "includes" . DIRECTORY_SEPARATOR . "db.php";
require_once "functions.php";

FUNCTIONS::createDB();
FUNCTIONS::createDir('uploads');
FUNCTIONS::createDir('pesquisas');