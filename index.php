<?php
require('top.php');

if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id']))
{
    $id = pg_escape_string($conn, $_GET['id']);
    pg_query($conn, "delete from course_tbl where cou_id ='$id'");
}
$res = pg_query($conn, "select * from course_tbl order by cou_id desc");

?>

<main>
         <h2 class="dash-title">Overview</h2>
         <div class="dash-cards">
            <div class="card-single">
               <div class="card-body">
                  <span class="ti-briefcase"></span>
                  <div>
                     <h5>add course</h5>
                  </div>
               </div>
               <div class="card-footer">
                  <a href="course.php">click here to add</a>
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
                              <th>ID</th>
                              <th>Course Name</th>
                              <th>Course Created On</th>
                              <th>Operations</th>
                           </tr>
                           </thead>
                           <tbody>
                           <?php
                              $i=1;
                              while($row=pg_fetch_assoc($res)){?>
                                 <tr class="active-row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo $row['cou_id']?></td>
                                    <td><?php echo $row['cou_name']?></td>
                                    <td><?php echo $row['cou_created']?></td>
                                    <td><a href="course.php?id=<?php echo $row['cou_id']?>">Edit</a> <a href="index.php?id=<?php echo $row['cou_id']?>&type=delete">Delete</a></td>
                                 </td>
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
