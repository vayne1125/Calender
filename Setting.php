<?php
session_start();   
include_once "db_conn.php";
$user_id = $_POST["user_id"];
?>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html" ; charset="utf-8">
    <meta http-equiv="Pragma" content="No-cache">
	<style>
	@import url(https://fonts.googleapis.com/css?family=Montserrat:400,700);
		html {
			font-family: 'Montserrat', Arial, sans-serif;
			-ms-text-size-adjust: 100%;
			-webkit-text-size-adjust: 100%;
		}
		body {
			background-image: linear-gradient(to top, 	#9FB5C3, #D6DDD9);
		}
		.buttonM, .buttonB{
			overflow: visible;
			text-transform: none;
			color: #5A5A5A;
			font: inherit;
			margin: 0;
		}
		input {
			line-height: normal;
		}
		#container {
			border: double 5px 	#336666;
			max-width: 800px;
			max-length: 600px;
			margin: 8% auto;
			position: relative;
		}

		form {
			padding: 37.5px;
			margin: 50px 0;
		}
		h1 {
			color: #474544;
			font-size: 32px;
			font-weight: 700;
			letter-spacing: 7px;
			text-align: center;
			text-transform: uppercase;
		}
		.underline {
			border-bottom: solid 2px #474544;
			margin: -0.512em auto;
			width: 80px;
		}
		.oldPwd, .newPwd{
			font-family:'Montserrat';
			background: none;
			border: none;
			border-bottom: solid 2px #474544;
			color: #474544;
			font-size: 1.000em;
			font-weight: 400;
			letter-spacing: 1px;
			margin: 0em 0 1.875em 0;
			padding: 0 0 0.875em 0;
			text-transform: uppercase;
			width: 100%;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			-ms-box-sizing: border-box;
			-o-box-sizing: border-box;
			box-sizing: border-box;
			-webkit-transition: all 0.3s;
			-moz-transition: all 0.3s;
			-ms-transition: all 0.3s;
			-o-transition: all 0.3s;
			transition: all 0.3s;
		}
		.oldPwd:focus, .newPwd:focus{
			outline: none;
			padding: 0 0 0.875em 0;
		}
		::-webkit-input-placeholder {
			color: #474544;
		}

		:-moz-placeholder { 
			color: #474544;
			opacity: 1;
		}

		::-moz-placeholder {
			color: #474544;
			opacity: 1;
		}

		:-ms-input-placeholder {
			color: #474544;
		}
		.buttonM {
			margin-left: 450px;
			background: none;
			border: groove 3px #95CACA;
			color: #474544;
			cursor: pointer;
			display: inline-block;
			font-family: 'Montserrat';
			font-size: 1em;
			font-weight: bold;
			outline: none;
			padding: 20px 35px;
			text-transform: uppercase;
			-webkit-transition: all 0.3s;
			-moz-transition: all 0.3s;
			-ms-transition: all 0.3s;
			-o-transition: all 0.3s;
			transition: all 0.3s;
		}
		.buttonB {
			margin-left: 20px;
			background: none;
			border: groove 3px #95CACA;
			color: #474544;
			cursor: pointer;
			display: inline-block;
			font-family: 'Montserrat';
			font-size: 1em;
			font-weight: bold;
			outline: none;
			padding: 20px 35px;
			text-transform: uppercase;
			-webkit-transition: all 0.3s;
			-moz-transition: all 0.3s;
			-ms-transition: all 0.3s;
			-o-transition: all 0.3s;
			transition: all 0.3s;
		}
		.buttonM:hover, .buttonB:hover {
			border-width:3px 8px 8px 3px;
			font-size: 1.5em;
			background: #6FB7B7;
			color: #F2F3EB;
		}
	</style>
</head>

<body>
	<div id="container">
		<h1>&bull; 修改密碼 &bull;</h1>
		<div class="underline">
		</div>
		<form action="setting.php" method="post" >	
			<input type="hidden" name="user_id" value="<?=$user_id?>">
			<input type="text" class="oldPwd" placeholder="舊的密碼" name="oldPassword"><br>
			<input type="password" class="newPwd" placeholder="新的密碼" name="newPassword"><br>
			<input type="submit" class="buttonM" value="修改">
			<input type="submit" class="buttonB" value="返回" formaction="./view.php">
		</form>
	</div>
    <div id = "msg"></div>

    <?php
    if (isset($_POST["newPassword"])) {

        $oldPassword = $_POST["oldPassword"];
        
        $sql = "select password
                from user
                where user.user_id = (?)";

        $stmt = $db->prepare($sql);
        $stmt->execute(array($user_id));
        $result = $stmt->fetchAll();
        
        if ($oldPassword != $result[0]['password']) {
            echo "<script type='text/javascript'>
                  document.getElementById('msg').innerHTML = '舊密碼輸入錯誤!';  
                  </script>";
        } else if(strlen($password) > 20 || strlen($password) == 0){
            echo "<script type='text/javascript'>
            document.getElementById('msg').innerHTML = '帳號、密碼應為20字元以內且不得為空!';  
            </script>";      
        }else{
            $newPassword = $_POST["newPassword"];

            $sql = "update user 
                    set password = (?)
                    where user.user_id = (?)";   //找帳號對應到的密碼值
            $stmt = $db->prepare($sql);
            $stmt->execute(array($newPassword,$user_id));
                      
                try {             
                    //修改成功就跳回到index.php且刪除session
                    unset($_SESSION['user_id']); 
                    //session_destroy();
                    
                    echo "<script type='text/javascript'>
                    alert('修改成功!');
                    window.location.href = './index.php';   
                    </script>";        
                } catch (PDOException $e) {
                    //print $e;
                    echo "<script type='text/javascript'>alert('無法預知的錯誤，請重試');</script>";
                }        
        }
    }
    ?>
</body>
<html>