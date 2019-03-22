<?php
session_start();
$_SESSION['user'] = NULL;
$_SESSION['level'] = NULL;
session_destroy();
header("Location: index.php");