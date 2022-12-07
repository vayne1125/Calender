<?php
include_once "db_conn.php";
?>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html" ; charset="utf-8">
    <meta http-equiv="Pragma" content="No-cache">
</head>

<body>
    <form action="Sign.php" method="post">
        帳號:<input type="text" name="account"><br>
        密碼:<input type="password" name="password"><br>
        <input type="submit" value="sign">
    </form>

    <?php
    if (isset($_POST["account"])) {
        $account = $_POST["account"];
        $password = $_POST["password"];

        //帳號密碼字元應小於20 且 大於0
        if (strlen($account) > 20 || strlen($password) > 20 || strlen($account) == 0 || strlen($password) == 0) {
            print "帳號、密碼應為20字元以內且不得為空!";
            return 0;
        }

        $sql = "select *
                from user
                where user.account in (?)";   //帳號是否存在
        $stmt = $db->prepare($sql);
        $stmt->execute(array($account));
        $result = $stmt->fetchAll();

        if ($result == true) {
            print "帳號已存在! 請重新輸入!";
        } else if ($result == false) {          
            try {
                $sql = "select count(*) as cnt
                        from user";
                $stmt = $db -> prepare($sql);
                $stmt -> execute();
                $result = $stmt->fetchAll();

                $sql = ("insert into user values(?,?,?)");
                $stmt = $db->prepare($sql);
                $stmt->execute(array($account, $password, $result[0]['cnt']));
                //成功創建帳號就跳回index.php
                echo "<script type='text/javascript'>
                alert('建立成功!');
                window.location.href = './index.php';   
                </script>";
                //header("Location:index.php");          
            } catch (PDOException $e) {
                //print $e;
                echo "<script type='text/javascript'>alert('無法預知的錯誤，請重試');</script>";
            }
        }
    }
    ?>
</body>
<html>