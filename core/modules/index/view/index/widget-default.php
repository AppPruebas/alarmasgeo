<?php 
 if(Session::getUID()!=""):
?>
<div class="container">
<div class="row">
<div class="col-md-12">
<h1>Bienvenidos</h1>
</div>
</div>
</div>
<?php else: print "<script>window.location='./';</script>"?>
<?php endif; ?>
