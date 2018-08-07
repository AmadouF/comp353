<?php
  include("includes.php");
?>

<!-- row -->
<div class="row py-3 text-center">
  <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
    <h1><?= $user["clientName"]?></h1>
    <span><strong>Client ID</strong>: <?= $user["clientId"]?></span><br/>
    <span><strong>Type</strong>: Client</span>
  </div>
</div>
<!-- ./ row -->
