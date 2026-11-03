<?php
include('../../admin/config.php');

if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    exit("Invalid patient ID");
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM patients WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$patient = $result->fetch_assoc();

if (!$patient) {
    exit("Patient not found");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Details</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f7fb;
            padding: 30px;
        }

        .details {
            max-width: 650px;
            margin: auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
        }

        h2 { color: #083778; }

        p {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        a {
            background: #083778;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<div class="details">

    <h2>Patient Details</h2>

    <p><b>Patient ID:</b> <?= $patient['id'] ?></p>

    <p><b>Name:</b> <?= htmlspecialchars($patient['patient_name']) ?></p>

    <p><b>Gender:</b> <?= htmlspecialchars($patient['gender'] ?? '') ?></p>

    <p><b>Date of Birth:</b> <?= htmlspecialchars($patient['dob'] ?? '') ?></p>

    <p><b>Age:</b> <?= htmlspecialchars($patient['age'] ?? '') ?></p>

    <p><b>Phone:</b> <?= htmlspecialchars($patient['phone'] ?? '') ?></p>

    <p><b>Email:</b> <?= htmlspecialchars($patient['email'] ?? '') ?></p>

    <p><b>Address:</b> <?= nl2br(htmlspecialchars($patient['address'] ?? '')) ?></p>

    <p><b>Blood Group:</b> <?= htmlspecialchars($patient['blood_group'] ?? '') ?></p>

    <p><b>Medical History:</b> <?= nl2br(htmlspecialchars($patient['medical_history'] ?? '')) ?></p>

    <p><b>Registration Date:</b> <?= htmlspecialchars($patient['created_at']) ?></p>

    <br>

    <a href="view_patients.php">Back to Patients</a>

</div>

</body>
</html>