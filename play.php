<?php 
	require 'database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM customers where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);


		$sql2 = "SELECT * FROM game where id = ?";
		$q2 = $pdo->prepare($sql2);
		$q2->execute(array($id));
		$data2 = $q2->fetch(PDO::FETCH_ASSOC);

		Database::disconnect();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Play Game</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>




  </body>
<!-- Navigation Starts -->

<div class="navbar">
  <div class="navbar-inner">
    <a class="brand" href="index.php">Qikipedia</a>
    <ul class="nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Player: <?php echo $data['name'];?></a></li>
      <li><a href="#">Start: <?php echo $data2['start'];?></a></li>
      <li><a href="#">End: <?php echo $data2['end'];?></a></li>
    </ul>
   
    
    <h1 class="pull-right navbar-text"><time>00:00:00</time></h1>
    <div class="btn-group pull-right">
		<button id="start" class="btn">start</button>
		<button id="stop" class="btn btn-danger" >stop</button>
		<button id="clear" class="btn btn-warning">clear</button>
    </div>
  </div>
</div>
<!-- Navigation Ends -->




 <iframe src="<?php echo $data2['link'];?>" frameborder="0" style="width: 100%; height: 100%; position: absolute" id="fileframe"></iframe>


<script type="text/javascript" src="js/stopwatch.js"></script>

</html>
