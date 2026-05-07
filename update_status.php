<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id']) && isset($_POST['new_status'])) {
    $order_id = mysqli_real_escape_with_string($con, $_POST['order_id']);
    $new_status = mysqli_real_escape_with_string($con, $_POST['new_status']);

    if (!empty($new_status)) {
        $update_query = "UPDATE order_detail SET order_status = '$new_status' WHERE order_id = '$order_id'";
        
        if (mysqli_query($con, $update_query)) {
            // Redirect back to the report page
            header("Location: all_order_report.php?msg=Status Updated Successfully");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    }
} else {
    header("Location: all_order_report.php");
    exit();
}
?>