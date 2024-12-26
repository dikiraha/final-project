<?php
require_once '../../classes/Car.php';

if (isset($_GET['uuid'])) {
    $uuid = $_GET['uuid'];
    $carModel = new Car();

    $car = $carModel->getDetail($uuid);

    if ($car) {
        header('Content-Type: application/json');
        echo json_encode($car);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Car not found']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
}
