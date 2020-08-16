<html>
<head>
  <title>Installation</title>
  <link rel="shortcut icon" href="includes/assets/img/favicon.png">
  <style type="text/css">
  .progress { height: 40px !important; }
   progress.active .progress-bar, .progress-bar.active { padding: 10px; }
  </style>
</head>
<body style="background: url('includes/assets/img/bg.png') #FFFFFF scroll center -50px repeat !important">
<link rel="stylesheet" href="../assets/css/style.css" />
<div style="padding-top:30px;">
<div class="col-md-3"></div>
<div class="col-md-6">
<div class="progress">
  <div class="progress-bar progress-bar-striped active" id="progress">
    <span id="information"></span>
  </div>
</div>
</div>
<div class="col-md-3"></div>
<div class="clearfix"></div>
<?php
  $total = 285;
  $arrayTimings = array("5000","10000","30000","400000","3000");
  for($i=1; $i<=$total; $i++){
  $keys = array_rand($arrayTimings);
  $val = $arrayTimings[$keys];
  $percent = intval($i/$total * 100);
  $percentage = $percent."%";
  if($percent == 100){
    $processed = "99%";
  }else{
    $processed = $percentage;
  }
  header( 'Content-type: text/html; charset=utf-8' );
  echo '<script language="javascript">
  document.getElementById("progress").style.width ="'.$processed.'";
  document.getElementById("information").innerHTML="'.$processed.' processed.";
  </script>';
  echo str_repeat(' ',1024*64);
  flush();
  usleep($val);
  }
  echo '<script language="javascript">document.getElementById("information").innerHTML="Process completed"</script>';
?>
</div>
<div class="col-md-3"></div>
<div class="col-md-6">

<div class="panel panel-default">
  <div class="panel-heading">Instalattion Completed</div>
  <div class="panel-body">
  <p>Congratulations PHPTRAVELS installed successfully and ready to get started.</p>
  <hr>
   <div class="block">
      <form action="<?php echo @$_POST['domain']; ?>" target="_blank" method="post">
        <button class="btn btn-default btn-lg btn-block">
          <h4 class="text-center">Homepage</h4>
        </button>
      </form>
      <hr>
      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <img class="img-rounded img-responsive" src="includes/assets/img/admin.png" alt="admin">
        </div>
        <div class="col-md-10 row">
          <div class="visible-lg">
            <div style="margin-top:10px"></div>
          </div>
          <strong>Admin URL :</strong> <?php echo @$_POST['domain']; ?>admin/<br>
          <strong>Email :</strong> <?php echo @$_POST['admin_email']; ?><br>
          <strong>Password :</strong> <?php echo @$_POST['admin_password']; ?>
        </div>
      </div>
  </div>
<div class="clearfix"></div>
<hr>
<div class="clearfix"></div>
<p class="bold"><strong>XML Sitemap For better SEO</strong><br>
<a target="_blank" class="target" href="<?php echo @$_POST['domain']; ?>sitemap.xml"><?php echo @$_POST['domain']; ?>sitemap.xml </a>
</p>
<hr>
<p>to get started and setup the website please visit here <a target="_blank" class="target" href="//phptravels.com/documentation/"><strong>www.phptravels.com/documentation/</strong></a><br>
Looking forward to hearing from you.
</p>
<hr>
<p><span class="bold"><strong>Regards</strong></span><br>
  PHPTRAVELS Team
</p>
</div>
</div>
</div>
<div class="col-md-3"></div>
<div class="clearfix"></div>
</body>
</html>
