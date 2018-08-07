<?php
  include("includes.php");
?>

<!-- nav -->
<ul class="nav nav-pills py-3 nav-fill">
    <li>
      <a class="nav-item nav-link btn btn-outline-success" href="index.php">
        Home
      </a>
    </li>
    <?php
      if(isLoggedIn()) {
    ?>
    <li class="nav-item text-right">
      <a class="nav-link text-danger" href="logout.php">
        Logout
      </a>
    </li>
    <?php
      }
    ?>
</ul>
<!-- ./nav -->
