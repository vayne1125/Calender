<?php
session_start();  
unset($_SESSION['user_id']);
echo "<script type='text/javascript'>
    window.location.href = './index.php';   
    </script>";
?>