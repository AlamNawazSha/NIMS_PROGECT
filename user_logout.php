<?php
// session_start();
// session_destroy();
// header("Location: index.php"); // Redirect to login page
// exit();
?>
<?php
session_start();
session_unset();
session_destroy();

// Prevent going back after logout
echo "<script>
    window.location.href = 'index.php';
    window.history.pushState(null, '', window.location.href);
    window.onpopstate = function() {
        window.history.pushState(null, '', window.location.href);
    };
</script>";
exit();
?>
