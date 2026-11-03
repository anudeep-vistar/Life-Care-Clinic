<?php
include('../../admin/config.php');

$sql = "SELECT * FROM doctors ORDER BY id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>View Doctors | Life Care Clinic</title>

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
    max-width: 1250px;
    margin: 20px auto;
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(8,55,120,0.08);
}

.top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    gap: 15px;
}

h2 {
    color: #083778;
    margin: 0 0 8px;
}

.subtitle {
    color: #78869B;
    margin: 0;
    font-size: 14px;
}

.add-btn {
    background: #083778;
    color: white;
    text-decoration: none;
    padding: 12px 18px;
    border-radius: 7px;
    font-size: 14px;
}

.add-btn:hover {
    background: #1769D2;
}

.table-box {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 1050px;
}

th {
    background: #083778;
    color: white;
    padding: 15px 12px;
    font-size: 13px;
    text-align: left;
}

td {
    padding: 14px 12px;
    border-bottom: 1px solid #E1E8F1;
    font-size: 13px;
}

tr:hover {
    background: #F5F8FF;
}

.status {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
}

.active {
    background: #E0F5E9;
    color: #18864B;
}

.inactive {
    background: #FDECEC;
    color: #D43C3C;
}

.edit-btn {
    background: #1769D2;
    color: white;
    padding: 7px 11px;
    text-decoration: none;
    border-radius: 5px;
}

.delete-btn {
    background: #DC3545;
    color: white;
    padding: 7px 11px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.actions {
    display: flex;
    align-items: center;
    gap: 7px;
}

.success {
    background: #E0F5E9;
    color: #18864B;
    padding: 12px;
    border-radius: 6px;
    margin-bottom: 20px;
}

.empty {
    text-align: center;
    padding: 30px;
    color: #78869B;
}

@media(max-width: 600px) {

    body {
        padding: 10px;
    }

    .top {
        flex-direction: column;
        align-items: flex-start;
    }

}

</style>

</head>

<body>

<div class="container">

    <div class="top">

        <div>

            <h2>Doctors Management</h2>

            <p class="subtitle">
                View and manage all registered doctors.
            </p>

        </div>

        <a href="add_doctor.php" class="add-btn">
            + Add New Doctor
        </a>

    </div>

    <?php if(isset($_GET['success'])) { ?>

        <div class="success">

            <?php

            if($_GET['success'] == 'added') {
                echo "Doctor added successfully!";
            }

            elseif($_GET['success'] == 'updated') {
                echo "Doctor details updated successfully!";
            }

            elseif($_GET['success'] == 'deleted') {
                echo "Doctor deleted successfully!";
            }

            ?>

        </div>

    <?php } ?>

    <div class="table-box">

        <table>

            <tr>

                <th>ID</th>
                <th>Doctor Name</th>
                <th>Specialization</th>
                <th>Qualification</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Consultation Fee</th>
                <th>Status</th>
                <th>Actions</th>

            </tr>

            <?php if($result && $result->num_rows > 0) { ?>

                <?php while($row = $result->fetch_assoc()) { ?>

                    <tr>

                        <td><?php echo $row['id']; ?></td>

                        <td>
                            <?php echo htmlspecialchars($row['doctor_name']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row['specialization']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row['qualification']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row['phone']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row['email']); ?>
                        </td>

                        <td>
                            ₹<?php echo number_format((float)$row['consultation_fee'], 2); ?>
                        </td>

                        <td>

                            <?php if($row['status'] == 'Active') { ?>

                                <span class="status active">Active</span>

                            <?php } else { ?>

                                <span class="status inactive">Inactive</span>

                            <?php } ?>

                        </td>

                        <td>

                            <div class="actions">

                                <a href="edit_doctors.php?id=<?php echo $row['id']; ?>"
                                class="edit-btn">
                                    Edit
                                </a>

                                <form method="POST"
                                action="delete_doctor.php"
                                onsubmit="return confirm('Are you sure you want to delete this doctor?');">

                                    <input type="hidden"
                                    name="id"
                                    value="<?php echo $row['id']; ?>">

                                    <button type="submit"
                                    class="delete-btn">
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                <?php } ?>

            <?php } else { ?>

                <tr>

                    <td colspan="9" class="empty">
                        No doctors found. Please add a new doctor.
                    </td>

                </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>