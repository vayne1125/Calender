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
        li{
            text-align:center;
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

        echo "
        <div style='text-align:center;'>
        這天還有".$result[0]['cnt']."件事沒做</div>
        ";

        $sql = ("select item,start_time,status,event.event_id
                from event,total
                where event.event_id = total.event_id and total.user_id = ? and total.date = ? and status = ?
                order by start_time 
                ");
        $stmt = $db->prepare($sql);
        $stmt->execute(array($user_id, $date, 0));
        $result = $stmt->fetchAll();
        //將表格打印出來
        //echo "<div style='text-align:center;'";
        //echo "<table border='1'>
        echo "
        <ul class='list-group list-group-horizontal justify-content-center' >
        <li class='list-group-item' style='background-color:#D6EAF8'>活動</li>
        <li class='list-group-item' style='background-color:#D6EAF8'>時間</li>
        </ul>";
        for ($i = 0; $i < count($result); $i++) {
            echo "<ul class='list-group list-group-horizontal justify-content-center'>";
            echo "<li class='list-group-item'>" . $result[$i]['item'] . "</li>";
            echo "<li class='list-group-item'>" . $result[$i]['start_time'] . "</li>";
            echo "</ul>";
        }
        //echo "</table>";
        //echo "</div>";
    }
    ?>
</body>
<html>