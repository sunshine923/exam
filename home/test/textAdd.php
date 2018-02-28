<?php
include '../db.php';
$pid = $_REQUEST['pid'];
$tid = $_REQUEST['tid'];
$str='';
for($i=0;$i<count($tid);$i++){
    $str.='('.$pid.','.$tid[$i].'),';
}
$str = substr($str,0,-1);
$sql="select * from paperextra where pid = $pid";
$data = $mysql->query($sql)->fetch_all(1);
for($i=0;$i<count($data);$i++){
    for($j=0;$j<count($tid);$j++){
        if($data[$i]['tid']==$tid[$j]){
            echo '1';
            exit();
        }
    }
}
$sql="insert into paperextra (pid,tid) VALUES $str";
$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}




