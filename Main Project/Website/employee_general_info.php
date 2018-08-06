<?php
  include("includes.php");
  if(!isLoggedIn() || !getUserType() == "Regular") {
    header("location: /");
  }
?>

<!-- row -->
<div class="row">
<div class="col-12">
    <h1><?= $user["firstName"].' '.$user["lastName"]?></h1>
    <span>ID: <?= $user["employeeId"] ?></span><br/>
    <span>Regular Employee</span>
    <br/>
</div>
</div>
<!-- ./ row -->