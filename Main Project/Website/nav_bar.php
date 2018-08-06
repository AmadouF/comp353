<?php 
  include("includes.php");
?>

<!-- nav -->
<ul class="nav nav-pills py-3 nav-fill">
    <li class="nav-item">
      <a class="nav-link btn-success" href="/">
        Home
      </a>
    </li>
    <?php
      if(isLoggedIn()) {
    ?>
    <li class="nav-item">
      <a class="nav-link" href="/logout.php">
        Logout
      </a>
    </li>
    <?php
      }
    ?>          
    <li class="nav-item">
      <a class="nav-link" href="/views/saleassociate.html">
        SaleAssociate
      </a>
    </li>          
    <li class="nav-item">
      <a class="nav-link" href="/views/manager.html">
        Manager
      </a>
    </li>    
    <li class="nav-item">
      <a class="nav-link" href="/views/admin.html">
        Admin
      </a>
    </li>  
    <li class="nav-item">
      <a class="nav-link" href="/views/regular.html">
        Regular
      </a>
    </li>   
    <li class="nav-item">
      <a class="nav-link" href="/views/client.html">
        Client
      </a>
    </li>                
  </ul>
<!-- ./nav -->