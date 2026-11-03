<?php
include("../../config/db.php");

if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    exit("Invalid patient ID");
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare("DELETE FROM patients WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: view_patients.php?success=deleted");
    exit();
} else {
    echo "Unable to delete patient.";
}
?>