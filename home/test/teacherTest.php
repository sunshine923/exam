<?php
include '../db.php';
$data = $mysql->query("select test.*,`type`.name,stage.sname from test,`type`,stage where test.type=`type`.id and test.sid = stage.sid")->fetch_all(1);
echo json_encode($data);