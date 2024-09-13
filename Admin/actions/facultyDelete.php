<?php
include '../db/connection.php';
if(isset($_GET['delete'])){
    $delete_id=$_GET['delete'];
    $delete_query=mysqli_query($conn,"Delete from `program` where pid=$delete_id") or die("query failed!");
    if($delete_query){
        echo"Education category  deleted";
        header('Location: ../faculty.php');
    }else{
        echo"Education category not deleted";
        header('Location: ../faculty.php');
    }
}
?>