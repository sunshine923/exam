<?php
    include '../db.php';
    $data = $_REQUEST['ids'];
    $eids = implode(',',$data);
    $sql="delete from paperextra where eid in ($eids)";
    $mysql->query($sql);
    if($mysql->affected_rows){
        echo 'ok';
        exit();
    }else{
        echo 'error';
    }