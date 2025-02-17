<?php 
if(isset($_SESSION['rol'])){
    
    
}
elseif($_SESSION['rol']==''){
    
       session_destroy();

    echo "<script>location.href='../index.php';</script>";
die();
}
else{
    

    session_destroy();
    
    
    echo "<script>location.href='../index.php';</script>";
die();

    header('Location: ../index.php');
}


?>