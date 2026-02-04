<?php
    session_start();
    if (empty($_SESSION['aid'])) {
        echo "Access Denied" ;
        echo "<meta http-equiv='content='4; url=index.php'>";
        exit;
    }
?>
