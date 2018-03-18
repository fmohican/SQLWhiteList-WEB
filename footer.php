<?php
require_once('function.php');
?>
    <nav class="navbar fixed-bottom navbar-dark bg-dark">
    <span class="navbar-text mx-auto">&copy; <?php echo $title; ?> - <?php echo debug();?></span>
    </nav>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); $('[data-toggle="tooltip"]').tooltip(); });</script>
  </body>
<html>