<?php
include('../func/redirect.php');
if (!isset($_SESSION['auth'])) {
    reDirect('../login.php', 'Please log in first.', 'alert-warning');
    exit;
}
if ($_SESSION['role_as'] != 1) {
    reDirect('../index.php', 'Unauthorized access to admin panel.', 'alert-danger');
    exit;
}
?>