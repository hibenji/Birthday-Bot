<?php
$conn = new mysqli('<database_ip>', '<database_user>', '<database_password>', '<database_name>');

if ($conn->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}

$webhook = '<discord_webhook_url>';

?>