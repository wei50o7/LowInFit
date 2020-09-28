<?php
  if (isset($_POST['submitedit'])) {

    session_start();
    include 'dbh.php';

    $efname = $_POST['editFirstName'];
    $elname = $_POST['editLastName'];
    $eaddress = $_POST['editAddress'];
    $ephone = $_POST['editPhone'];
    $eid = $_SESSION['customerId'];

    $sql = 'UPDATE customer SET FirstName=?, LastName=?, Address=?, Phone=? WHERE CustomerID=?';
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header('Location: ../editprofile.php?error=sql');
      exit();
    } else {

      mysqli_stmt_bind_param($stmt, 'sssss', $efname, $elname, $eaddress, $ephone, $eid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_store_result($stmt);
      $read = 'SELECT * FROM customer WHERE CustomerID ='.$eid;
      $result = mysqli_query($conn, $read);
      $row2 = mysqli_fetch_assoc($result);

      $_SESSION['customerFirstName'] = $row2['FirstName'];
      $_SESSION['customerLastName'] = $row2['LastName'];
      $_SESSION['customerAddress'] = $row2['Address'];
      $_SESSION['customerPhone'] = $row2['Phone'];

      $cid = $_SESSION['customerId'];
      $target_dir = "../img/profpic/";
      $removeOldPicture = "SELECT CustPicture FROM customer WHERE CustomerID = $cid";
      $result = mysqli_query($conn, $removeOldPicture);
      $row = mysqli_fetch_array($result);
      $oldPic = "../".$row[0];

      if(isset($_POST['editProfilePicture'])) {
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      // Check if image file is a actual image or fake image
          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            header("Location: ../edit.php?error=type");
            exit();
            $uploadOk = 0;
          }

      // Check if file already exists
        if (file_exists($oldPic)) {
          unlink($oldPic);
          $uploadOk = 1;
        }

      // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          header("Location: ../edit.php?error=size");
          exit();
          $uploadOk = 0;
        }
      // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          header("Location: ../edit.php?error=format");
          exit();
          $uploadOk = 0;
        }
      // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
          header("Location: ../edit.php?error=upload");
          exit();
      // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            $newTarget = substr($target_file, 3);
            $sql = "UPDATE customer SET CustPicture = ? WHERE CustomerID = ?;";
            $result = mysqli_query($conn, $sql);
      //$row = mysqli_fetch_array($result);
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'error';
          } else {
            mysqli_stmt_bind_param($stmt, "ss", $newTarget, $cid);
            mysqli_stmt_execute($stmt);
            $_SESSION['image'] = $newTarget;
            echo "<script>alert('Update Success');</script>";
            header("Location: ../profile.php?upload=success");
            exit();
          }
        } else {
          echo "Sorry, there was an error uploading your file.";
          header("Location: ../edit.php?upload=failed");
          exit();
        }
        }

        header("Location: ../profile.php?edit=success");
        exit();
      }
    }
  }
