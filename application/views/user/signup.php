<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>HOME - I Doc View</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Online Document Preview, synchronous preview and annotating. types including Microsoft Office types(.doc, .docx, .xls, .xlsx, ppt, pptx), txt, pdf, odt, ods, odp and more.">
    <meta name="keywords" content="Online Document Preview doc view viewer office word excel 在线 文档 同步 协作 预览" />
    <meta name="author" content="Godwin">

    <base href="<?php echo base_url()?>assets/">
    
    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="idocv/css/style.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="bootstrap/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <!-- to be done -->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="http://www.idocv.com">I Doc View</a>
          <!-- SIGN UP & SIGN IN HERE -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
       		<!-- PAGE CONTENT HERE -->
       		<form id="form-signup" class="form-horizontal" action='' method="POST" style="max-width: 600px; margin: 0 auto;">
			  <fieldset>
			    <div id="legend">
			      <legend class="">Register</legend>
			    </div>
			    
			    <!-- ERROR RESULT HERE -->
			    <div id="sign-up-result"></div>
			    
			    <div class="control-group">
			      <!-- Username -->
			      <label class="control-label"  for="username">Username</label>
			      <div class="controls">
			        <input type="text" id="username" name="username" placeholder="Username should be at least 3 characters" class="input-xlarge" data-validation="validate_min_length length3" >
			        <p class="help-block"></p>
			      </div>
			    </div>
			    
			    <div class="control-group">
			      <!-- E-mail -->
			      <label class="control-label" for="email">E-mail</label>
			      <div class="controls">
			        <input type="text" id="email" name="email" placeholder="example@idocv.com" class="input-xlarge" data-validation="validate_email" />
			        <p class="help-block"></p>
			      </div>
			    </div>
			
			    <div class="control-group">
			      <!-- Password-->
			      <label class="control-label" for="password">Password</label>
			      <div class="controls">
			        <input type="password" id="password" name="password" placeholder="Password should be at least 4 characters" class="input-xlarge" data-validation="validate_confirmation validate_min_length length4" />
			        <p class="help-block"></p>
			      </div>
			    </div>
			
			    <div class="control-group">
			      <!-- Password -->
			      <label class="control-label"  for="password_confirm">Password (Confirm)</label>
			      <div class="controls">
			        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Please confirm password" class="input-xlarge">
			        <p class="help-block"></p>
			      </div>
			    </div>

			    <div class="control-group">
			      <!-- Button -->
			      <div class="controls">
			        <button class="btn btn-success">Register</button>
			      </div>
			    </div>
			  </fieldset>
			</form>
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
			Powered by: <a href="http://www.idocv.com">I Doc View</a>&nbsp;&nbsp;&nbsp;Email: <a href="mailto:support@idocv.com">support@idocv.com</a>
      </footer>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="jquery/js/jquery-1.9.1.min.js"><\/script>')</script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="jquerycookie/js/jquery.cookie.js"></script>
    <script src="formvalidator/js/jquery.formvalidator.min.js"></script>
    <script src="idocv/js/user.js"></script>
    <script src="idocv/js/signup.js"></script>

  </body>
</html>