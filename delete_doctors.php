<?php

include('../../admin/config.php');

if(isset($_POST['id']) && is_numeric($_POST['id'])) {

    $id = (int)$_POST['id'];

    $sql = "DELETE FROM doctors WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id);

    if($stmt->execute()) {

        header("Location: view_doctors.php?success=deleted");
        exit();

    } else {

        echo "Unable to delete doctor!";

    }

} else {

    header("Location: view_doctors.php");
    exit();

}

?>