<?php
//upload.php
//if($_FILES["file"]["name"] != '')
//{
// $test = explode('.', $_FILES["file"]["name"]);
// $ext = end($test);
// $name = rand(100, 999) . '.' . $ext;
// $location = './upload/' . $name;  
// move_uploaded_file($_FILES["file"]["tmp_name"], $location);
// echo '<img src="../workers/'.$location.'" height="150" width="225" class="img-thumbnail" />';
//}

require_once("db.php");

$nic = $_POST['cid'];
echo("<br>".$nic);


if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])) {
        //Allowed file type
        $allowed_extensions = array("jpg","jpeg","png","gif");
    
        //File extension
        $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
    
        //Check extension
        if(in_array($ext, $allowed_extensions)) {
           //Convert image to base64
			list( $width,$height ) = getimagesize( $_FILES['file']['tmp_name'] );
			echo("height is $height");
			$thumb = imagecreatetruecolor( 200, 200 );
			$source = imagecreatefromjpeg($_FILES['file']['tmp_name']);
			
			imagecopyresized($thumb, $source, 0, 0, 0, 0, 200, 200, $width, $height);
			imagejpeg( $thumb, $_FILES['file']['tmp_name'], 100 ); 
			
           $encoded_image = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
           $encoded_image = 'data:image/' . $ext . ';base64,' . $encoded_image;
           $query = "UPDATE customer SET img = '$encoded_image' WHERE customer.nic LIKE '{$nic}';";
			
			
//			echo("<br>");
//			echo($query);
//			echo("<br>");
//           mysqli_query($conn, $query);
//			echo($encoded_image);
			$re = $conn->query($query);
			if($re){
				echo("<br>done uploading");
			}else{
				echo("<br>failed to upload");
			}
		   echo("<br>");
           echo "File name : " . $_FILES['file']['name'];
           echo "<br>";
           
       } else {
           echo "File not allowed";
       }
  }

?>