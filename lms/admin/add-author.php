<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Redirect user to index.php if not logged in
if(strlen($_SESSION['alogin'])==0) {   
    header('location:index.php');
} else { 
    // Check if form is submitted
    if(isset($_POST['create'])) {
        $author = $_POST['author'];
        $sql = "INSERT INTO tblauthors(AuthorName) VALUES(:author)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        
        // Redirect user to manage-authors.php with success or error message
        if($lastInsertId) {
            $_SESSION['msg'] = "Author Listed successfully";
            header('location:manage-authors.php');
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
            header('location:manage-authors.php');
        }
    }
}
?>
<!DOCTYPE html>
<html">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Add Author</title>
</head>
<body>
<?php include('includes\header.php');?>
<div class="content-wrapper">
    <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Add Author</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Author Info
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>Author Name</label>
                                <input class="form-control" type="text" name="author" autocomplete="off" required />
                            </div>
                            <button type="submit" name="create" class="btn btn-info">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php  ?>