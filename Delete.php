<?php
    include_once "db_conn.php";

    $user_id = $_POST["user_id"];
    $event_id = $_POST["event_id"];
    $date = $_POST["date"];
    $sql = "delete from event
            where event.event_id = ?";
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute(array($event_id));
        echo "<form id = 'myForm' action = 'View.php' method = 'post'>";
        echo "<input type='hidden' name = 'user_id' value='" . $user_id . "'>";
        echo "<input type='hidden' name = 'date' value='" . $date . "'>";
        echo "</form>";
        echo "<script type='text/javascript'> document.getElementById('myForm').submit(); </script>"; 
    }catch(PDOException $e){
        print $e;

    }

?>