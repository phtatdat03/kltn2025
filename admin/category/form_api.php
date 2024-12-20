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
                deleteCategory();
                break;
        }
    }

// Ở phần này khi người dùng muốn xóa 1 danh mục sản phẩm hệ thống sẽ 
// yêu cầu người dùng xóa tất cả các sản phẩm liên quan đến danh mục này trước rồi mới xóa danh mục
// tránh bị lỗi dữ liệu
    function deleteCategory() {
        $id = getPost('id');
        $sql = "SELECT count(*) as total FROM product WHERE category_id = $id and deleted=0";
        $data = executeResult($sql, true);
        $total = $data['total'];
        if($total> 0){
            echo 'Danh mục chứa sản phẩm, không thể xóa!';
            die();
        }

        $sql = "DELETE FROM category WHERE id=$id";
        execute($sql);
    }
?>