<?php
    include_once "db_conn.php";

    $user_id = $_POST["user_id"];
    $date = $_POST["date"];
    $viewType = $_POST["viewType"];

    $event_id = $_POST["event_id"];
    $start_time = $_POST["start_time"];
    $item = $_POST["item"];
    $type = $_POST["type"]; 

    try {
        $sql = "update event set item = ? where event_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($item,$event_id));

        $sql = "update event set start_time = ? where event_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($start_time,$event_id));

        $sql = "update event set type = ? where event_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($type,$event_id));

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