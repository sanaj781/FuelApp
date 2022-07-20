<?php

$_SESSION['logedin'] = 0;
$_SESSION = array();
session_destroy();
?>
<script>
    location.href = 'index.php'
</script>