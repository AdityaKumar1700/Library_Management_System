<?php
session_start();
error_reporting(0);
include('dbconnect.php');

// Check if the user is logged in as an admin
if(strlen($_SESSION['alogin']) == 0) { 
    header('location:index.php');
} else {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Admin Dash Board</title>
</head>
<body>
<?php include('admin\includes\header.php');?>
   
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">ADMIN DASHBOARD</h4>
                </div>
            </div>
             
            <div class="row">
                <a href="admin\manage-books.php">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="alert alert-success back-widget-set text-center">
                        Books Listed
                            <?php 
                            $sql ="SELECT id from tblbooks ";
                            $query = $dbh -> prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $listdbooks=$query->rowCount();
                            ?>
                            <h3><?php echo htmlentities($listdbooks);?></h3>
                        </div>
                    </div>
                </a>
                <a href="admin\manage-issued-books.php">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="alert alert-warning back-widget-set text-center">
                            Books Not Returned Yet
                            <?php 
                            $sql2 ="SELECT id from tblissuedbookdetails where (RetrunStatus='' || RetrunStatus is null)";
                            $query2 = $dbh -> prepare($sql2);
                            $query2->execute();
                            $results2=$query2->fetchAll(PDO::FETCH_OBJ);
                            $returnedbooks=$query2->rowCount();
                            ?>
                            <h3><?php echo htmlentities($returnedbooks);?></h3>
                        </div>
                    </div>
                </a>
                <a href="admin\reg-students.php">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="alert alert-danger back-widget-set text-center">
                            Registered Users
                            <?php 
                            $sql3 ="SELECT id from tblstudents ";
                            $query3 = $dbh -> prepare($sql3);
                            $query3->execute();
                            $results3=$query3->fetchAll(PDO::FETCH_OBJ);
                            $regstds=$query3->rowCount();
                            ?>
                            <h3><?php echo htmlentities($regstds);?></h3>
                        </div>
                    </div>
                </a>
                <a href="admin\manage-authors.php">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="alert alert-success back-widget-set text-center">
                            Authors Listed
                            <?php 
                            $sq4 ="SELECT id from tblauthors ";
                            $query4 = $dbh -> prepare($sq4);
                            $query4->execute();
                            $results4=$query4->fetchAll(PDO::FETCH_OBJ);
                            $listdathrs=$query4->rowCount();
                            ?>
                            <h3><?php echo htmlentities($listdathrs);?></h3>
                        </div>
                    </div>
                </a>
            <!-- </div> -->

            <div class="row">
                <a href="admin\manage-categories.php">            
                    <div class="col-md-3 col-sm-3 rscol-xs-6">
                        <div class="alert alert-info back-widget-set text-center">
                            Listed Categories
                            <?php 
                            $sql5 ="SELECT id from tblcategory ";
                            $query5 = $dbh -> prepare($sql5);
                            $query5->execute();
                            $results5=$query5->fetchAll(PDO::FETCH_OBJ);
                            $listdcats=$query5->rowCount();
                            ?>
                            <h3><?php echo htmlentities($listdcats);?> </h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
<?php } ?>