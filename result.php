<?php
    include('stop.php');
    // $res = pg_query($conn,"select * from stu_tbl where exmne_id='{$_SESSION['STU_ID']}'");
    // while($row = pg_fetch_assoc($res)){
    //     $eid = $row['exam_id'];
    // }
    // if(isset($_SESSION['eid']) && isset($_SESSION['STU_ID']))
    // {
    // $sql = pg_query($conn,"select * from result where exmne_id='{$_SESSION['STU_ID']}' and exam_id='{$_SESSION['eid']}'");
    // $cnt = pg_num_rows($sql);
    // }
    // if($cnt<0)
    // {
    //     $selScore = pg_query("SELECT * FROM eqt eqt INNER JOIN stu_ans ea ON eqt.eqt_id = ea.eqt_id AND eqt.exam_answer = ea.exans_answer  WHERE ea.exmne_id='{$_SESSION['STU_ID']}' AND ea.exam_id='{$_SESSION['eid']}'");
    //     $score = pg_num_rows($selScore);
    //     $o = pg_query($conn,"select * from eqt where exam_id='{$_SESSION['eid']}'");
    //     $over = pg_num_rows($o);
    //     $ans = $score / $over * 100;
    //     // echo "$ans";
    //     // echo "%";
    //     $insr = pg_query($conn,"insert into result(exnme_id,exam_id,result)values(".$_SESSION['STU_ID'].",".$_SESSION['eid'].",'$ans')");
    // }
    $dispr = pg_query($conn,"select * from result where exmne_id='{$_SESSION['STU_ID']}'");
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
                                    <td><?php $cn=pg_query($conn,"select * from course_tbl where cou_id=(select cou_id from stu_tbl where exmne_id={$row['exmne_id']})");
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
                                        $qa = pg_query($conn,"select * from stu_ans where exam_id='$ei' and exmne_id='{$row['exmne_id']}'");
                                        $qaa = pg_num_rows($qa);
                                        echo $qaa;
                                    ?>
                                    </td>
                                    <td><?php
                                        $selScore = pg_query($conn,"SELECT * FROM eqt eqt INNER JOIN stu_ans ea ON eqt.eqt_id = ea.eqt_id AND eqt.exam_answer = ea.exans_answer  WHERE ea.exmne_id='{$_SESSION['STU_ID']}' AND ea.exam_id='{$_SESSION['eid']}'");
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

