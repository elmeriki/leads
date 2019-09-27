<?php
try {
    $query = ($_GET['action']);
} catch (Exception $ex) {
    echo "Error has occured." . $ex->getMessage();
}

