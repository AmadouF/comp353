<?php
  include("includes.php");
  if(!isLoggedIn() || !getUserType() == "Regular") {
    header("location: /");
  }
?>

<!-- row -->
<div class="row text-center">
	<div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
	    <h1><?= $user["firstName"].' '.$user["lastName"]?></h1>
	    <span><strong>Employee ID</strong>: <?= $user["employeeId"] ?></span><br/>
	    <span><strong>Type</strong>: Regular Employee</span>
	    <br/>
	</div>
</div>
<!-- ./ row -->