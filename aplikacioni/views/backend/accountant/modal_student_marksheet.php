<style>
    #chartdiv {
	width       : 100%;
        height      : 250px;
        font-size   : 11px;
}	
</style>

<?php
$student_info = $this->crud_model->get_student_info($param2);
foreach ($student_info as $row1):
    ?>
    <center>
        <div style="font-size: 20px;font-weight: 200;margin: 10px;"><?php echo $row1['name']; ?></div>

        <div class="panel-group joined" id="accordion-test-2">

            <?php
            /////REZULTATET E SEMESTRIT, PASQYRA E REZULTATEVE PER ÇDO SEMESTER MENJANE
            $toggle = true;
            $exams = $this->crud_model->get_exams();
            foreach ($exams as $row0):

                $total_grade_point = 0;
                $total_marks = 0;
                $total_subjects = 0;
            ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapse<?php echo $row0['exam_id']; ?>">
                                <i class="entypo-rss"></i>  <?php echo $row0['name']; ?>
                            </a>
                        </h4>
                    </div>

                    <div id="collapse<?php echo $row0['exam_id']; ?>" class="panel-collapse collapse <?php
                    if ($toggle) {
                        echo 'in';
                        $toggle = false;
                    }
                    ?>" >
                        <div class="panel-body">
                            <center>
                                <table class="table table-bordered " >
                                    <thead>
                                        <tr>
                                            <th>Lenda</th>
                                            <th>Piket e marra</th>
                                            <th>Piket maksimale</th>
                                            <th>Nota</th>
                                            <th>Shenime</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $subjects = $this->crud_model->get_subjects_by_class($row1['class_id']);
                                        foreach ($subjects as $row2):
                                            $total_subjects++;
                                            ?>
                                            <tr>
                                                <td><?php echo $row2['name']; $subject_name[] = $row2['name']; ?></td>
                                                <td>
                                                    <?php
                                                    //piket e marra
                                                    $verify_data = array('exam_id' => $row0['exam_id'],
                                                        'class_id' => $row1['class_id'],
                                                        'subject_id' => $row2['subject_id'],
                                                        'student_id' => $row1['student_id']);

                                                    $query = $this->db->get_where('mark', $verify_data);
                                                    $marks = $query->result_array();
                                                    foreach ($marks as $row3):
                                                        echo $row3['mark_obtained'];
                                                        $mark_obtained[] = $row3['mark_obtained'];
                                                        $total_marks += $row3['mark_obtained'];
                                                    endforeach;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    //PIKET ME TE LARTA
                                                    $verify_data = array('exam_id' => $row0['exam_id'],
                                                        'subject_id' => $row2['subject_id']);
                                                    $this->db->select_max('mark_obtained', 'mark_highest');
                                                    $query = $this->db->get_where('mark', $verify_data);
                                                    $marks = $query->result_array();
                                                    foreach ($marks as $row4):
                                                        echo $row4['mark_highest'];
                                                        $mark_highest[] = $row4['mark_highest'];
                                                    endforeach;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $grade = $this->crud_model->get_grade($row3['mark_obtained']);
                                                    echo $grade['name'];
                                                    $total_grade_point += $grade['grade_point'];
                                                    ?>
                                                </td>
                                                <td></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <hr />
                                Totali i Pikeve : <?php echo $total_marks; ?>
                                <hr />
                                GPA(Mesatarja) : <?php echo round($total_grade_point / $total_subjects, 2); ?>
                                <div id="chartdiv"></div>
                                <script>
                                    setTimeout(function() {
                                        var chart = AmCharts.makeChart("chartdiv", {
                                            "theme": "none",
                                            "type": "serial",
                                            "dataProvider": [
                                                <?php for( $i = 0; $i < count($subjects); $i++ ) { ?>
                                                    {
                                                        "subject": "<?php echo $subject_name[$i]; ?>",
                                                        "mark_obtained": <?php echo $mark_obtained[$i]; ?>,
                                                        "mark_highest": <?php echo $mark_highest[$i]; ?>
                                                    },
                                                <?php } ?>
                                            ],
                                            "valueAxes": [{
                                                "stackType": "3d",
                                                "unit": "%",
                                                "position": "left",
                                                "title": "Piket e marra kundrejt Pikeve me te Larta"
                                            }],
                                            "startDuration": 1,
                                            "graphs": [{
                                                "balloonText": "Piket e marra ne [[category]]: <b>[[value]]</b>",
                                                "fillAlphas": 0.9,
                                                "lineAlpha": 0.2,
                                                "title": "2004",
                                                "type": "column",
                                                "fillColors":"#7f8c8d",
                                                "valueField": "mark_obtained"
                                            }, {
                                                "balloonText": "Piket me te Larta ne [[category]]: <b>[[value]]</b>",
                                                "fillAlphas": 0.9,
                                                "lineAlpha": 0.2,
                                                "title": "2005",
                                                "type": "column",
                                                "fillColors":"#34495e",
                                                "valueField": "mark_highest"
                                            }],
                                            "plotAreaFillAlphas": 0.1,
                                            "depth3D": 20,
                                            "angle": 45,
                                            "categoryField": "subject",
                                            "categoryAxis": {
                                                "gridPosition": "start"
                                            },
                                            "exportConfig":{
                                                "menuTop":"20px",
                                                "menuRight":"20px",
                                                "menuItems": [{
                                                    "format": 'png'	  
                                                }]  
                                            }
                                        });
                                    }, 500);
                                </script>
                            </center>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </center>
<?php endforeach; ?>