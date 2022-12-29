<?php
    include_once "Db_conn.php";
    if(isset($_POST["user_id"])) $user_id = $_POST["user_id"];
    else header("Location:login.php"); 
    $date = isset($_POST["date"]) ? $_POST["date"] : date("Y-m-d");
    $viewType = isset($_POST["viewType"]) ? $_POST["viewType"] : "all";
?>
<html>

<script>
    //設定資料
    function Pk_test(){
        document.getElementById("otherForm").action = './PK_test.php';
        document.getElementById("otherForm").submit();
    }
    //跳到月曆
    // function toHome(){
    //     document.getElementById("otherForm").action = './View_month.php';
    //     document.getElementById("otherForm").submit();
    // }
    //設定個人資料
    function setPersonalData(){     
        document.getElementById("otherForm").action = './Setting.php';
        document.getElementById("otherForm").submit();
    }
    //選日期
    function chooseDate(){
        document.getElementById("dateForm").submit();
    }
    //切換顯示畫面
    function changeView(type){
        if(type === "do"){
            document.getElementById("changeViewForm").action = "./View.php";           
        }else if(type === "work"){
            document.getElementById("viewType").value = "work";
            document.getElementById("changeViewForm").action = "./View_undo.php";           
        }else if(type === "fun"){
            document.getElementById("viewType").value = "fun";
            document.getElementById("changeViewForm").action = "./View_undo.php";           
        }else if(type === "all"){
            document.getElementById("viewType").value = "all";
            document.getElementById("changeViewForm").action = "./View_undo.php";           
        }
        document.getElementById("changeViewForm").submit();
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
                <a class="nav-link active"></a>
                </li>

                <li class="nav-item">
                <a class="nav-link active" aria-current="page">Home</a>
                </li>

                <!-- <li class="nav-item">
                <a class="nav-link active">Daily</a>
                </li> -->

                </li>
                <li class="nav-item">
                <a class="nav-link" onclick='setPersonalData()'>Setting</a>
                </li>

                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    More
                </a>
                <ul class="dropdown-menu">
                    <!-- <li><a class="dropdown-item">Daily</a></li> -->
                    <li><a class="dropdown-item" onclick='Pk_test()'>PK-test</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="./Logout.php">Logout</a></li>
                </ul>
                </li>
                
                <li class="nav-item">
                <a class="nav-link disabled">comming soon</a>
                </li>

            </ul>
            <!--
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            -->
            </div>
        </div>
    </nav>
    <!-- 日期 -->    
    <form action="View_undo.php" id = "dateForm" method="post">
        <input type="hidden" name="user_id" value="<?=$user_id?>">
        <input type="date" name="date" id="date" onchange='chooseDate()' value="<?=$_POST["date"]?>">
    </form>

    <!-- 未完成事項 -->
    <!-- 工作 -->
    <!-- 娛樂 -->
    <form action = "View_undo.php" id = "changeViewForm" method = "post">
        <input type="hidden" name="user_id" value="<?=$user_id?>">
        <input type="hidden" name="date" value="<?=$date?>">
        <input type="hidden" name="viewType" id = "viewType" value="<?=$viewType?>">
        <input type='checkbox' checked onclick='changeView("do")'>未完成事項</br>   
        <?php
        if ($viewType == "work")
            echo "<input type='checkbox' checked onclick='changeView(\"all\")'>只顯示工作</br>";
        else
            echo "<input type='checkbox' onclick='changeView(\"work\")'>只顯示工作</br>";

        if ($viewType == "fun")
            echo "<input type='checkbox' checked onclick='changeView(\"all\")'>只顯示娛樂";
        else
            echo "<input type='checkbox' onclick='changeView(\"fun\")'>只顯示娛樂";
        ?>    
    </form>

    <!-- 設定跳轉 -->
    <form action = "setting.php" id = "otherForm" method = "post">
        <input type="hidden" name="user_id" value="<?=$user_id?>">
    </form>

    <?php
    //更新日期
    if (isset($_POST["date"])) {
        $date = $_POST["date"];           
        //echo "<h2>" . $date . "</h2>"; 這一行可以顯示日期

        $sql = ("select count(*) as cnt
                from undoitemView
                where user_id = ? and date = ?;
                ");
        $stmt = $db->prepare($sql);
        $stmt->execute(array($user_id, $date));
        $result = $stmt->fetchAll();

        echo "
        <div style='text-align:center;'>
        這天還有".$result[0]['cnt']."件事沒做</div>
        ";


        if($viewType == "all"){
            $sql = ("select item,start_time,type
            from undoitemView
            where user_id = ? and date = ?
            order by start_time
            ");
        }else if($viewType == "work"){
            $sql = ("select item,start_time,status,event_id,type
            from workView
            where user_id = ? and date = ? and status = 0
            order by start_time 
            ");            
        }else if($viewType == "fun"){
            $sql = ("select item,start_time,status,event_id,type
            from funView
            where user_id = ? and date = ? and status = 0
            order by start_time 
            "); 
        }
        $stmt = $db->prepare($sql);
        $stmt->execute(array($user_id, $date));
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
            echo "<li class='list-group-item'>" . substr($result[$i]['start_time'],0,5) . "</li>";
            echo "</ul>";
        }
        //echo "</table>";
        //echo "</div>";
    }
    ?>
</body>
<html>