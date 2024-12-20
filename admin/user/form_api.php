<?php
    session_start();
    require_once('../../utils/utility.php');
    require_once('../../database/dbhelper.php');

    $user = getUserToken();
    if($user==null){
        die(); // ngừng hành động nếu chưa login
    }

    if(!empty($_POST)) {
        $action = getPost('action');
        switch($action){
            case 'delete':
                deleteUser();
                break;
        }
    }

    function deleteUser() {
        $id = getPost('id');
        $updated_at = date("Y-m-d H:i:s");
        $sql = "UPDATE user SET deleted = 1, updated_at='$updated_at' WHERE id = $id";
        execute($sql);
    }
?>