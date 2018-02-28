<?php
    include '../db.php';
    session_start();
    $author = $_SESSION['user'];
    $data = $_REQUEST;
    $arr = array_keys($data);
    $str = '(';
    for($i=0;$i<count($arr);$i++){
        $str.=$arr[$i].',';
    }
    $str.='author) values (';
    foreach ($data as $v){
        $str.="'".$v."',";
    }
    $str.="'".$author."')";
    $mysql->query("insert into test $str");
    if($mysql->affected_rows){
        echo 'ok';
        exit();
    }else{
        echo 'error';
    }