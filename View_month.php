<?php
include_once "db_conn.php";
session_start();

if(isset($_POST["user_id"]))$user_id = $_POST["user_id"];
else header("Location:login.php"); 

if (isset($_POST['year'])) {
    $year = $_POST['year'];
    $month = $_POST['month'];
} else {
    $year = date('Y');
    $month = date('n');
}
$week = ["Sun","Mon","Tues","Wed","Thur","Fri","Sat"];
$firstday = date("Y-m-01", mktime(0, 0, 0, $month, 1, $year)); //取得該日期月份的第一天
$lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day")); //取得該日期月份的最後一天
$day = array($firstday, $lastday);
$dayCount = date("t", strtotime($day[0]));
$weekday = date('w', strtotime($day[0]));
$d_first = date("j", strtotime($day[0]));
$d_last = date("j", strtotime($day[1]));
$d_last = intval($dayCount) + intval($weekday) - 1;
/*
echo '<div>' . $year . '</div></br>';
echo '<div>' . $month . '</div></br>';
echo '<div>' . $day[0] . '</div></br>';
echo '<div>' . $day[1] . '</div>';
echo '<br/>';
echo '這個月有幾 ' . $dayCount = date("t", strtotime($day[0])) . ' 天'; //t:該月有的天數
echo '<br/>';
echo '這個月的第一天是禮拜 ' . $weekday = date('w', strtotime($day[0])); //w:這天禮拜幾
echo '<br/>';
echo '這個月的最後一天是禮拜 ' . date('w', strtotime($day[1]));
echo '<br/>';
echo $d_first = date("j", strtotime($day[0])) . ' - ' . $d_last = date("j", strtotime($day[1])); //月分中的第幾天
echo '<br/>';
echo 'last:' . $d_last;
*/
?>
<script>
    //選日期
    function chooseYM() {
        for (var i = 0; i < 4; i++) {
            if (document.getElementById("yearSel").options[i].selected) {
                document.getElementById("chooseY").value = document.getElementById("yearSel").options[i].value;
                break;
            }
        }
        for (var i = 0; i < 12; i++) {
            if (document.getElementById("monthSel").options[i].selected) {
                document.getElementById("chooseM").value = document.getElementById("monthSel").options[i].value;
                break;
            }
        }
        document.getElementById("chooseYMForm").submit();
    }
</script>

<head>
    <meta http-equiv="Content-type" content="text/html" ; charset="utf-8">
    <meta http-equiv="Pragma" content="No-cache">
</head>

<body>
    <div>
        <!--年份月份選擇器-->
        <select id="yearSel">
            <?php
            for ($i = 2022; $i <= 2025; $i++) {
                if ($i == $year)
                    echo "<option selected value='" . $i . "'>" . $i . "</option>";
                else
                    echo "<option value='" . $i . "'>" . $i . "</option>";
            }
            ?>
        </select>
        <select id="monthSel">
            <?php
            for ($i = 1; $i <= 12; $i++) {
                if ($i == $month) {
                    if($i < 10) echo "<option selected value='0" . $i . "'>0" . $i . "</option>";
                    else echo "<option selected value='" . $i . "'>" . $i . "</option>";
                } else {
                    if($i < 10) echo "<option value='0" . $i . "'>0" . $i . "</option>";
                    else echo "<option value='" . $i . "'>" . $i . "</option>";
                }
            }
            ?>
        </select>
        <input type="button" value="GO" id="chooseYMBtn" onclick="chooseYM()">
        <!-- 切換月份 -->
        <form id="chooseYMForm" method="post" action="./View_month.php">
            <input type="hidden" name="user_id" value="<?= $user_id ?>">
            <input type="hidden" name="year" id="chooseY">
            <input type="hidden" name="month" id="chooseM">
        </form>
    </div>
    <table>
        <?php
        echo "<div><table>";
        echo "<tr>";
        for ($i = 0; $i < 7; $i++) {
            echo '<th style="background-color:#dddddd;width:100px;height:40px; border:#ffffff 1px solid;">'.$week[$i].'</th>';
        }
        echo "</tr>";
        $i = 1;
        for ($x = 0; $x <= 41; $x++) { //顯示42格
            if ($x % 7 == 0)
                echo "<tr>";
            if ($x + 1 > $weekday && $x <= $d_last) { //有日期
                echo '<td style="position: relative; background-color: #f0f0f0; width:100px;height:100px; border:#ffffff 1px solid;">';
                echo '<div style="position: absolute; bottom:20%; right:0px; background-color: #aaaaaa; width:100% ;height:60%">';
                echo '<div id="'.$i.'_0"></div>';
                echo '<div id="'.$i.'_1"></div>';
                echo '<div id="'.$i.'_2"></div>';
                echo '</div>';
                echo '<div style="position: absolute; bottom:0px; right:0px; background-color: #aaaaaa;">' . $i . '</div>';
                echo '</td>';
            } else {
                echo '<td style="background-color:#ffffff;width:100px;height:100px;border:#ffffff 1px solid;"></td>';
            }
            if ($x % 7 == 6)
                echo '</tr>';
            $i = ($x + 1 > $weekday ? $i + 1 : 1);
        }
        echo "</table></div>";
        ?>
</body>
<html>