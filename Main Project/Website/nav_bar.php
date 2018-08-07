<?php 
  include("includes.php");
?>

<!-- nav -->
<ul class="nav nav-pills py-3 nav-fill">
    <li class="nav-item">
      <a class="nav-link btn-success" href="">
        Home
      </a>
    </li>
    <?php
      if(isLoggedIn()) {
    ?>
    <li class="nav-item">
      <a class="nav-link" href="logout.php">
        Logout
      </a>
    </li>
    <?php
      }
    ?>                          
  </ul>
<!-- ./nav -->