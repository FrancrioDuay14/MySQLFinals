<?php
    session_start();
    $_SESSION['CURR_PAGE'] = 'changePass';
?>
<?php require_once("header-nav.php");?>
<?php
  
  $con = openConn();
  $strSql = "SELECT * FROM tbl_user";

  if($rsUser = mysqli_query($con,$strSql)){
      if(mysqli_num_rows($rsUser)>0){
          while($recUser = mysqli_fetch_array($rsUser)){
              $password = $recUser['password'];
              $name = $recUser['name'];
              
          }
          mysqli_free_result($rsUser);
      }
      else
          echo 'No record found!';
  }
  else
      echo 'ERROR: Could not execute your request!';

      closeConn($con); 
  
?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><i class="fa-solid fa-key"></i> Change Password</h1>
                </div> 
                <form method="post">
                        <?php
                            if(isset($_POST['btnUpdatePass'])){
                                $newpassword = $_POST['txtNewPass'];
                                $newpassword = md5($newpassword);
                                $existingPass = $_POST['txtExistingPass'];
                                $existingPass = md5( $existingPass);
                                if($password == $existingPass){
                                    if($_POST['txtNewPass'] == $_POST['ConfirmPass']){       
                                        
                                        $con = openConn();
                                            $strSql = "UPDATE tbl_user SET password = '$newpassword' WHERE userid = 1";
                                            if(mysqli_query($con,$strSql))
                                                header("location:login.php");
                                            else
                                                echo "Error!";
                                                closeConn($con); 
                                    }
                                    else
                                        echo "New/Confirm Password not match! <br><br>";

                                }
                                else
                                    echo "Existing password doesn't match! <br><br>";            
                            }

                        ?>
                        <div class="form-group row">
                            <label for="txtExistingPass" class="col-sm-2 col-form-label">Existing Password:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="txtExistingPass" id="txtExistingPass" required>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtNewPass" class="col-sm-2 col-form-label">New Password:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="txtNewPass" id="txtNewPass" required>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="ConfirmPass" class="col-sm-2 col-form-label">Confrim Password:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="ConfirmPass" id="ConfirmPass" required>
                                </div>
                        </div>
                        <!--<div class="form-group row">
                            <label for="filImageOne" class="col-sm-2 col-form-label"> Photo 1</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="filImageOne" value=""id="filImageOne">
                                </div>
                        </div>-->
                        <!--<div class="form-group row">
                            <label for="filImageTwo" class="col-sm-2 col-form-label"> Photo 2</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="filImageTwo" id="filImageTwo" required>
                                </div>
                        </div>-->
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" name="btnUpdatePass" class="btn btn-primary  "><i class="fa fa-edit"></i> Save Changes</button>
                                <a href="products.php" class="btn btn-primary  ">Go back</a>
                            </div>
                        </div>

                </form>
                <br><br>
            </main>
        </div>
    </div>       
<?php require_once("footer.php");?>