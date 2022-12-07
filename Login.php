<?php
include_once "db_conn.php";
?>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html" ; charset="utf-8">
    <meta http-equiv="Pragma" content="No-cache">
</head>

<body>
    <form action="Login.php" method="post">
        帳號:<input type="text" name="account"><br>
        密碼:<input type="password" name="password"><br>
        <input type="submit" value="login">
    </form>

    <?php
    if (isset($_POST["account"])) {
        $account = $_POST["account"];
        $password = $_POST["password"];

        $sql = "select password,user_id
                from user
                where user.account = (?)";   //找帳號對應到的密碼值
        $stmt = $db->prepare($sql);
        $stmt->execute(array($account));
        $result = $stmt->fetchAll();
        if ($result[0]['password'] == $password){          
            try {                
                //登陸成功就跳到view.php(用post傳參數) 日期預設今天!
                echo "<form id = 'myForm' action = 'View.php' method = 'post'>";
                echo "<input type='hidden' name = 'user_id' value='" . $result[0]['user_id'] . "'>";
                echo "<input type='hidden' name = 'date' id = 'date'>";
                echo "</form>";
                echo "<script type='text/javascript'> 
                        let d = new Date();
                        let year = d.getFullYear();
                        let mon = d.getMonth() + 1;
                        let day = d.getDate();
                        if(day < 10) day = '0' + day;
                        if(mon < 10) mon = '0' + mon;
                        let rt = '';
                        rt = year + '-' + mon + '-' + day;
                        document.getElementById('date').value = rt; 
                        document.getElementById('myForm').submit(); 
                      </script>";              
                //header("Location:view.php?uid=".$result[0]['user_id']);          
            } catch (PDOException $e) {
                //print $e;
                echo "<script type='text/javascript'>alert('無法預知的錯誤，請重試');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('帳號或密碼錯誤');</script>";
        }
    }
    ?>
</body>
<html>