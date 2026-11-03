<?php
include('../../admin/config.php');

$sql = "SELECT * FROM patients ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Patients</title>

    <style>
        body {
             font-family: Arial, sans-serif;
            background: #EAF1FF;
            padding: 20px;
        }

        h2 {
            color: #083778;
        }

        table {
           width: 70%;
	
	 margin: 20px auto;
            background: white;
            border-collapse: collapse;
        }

        th, td {
            padding: 13px;
            border: 1px solid #E1E8F1;
            text-align: left;
        }

        th {
            background: #083778;
            color: white;
        }

        .btn {
            padding: 7px 10px;
		
            text-decoration: none;
            color: white;
            border-radius: 4px;
            display: inline-block;
            margin: 2px;
        }

        .add { background: #083778; margin-left: 280px; }
        .view { background: #198754; }
        .edit { background: #e6a000; }
        .delete { background: #dc3545; }
    </style>
</head>

<body>

<h2 style="margin-left: 280px;">All Patients</h2>

<a href="add_patient.php" class="btn add">+ Add Patient</a>

<br><br>

<?php if(isset($_GET['success'])) { ?>

    <p style="color:green;">
        Patient record successfully <?= htmlspecialchars($_GET['success']) ?>.
    </p>

<?php } ?>

<table>

    <tr>
        <th>ID</th>
        <th>Patient Name</th>
        <th>Gender</th>
        <th>Age</th>
        <th>Phone</th>
        <th>Blood Group</th>
        <th>Action</th>
    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>

    <tr>

        <td><?= $row['id'] ?></td>

        <td><?= htmlspecialchars($row['patient_name']) ?></td>

        <td><?= htmlspecialchars($row['gender'] ?? '') ?></td>

        <td><?= htmlspecialchars($row['age'] ?? '') ?></td>

        <td><?= htmlspecialchars($row['phone'] ?? '') ?></td>

        <td><?= htmlspecialchars($row['blood_group'] ?? '') ?></td>

        <td>

            <a class="btn view" href="patient_details.php?id=<?= $row['id'] ?>">View</a>

            <a class="btn edit" href="edit_patient.php?id=<?= $row['id'] ?>">Edit</a>

            <a class="btn delete"
               href="delete_patient.php?id=<?= $row['id'] ?>"
               onclick="return confirm('Are you sure you want to delete this patient?')">
               Delete
            </a>

        </td>

    </tr>

    <?php } ?>

</table>

</body>
</html>