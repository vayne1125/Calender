<html>
    <head>
        <meta http-equiv="Content-type" content="text/html"; charset="utf-8">
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
			
			header {
				margin: 12% auto 1% auto;
				text-align: center;
			}
			header p{
				font-size: 320%;
				color: #F3F3FA;
				text-align: center;
			}
			input{
				display: inline-block;
				color: #F3F3FA;
				font-size:16px;
			  
				width: 280px;
				height: 50px;
			  
				padding: 0 20px;
				background-image: linear-gradient(to top, #6D7B86, #D6DDD9);
				border-radius: 5px;
				
				outline: none;
				border: 2px solid #EBD6D6;
			  
				cursor: pointer;
				text-align: center;
				transition: all 0.2s linear;
				
				margin: 3% auto;
				letter-spacing: 0.05em;
			}
			input:hover {
				transform: translatey(3px);
				box-shadow: none;
			}
			input:hover{
				animation: ani9 0.4s ease-in-out infinite alternate;
			}
			@keyframes ani9 {
				0% {
					transform: translateY(3px);
				}
				100% {
					transform: translateY(5px);
				}
			}
		</style>
    </head>
    <body>
		<div class="container">
			<header class="head-form">
			  <p>大學生Calender</p>
			</header>
			<input class="sign" type="button" value="sign" onclick="javascript:location.href= './sign.php'">
			<input class="login" type="button" value="login" onclick="javascript:location.href = './login.php'">
		</div>
	</body>
<html>