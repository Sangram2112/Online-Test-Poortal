<?php
require('top.php');
// date_default_timezone_set('Asia/Kolkata');
// $currtime = date("h:ia");
// echo $currtime."<br>";
// echo gettype($currtime)."<br>";
// $strtt = strtotime($currtime);
// echo $strtt."<br>";
// echo gettype($strtt);
if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id']))
{
    $id = pg_escape_string($conn, $_GET['id']);
    pg_query($conn, "delete from exam_tbl where exam_id ='$id'");
}
$res = pg_query($conn, "select * from exam_tbl order by exam_id desc");
?>
<main>
         <h2 class="dash-title">Overview</h2>
         <div class="dash-cards">
            <div class="card-single">
               <div class="card-body">
                  <span class="ti-briefcase"></span>
                  <div>
                     <h5>add exam</h5>
                  </div>
               </div>
               <div class="card-footer">
                  <a href="addexam.php">click here to add</a>
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
                              <th>S.No</th>
                              <th>EXAM ID</th>
                              <th>Course Name</th>
                              <th>EXAM TITLE</th>
                              <th>EXAM DATE</th>
                              <th>START TIME</th>
                              <th>EXAM DURATION</th>
                              <th>NO. OF QUESTIONS</th>
                              <th>EXAM DESCRIPTION</th>
                              <th>CREATED ON</th>
                              <th>Operations</th>
                              <th>Add Questions</th>
                              <!-- <th>STUDENTS</th>  -->
                           </tr>
                           </thead>
                           <tbody>
                           <?php
                              $i=1;
                              while($row=pg_fetch_assoc($res)){?>
                                 <tr class="active-row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo $row['exam_id']?></td>
                                    <td><?php 
											            $courseId =  $row['cou_id']; 
											            $selCourse = pg_query($conn, "SELECT cou_name FROM course_tbl WHERE cou_id='$courseId'");
                                             while($crow=pg_fetch_assoc($selCourse)){
												            echo $crow['cou_name'];
											            }
									            ?></td>
                                    <td><?php echo $row['ex_title']?></td>
                                    <td><?php echo $row['ex_date']?></td>
                                    <td><?php echo $row['ex_start_time'];
                                                // echo gettype($row['ex_start_time'])."<br>";
                                                // $strtt = strtotime($row['ex_start_time']);
                                                // echo $strtt."<br>";
                                                // echo gettype($strtt);?></td>
									         <td><?php echo $row['ex_time_limit']?></td>
									         <td><?php echo $row['ex_questlimit_display']?></td>
									         <td><?php echo $row['ex_description']?></td>
									         <td><?php echo $row['ex_created']?></td>
                                    <td><a href="addexam.php?id=<?php echo $row['exam_id']?>">Edit</a> <a href="exam.php?id=<?php echo $row['exam_id']?>&type=delete">Delete</a></td>
                                    </td>
                                    
                                    <td><button style="background-color:white;"><a href="viewQuest.php?vid=<?php echo $row['exam_id']?>">view</a></button></td>
                                    <!-- <td><button><a href="student.php">VIEW</a></button></td> -->
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