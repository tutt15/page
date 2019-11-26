<?php 
    include_once dirname(__DIR__).'/model/action.php';
	$obj = new DataOperation;
    $conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);

    if(isset($_POST['search'])){
		$title = $_POST['search-title'];
		if($title == ""){
            echo "<div class='container alert alert-danger'>Please enter title need search</div>";
        }

        // $fields = array(
        //     'tile'
        // );
        $sql = "SELECT title FROM page WHERE title LIKE '%".$title."%' ";
        $query = mysqli_query($conn,$sql);


	}
?>