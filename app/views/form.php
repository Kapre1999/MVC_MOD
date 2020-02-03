<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Document</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	</head>
	<body class="container">
		<form action="<?php echo URLROOT ?>/test/formProcess" method="POST" enctype="multipart/form-data">
			<?php 
				echo CSRF_TOKEN();
			?>
			<div class="form-group">
				<label for="exampleFormControlFile1">Example file input</label>
				<input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
			</div>
			<input type="submit" name="Upload" class="btn btn-primary">
		</form>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</body>
</html>

<?php 

print_r($data);
echo "<br><br><br>";
print_r($_SESSION);
// if (isset($data['csrf_error'])) {
// 	echo $data['csrf_error'];
// }
// if (isset($data['image_uploade_error'])) {
// 	echo $data['image_uploade_error'];
// }

?>
