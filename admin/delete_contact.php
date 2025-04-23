<?php
require_once('database/config.php');
require_once('database/dbhelper.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM contact WHERE id = $id";
    execute($sql);
}

header("Location: index.php"); // chuyển về trang quản lý liên hệ
exit;
?>
