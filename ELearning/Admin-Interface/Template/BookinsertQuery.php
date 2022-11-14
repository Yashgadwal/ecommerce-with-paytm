	 <?php
		try {
			$db = new PDO('mysql:host=localhost;dbname=bookstore;charset=utf8', 'root', '');
		} catch (Exception $e) {

			echo "Error has Occured";
		}




		$title = $_POST['title'];
		$price = $_POST['price'];
		$description = $_POST['description'];
		$file = $_FILES['photo'];
		//PRINT_R( $file);

		$filename = $file['name'];
		$filepath = $file['tmp_name'];
		$fileerror = $file['error'];
		if ($fileerror == 0) {
			$destfile = '../../pic/book/' . $filename;
			//ECHO  $destfile;

			move_uploaded_file($filepath, $destfile);
		}

		// Connecting to the Database
		$servername = "localhost";
		$username = "root";
		$password = "";
		$database = "bookstore";

		// Create a connection
		$conn = mysqli_connect($servername, $username, $password, $database);

		// Die if connection was not successful
		if (!$conn) {
			die("Sorry we failed to connect: " . mysqli_connect_error());
		} else {
			echo "Connection was successful";
		}

		// $sql = "insert into product values(null,'$title', $price , '$description','$filename',now(),'NO'";
		// $stmt = mysqli_query($conn, $sql);

		$stmt = $db->prepare("insert into product values(null,'$title', $price , '$description','$filename',now(),'NO')");
		$stmt->execute();

		header("location:../books.php");
		exit();
		?>