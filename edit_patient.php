<?php
include('../../admin/config.php');;

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

if (isset($_POST['update'])) {

    $patient_name = $_POST['patient_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $blood_group = $_POST['blood_group'];
    $medical_history = $_POST['medical_history'];

    $sql = "UPDATE patients SET
    patient_name=?, gender=?, dob=?, age=?, phone=?,
    email=?, address=?, blood_group=?, medical_history=?
    WHERE id=?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sssisssssi",
        $patient_name,
        $gender,
        $dob,
        $age,
        $phone,
        $email,
        $address,
        $blood_group,
        $medical_history,
        $id
    );

    if ($stmt->execute()) {
        header("Location: view_patients.php?success=updated");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f7fb;
        }

        .form-box {
            width: 650px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
        }

        h2 { color: #083778; }

        input, select, textarea {
            width: 100%;
            padding: 11px;
            margin: 8px 0 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background: #083778;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="form-box">

<h2>Edit Patient</h2>

<form method="POST">

    <label>Patient Name</label>
    <input type="text" name="patient_name" value="<?= htmlspecialchars($patient['patient_name']) ?>" required>

    <label>Gender</label>
    <select name="gender">
        <option value="Male" <?= $patient['gender']=='Male'?'selected':'' ?>>Male</option>
        <option value="Female" <?= $patient['gender']=='Female'?'selected':'' ?>>Female</option>
        <option value="Other" <?= $patient['gender']=='Other'?'selected':'' ?>>Other</option>
    </select>

    <label>Date of Birth</label>
    <input type="date" name="dob" value="<?= htmlspecialchars($patient['dob'] ?? '') ?>">

    <label>Age</label>
    <input type="number" name="age" min="0" value="<?= htmlspecialchars($patient['age'] ?? '') ?>">

    <label>Phone</label>
    <input type="text" name="phone" value="<?= htmlspecialchars($patient['phone'] ?? '') ?>">

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($patient['email'] ?? '') ?>">

    <label>Address</label>
    <textarea name="address"><?= htmlspecialchars($patient['address'] ?? '') ?></textarea>

    <label>Blood Group</label>
    <select name="blood_group">
        <?php
        $groups = ['A+','A-','B+','B-','O+','O-','AB+','AB-'];
        foreach($groups as $group) {
        ?>
            <option value="<?= $group ?>" <?= $patient['blood_group']==$group?'selected':'' ?>>
                <?= $group ?>
            </option>
        <?php } ?>
    </select>

    <label>Medical History</label>
    <textarea name="medical_history"><?= htmlspecialchars($patient['medical_history'] ?? '') ?></textarea>

    <button type="submit" name="update">Update Patient</button>

</form>

</div>

</body>
</html>