<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Consulting Hours</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    </head>
    <body>
        <?php
        require_once "../models/User.php";

        ?>
        <div class="container">
            <div class="col-lg-12">
                <h2 class="text-center text-primary">Users List</h2>
                <div class="col-lg-12" style="margin-bottom: 100px">
                    <a class="btn btn-info btn-block" href="<?php echo User::baseurl() ?>app/professor.php">Professor</a>
                </div>
                <div class="col-lg-12" style="margin-bottom: 100px">
                    <a class="btn btn-info btn-block" href="<?php echo User::baseurl() ?>app/student.php">Student</a>
                </div>
            </div>
        </div>
    </body>
</html>