<?php include("db.php"); ?>

<?php include("includes/header.php") ?>

<div class="container p-4">

    <div class="row">

        <div class="col-md-4">

            <!-- Comprobar si existe en la sesión un dato llamado message -->
            <?php if(isset($_SESSION['message'])) { ?>

                <!-- Accedemos a la variable del archivo save_task.php para añadir success -->
                <div class="alert alert-<?= $_SESSION['message_color']; ?> alert-dismissible fade show" role="alert">
                    <strong><?= $_SESSION['message'] ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <!-- Limpiamos los datos de la sesión y cerramos la llave de apertura del scope -->
            <?php session_unset(); } ?>

            <div class="card card-body">
                <form action="save_task.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control mb-3" placeholder="Task Title" autofocus require>
                    </div>
                    <div class="form-group">
                        <textarea name="description" rows="2" class="form-control mb-3" placeholder="Task Description"></textarea>
                    </div>
                    <input type="submit" value="Save Task" class="btn btn-success btn-block" name="save_task">
                </form>
            </div>

        </div>

        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "SELECT * FROM task";
                        $result_tasks = mysqli_query($conn, $query);

                        while($row_data = mysqli_fetch_array($result_tasks)) { ?>
                            <tr>
                                <td class="align-middle"><?php echo $row_data['title'] ?></td>
                                <td class="align-middle"><?php echo $row_data['description'] ?></td>
                                <td class="align-middle"><?php echo $row_data['created_at'] ?></td>

                                <td>
                                    <a href="edit_task.php?id=<?php echo $row_data['id'] ?>" class="ms-1 me-2 text-decoration-none btn btn-secondary">
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAA55JREFUSEuNV9152zAMBChKeYw7QdsJqk5QeZIkGyQTJBu0G7gZoRPYnSDuBHU3sF9FiuwHCvwTaTt6sn7I4wGHA4xQvRAQLFgEAMsfuN/8IP1dWZ8uc6+LB/Oj9yzlxSlwuqw4YQ5WOfRl4IsEcxrF3gWd8vviE2vtSmv9JXtBIcc58tlpLYBs5R+BeKR3tHaapu/W2h4RD6JpngTiIQehVCYX3Sit7wFgU09BNbyvUkpa40C1VltE0Sd5PRpj1l3X7ZcJCbtZaz9N0/Q3PChEVKgkgBpiqvQWhehZmP/AwkcW17ERzVdinmo14CilBkTcOiEiPhlj9o4J3RcxBmjbdjczNSutpy0i9ryZO5DW+icC3DHYTkq59mBzqJnIqNQgGNhau/YbR56lelkPW4HYc7UdpJSfZwAErRUd7hvdSSlDarMcp4xT4LpAEYw1q0nrlKn/9Kds5YNW+h4BNsz4t5Ry8CQTYASlxhDqi8BBSBnoLwAYAOCW0Ykp3dN1MsYMJLAZeKFqx1jglpLqgLt2R7+XGvPhjTnFVymb+3EceyHEDgFuE9eLoGkFpVkrQs3AaagjKKsXICibTqhG9SIQnzm8VdBZvMGOOdQpY1atBy6ZJqAAoHMPOAtKMcxUnTI21q67BJjDuEWAFbOJTD0owoZTc5o4p96UrLUHXyW+kEIk03JKgT0oAKzSOvULq0xvuj0dwr1D2Fhj1m3bubqPwKyeqGokU3B1zG72NoO6dvnasEXSBiWoHW66dk9RGUfVNwLf2MODL7h9CnFxjj3jNPzghcSLlFIviPjMuj8Za4au7Zzb0UVryZBmYGacdLzgXLVyUiPbKHUmE92M7BAA7jhwJ2OmoePwFsCLtQXjmOMY6ty/4dEYu0dE6kauI2XmsLC4nHE8dL2cUq/u2l1gHCTh+4sLVFBvxIzJC8DXGMdQp4zJRoXrWPmFc3jJButjlcux73bkhFSe6dgW9qs1CTaNfjl6SCkPsb/ycJiUCsWl2nS8uOqW6TpPZiC++lyTL+nH4kxezuU5RytvOrUmEQeBRz8IRJzKNOBe0mEWmwGAEKK31v7IgGuMi9HnHDMWWmRfjETFyqYRHxDF0b/IDIQeLpzIySYN7/UxNk10+GPwIBtJdR88IxsEPEAQ1EXG58Kej8BSyj0KPC6FUYy3pXCuhPF6lMPxz463Zan6MWWh5GLmy9Hfc5aM8TIHGfvE3Gv/4+qHrvyF4g//A4L1pkUZl+gDAAAAAElFTkSuQmCC"/>
                                    <a href="delete_task.php?id=<?php echo $row_data['id'] ?>" class="btn btn-danger">
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAuxJREFUSEudVtF12zAMPNCU+9sN7BGaCaxMkHSCerO6G7QTRJ6gGcHZIN8WJfSRpkRQBBWn/rJpkgAOd0cQ1A8B4PiP/J5vDv8oW+sn0nkqNsWF4r57btOrAJSzfunDz8j8dRyGJ2beexxqh4wx78aYX0T0Pl2aUMmjVyuW2TjnLgB2auphY7qUeXxtmu2DVs0SxXmPhub1ev1mjPlbg0tjwjiOD9sv29c1mmSopcDpW9/3LRG9+MA88mPTNF0GY/wR9hl68WwbeXzcin23LTl5ynZJqhLQX2Ngz2CWgXN85gQBjMx5YI35cs2Txzn3w0uJQSFHItoTcIyQnpjZ97v4+H0AjvGPYp+11pPuciuckJErwfWhhFXopn5riXm0PPyT7svAvp9aE1dFV/ZvDhBNRuOHEofgXO9JdABwbqxtP+NQzrl4ls7WbtpMEVOONUNKh3G21rafASGcJRzAMWmNE3JNJjE413GsOAQmwPXuODLvjKE3u2lOBEbv3JF53BGZN2vtyd8nk05oLZxrYTwzqxLUdG7spvXE0VCY1gg4byIy96AldJxnVBwOFQ8dgQ8MD3/Tetm5wXVgHO4JnIq8SVXVjtYnteIY2JNw4oKW9NI+q6+TZKaEmoBY8Y1wZTJSEZHVsVTPCentas1r/axW19jW3yzRSoq4i1xKJTdWz9quwgogKULR8dRYxb+DHUpWBxNQYPVn+2AWdCBwZHVuPtIDltKdyRV6EDP5L6ilnBQDkc/uXeRKFQ8dwMFGfSWh4oLVhMH1ufmor5mYJ6WZaARxwaV4T4Yu3rmCjqc1okvpXJLVcRSYnsXaoxMIsuq3Ojtq/FjGKUcf2eMYWEpC8mAxrMwaXX2dhF1JDObEBNQlKPnzuzC/TK9/rLXPGqpr5DqC8DO3OuUR1eapxJvv1trf9cCVdvnRloiewxCvTPL6cD+vdnIiLXqc+pRHl75aZLxaeGmNN39e3q/RbTG1FXEkqyrTRXaFkug/ow4mQsHNYEAAAAAASUVORK5CYII="/>                                </td>
                            </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php include("includes/footer.php") ?>