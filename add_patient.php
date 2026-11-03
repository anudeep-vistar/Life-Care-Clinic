<?php
include('../../admin/config.php');

if (isset($_POST['submit'])) {

    $patient_name = $_POST['patient_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $blood_group = $_POST['blood_group'];
    $medical_history = $_POST['medical_history'];

    $sql = "INSERT INTO patients 
    (patient_name, gender, dob, age, phone, email, address, blood_group, medical_history)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisssss", $patient_name, $gender, $dob, $age, $phone, $email, $address, $blood_group, $medical_history);

    if ($stmt->execute()) {
        header("Location: view_patients.php?success=added");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Patient</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f7fb;
        }

        .form-box {
            width: 650px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        h2 {
            color: #083778;
        }

        input, select, textarea {
            width: 100%;
            padding: 11px;
            margin: 8px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
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

    <h2>Add New Patient</h2>

    <form method="POST">

        <label>Patient Name</label>
        <input type="text" name="patient_name" required>

        <label>Gender</label>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <label>Date of Birth</label>
        <input type="date" name="dob">

        <label>Age</label>
        <input type="number" name="age" min="0">

        <label>Phone Number</label>
        <input type="text" name="phone">

        <label>Email</label>
        <input type="email" name="email">

        <label>Address</label>
        <textarea name="address"></textarea>

        <label>Blood Group</label>
        <select name="blood_group">
            <option value="">Select Blood Group</option>
            <option>A+</option>
            <option>A-</option>
            <option>B+</option>
            <option>B-</option>
            <option>O+</option>
            <option>O-</option>
            <option>AB+</option>
            <option>AB-</option>
        </select>

        <label>Medical History</label>
        <textarea name="medical_history"></textarea>

        <button type="submit" name="submit">Save Patient</button>

    </form>

</div>

</body>
</html>