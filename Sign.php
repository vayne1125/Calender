<?php
include_once "db_conn.php";
?>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html" ; charset="utf-8">
    <meta http-equiv="Pragma" content="No-cache">
	<style>
		@import url(https://fonts.googleapis.com/earlyaccess/cwtexyen.css);
        *{
				font-family:'cwTeXYen', Comic Sans MS;  
			}
		body{
				background-image: linear-gradient(to bottom right, 	#9FB5C3, #D6DDD9);    
				background-size: cover;
				text-align: center;
			}
		.container{
                padding: 10px;
                width: 460px;
                height: 400px;
                background-color: #E0DFD8;
                border-radius: 70px;
                border-top: 15px groove #D8D6CA;
                border-bottom: 10px ridge #D8D6CA;
                box-shadow: 0 0px 70px rgba(0, 0, 0, 0.2);
                position:relative;   
                margin: auto;
                top: 150px;
                text-align:center;
            }
		.title{
                color:#A1BAD0;
				font-size:38px;
                margin: 15px;
                text-align:center;
				text-shadow: -1px -1px 0 #FFFFF4,
							1px -1px 0 	#FFFFF4,
							-1px 1px 0	#FFFFF4,
							1px 1px 0 	#FFFFF4;
            }	
		.sbt{
                display: inline-block;
				color: #F3F3FA;
				font-size:16px;
			  
				width: 75px;
				height: 30px;
			  
				padding: 0 20px;
				background-image: linear-gradient(to bottom,  #6D7B86, #BFCDD4);
				border-radius: 5px;
				
				outline: none;
				border: 2px solid #EBD6D6;
			  
				cursor: pointer;
				text-align: center;
				transition: all 0.2s linear;
				
				margin: 3% auto;
				letter-spacing: 0.05em;
            }	
		.act, .pwd{
				display: inline-block;
				color: 	#5555FF;
				font-size:24px;
			  
				width: 200px;
				height: 30px;
			  
				padding: 0 20px;
				border-radius: 5px;
				
				outline: none;
				border: 2px solid #EBD6D6;
			  
				cursor: pointer;
				text-align: center;
				transition: all 0.2s linear;
				
				margin: 3% auto;
				letter-spacing: 0.05em;
		}
		#act, #pwd{
				color: #7373B9;
				font-size:24px;
				text-shadow: -1px -1px 0 #FFFFBB,
							1px -1px 0 	#FFFFBB,
							-1px 1px 0	#FFFFBB,
							1px 1px 0 	#FFFFBB;
		}
	</style>
</head>

<body>
	<div class="container">
		<h2 class="title">註冊 Register</h2>
		<form action="Sign.php" method="post">
			<p id="act">帳號:<input class="act" type="text" name="account"></p>
			<p id="pwd">密碼:<input class="pwd" type="password" name="password"></p>
			<input class="sbt" type="submit" value="sign">
		</form>

    <?php
    if (isset($_POST["account"])) {
        $account = $_POST["account"];
        $password = $_POST["password"];

        //帳號密碼字元應小於20 且 大於0
        if (strlen($account) > 20 || strlen($password) > 20 || strlen($account) == 0 || strlen($password) == 0) {
            print "帳號、密碼應為20字元以內且不得為空!";
            return 0;
        }

        $sql = "select *
                from user
                where user.account in (?)";   //帳號是否存在
        $stmt = $db->prepare($sql);
        $stmt->execute(array($account));
        $result = $stmt->fetchAll();

        if ($result == true) {
            print "帳號已存在! 請重新輸入!";
        } else if ($result == false) {          
            try {
                $sql = "select count(*) as cnt
                        from user";
                $stmt = $db -> prepare($sql);
                $stmt -> execute();
                $result = $stmt->fetchAll();

                $sql = ("insert into user values(?,?,?)");
                $stmt = $db->prepare($sql);
                $stmt->execute(array($account, $password, $result[0]['cnt']));
                //成功創建帳號就跳回index.php
                echo "<script type='text/javascript'>
                alert('建立成功!');
                window.location.href = './index.php';   
                </script>";
                //header("Location:index.php");          
            } catch (PDOException $e) {
                //print $e;
                echo "<script type='text/javascript'>alert('無法預知的錯誤，請重試');</script>";
            }
        }
    }
    ?>
	</div>
</body>
<html>