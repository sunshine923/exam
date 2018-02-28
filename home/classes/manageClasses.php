<?php
include '../db.php';
$data = $mysql->query("select direction.dname,stage.sname,classes.* from classes,direction,stage where direction.did=classes.did and stage.sid=classes.sid")->fetch_all(1);
echo json_encode($data);