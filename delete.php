<?php
session_start();
if($_SESSION['level'] == 2) {
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        include_once("dbcon.php");
        $link = DBcon();
        $link->query("DELETE FROM uzik WHERE id = $id;");
        $link->close();
    }
}

header("Location: index.php");