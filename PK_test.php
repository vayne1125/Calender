<?php
include_once "db_conn.php";
?>
<html>
<script>
	function loadXMLDoc(isOk)
	{
		var xmlhttp;
		if (window.XMLHttpRequest)
		{
			// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			// IE6, IE5 浏览器执行代码
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{		
			if(isOk == true)
				document.getElementById("myDiv").innerHTML="新增成功!";
			else 
				document.getElementById("myDiv").innerHTML="pk重複!";	
		}
		xmlhttp.open("GET","PK_test.php",true);
		xmlhttp.send();
	}
	</script>
<head>
    <meta http-equiv="Content-type" content="text/html" ; charset="utf-8">
    <meta http-equiv="Pragma" content="No-cache">
	<style>
	@import url('https://fonts.googleapis.com/css?family=Lato:400,700');
	::-webkit-input-placeholder {
	  color: #56585b;
	}
	::-moz-placeholder {
	  color: #56585b;
	}
	:-moz-placeholder {
	  color: #56585b;
	}
	html {
	  -webkit-box-sizing: border-box;
	  -moz-box-sizing: border-box;
	  box-sizing: border-box;
	}

	body {
	  font-family: 'Lato', sans-serif;
	  margin: 0;
	  background-image: linear-gradient(to bottom,#CECEFF, #ACD6FF); 
	  -webkit-background-size: cover;
	  -moz-background-size: cover;
	  background-size: cover;
	  color: #0a0a0b;
	  overflow: hidden;
	}
	h1 {
	  font-size: 3rem;
	  font-weight: 700;
	  color: #fff;
	  margin: 0 0 1.5rem;
	}
	.container  {
	  height: 100vh;
	  width: 100%;
	  background: -webkit-gradient(linear, left top, left bottom, from(rgba(0,0,0,0.05)), to(rgba(0,0,0,0)));
	  background: -webkit-linear-gradient(top, rgba(0,0,0,0.05) 0%, rgba(0,0,0,0) 100%);
	  background: linear-gradient(to bottom, rgba(0,0,0,0.05) 0%, rgba(0,0,0,0) 100%);
	  padding: 20px 50px;
	  display: -webkit-box;
	  display: flex;
	  -webkit-box-orient: vertical;
	  -webkit-box-direction: normal;
	  flex-direction: column;
	  -webkit-box-pack: center;
	  justify-content: center;
	  -webkit-box-align: center;
	  align-items: center;
	}
	.pkForm .buttonA{
	  background: #CF9E9E;
	  border: none;
	  color: #fff;
	  padding: 0 30px;
	  cursor: pointer;
	  -webkit-transition: all 0.2s;
	  -moz-transition: all 0.2s;
	  transition: all 0.2s;
	}
	.pkForm .buttonA:hover {
	  padding: 5px 30px;
	  background: #C2C287;
	  border:none;
	}
	.pkForm .buttonB{
	  background: #C2C287;
	  border: none;
	  color: #fff;
	  padding: 0 10px;
	  cursor: pointer;
	  -webkit-transition: all 0.2s;
	  -moz-transition: all 0.2s;
	  transition: all 0.2s;
	}
	.pkForm .buttonB:hover {
	  background: #CF9E9E;
	  border: none;
	}
	.pkForm {
	  display: -webkit-box;
	  display: flex;
	  z-index: 10;
	  position: relative;
	  width: 500px;
	  box-shadow: 4px 8px 16px rgba(0, 0, 0, 0.3);
	}
	.name{
	  flex-basis: 500px;
	}
	.pkForm > * {
	  border: 0;
	  padding: 0 0 0 10px;
	  background: #fff;
	  line-height: 50px;
	  font-size: 1rem;
	  border-radius: 0;
	  outline: 0;
	  -webkit-appearance: none;
	}
	</style>
</head>

<body>
<div class="container">
	<h1>Add pk</h1>
    <form action="PK_test.php" class="pkForm" method="post">
		<input type="submit" value="返回" class="buttonB" formaction="./Login.php">
        <input type="text" placeholder="input pk" class="name" name="pk">
        <input type="submit" class="buttonA" value="✚"><br>
    </form>
	<div id = "myDiv"></div>
</div>
    <?php
    if (isset($_POST["pk"])) {
        $pk = $_POST["pk"];
            try {
                $sql = ("insert into pk_table values(?)");
                $stmt = $db->prepare($sql);
                $stmt->execute(array($pk));       
				echo "<script type='text/javascript'>loadXMLDoc(true)</script>";
            } catch (PDOException $e) {
                //print $e;
                echo "<script type='text/javascript'>loadXMLDoc(false)</script>";
            }
    }
    ?>
</body>
<html>