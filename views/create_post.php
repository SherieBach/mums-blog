<?php
session_start();
//include '../includes/upload.php';
$_SESSION["user_id"] = 1;
include '../includes/database_connection.php';
$imageErr = "";

$statement = $pdo->prepare("SELECT * FROM images");	
$statement->execute();
$images = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM product_category");	
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<!-- Include stylesheet -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="../css/style.css">

    <title>Write new post</title>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
<div class="container-fluid">
<main class="post_wrap">
	<div class="row justify-content-around">


		<!-- Modal -->
		<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Choose and image</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">

						<div class="container-fluid">
						<!-- CHOOSE IMAGE FORM -->
						<form action="create_post.php" method="post" id="choose_image">
						</form>
							
							<div class="row justify-content-left">
						
								<?php if(count($images) > 0){
									for($i=0;$i<count($images);$i++){ ?>										
											<label class="col-md-3 mr-auto">
												<input type="radio" class="choose_image" name="image" value="<?=$images[$i]["image"]?>" form="choose_image">
												<div class="image_container">
												<img src="../<?=$images[$i]["image"]?>">
												</div>
											</label>									
									<?php }
									}else{ ?>
									<div class="col-md-3 mr-auto"><p>No images uploaded</p></div>
								<?php } ?>		
							</div>	
						</div>

						<form action="upload_image.php" method="post" enctype="multipart/form-data" id="upload_image">
							Select image to upload (max 500kB):
							<input type="file" name="image" id="image">
							<button type="submit" class="btn btn-primary" form="upload_image">Upload image</button><br>
							<span class="error"><?=$imageErr;?></span><br>
							
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" form="choose_image">Choose image</button>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12">
			<?php if(isset($_POST["image"])){?>
				<img src="../<?=$_POST["image"];?>">
			<?php } ?>
		</div>
		<!-- Create the editor container -->
		<div class="col-12">
			<!-- Create toolbar container -->
			<div id="toolbar">
				<!-- But you can also add your own -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
				Choose an image
				</button>
			</div>
			<form action="upload_post.php" method="post" id="post">
				<input type="hidden" name="image_id" id="image_id" value="<?=$images[$i]['id'];?>">
				<input type="hidden" name="user_id" id="user_id" value="<?=$_SESSION["user_id"];?>">

				<input class="post_title" aria-label="Title" id="tile" name="title" type="text" placeholder="Title" form="post">
				<?php foreach($categories as $single_category){ ?>
					&ensp;
					<label for="<?=$single_category['category']?>"><?=ucfirst($single_category['category'])?></label>
					<input type="radio" id="<?=$single_category['category']?>" name="drone" value="<?=$single_category['category_id']?>" form="post">
					
				<?php } ?>

				<div class="col-12" id="editor">
					<textarea name="description" rows="5" cols="40" form="post" placeholder="d">
					</textarea>
				</div>
				<button type="submit" class="btn btn-primary" form="post">Post</button>
			</form>

		</div>


<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>


<!-- Initialize Quill editor -->
		<script>

		var toolbarOptions = [

		['bold', 'italic', 'underline', 'strike'],        // toggled buttons
		['blockquote', 'code-block'],

		[{ 'list': 'ordered'}, { 'list': 'bullet' }],
		[{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
		[{ 'direction': 'rtl' }],                         // text direction

		[{ 'header': [1, 2, 3, 4, 5, 6, false] }],

		['link'],

		[{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
		[{ 'font': [] }],
		[{ 'align': [] }],

		['clean']                                         // remove formatting button
		];

		var quill = new Quill('#editor', {
			modules: {
				toolbar: toolbarOptions
			},
			theme: 'snow'
		});


		</script>

	</div>
</main>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>