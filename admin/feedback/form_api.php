<?php
    session_start();
    require_once('../../utils/utility.php');
    require_once('../../database/dbhelper.php');

    $user = getUserToken();
    if($user==null){
        die();
    }

    if(!empty($_POST)) {
        $action = getPost('action');
        switch($action){
            case 'mark':
                read();
                break;
        }
    }

    function read() {
        $id = getPost('id');
        $updated_at = date("Y-m-d H:i:s");
        $sql = "UPDATE feedback SET status = 1, updated_at='$updated_at' WHERE id = $id";
        execute($sql);
    }
?>