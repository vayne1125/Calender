<?php
include_once "db_conn.php";
?>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html" ; charset="utf-8">
    <meta http-equiv="Pragma" content="No-cache">
	<style>
	@import url(https://fonts.googleapis.com/earlyaccess/cwtexyen.css);
	body {
		font-family: 'cwTeXYen',"Open Sans", sans-serif;
		background-image: linear-gradient(to bottom right, 	#9FB5C3, #D6DDD9); 
		-webkit-transition: 0.3s;
		-moz-transition: 0.3s;
		-ms-transition: 0.3s;
		-o-transition: 0.3s;
		transition: 0.3s;
	}
	.login {
		position: relative;
		background: #D6DDD9;
		display: block;
		width: 520px;
		height: 70px;
		margin: 10% auto;
		overflow: hidden;
		-webkit-transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
		-moz-transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
		-ms-transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
		-o-transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
		transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
		-webkit-border-radius: 4px;
		-moz-border-radius: 4px;
		-ms-border-radius: 4px;
		-o-border-radius: 4px;
		border-radius: 4px;
		-webkit-box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.2);
		-moz-box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.2);
		-ms-box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.2);
		-o-box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.2);
		box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.2);
		-webkit-transform: translateY(-50px);
		-moz-transform: translateY(-50px);
		-ms-transform: translateY(-50px);
		-o-transform: translateY(-50px);
		transform: translateY(-50px);
	}
	.form-group {
		position: relative;
		top: 90%;
		left: 8%;
		-webkit-transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
		-moz-transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
		-ms-transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
		-o-transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
		transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
		-webkit-transition-delay: 1s;
		transition-delay: 1s;
	}
	.account,.password {
		position: absolute;
		display: block;
		width: 80%;
		height: 50px;
		background: #fff;
		font-size: 10pt;
		text-transform: capitalize;
		padding-left: 20px;
		color: rgba(0, 0, 0, 0.1);
		-webkit-box-shadow: 1px 1px 20px rgba(0, 0, 0, 0.2);
		-moz-box-shadow: 1px 1px 20px rgba(0, 0, 0, 0.2);
		-ms-box-shadow: 1px 1px 20px rgba(0, 0, 0, 0.2);
		-o-box-shadow: 1px 1px 20px rgba(0, 0, 0, 0.2);
		box-shadow: 1px 1px 20px rgba(0, 0, 0, 0.2);
		border: none;
		-webkit-border-radius: 4px;
		-moz-border-radius: 4px;
		-ms-border-radius: 4px;
		-o-border-radius: 4px;
		border-radius: 4px;
		-webkit-transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
		-moz-transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
		-ms-transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
		-o-transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
		transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
	}
	.account:focus, .account:active:focus,.pwd:focus,.pwd:active:focus
	,.button:focus,.button:active:focus	{
		outline: none;
		padding-left: 30px;
	}

	.account {
		margin-bottom: 10%;
		z-index: 3;
		-webkit-transition: 0.5s;
		-moz-transition: 0.5s;
		-ms-transition: 0.5s;
		-o-transition: 0.5s;
		transition: 0.5s;
	}

	.password {
		margin-top: 10%;
		z-index: 2;

		-webkit-transition: 0.5s;
		-moz-transition: 0.5s;
		-ms-transition: 0.5s;
		-o-transition: 0.5s;
		transition: 0.5s;
	}
	
	.button {
		margin-top: 20%;
		z-index: 1;
		font-size: 16pt;
		text-align: center;
		margin-left:340px;
		border: 2px #BFCDD4 dashed;
		background:#8A9DA8;
		-webkit-transition: 0.5s;
		-moz-transition: 0.5s;
		-ms-transition: 0.5s;
		-o-transition: 0.5s;
		transition: 0.5s;
	}
	
	.btn {
		position: absolute;
		bottom: 0;
		width: 100%;
		height: 70px;
		border: groove;
		background-image: linear-gradient(to bottom,  #6D7B86, #BFCDD4); 
		font-family: "Open Sans", sans-serif;
		text-align: center;
		font-size: 18pt;
		text-transform: capitalize;
		color: #fff;
		z-index: 3;
		-webkit-border-radius: 4px;
		-moz-border-radius: 4px;
		-ms-border-radius: 4px;
		-o-border-radius: 4px;
		border-radius: 4px;
		-webkit-transition: 0.3s;
		-moz-transition: 0.3s;
		-ms-transition: 0.3s;
		-o-transition: 0.3s;
		transition: 0.3s;
	}
	.btn:hover, .btn:focus, .btn:active:focus {
		background-image: linear-gradient(to top, #6D7B86, #BFCDD4); 
		cursor: pointer;
		outline: none;
		letter-spacing: 5px;
	}
	</style>
</head>

<body>
    <form action="Login.php" class="login" method="post">
	<div class="form-group">
        <input type="text" class="account" name="account" placeholder="輸入您的帳號"><br>
        <input type="password" class="password" name="password" placeholder="輸入您的密碼"><br>
		<input type="submit" class="button" value="Enter">
    </div>
		<input type="button" class="btn" value="登入 Login">
    </form>
	
    <?php
    if (isset($_POST["account"])) {
        $account = $_POST["account"];
        $password = $_POST["password"];

        $sql = "select password,user_id
                from user
                where user.account = (?)";   //找帳號對應到的密碼值
        $stmt = $db->prepare($sql);
        $stmt->execute(array($account));
        $result = $stmt->fetchAll();
        if ($result[0]['password'] == $password){          
            try {                
                //登陸成功就跳到view.php(用post傳參數) 日期預設今天!
                echo "<form id = 'myForm' action = 'View.php' method = 'post'>";
                echo "<input type='hidden' name = 'user_id' value='" . $result[0]['user_id'] . "'>";
                echo "<input type='hidden' name = 'date' id = 'date'>";
                echo "</form>";
                echo "<script type='text/javascript'> 
                        let d = new Date();
                        let year = d.getFullYear();
                        let mon = d.getMonth() + 1;
                        let day = d.getDate();
                        if(day < 10) day = '0' + day;
                        if(mon < 10) mon = '0' + mon;
                        let rt = '';
                        rt = year + '-' + mon + '-' + day;
                        document.getElementById('date').value = rt; 
                        document.getElementById('myForm').submit(); 
                      </script>";              
                //header("Location:view.php?uid=".$result[0]['user_id']);          
            } catch (PDOException $e) {
                //print $e;
                echo "<script type='text/javascript'>alert('無法預知的錯誤，請重試');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('帳號或密碼錯誤');</script>";
        }
    }
    ?>
	<script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-2c7831bb44f98c1391d6a4ffda0e1fd302503391ca806e7fcc7b9b87197aec26.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script>
	$(document).ready(function () {
		$('form').find('.btn').on('click', function () {
			$(this).parent().css({'height': '350px','transform': 'translateY(50px)' });
			$(this).siblings('.form-group').css({'top': '20%' });
		});
	
		$('.password').on('focusin', function () {
			$(this).siblings('.account').css({'z-index': '1','background': 'rgba(0,0,0,.1)' });
			$(this).siblings('.button').css({'z-index': '1','background': 'rgba(153,153,255,.5)' });
			$(this).css({'z-index': '2','background': '#fff' });
		});


		$('.account').on('focusin', function () {
			$(this).siblings('.password').css({'z-index': '1','background': 'rgba(0,0,0,.1)' });
			$(this).siblings('.button').css({'z-index': '1','background': 'rgba(153,153,255,.5)' });
			$(this).css({'z-index': '2','background': '#fff' });
		});
		
		$('.button').on('focusin', function () {
			$(this).siblings('.password').css({'z-index': '1','background': 'rgba(0,0,0,.1)' });
			$(this).siblings('.account').css({'z-index': '1','background': 'rgba(0,0,0,.1)' });
			$(this).css({'z-index': '2','background': '#fff' });
		});
		
		$('.password').on('focusout', function () {
			$(this).siblings('.account').css({'z-index': '1','background': 'rgba(0,0,0,.1)' });
			$(this).siblings('.button').css({'z-index': '1','background': 'rgba(153,153,255,.5)' });
			$(this).css({'z-index': '2','background': '#fff' });
		});
		
		$('.account').on('focusout', function () {
			$(this).siblings('.password').css({'z-index': '1','background': 'rgba(0,0,0,.1)' });
			$(this).siblings('.button').css({'z-index': '1','background': 'rgba(153,153,255,.5)' });
			$(this).css({'z-index': '2','background': '#fff' });
		  });
		  
		$('.button').on('focusout', function () {
			$(this).siblings('.password').css({'z-index': '1','background': 'rgba(0,0,0,.1)' });
			$(this).siblings('.account').css({'z-index': '1','background': 'rgba(0,0,0,.1)' });
			$(this).css({'z-index': '2','background': '#fff' });
		});
	});
	</script>
</body>
<html>