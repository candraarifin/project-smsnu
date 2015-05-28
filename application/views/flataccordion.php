<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <title>Welcome to CodeIgniter Pagination System</title>

</head>
<body>

<div id="container">
 <h1>Welcome to CodeIgniter Pagination System!</h1>

<div id="body">

 <?php echo $this->table->generate($records); ?>
 <?php echo $this->pagination->create_links(); ?>
 </div>

<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>
