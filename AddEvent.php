<?php
    include_once "db_conn.php";

    list($msec, $sec) = explode(' ',microtime());
    $event_id = (float) sprintf('%.0f',(floatval($msec) + floatval($sec)) * 1000);

    $user_id = $_POST["user_id"];
    $date = $_POST["date"];
    $viewType = $_POST["viewType"];

    $start_time = $_POST["start_time"];
    $item = $_POST["item"];
    $type = $_POST['type'];
    //$type = "";
    try {
        $sql = "insert into event values(?,?,?,0,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($event_id,$item,$start_time,$type));

        $sql = "insert into total values(?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($event_id,$date,$user_id));

        echo "<form id = 'myForm' action = 'View.php' method = 'post'>";
        echo "<input type='hidden' name = 'user_id' value='" . $user_id . "'>";
        echo "<input type='hidden' name = 'date' value='" . $date . "'>";
        echo "<input type='hidden' name = 'viewType' value='" . $viewType . "'>";
        echo "</form>";
        echo "<script type='text/javascript'> document.getElementById('myForm').submit(); </script>"; 
    }catch(PDOException $e){
        print $e;
    }

?>