<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


session_destroy();

?>

<script>
    location.href ="../index.php";
</script>