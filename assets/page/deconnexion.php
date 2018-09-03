<?php
session_start();
$_SESSION = array();
session_destroy();
echo "<p style='color:red; font-size:30px; font-family:calibri; font-weight:bold;'>Vous voilà déconnecté.</p>";
echo "<a href='../../index.html' style='color:grey; font-size:50px; font-family:calibri; text-decoration:none;'>>>CLIQUEZ ICI<<</a>";
 ?>
