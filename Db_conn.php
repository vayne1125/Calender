<?php
    $user = 'root';
    $password = '00957025';
    try{
        $db = new PDO(
            'mysql:host=localhost;
             dbname=test;
             charset=utf8',$user,$password);
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db -> setAttribute(PDO::ATTR_EMULATE_PREPARES,false);       
        //Print "hi!";
    }catch(PDOException $e){
        Print "ERROR!: " . $e -> getMessage();
        die();
    }
?>