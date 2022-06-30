<?php
require('top.php');
$exnm='';
$cou_id ='';
$gender = '';
$dob = '';
$yr = '';
$mail = '';
$pass = '';
$id='';
$sub2='';
if(isset($_GET['id'])){
    $id=pg_escape_string($conn,$_GET['id']);
    $res=pg_query($conn,"select * from stu_tbl where exmne_id='$id'");
    $row=pg_fetch_assoc($res);
    $exnm =$row["exmne_fullname"];
    $cou_id =$row["cou_id"];
    $gender = $row["exmne_gender"];
    $dob = $row["exmne_birthdate"];
    $yr = $row["exmne_year_level"];
    $mail= $row["exmne_email"];
    $pass = $row["exmne_password"];
    $sub2 = 1;
}
if(isset($_POST["exnm"]) && isset($_POST["cou_id"]) && isset($_POST["gender"]) && isset($_POST["dob"]) && isset($_POST["yr"]) && isset($_POST["mail"]) && isset($_POST["pass"])){
    $exnm =$_POST["exnm"];
    $cou_id =$_POST["cou_id"];
    $gender = $_POST["gender"];
    $dob = $_POST["dob"];
    $yr = $_POST["yr"];
    $mail= $_POST["mail"];
    $pass = $_POST["pass"];
    if($id>0){
        $sql="UPDATE stu_tbl SET exmne_fullname='$exnm', cou_id='$cou_id', exmne_gender='$gender', exmne_birthdate='$dob', exmne_year_level='$yr', exmne_email='$mail', exmne_password='$pass' WHERE exmne_id='$id' ";
        pg_query($conn,$sql);
        header('location:student.php');
        die();
    }else{
        echo "successfull";
        $conn = new PDO("pgsql:host=localhost; dbname=mytest","postgres","Sid123@1999");
        $data = array(
            ':exnm' =>$_POST["exnm"],
            ':cou_id' =>$_POST["cou_id"],
            ':gender' => $_POST["gender"],
            ':dob' => $_POST["dob"],
            ':yr' => $_POST["yr"],
            ':mail'=> $_POST["mail"],
            ':pass' => $_POST["pass"]
        );
        $sql = "INSERT INTO stu_tbl(exmne_fullname,cou_id,exmne_gender,exmne_birthdate,exmne_year_level,exmne_email,exmne_password) VALUES(:exnm,:cou_id,:gender,:dob,:yr,:mail,:pass) ";
        // pg_query($conn,$sql);
        // header('location:exam.php');
        
        
        $statement = $conn->prepare($sql);
        $statement->execute($data);
    }
}
?> 
<main>
        
            <div class="wrapper">
                        
                <form method="post" name="mform" id="stu_form">
                <div>
        <h1><center><strong>Student Form</strong></center></h1>
</div>
<br>
<br>
                                
                
                                
                        <div style="display: inline-block; text-align: left;">
                            NAME<br><input type="text" class="form_data" id="exnm" name="exnm" value="<?php echo $exnm?>" placeholder="" required/>
                            <br>
                        </div>
                        <br>
                        <br>
                        
                        <div style="display: inline-block; text-align: left;">
                            Course Name<br><select class="form_data" id="cou_id" name="cou_id" required/>
				                <option value="">Select course</option>
					            
                                <?php
							        $res=pg_query($conn,"select * from course_tbl order by cou_name desc");
							        
                                    while($row=pg_fetch_assoc($res)){
                                        if($cou_id==$row['cou_id']){
                                            echo "<option selected='selected' value=".$row['cou_id'].">".$row['cou_name']."</option>";
                                        }
                                        else{
									    echo "<option value=".$row['cou_id'].">".$row['cou_name']."</option>";
                                        }
							        }
					            ?>
			                </select>
                            <br>
                        </div>
                        <br>
                        <br>
                        
                              
                        <div style="display: inline-block; text-align: left;">
                            GENDER<br><input type="radio" class="form_data" id="male" name="gender" value="male" placeholder="" <?php echo ($gender=='male')?'checked':'' ?>>
                           <label for="male">MALE</label>
                           <input type="radio" class="form_data" id="female" name="gender" value="female" placeholder="" <?php echo ($gender=='female')?'checked':'' ?>>
                            <label for="female">FEMALE</label>
                            <br>
                        </div>
                        <br>
                        <br>
                              
                        <div style="display: inline-block; text-align: left;">
                            BIRTH-DATE<br><input type="date" class="form_data" id="dob" name="dob" value="<?php echo $dob?>" placeholder="" required/>
                            <br>
                        </div>
                        <br>
                        <br>

                        <div style="display: inline-block; text-align: left;">
                            AGE<br><input type="text" class="form_data" id="yr" name="yr" value="<?php echo $yr?>" placeholder="" required/>
                            <br>
                        </div>
                        <br>
                        <br>
                                
                        <div style="display: inline-block; text-align: left;">
                            MAIL<br><input type="email" class="form_data" id="mail" name="mail" value="<?php echo $mail?>" placeholder="" required/>                            
                            <br>
                        </div>
                        <br>
                        <br>
                                
                        <div style="display: inline-block; text-align: left;">
                            PASSWORD<br><input type="text" class="form_data" id="pass" name="pass" value="<?php echo $pass?>" placeholder="" required/>
                            <br>
                        </div>
                        <br>
                        <br>
                                
                        <center>
                        <div style="display: inline-block; align: center;">
                            <?php if($sub2==1){ ?>
                                    
                                        <button id="submit" type="submit">
                                    <span>submit</span>
                                    </button>
                            
                                <?php }else{ ?>
                                    <button id="submit" type="submit" onclick="save_data(); return false;">
                                    <span>submit</span>
                                    </button>
                                <?php } ?>
                        </div> 
                        </center>
                        
                        
                                
                    
				</form>
            </div>
        </div>
                                </main>
<!-- </html> -->
<!-- <main>
                        <div><strong>Exam</strong><small> Form</small></div>
                           <form method="post" name="mform" id="stu_form">
                                NAME<input type="text" class="form_data" id="exnm" name="exnm" value="<?php //echo $exnm?>" placeholder="" required></input>
                                <br>

                                Course Name<select class="form_data" id="cou_id" name="cou_id" required >
				                <option value="">Select course</option>
					            <?php
							        // $res=pg_query($conn,"select * from course_tbl order by cou_name desc");
							        // while($row=pg_fetch_assoc($res)){
                                    //     if($cou_id==$row['cou_id']){
                                    //         echo "<option selected='selected' value=".$row['cou_id'].">".$row['cou_name']."</option>";
                                    //     }else{
									//     echo "<option value=".$row['cou_id'].">".$row['cou_name']."</option>";
                                    //     }
							        // }
					                ?>
			                    </select>
                                <br>
                                GENDER<input type="text" class="form_data" id="gender" name="gender" value="<?php //echo $gender?>" placeholder="" required></input>
                                <br>
                                BIRTH-DATE<input type="date" class="form_data" id="dob" name="dob" value="<?php //echo $dob?>" placeholder="" required></input>
                                <br>
                                AGE<input type="text" class="form_data" id="yr" name="yr" value="<?php //echo $yr?>" placeholder="" required></input>
                                
                                <br>
                                MAIL<input type="text" class="form_data" id="mail" name="mail" value="<?php //echo $mail?>" placeholder="" required></input>
                                <br>
                                PASSWORD<input type="text" class="form_data" id="pass" name="pass" value="<?php //echo $pass?>" placeholder="" required></input>
                                <br>
                                <?php //if($sub2==1){ ?>
                                    <button id="submit" type="submit">
                                    <span>submit</span>
                                    </button>
                                <?php //}else{ ?>
                                    <button id="submit" type="submit" onclick="save_data(); return false;">
                                    <span>submit</span>
                                    </button>
                                <?php //} ?>
							  </form>
</main> -->
<script>
    function save_data(){
        var form_elt = document.getElementsByClassName('form_data');
        var form_data = new FormData();
        for(var count = 0 ; count<form_elt.length ; count++){
            form_data.append(form_elt[count].name,form_elt[count].value);
        }
        document.getElementById('submit').disabled = true;
        var ajax_request = new XMLHttpRequest();
        ajax_request.open('POST','addstudent.php');
        ajax_request.send(form_data);
        ajax_request.onreadyatatechange = function(){
            if(ajax_request.readyState == 4 && ajax_request.status == 200)
            {
                document.getElementById('submit').disable = false;
                document.getElementById('stu_form').reset();
            }
        }
        window.location.href = "student.php";
    }
    </script>
