<?php
include '../db.php';
$data = $mysql->query("select paper.*,classes.cname from paper,classes where paper.cid=classes.cid ")->fetch_all(1);
echo json_encode($data);