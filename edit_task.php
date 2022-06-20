<?php

    include("db.php");

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM task WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) == 1) {
            $row_data = mysqli_fetch_array($result);
            $title = $row_data['title'];
            $description = $row_data['description'];
        };
    }

    if (isset($_POST['update'])) {
        $id = $_GET['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        $query = "UPDATE task set title = '$title', description = '$description' WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo 'No funciona';
        };

        $_SESSION['message'] = 'Task Updated Successfully';
        $_SESSION['message_color'] = 'warning';
        header('Location: index.php');
    }

?>

<?php include('includes/header.php') ?>

<div class="container p-4">
    <div class="row">
        <div class="col-4 mx-auto">
            <div class="card card-body">
                <form action="edit_task.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <input type="text" name="title" value="<?php echo $title; ?>" class="form-control mb-3" placeholder="Update title">
                    </div>
                    <div class="form-group">
                        <textarea name="description" rows="2" class="form-control mb-3" placeholder="Update Description"><?php echo $description; ?></textarea>
                    </div>
                    <button class="btn btn-success" name="update">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>
