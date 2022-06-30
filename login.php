<?php
require('db.php');
$msg="";
if(isset($_POST['email']) && isset($_POST['password'])){
        $email=pg_escape_string($_POST['email']);
        $password=pg_escape_string($_POST['password']);
	$res=pg_query("select * from admin_acc where admin_user='$email' and admin_pass='$password'");
        $count=pg_num_rows($res);
        if($count>0){
                $row=pg_fetch_assoc($res);
                $_SESSION['USER_ID']=$row['admin_id'];
                $_SESSION['USER_NAME']=$row['admin_user'];
                header('location:index.php');
		die();
		
        }else{
                $msg="Please enter correct login details";
        }
}
?>
<!-- <!doctype html>
<html>
   
   <head>
     <link rel="stylesheet" href="login_style.css">
   </head>
   <body>
                <div class="wrapper">
                  <form method="POST">
                     
                        <label>Email address</label>
                        <input type="email" name="email" placeholder="Email">
                    <br> 
                        <label>Password</label>
                        <input type="password" name="password"  placeholder="Password">
                     
                     <h1><button type="submit">log in</button></h1>
                    
                     <div class="bottom-text">
                     <a href="forgot_pass.php">Forgot Password ?</a>
                     </div> 
                     
                   <div id="msg"><?php //echo $msg?></div>
                    <label>
                   <button><a href="register.php">SIGN IN</a></button>
                   </label> 
                  </form>
                  </div>
   </body>
</html>  -->
<html>
   
   <head>
     <link rel="stylesheet" href="login.css">
   </head>
   <body>
                <div class="wrapper">
                        <h3 align="center">ADMIN LOGIN</h3>
                  <form method="POST">
                                <div id="msg" style="color:red;"><?php echo $msg?></div>
                        <div style="text-align: center;">
                                <div style="display: inline-block; text-align: left;">
                                        <label>Email</label><br />
                                        <input type="email" name="email" placeholder="Email" style="text-align:left;">
                                </div>
                        </div>
                
                        
                    <br>
                <div style="text-align: center;">
                                <div style="display: inline-block; text-align: left;">
                                        <label>Password</label><br />
                                        <input type="password" name="password" placeholder="password" style="text-align:left;">
                                </div>
                </div> 
                  <br>      

                     
                     <h1><button type="submit">log in</button></h1>
</div>
                      
                     <!-- <div class="bottom-text">
                     <a href="forgot_pass.php">Forgot Password ?</a>
                     </div> 
                     
                   <div id="msg"><?php //echo $msg?></div>
                   <label>
                   <button><a href="register.php">SIGN IN</a></button>
                   </label>
                  </form>
                  </div> -->
   </body>
</html>

