<?php
session_start();

// Hapus semua variabel session, lalu hancurkan session-nya
session_unset();
session_destroy();

header('Location: login.php');
exit;
