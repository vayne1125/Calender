<?php
    $user = 'root';
    $password = '51318862';
    try{
        $db = new PDO(
            'mysql:host=localhost;
             dbname=calender;
             charset=utf8',$user,$password);
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db -> setAttribute(PDO::ATTR_EMULATE_PREPARES,false);       
        //Print "hi!";
    }catch(PDOException $e){
        Print "ERROR!: " . $e -> getMessage();
        die();
    }
?>
