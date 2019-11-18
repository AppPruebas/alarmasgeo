<?php 
 if(Session::getUID()!=""):
?>
<h1>Bienvenido</h1>
<?php else: print "<script>window.location='./';</script>"?>
<?php endif; ?>