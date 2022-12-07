<?php
    include_once "Db_conn.php";
    $user_id = $_POST["user_id"];
?>
<html>

<script>
    function changeStatus(id){
        var myId = "myForm" + id.toString(10);
        document.getElementById(myId).action = "ChangeStatus.php";       
        document.getElementById(myId).submit();
    }
    function chooseDate(){
        document.getElementById("dateForm").submit();
    }
    function del(id){
        var myId = "myForm" + id.toString(10);
        document.getElementById(myId).action = "Delete.php";       
        document.getElementById(myId).submit();
    }
    function edit(id){
        var myId = "myForm" + id.toString(10);
        document.getElementById(myId).action = "Edit.php";       
        document.getElementById(myId).submit();
    }
    function addEvent(id){
        var myId = "myForm" + id.toString(10);
        document.getElementById(myId).action = "AddEvent.php";       
        document.getElementById(myId).submit();
    }

</script>

<head>
    <meta http-equiv="Content-type" content="text/html" ; charset="utf-8">
    <meta http-equiv="Pragma" content="No-cache">
</head>

<body>
    <form action="View.php" id = "dateForm" method="post">
        <input type="hidden" name="user_id" value="<?=$user_id?>">
        <input type="date" name="date" id="date" onchange='chooseDate()' value="<?=$_POST["date"]?>">
    </form>
    <?php
    //如果有新的日期就更新日期 沒有的話顯示原本的
    if (isset($_POST["date"])) {
        $date = $_POST["date"];           
        //echo "<h2>" . $date . "</h2>"; 這一行可以顯示日期
        echo "<table border='1'>
        <tr>
        <th></th>
        <th>活動</th>
        <th>時間</th>
        <th>是否完成</th>
        <th></th>
        </tr>";

        $sql = ("select item,start_time,status,event.event_id 
                from event,total
                where event.event_id = total.event_id and total.user_id = ? and total.date = ?
                ");
        $stmt = $db->prepare($sql);
        $stmt->execute(array($user_id, $date));
        $result = $stmt->fetchAll();
        //將表格打印出來
        for ($i = 0; $i < count($result); $i++) {
            //建立一個表單
            echo "<form id = 'myForm".$i."' action='' method='post'>";
            //作為傳參用，不顯示在畫面上
            echo "<input type='hidden' name = 'date' value='" . $date . "'>";
            echo "<input type='hidden' name = 'user_id' value='" . $user_id . "'>";
            echo "<input type='hidden' name = 'item' value='" . $result[$i]['item'] . "'>";
            echo "<input type='hidden' name = 'status' value='" . $result[$i]['status'] . "'>";
            echo "<input type='hidden' name = 'start_time' value='" . $result[$i]['start_time'] . "'>";
            echo "<input type='hidden' name = 'event_id' value='" . $result[$i]['event_id'] . "'>";
            //一列 刪除和編輯會跳到對應的php
            echo "<tr>";
            echo "<td><div onclick='del(this.id)' id = '".$i."'>刪除</div></td>";
            echo "<td>" . $result[$i]['item'] . "</td>";
            echo "<td>" . $result[$i]['start_time'] . "</td>";
            //判斷當前狀態，是否完成，是的話就打勾
            if($result[$i]['status'] == true){
                echo "<td><input type='checkbox' name='status' id ='".$i."'checked onclick='changeStatus(this.id)'></td>";
            } else {
                echo "<td><input type='checkbox' name='status' id ='".$i."' onclick='changeStatus(this.id)'></td>";
            }
            //echo "<td>" . $result[$i]['status'] . "</td>";
            echo "<td><div onclick='edit(this.id)' id = '".$i."'>編輯</div></td>";
            echo "</form></tr>";
        }
        echo "</table>";
    }
    ?>
</body>
<html>