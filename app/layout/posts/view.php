<div class="mx-1 m-t-8 m-b-10">
	<?php 
	$post_id = $_GET['post_id'];
	$q = mysqli_query($con, "SELECT * FROM posts WHERE id = '$post_id'");
	if ($q->num_rows == 1) {
		$n['post'] = mysqli_fetch_array($q);
		include 'content.php';
	}
	?>
</div>