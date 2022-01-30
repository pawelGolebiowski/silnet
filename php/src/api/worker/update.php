<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../config/Logger.php';
include_once '../../models/Worker.php';

$database = new Database();
$db = $database->connect();

$worker = new Worker($db);

$data = json_decode(file_get_contents("php://input"));

$worker->id = $data->id;

$worker->name = $data->name;
$worker->surname = $data->surname;
$worker->company_id = $data->company_id;

if ($worker->update()) {
    Logger::show_logs('Update worker data');
    echo json_encode(
        array('message' => 'Data updateted')
    );
} else {
    Logger::show_logs('Error worker data update');
    echo json_encode(
        array('message' => 'Error')
    );
}