<?php
require('top.php');
if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
	$id=pg_escape_string($conn,$_GET['id']);
	pg_query($conn,"delete from stu_tbl where exmne_id='$id'");
}
$res=pg_query($conn,"select * from stu_tbl order by exmne_id desc");
?>

      <main>
         <h2 class="dash-title">Overview</h2>
         <div class="dash-cards">
            <div class="card-single">
               <div class="card-body">
                  <span class="ti-briefcase"></span>
                  <div>
                     <h5>Add Student</h5>
                  </div>
               </div>
               <div class="card-footer">
                  <a href="addstudent.php">click here to add</a>
               </div>
            </div>
         </div>

         <section class="recent">
            <div class="activity-grid">
               <div class="activity-card">
                  <h3>recent activity</h3>

                     <div class="table-responsive">
                        <table>
                           <thead>
                              <tr>
                                 <th>SR. NO.</th>
                                 <th>ID</th>
                                 <th>STUDENT NAME</th>
                                 <th>COURSE NAME</th>
                                 <th>GENDER</th>
                                 <th>DOB</th>
                                 <th>AGE</th>
                                 <th>EMAIL</th>
                                 <th>PASSWORD</th>
                                 <th>STATUS</th>
                                 <th>OPERATIONS</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php 
									$i=1;
									while($row=pg_fetch_assoc($res)){?>
                              <tr>
                                 <td><?php echo $i?></td>
                                 <td><?php echo $row['exmne_id']?></td>
                                 <td><?php echo $row['exmne_fullname']?></td>
                                 <td><?php 
											            $courseId =  $row['cou_id']; 
											            $selCourse = pg_query($conn, "SELECT cou_name FROM course_tbl WHERE cou_id='$courseId'");
                                             while($crow=pg_fetch_assoc($selCourse)){
												            echo $crow['cou_name'];
											            }
									            ?></td>
                                 <td><?php echo $row['exmne_gender']?></td>
                                 <td><?php echo $row['exmne_birthdate']?></td>
                                 <td><?php echo $row['exmne_year_level']?></td>
                                 <td><?php echo $row['exmne_email']?></td>
                                 <td><?php echo $row['exmne_password']?></td>
                                 <td><?php echo $row['exmne_status']?></td>
                                 <td><a href="addstudent.php?id=<?php echo $row['exmne_id']?>"><span class="badge success">edit</span></a> <a href="student.php?id=<?php echo $row['exmne_id']?>&type=delete"><span class="badge success">delete</span></a></td>
                                 <!-- <td><a href="addstudent.php?id=<?php //echo $row['exmne_id']?>"><span class="badge success">edit</span></a> <a href="student.php?id=<?php //echo $row['exmne_id']?>&type=delete"><span class="badge success">delete</span></a></td> -->
                              </tr>
                              <?php 
									$i++;
									} ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
            </div>
            
         </section>
      </main>
   </div>
</body>
</html>
