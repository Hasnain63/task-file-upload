<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/yourcode.js"></script>

    <title>file</title>
</head>

<body>
    <div class="container">
        <h1 class="ml-5"> Download File from here</h1>
        <a class="btn btn-success ml-4 mb-4" href="index.php">Back to Add Product</a>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped" style="text-align: center;">
                    <thead class="thead-dark">
                        <tr>
                            <th>id</th>
                            <th>File namee</th>
                            <th>File Path</th>
                            <th>Created at</th>
                            <th>File Download</th>
                        </tr>
                    </thead>

                    <tbody style="text-align: center;">
                        <?php include "db.php";
                        $selectquery = "select * from tbl_file";

                        $query = mysqli_query($conn, $selectquery);


                        while ($result = mysqli_fetch_assoc($query)) {

                        ?>
                        <tr>
                            <td><?php echo $result['id']; ?></td>
                            <td><?php echo $result['file_name']; ?></td>
                            <td><?php echo $result['file_path']; ?></td>
                            <td><?php echo $result['created_at']; ?></td>
                            <td><a href="uploads/<?php echo $result['file_name'] ?>">Download</a></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>