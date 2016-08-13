<?php
require_once("../dompdf_config.inc.php");


  if ( get_magic_quotes_gpc() )
    $_POST["html"] = stripslashes($_POST["html"]);
  
  $old_limit = ini_set("memory_limit", "16M");
  $html = '<html>
<head>
<style>

/* Type some style rules here */

</style>
</head>

<body>
I came dear
<!-- Type some HTML here -->

</body>
</html>';
  $dompdf = new DOMPDF();
  $dompdf->load_html($html);
  $dompdf->set_paper('letter', 'portrait');
  $dompdf->render();

  $dompdf->stream("dompdf_out.pdf");

  exit(0);
