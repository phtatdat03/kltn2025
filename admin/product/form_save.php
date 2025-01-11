<?php
    if(!empty($_POST)) {
        $id = getPost("id");
        $title =  getPost("title");
        $price = getPost("price");
        $discount = getPost("discount");

        $picture = moveFile('picture');

        $description = getPost("description");
        $category = getPost("category_id");
        $created_at = $updated_at = date("Y-m-d H:i:s");                                                                                           

        if($id > 0) {
            //update
            if($picture != '') {
                $sql = "UPDATE product set picture='$picture',
                                        title='$title',
                                        price='$price',
                                        discount='$discount',
                                        description='$description',
                                        category_id='$category',
                                        updated_at='$updated_at'
                                        WHERE id='$id'
                                        ";
            } else {
                $sql = "UPDATE product set 
                                       title='$title',
                                       price='$price',
                                       discount='$discount',
                                       description='$description',
                                       category_id='$category',
                                       updated_at='$updated_at'
                                       WHERE id='$id'
                                       ";
            }
            execute($sql);
            header("location: index.php");
            die();
        } else {
            //insert
            $sql = "INSERT INTO product(category_id, picture, title, price, discount, description, updated_at, created_at, deleted)
            values ('$category','$picture', '$title', '$price', '$discount', '$description', '$updated_at', '$created_at', 0)";

            execute($sql);
            header("Location: index.php");
            die();
        }
    }
?>