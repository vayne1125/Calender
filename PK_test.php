<?php
include_once "db_conn.php";
?>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html" ; charset="utf-8">
    <meta http-equiv="Pragma" content="No-cache">
</head>

<body>
    <form action="PK_test.php" method="post">
        pk:<input type="text" name="pk"><br>
        <input type="submit" value="add">
        <input type="submit" value="返回" formaction="./Login.php">
    </form>

    <?php
    if (isset($_POST["pk"])) {
        $pk = $_POST["pk"];

            try {
                $sql = ("insert into pk_table values(?)");
                $stmt = $db->prepare($sql);
                $stmt->execute(array($pk));        
            } catch (PDOException $e) {
                //print $e;
                echo "<script type='text/javascript'>alert('pk重複!');</script>";
            }
    }
    ?>
</body>
<html>