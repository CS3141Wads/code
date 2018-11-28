<?php

    // Clear and destroy the current session
    session_start();
    session_unset();
    session_destroy();

    // Go back to the start page
    header("Location: index.html");
?>