<?php
    $data = $_POST;
    $errors = [];

    //Validate
    if(!is_string($data['name']) || strlen($data['name']) < 5 ||  strlen($data['name']) > 50){
        $errors ['name'] = $data['name']."Tên cầu thủ không hợp lệ"; 
    }
    if(!is_numeric($data['age']) || $data['age'] < 0 ||  $data['age'] > 150){
        $errors['age'] = "Tuổi không hợp lệ";
    }
    if(!is_string($data['national']) || strlen($data['national']) < 2 ||  strlen($data['national']) > 10){
        $errors ['national'] = "Tên quốc gia không hợp lệ"; 
    }
    if(!is_string($data['position']) || strlen($data['position']) < 2 ||  strlen($data['position']) > 10){
        $errors ['position'] = "Vị trí không hợp lệ"; 
    }
    if (!is_numeric($data['salary']) || $data['salary'] < 0 || $data['salary'] > 1000000) {
        $errors['salary'] = "Lương không hợp lệ!";
    }

    if(count($errors) > 0){
        $err_str = '<ul>';
        foreach($errors as $err){
            $err_str .= '<li>'.$err.'</li>';
        }
        $err_str .= '</ul>';
        echo $err_str;
    }
    else{
       if(isset($_GET['id'])){
            $conn = mysqli_connect('localhost','root','','demo');
            $id = $_GET['id'];
            $sql = "UPDATE `players` SET `name` = '".$data['name']."',
                                         `age` = '".$data['age']."',
                                          `national` = '".$data['national']."',
                                          `position` = '".$data['position']."',
                                          `salary` = '".$data['salary']."' 
                    WHERE id =  $id ";
            if($result = mysqli_query($conn,$sql)){
                echo "<h1>Chỉnh sửa thông tin cầu thủ thành công Click vào <a href='index.php'>đây</a> để về trang danh sách</h1>";
            }else{
                echo "<h1>Có lỗi xảy ra Click vào <a href='index.php'>đây</a> để về trang danh sách</h1>";
            }
       }
       else{
        $conn = mysqli_connect('localhost','root','','demo');

        $sql = "INSERT INTO `players` 
                (`name`, `age`, `national`, `position`, `salary`) 
                VALUES ('".$data['name']."', '".$data['age']."',
                '".$data['national']."', '".$data['position']."', '".$data['salary']."');";
    }
    if ($result = mysqli_query($conn,$sql)) {
        echo "<h1>Thêm mới cầu thủ thành công Click vào 
        <a href='index.php'>đây</a> để về trang danh sách</h1>";
    }else{
        echo "<h1>Có lỗi xảy ra Click vào 
        <a href='index.php'>đây</a> để về trang danh sách</h1>";
       }
       
    }
    if($conn){
        mysqli_close($conn);
    }
?>