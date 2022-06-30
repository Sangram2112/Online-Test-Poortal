<?php
    include('top.php');
    $dispr = pg_query($conn,"select * from result");
?>
<main>
         <section class="recent">
            <div class="activity-grid">
               <div class="activity-card">
                  <h3>recent activity</h3>

                     <div class="table-responsive">
                        <table>
                           <thead>
                           <tr>
                              <th>S.No</th>
                              <th>RESULT ID</th>
                              <th>STUDENT NAME</th>
                              <th>Course Name</th>
                              <th>EXAM TITLE</th>
                              <th>TOTAL QUESTIONS</th>
                              <th>QUESTIONS ATTEMPTED</th>
                              <th>CORRECT ANSWER</th>
                              <th>MARKS</th>
                           </tr>
                           </thead>
                           <tbody>
                           <?php
                              $i=1;
                              while($row=pg_fetch_assoc($dispr)){?>
                                 <tr class="active-row">
                                    <td><?php echo $i?></td>
                                    <td><?php echo $row['r_id']?></td>
                                    <td><?php $exme = $row['exmne_id'];
                                          $sn=pg_query($conn,"select * from stu_tbl where exmne_id='$exme'");
                                          while($r1=pg_fetch_assoc($sn)){
                                                     $snn = $r1['exmne_fullname']; 
                                                 }
                                                 echo $snn;
                                    ?></td>
                                    <td><?php 
                                    // $exme = $row['exmne_id'];
                                    $cn=pg_query($conn,"select * from course_tbl where cou_id=(select cou_id from stu_tbl where exmne_id='$exme')");
							        while($r1=pg_fetch_assoc($cn)){
                                        $cnn = $r1['cou_name']; 
                                    }
                                    echo $cnn;
                                        ?></td>
                                    <td><?php $ei = $row['exam_id'];
                                    $et=pg_query($conn,"select * from exam_tbl where exam_id='$ei'");
							        while($r2=pg_fetch_assoc($et)){
                                        $ett = $r2['ex_title']; 
                                    }
                                    echo $ett; ?></td>
                                    <td><?php //$ei = $row['exam_id'];
                                        $tq = pg_query($conn,"select * from exam_tbl where exam_id='$ei'");
                                        while($r3=pg_fetch_assoc($tq)){
                                            $tqq = $r3['ex_questlimit_display']; 
                                        }
                                        echo $tqq;
                                    ?></td>
                                    <td>
                                    <?php
                                        $qa = pg_query($conn,"select * from stu_ans where exam_id='$ei' and exmne_id='$exme'");
                                        $qaa = pg_num_rows($qa);
                                        echo $qaa;
                                    ?>
                                    </td>
                                    <td><?php
                                        $selScore = pg_query($conn,"SELECT * FROM eqt eqt INNER JOIN stu_ans ea ON eqt.eqt_id = ea.eqt_id AND eqt.exam_answer = ea.exans_answer  WHERE ea.exmne_id='$exme' AND ea.exam_id='$ei'");
                                        $correctans = pg_num_rows($selScore);
                                        echo $correctans;
                                        ?>
                                        </td>
                                    <td>
                                    <?php
                                    echo "(".$correctans."/".$tqq.")*100=";
                                    echo "<br>".$row['result'];?>
                                    </td>
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

