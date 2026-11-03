<?php
include('../../admin/config.php');

$message = "";

if(isset($_POST['add_doctor'])) {

    $doctor_name = $_POST['doctor_name'];
    $specialization = $_POST['specialization'];
    $qualification = $_POST['qualification'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $fee = $_POST['consultation_fee'];
    $status = $_POST['status'];

    $sql = "INSERT INTO doctors
    (doctor_name, specialization, qualification, phone, email, address, consultation_fee, status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssssssds",
        $doctor_name,
        $specialization,
        $qualification,
        $phone,
        $email,
        $address,
        $fee,
        $status
    );

    if($stmt->execute()) {

        header("Location: view_doctors.php?success=added");
        exit();

    } else {

        $message = "Something went wrong! Please try again.";

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Add Doctor | Life Care Clinic</title>

<style>

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 30px;
    font-family: Arial, sans-serif;
    background: #EAF1FF;
    color: #263445;
}

.container {
    max-width: 950px;
    margin: 20px auto;
    background: #FFFFFF;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(8,55,120,0.08);
}

.header {
    border-bottom: 1px solid #E1E8F1;
    padding-bottom: 20px;
    margin-bottom: 25px;
}

.header h2 {
    color: #083778;
    margin: 0 0 8px;
}

.header p {
    color: #78869B;
    margin: 0;
    font-size: 14px;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 22px;
}

.form-group label {
    display: block;
    margin-bottom: 9px;
    font-size: 14px;
    font-weight: bold;
}

input, select, textarea {
    width: 100%;
    padding: 13px;
    border: 1px solid #E1E8F1;
    border-radius: 7px;
    font-size: 14px;
    outline: none;
    font-family: Arial, sans-serif;
}

input:focus, select:focus, textarea:focus {
    border-color: #1769D2;
    box-shadow: 0 0 0 3px rgba(23,105,210,0.08);
}

textarea {
    resize: vertical;
    min-height: 90px;
}

.full {
    grid-column: 1 / 3;
}

.buttons {
    margin-top: 25px;
}

button {
    background: #083778;
    color: white;
    padding: 13px 25px;
    border: none;
    border-radius: 7px;
    cursor: pointer;
    font-size: 14px;
    font-weight: bold;
}

button:hover {
    background: #1769D2;
}

.back-btn {
    display: inline-block;
    background: #EAF1FF;
    color: #083778;
    text-decoration: none;
    padding: 13px 20px;
    border-radius: 7px;
    margin-left: 10px;
    font-size: 14px;
}

.error {
    background: #FDECEC;
    color: #C62828;
    padding: 12px;
    border-radius: 6px;
    margin-bottom: 20px;
}

@media(max-width: 600px) {

    body {
        padding: 10px;
    }

    .form-grid {
        grid-template-columns: 1fr;
    }

    .full {
        grid-column: auto;
    }

}

</style>

</head>

<body>

<div class="container">

    <div class="header">

        <h2>+ Add New Doctor</h2>

        <p>Enter the doctor's information to register in Life Care Clinic.</p>

    </div>

    <?php if($message != "") { ?>

        <div class="error">
            <?php echo htmlspecialchars($message); ?>
        </div>

    <?php } ?>

    <form method="POST">

        <div class="form-grid">

            <div class="form-group">

                <label>Doctor Name *</label>

                <input type="text"
                name="doctor_name"
                placeholder="Enter doctor name"
                required>

            </div>

            <div class="form-group">

                <label>Specialization *</label>

                <input type="text"
                name="specialization"
                placeholder="e.g. Cardiologist"
                required>

            </div>

            <div class="form-group">

                <label>Qualification</label>

                <input type="text"
                name="qualification"
                placeholder="e.g. MBBS, MD">

            </div>

            <div class="form-group">

                <label>Phone Number</label>

                <input type="tel"
                name="phone"
                placeholder="Enter phone number">

            </div>

            <div class="form-group">

                <label>Email Address</label>

                <input type="email"
                name="email"
                placeholder="Enter email address">

            </div>

            <div class="form-group">

                <label>Consultation Fee (₹)</label>

                <input type="number"
                name="consultation_fee"
                min="0"
                step="0.01"
                value="0">

            </div>

            <div class="form-group full">

                <label>Address</label>

                <textarea name="address"
                placeholder="Enter doctor's address"></textarea>

            </div>

            <div class="form-group">

                <label>Status</label>

                <select name="status">

                    <option value="Active">Active</option>

                    <option value="Inactive">Inactive</option>

                </select>

            </div>

        </div>

        <div class="buttons">

            <button type="submit" name="add_doctor">
                Save Doctor
            </button>

            <a href="view_doctors.php" class="back-btn">
                View Doctors
            </a>

        </div>

    </form>

</div>

</body>
</html>