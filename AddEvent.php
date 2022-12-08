<?php
    include_once "db_conn.php";

    list($msec, $sec) = explode(' ',microtime());
    $event_id = (float) sprintf('%.0f',(floatval($msec) + floatval($sec)) * 1000);

    $user_id = $_POST["user_id"];
    $date = $_POST["date"];
    $start_time = $_POST["start_time"];
    $item = $_POST["item"];

    try {
        $sql = "insert into event values(?,?,?,0)";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($event_id,$item,$start_time));

        $sql = "insert into total values(?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($event_id,$date,$user_id));

        echo "<form id = 'myForm' action = 'View.php' method = 'post'>";
        echo "<input type='hidden' name = 'user_id' value='" . $user_id . "'>";
        echo "<input type='hidden' name = 'date' value='" . $date . "'>";
        echo "</form>";
        echo "<script type='text/javascript'> document.getElementById('myForm').submit(); </script>"; 
    }catch(PDOException $e){
        print $e;
    }

?>