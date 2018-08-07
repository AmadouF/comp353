<?php
  include("includes.php");
?>

<!-- row -->
<div class="row text-center">
	<div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
	    <h1><?= $user["firstName"].' '.$user["lastName"]?></h1>
	    <span><strong>Employee ID</strong>: <?= $user["employeeId"] ?></span><br/>
	    <span><strong>Type</strong>: <?= getUserType() ?></span>
	    <br/>
	</div>
</div>
<!-- ./ row -->
