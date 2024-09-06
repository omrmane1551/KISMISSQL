<?php
include 'db.php';

// Retrieve form data
$machine_name = $_POST['machine_name'];
$model_number = $_POST['model_number'];
$manufacturer = $_POST['manufacturer'];
$purchase_date = $_POST['purchase_date'];
$installation_date = $_POST['installation_date'];
$parameter_name = $_POST['parameter_name'];
$parameter_value = $_POST['parameter_value'];
$total_items = $_POST['total_items'];
$sorted_items = $_POST['sorted_items'];
$defective_items = $_POST['defective_items'];

// Insert machine details
$sql = "INSERT INTO machines (machine_name, model_number, manufacturer, purchase_date, installation_date)
VALUES ('$machine_name', '$model_number', '$manufacturer', '$purchase_date', '$installation_date')";

if ($conn->query($sql) === TRUE) {
    $machine_id = $conn->insert_id; // Get the last inserted machine_id

    // Insert sorting parameters
    if (!empty($parameter_name) && !empty($parameter_value)) {
        $sql = "INSERT INTO sorting_parameters (machine_id, parameter_name, parameter_value)
        VALUES ('$machine_id', '$parameter_name', '$parameter_value')";
        $conn->query($sql);
    }

    // Insert sorting results
    $sql = "INSERT INTO sorting_results (machine_id, sorting_date, total_items, sorted_items, defective_items)
    VALUES ('$machine_id', NOW(), '$total_items', '$sorted_items', '$defective_items')";
    $conn->query($sql);

    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
