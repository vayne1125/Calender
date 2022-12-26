<?php
session_start();   
include_once "db_conn.php";
$user_id = $_POST["user_id"];
$date = $_POST["date"];
?>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html" ; charset="utf-8">
    <meta http-equiv="Pragma" content="No-cache">
</head>

<body>
    <form action="setting.php" method="post">
        
        <input type="hidden" name="user_id" value="<?=$user_id?>">
        <input type="hidden" name="date" value="<?=$date?>">
        舊的密碼:<input type="text" name="oldPassword"><br>
        新的密碼:<input type="password" name="newPassword"><br>
        <input type="submit" value="修改">
        <input type="submit" value="返回" formaction="./view.php">
    </form>
    <div id = "msg"></div>

    <?php
    if (isset($_POST["newPassword"])) {

        $oldPassword = $_POST["oldPassword"];
        
        $sql = "select password
                from user
                where user.user_id = (?)";

        $stmt = $db->prepare($sql);
        $stmt->execute(array($user_id));
        $result = $stmt->fetchAll();
        
        if ($oldPassword != $result[0]['password']) {
            echo "<script type='text/javascript'>
                  document.getElementById('msg').innerHTML = '舊密碼輸入錯誤!';  
                  </script>";
        } else if(strlen($password) > 20 || strlen($password) == 0){
            echo "<script type='text/javascript'>
            document.getElementById('msg').innerHTML = '帳號、密碼應為20字元以內且不得為空!';  
            </script>";      
        }else{
            $newPassword = $_POST["newPassword"];

            $sql = "update user 
                    set password = (?)
                    where user.user_id = (?)";   //找帳號對應到的密碼值
            $stmt = $db->prepare($sql);
            $stmt->execute(array($newPassword,$user_id));
                      
                try {             
                    //修改成功就跳回到index.php且刪除session
                    unset($_SESSION['user_id']); 
                    //session_destroy();
                    
                    echo "<script type='text/javascript'>
                    alert('修改成功!');
                    window.location.href = './index.php';   
                    </script>";        
                } catch (PDOException $e) {
                    //print $e;
                    echo "<script type='text/javascript'>alert('無法預知的錯誤，請重試');</script>";
                }        
        }
    }
    ?>
</body>
<html>