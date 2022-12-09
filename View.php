<?php
    include_once "Db_conn.php";
    $user_id = $_POST["user_id"];
?>
<html>

<script>
    //更改狀態
    function changeStatus(id){
        var myId = "myForm" + id.toString(10);
        document.getElementById(myId).action = "ChangeStatus.php";       
        document.getElementById(myId).submit();
    }
    //選日期
    function chooseDate(){
        document.getElementById("dateForm").submit();
    }
    //刪除
    function del(id){
        var yes = confirm('確定要刪除嗎？');
        if (yes) {
            var myId = "myForm" + id.toString(10);
            document.getElementById(myId).action = "Delete.php";       
            document.getElementById(myId).submit();
        }
    }
    //顯示修改的modal
    function showModalEdit(id){
        //抓表格內參數
        var event_idId = "event_id" + id.toString(10);
        var event_idValue = document.getElementById(event_idId).value;

        var start_timeId = "start_time" + id.toString(10);
        var start_timeValue = document.getElementById(start_timeId).value;

        var itemId = "item" + id.toString(10);
        var itemValue = document.getElementById(itemId).value;
        //set到modal裡
        document.getElementById("itemEdit").value = itemValue;
        document.getElementById("start_timeEdit").value = start_timeValue;
        document.getElementById("event_idEdit").value = event_idValue;
        //顯示modal
        document.getElementById("infoModalEdit").showModal(); 
    }
    function addEvent(){      
        document.getElementById("addEventForm").submit();
    }
    function edit(){
        document.getElementById("editForm").submit();
    }
    function showModal(){
        document.getElementById("infoModal").showModal();   
    }
    function closeModal(){
        document.getElementById("infoModalEdit").close();
        document.getElementById("infoModal").close();
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
    <form action="View.php" id = "dateForm" method="post">
        <input type="hidden" name="user_id" value="<?=$user_id?>">
        <input type="date" name="date" id="date" onchange='chooseDate()' value="<?=$_POST["date"]?>">
    </form>

    <!-- 未完成事項 -->
    <form action = "View_undo.php" id = "undoForm" method = "post">
        <input type="hidden" name="user_id" value="<?=$user_id?>">
        <input type="hidden" name="date" value="<?=$_POST["date"]?>">
        <input type='checkbox' onclick='changeView()'>未完成事項   
    </form>

    <!-- 彈窗 add-->
    <button onclick="showModal()">add</button>
    <dialog id="infoModal">
        <form action="AddEvent.php" id = "addEventForm" method="post">
            <input type="hidden" name="user_id" value="<?=$user_id?>">
            <input type="hidden" name="date" value="<?=$_POST["date"]?>">
            活動: <input type="text" name="item">
            開始時間:<input type="text" name="start_time">
        </form>
        <button onclick="addEvent()">add</button>
        <button onclick="closeModal()">返回</button>
    </dialog>

    <!-- 彈窗 edit-->
    <dialog id="infoModalEdit">
        <form action="Edit.php" id = "editForm" method="post">
            <input type="hidden" name="user_id" value="<?=$user_id?>">
            <input type="hidden" name="date" value="<?=$_POST["date"]?>">
            <input type="hidden" name="event_id" id = "event_idEdit">
            活動: <input id = "itemEdit" type="text" name="item">
            開始時間:<input id = "start_timeEdit" type="text" name="start_time">
        </form>
        <button onclick="edit()">edit</button>
        <button onclick="closeModal()">返回</button>
    </dialog>
        
    <?php
    //更新日期
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
                order by start_time 
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
            echo "<input id = 'item".$i."' type='hidden' name = 'item' value='" . $result[$i]['item'] . "'>";
            echo "<input type='hidden' name = 'status' value='" . $result[$i]['status'] . "'>";
            echo "<input id = 'start_time".$i."' type='hidden' name = 'start_time' value='" . $result[$i]['start_time'] . "'>";
            echo "<input id = 'event_id".$i."' type='hidden' name = 'event_id' value='" . $result[$i]['event_id'] . "'>";
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
            echo "<td><div onclick='showModalEdit(this.id)' id = '".$i."'>編輯</div></td>";
            echo "</form></tr>";
        }
        echo "</table>";
    }
    ?>
</body>
<html>