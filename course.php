<?php
require('top.php');
	$cou_name='';
    $id='';
    $sub2='';
    if(isset($_GET['id'])){
        $id=pg_escape_string($conn,$_GET['id']);
        $res=pg_query($conn,"select * from course_tbl where cou_id='$id'");
        $row=pg_fetch_assoc($res);
        $cou_name=$row['cou_name'];
        $sub2 = 1;
    }
	if(isset($_POST["cou_name"])){
        $cou_name=pg_escape_string($conn,$_POST['cou_name']);
	    if($id>0){
		    $sql="update course_tbl set cou_name='$cou_name' where cou_id='$id'";
            pg_query($conn,$sql);
	        header('location:index.php');
	        die();
	    }else{
                $conn = new PDO("pgsql:host=localhost; dbname=mytest","postgres","Sid123@1999");
		        $data = array(
			    ':cou_name' => $_POST["cou_name"]
		        );
		        $sql = "insert into course_tbl(cou_name) values(:cou_name)";
		        // pg_query($conn,$sql);
                $statement = $conn->prepare($sql);
                $statement->execute($data);
	    }
    }

?>
<!-- <html>
    <head>
        <link rel="stylesheet" href="addstudent.css">
</head> -->

    <main>
       
            <div class="wrapper">
                       
                <form method="post" name="mform" id="stu_form">
                <div>
        <h1><center><strong>COURSE NAME</strong></center></h1>
</div>
<br>
<br>
                               
<div style="display: inline-block; text-align: left;">
Course Name<br>    <input type="text" value="<?php echo $cou_name;?>" class="form_data" id="cou_name" name="cou_name" placeholder="Enter course name" required></input>
                           
                                    <br>
                                    </div>
                                    <br>
                                    <br>

                                    <center>
                                <div style="display: inline-block; text-align: left;">
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
</main>
<!-- <main>
                        <div><strong>Course</strong><small> Form</small></div>
                           <form method="POST" name="mform" id="cou_form">
							   <label >Course Name</label>
							    <input type="text" value="<?php //echo $cou_name;?>" class="form_data" id="cou_name" name="cou_name" placeholder="Enter course name" required></input>
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
        ajax_request.open('POST','course.php');
        ajax_request.send(form_data);
        ajax_request.onreadyatatechange = function(){
            if(ajax_request.readyState == 4 && ajax_request.status == 200)
            {
                document.getElementById('submit').disable = false;
                document.getElementById('cou_form').reset();
            }
        }
        window.location.href = "index.php";
    }
    </script>