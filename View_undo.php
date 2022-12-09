<?php
    include_once "Db_conn.php";
    $user_id = $_POST["user_id"];
?>
<html>

<script>
    //選日期
    function chooseDate(){
        document.getElementById("dateForm").submit();
    }
    //切換顯示畫面
    function changeView(){
        document.getElementById("undoForm").submit();
    }
</script>

<head>
    <meta http-equiv="Content-type" content="text/html" ; charset="utf-8">
    <meta http-equiv="Pragma" content="No-cache">
</head>

<body>
    <!-- 日期 -->    
    <form action="View_undo.php" id = "dateForm" method="post">
        <input type="hidden" name="user_id" value="<?=$user_id?>">
        <input type="date" name="date" id="date" onchange='chooseDate()' value="<?=$_POST["date"]?>">
    </form>

    <!-- 未完成事項 -->
    <form action = "View.php" id = "undoForm" method = "post">
        <input type="hidden" name="user_id" value="<?=$user_id?>">
        <input type="hidden" name="date" value="<?=$_POST["date"]?>">
        <input type='checkbox' checked onclick='changeView()'>未完成事項   
    </form>

    <?php
    //更新日期
    if (isset($_POST["date"])) {
        $date = $_POST["date"];           
        //echo "<h2>" . $date . "</h2>"; 這一行可以顯示日期

        $sql = ("select count(*) as cnt
                from event,total
                where event.event_id = total.event_id and total.user_id = ? and total.date = ? and status = ?
                ");
        $stmt = $db->prepare($sql);
        $stmt->execute(array($user_id, $date, 0));
        $result = $stmt->fetchAll();

        echo "這天還有".$result[0]['cnt']."件事沒做";

        $sql = ("select item,start_time,status,event.event_id
                from event,total
                where event.event_id = total.event_id and total.user_id = ? and total.date = ? and status = ?
                order by start_time 
                ");
        $stmt = $db->prepare($sql);
        $stmt->execute(array($user_id, $date, 0));
        $result = $stmt->fetchAll();
        //將表格打印出來
        echo "<table border='1'>
        <tr>
        <th>活動</th>
        <th>時間</th>
        </tr>";
        for ($i = 0; $i < count($result); $i++) {
            echo "<tr>";
            echo "<td>" . $result[$i]['item'] . "</td>";
            echo "<td>" . $result[$i]['start_time'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
</body>
<html>