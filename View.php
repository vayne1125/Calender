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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        @import url(https://fonts.googleapis.com/earlyaccess/cwtexyen.css);
        *{
            font-family:'cwTeXYen', Comic Sans MS;  
        }
        body{
            background-image: linear-gradient(to bottom,  #9FB5C3, #ffff); 
        }
        nav{
            background-color: #bfccd4;
        }
        input[type="date"]{
            border-style:solid;
        }
        li{
            text-align:center;
            float:left;
            width: 150px;
            margin: 1px;
        }
        
        .colorBtn{
            background-image:linear-gradient(to bottom,  #9FB5C3, #ffff);
            border-radius: 12px;
            border: 2px solid #6d7b86; /* Green */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" >Calender</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>
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
    <button onclick="showModal()" class="colorBtn">add</button>
    <dialog id="infoModal" style="background-color:#d6ddd9">
        <form action="AddEvent.php" id = "addEventForm" method="post">
            <input type="hidden" name="user_id" value="<?=$user_id?>">
            <input type="hidden" name="date" value="<?=$_POST["date"]?>">
            活動: <input type="text" name="item">
            開始時間:<input type="text" name="start_time">
        </form>
        <button onclick="addEvent()" class="colorBtn">add</button>
        <button onclick="closeModal()" class="colorBtn">返回</button>
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
        <button onclick="edit()" class="colorBtn">edit</button>
        <button onclick="closeModal()" class="colorBtn">返回</button>
    </dialog>
        
    <?php
    //更新日期
    if (isset($_POST["date"])) {
        $date = $_POST["date"];           
        //echo "<h2>" . $date . "</h2>"; 這一行可以顯示日期
        echo "
            <ul class='list-group list-group-horizontal justify-content-center' >
                <li class='list-group-item' style='background-color:#D6EAF8'></li>
                <li class='list-group-item' style='background-color:#D6EAF8'>活動</li>
                <li class='list-group-item' style='background-color:#D6EAF8'>時間</li>
                <li class='list-group-item' style='background-color:#D6EAF8'>是否完成</li>
                <li class='list-group-item' style='background-color:#D6EAF8'></li>
            </ul>";
        echo "<table border='1'>";
    
    
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
            echo "<ul class='list-group list-group-horizontal justify-content-center' >";
            echo "<li class='list-group-item '><div onclick='del(this.id)' id = '".$i."' class='colorBtn'>刪除</div></li>";
            echo "<li class='list-group-item '>" . $result[$i]['item'] . "</li>";
            echo "<li class='list-group-item '>" . $result[$i]['start_time'] . "</li>";
            //判斷當前狀態，是否完成，是的話就打勾
            if($result[$i]['status'] == true){
                echo "<li class='list-group-item'><input type='checkbox' name='status' id ='".$i."'checked onclick='changeStatus(this.id)'></li>";
            } else {
                echo "<li class='list-group-item'><input type='checkbox' name='status' id ='".$i."' onclick='changeStatus(this.id)'></li>";
            }
            //echo "<li>" . $result[$i]['status'] . "</li>";
            echo "<li class='list-group-item'><div onclick='showModalEdit(this.id)' id = '".$i."' class='colorBtn'>編輯</div></li>";
            echo "</ul></form>";
            echo "</table";
        }
    }
    ?>
</body>
<html>