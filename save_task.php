<?php

include('db.php');

// Si existe en el POST el nombre save_task continúa dentro del scope
if (isset($_POST['save_task'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $query = "INSERT INTO task(title, description) VALUES ('$title', '$description')";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed");
    };

    //ALMACENAR DATOS EN UNA SESIÓN
    $_SESSION['message'] = 'Task saved succesfully';
    $_SESSION['message_color'] = 'success'; //Le añadimos el color verde (success) con Bbootstrap

    header("Location: index.php");
};

?>