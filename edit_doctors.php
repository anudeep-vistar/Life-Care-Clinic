<?php
include('../../admin/config.php');

if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid Doctor ID");
}

$id = (int)$_GET['id'];

// Get Doctor Details

$sql = "SELECT * FROM doctors WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows == 0) {
    die("Doctor not found!");
}

$doctor = $result->fetch_assoc();


// Update Doctor Details

if(isset($_POST['update_doctor'])) {

    $doctor_name = $_POST['doctor_name'];
    $specialization = $_POST['specialization'];
    $qualification = $_POST['qualification'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $fee = $_POST['consultation_fee'];
    $status = $_POST['status'];

    $sql = "UPDATE doctors SET
            doctor_name = ?,
            specialization = ?,
            qualification = ?,
            phone = ?,
            email = ?,
            address = ?,
            consultation_fee = ?,
            status = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssssssdsi",
        $doctor_name,
        $specialization,
        $qualification,
        $phone,
        $email,
        $address,
        $fee,
        $status,
        $id
    );

    if($stmt->execute()) {

        header("Location: view_doctors.php?success=updated");
        exit();

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Doctor | Life Care Clinic</title>

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
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(8,55,120,0.08);
}

.header {
    border-bottom: 1px solid #E1E8F1;
    padding-bottom: 20px;
    margin-bottom: 25px;
}

h2 {
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

label {
    display: block;
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 9px;
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

button {
    background: #083778;
    color: white;
    padding: 13px 25px;
    border: none;
    border-radius: 7px;
    cursor: pointer;
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
}

.buttons {
    margin-top: 25px;
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

        <h2>Edit Doctor Details</h2>

        <p>Update the doctor's information below.</p>

    </div>

    <form method="POST">

        <div class="form-grid">

            <div>

                <label>Doctor Name *</label>

                <input type="text"
                name="doctor_name"
                value="<?php echo htmlspecialchars($doctor['doctor_name']); ?>"
                required>

            </div>

            <div>

                <label>Specialization *</label>

                <input type="text"
                name="specialization"
                value="<?php echo htmlspecialchars($doctor['specialization']); ?>"
                required>

            </div>

            <div>

                <label>Qualification</label>

                <input type="text"
                name="qualification"
                value="<?php echo htmlspecialchars($doctor['qualification']); ?>">

            </div>

            <div>

                <label>Phone Number</label>

                <input type="tel"
                name="phone"
                value="<?php echo htmlspecialchars($doctor['phone']); ?>">

            </div>

            <div>

                <label>Email Address</label>

                <input type="email"
                name="email"
                value="<?php echo htmlspecialchars($doctor['email']); ?>">

            </div>

            <div>

                <label>Consultation Fee (₹)</label>

                <input type="number"
                name="consultation_fee"
                min="0"
                step="0.01"
                value="<?php echo htmlspecialchars($doctor['consultation_fee']); ?>">

            </div>

            <div class="full">

                <label>Address</label>

                <textarea name="address"><?php echo htmlspecialchars($doctor['address']); ?></textarea>

            </div>

            <div>

                <label>Status</label>

                <select name="status">

                    <option value="Active"
                    <?php if($doctor['status'] == 'Active') echo 'selected'; ?>>
                        Active
                    </option>

                    <option value="Inactive"
                    <?php if($doctor['status'] == 'Inactive') echo 'selected'; ?>>
                        Inactive
                    </option>

                </select>

            </div>

        </div>

        <div class="buttons">

            <button type="submit" name="update_doctor">
                Update Doctor
            </button>

            <a href="view_doctors.php" class="back-btn">
                Cancel
            </a>

        </div>

    </form>

</div>

</body>
</html>