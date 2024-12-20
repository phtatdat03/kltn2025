<?php
    session_start();
    require_once($baseUrl.'../utils/utility.php');
    require_once($baseUrl.'../database/dbhelper.php');

    $user = getUserToken();
    if($user==null){
        header('Location: '.$baseUrl.'authen/login.php');
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="<?=$baseUrl?>../assets/css/dashboard.css">
    <title><?=$title?></title>

    
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <i class="fas me-2"></i> ADMINISTRATION
            </div>

            <div class="list-group list-group-flush my-3">
                <a href="<?=$baseUrl?>" class="list-group-item list-group-item-action bg-transparent second-text active">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a href="<?=$baseUrl?>category" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-project-diagram me-2"></i> Danh mục sản phẩm
                </a>
                <a href="<?=$baseUrl?>product" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-gift me-2"></i> Sản phẩm
                </a>
                <a href="<?=$baseUrl?>order" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-shopping-cart me-2"></i> Quản lý đơn hàng
                </a>
                <a href="<?=$baseUrl?>user" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-user me-2"></i> Quản lý người dùng
                </a>
                <a href="<?=$baseUrl?>feedback" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-comment-dots me-2"></i> Quản lý phản hồi
                </a>
            </div>
        </div>
        <!-- Sidebar -->

