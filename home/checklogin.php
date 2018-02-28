<?php
    include 'db.php';
    $name = $_POST['name'];
    $pass = md5($_POST['pass']);
    $type = $_POST['type'];
    $code = strtolower($_POST['code']);
    session_start();
    $oldCode=$_SESSION['code'];
    if($code == $oldCode){
        $data = $mysql->query("select * from $type")->fetch_all(1);

        for($i=0;$i<count($data);$i++){
            if($data[$i]['user']==$name){
                if($data[$i]['pass']==$pass){
                    $_SESSION['user'] =$name;
                    if($type == 'student'){
                        $_SESSION['cname'] =$data[$i]['cname'];
                        $_SESSION['uid'] =$data[$i]['uid'];
                    }
                    echo 1;
                    exit();
                }else{
                    echo 2;
                    exit();
                }
            }
        }
        echo 3;
    }else{
        echo 4;
    }


