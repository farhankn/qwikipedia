<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$startError = null;
		$endError = null;
		$linkError = null;
		
		// keep track post values
		$start = $_POST['start'];
		$end = $_POST['end'];
		$link = $_POST['link'];
		
		// validate input
		$valid = true;
		if (empty($start)) {
			$startError = 'Please enter start';
			$valid = false;
		}
		
		if (empty($end)) {
			$endError = 'Please enter end Address';
			$valid = false;
		} 
		
		if (empty($link)) {
			$linkError = 'Please enter link Number';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO game (start,end,link) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($start,$end,$link));
			Database::disconnect();
			header("Location: index.php");
		}
	}
?>


<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Create an Address</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="create.php" method="post">
					  <div class="control-group <?php echo !empty($startError)?'error':'';?>">
					    <label class="control-label">start</label>
					    <div class="controls">
					      	<input start="start" type="text"  placeholder="start" value="<?php echo !empty($start)?$start:'';?>">
					      	<?php if (!empty($startError)): ?>
					      		<span class="help-inline"><?php echo $startError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($endError)?'error':'';?>">
					    <label class="control-label">end Address</label>
					    <div class="controls">
					      	<input start="end" type="text" placeholder="end Address" value="<?php echo !empty($end)?$end:'';?>">
					      	<?php if (!empty($endError)): ?>
					      		<span class="help-inline"><?php echo $endError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($linkError)?'error':'';?>">
					    <label class="control-label">link Number</label>
					    <div class="controls">
					      <input start="link" type="text"  placeholder="link Number" value="<?php echo !empty($link)?$link:'';?>">
					      	<?php if (!empty($linkError)): ?>
					      		<span class="help-inline"><?php echo $linkError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>
