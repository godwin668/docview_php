<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>
<?php echo form_open_multipart('doc/do_upload');?>
<input type="file" name="userfile" size="20" />
	<br />
	<input type="submit" value="upload" />
<?php echo form_close()?>

</body>
</html>