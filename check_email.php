<?php
    include "../db_connection.php";  

    $email = isset($_POST['email']) ? $_POST['email'] : '';

    if (empty($email)) {
        echo json_encode(['exists' => false, 'error' => 'Correo vacío']);
        exit;
    }

    $email = pg_escape_string($conn, $email);

    $query = "SELECT email FROM form_responses WHERE email = '$email'";
    $result = pg_query($conn, $query);

    if (pg_num_rows($result) > 0) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }
    pg_close($conn);
?>
