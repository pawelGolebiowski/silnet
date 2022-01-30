<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../config/Logger.php';
include_once '../../models/Worker.php';

$database = new Database();
$db = $database->connect();

$worker = new Worker($db);

$result = $worker->read();

$num = $result->rowCount();

if ($num > 0) {
    $worker_arr = array();
    $worker_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $worker_item = array(
            'id' => $id,
            'company_name' => $company_name,
            'name' => $name,
            'surname' => $surname,
            'add_date' => $add_date,
            'mod_date' => $mod_date
        );

        array_push($worker_arr['data'], $worker_item);
    }
    Logger::show_logs('Read workers');
    echo json_encode($worker_arr);
} else {
    Logger::show_logs('Error workers read');
    echo json_encode(
        array('message' => 'No worker found')
    );
}