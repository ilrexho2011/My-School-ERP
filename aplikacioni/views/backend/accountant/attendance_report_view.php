<hr />

<?php echo form_open(base_url() . 'index.php?accountant/attendance_report_selector/'); ?>
<div class="row">

    <?php
    $query = $this->db->get('class');
    if ($query->num_rows() > 0):
        $class = $query->result_array();
        ?>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label>
                <select class="form-control selectboxit" name="class_id" onchange="select_section(this.value)">
                    <option value=""><?php echo get_phrase('select_class'); ?></option>
                    <?php foreach ($class as $row): ?>
                        <option value="<?php echo $row['class_id']; ?>"<?php if ($class_id == $row['class_id']) echo 'selected'; ?> ><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    <?php endif; ?>

    <?php
    $query = $this->db->get_where('section', array('class_id' => $class_id));
    if ($query->num_rows() > 0):
        $sections = $query->result_array();
        ?>
        <div id="section_holder">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section'); ?></label>
                    <select class="form-control selectboxit" name="section_id">
                        <?php foreach ($sections as $row): ?>
                            <option value="<?php echo $row['section_id']; ?>"
                                    <?php if ($section_id == $row['section_id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
                                <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
            <select name="month" class="form-control selectboxit" id="month">
                <?php
                for ($i = 1; $i <= 12; $i++):
                    if ($i == 1)
                        $m = 'janar';
                    else if ($i == 2)
                        $m = 'shkurt';
                    else if ($i == 3)
                        $m = 'mars';
                    else if ($i == 4)
                        $m = 'prill';
                    else if ($i == 5)
                        $m = 'maj';
                    else if ($i == 6)
                        $m = 'qershor';
                    else if ($i == 7)
                        $m = 'korrik';
                    else if ($i == 8)
                        $m = 'gusht';
                    else if ($i == 9)
                        $m = 'shtator';
                    else if ($i == 10)
                        $m = 'tetor';
                    else if ($i == 11)
                        $m = 'nentor';
                    else if ($i == 12)
                        $m = 'dhjetor';
                    ?>
                    <option value="<?php echo $i; ?>"
                            <?php if ($month == $i) echo 'selected'; ?>  >
                                <?php echo $m; ?>
                    </option>
                    <?php
                endfor;
                ?>
            </select>
        </div>
    </div>

    <input type="hidden" name="year" value="<?php echo $running_year; ?>">

    <div class="col-md-3" style="margin-top: 20px;">
        <button type="submit" class="btn btn-info"><?php echo get_phrase('show_report'); ?></button>
    </div>

</div>


<?php if ($class_id != '' && $section_id != '' && $month != ''): ?>

    <br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="text-align: center;">
            <div class="tile-stats tile-gray">
                <div class="icon"><i class="entypo-docs"></i></div>
                <h3 style="color: #696969;">
                    <?php
                    $section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
                    $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
                    if ($month == 1)
                        $m = 'Janar';
                    else if ($month == 2)
                        $m = 'Shkurt';
                    else if ($month == 3)
                        $m = 'Mars';
                    else if ($month == 4)
                        $m = 'Prill';
                    else if ($month == 5)
                        $m = 'Maj';
                    else if ($month == 6)
                        $m = 'Qershor';
                    else if ($month == 7)
                        $m = 'Korrik';
                    else if ($month == 8)
                        $m = 'Gusht';
                    else if ($month == 9)
                        $m = 'Shtator';
                    else if ($month == 10)
                        $m = 'Tetor';
                    else if ($month == 11)
                        $m = 'Nentor';
                    else if ($month == 12)
                        $m = 'Dhjetor';
                    echo get_phrase('attendance_sheet');
                    ?>
                </h3>
                <h4 style="color: #696969;">
    <?php echo get_phrase('class') . ' ' . $class_name; ?> <br>Muaji : 
    <?php echo $m;?>
                </h4>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>


    <hr />

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" id="my_table">
                <thead>
                    <tr>
                        <td style="text-align: center;">
    <?php echo get_phrase('students'); ?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('date'); ?> <i class="entypo-right-thin"></i>
                        </td>
    <?php
    $year = explode('-', $running_year);
    $days = cal_days_in_month(CAL_GREGORIAN, $month, $year[0]);
    for ($i = 1; $i <= $days; $i++) {
        ?>
                            <td style="text-align: center;"><?php echo $i; ?></td>
                    <?php } ?>

                    </tr>
                </thead>

                <tbody>
                            <?php
                            $data = array();

                            $students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $running_year, 'section_id' => $section_id))->result_array();

                            foreach ($students as $row):
                                ?>
                        <tr>
                            <td style="text-align: center;">
                            <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?>
                            </td>
                            <?php
                            $status = 0;
                            for ($i = 1; $i <= $days; $i++) {
                                $timestamp = strtotime($i . '-' . $month . '-' . $year[0]);
                                $this->db->group_by('timestamp');
                                $attendance = $this->db->get_where('attendance', array('section_id' => $section_id, 'class_id' => $class_id, 'year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $row['student_id']))->result_array();


                                foreach ($attendance as $row1):
                                    $month_dummy = date('m', $row1['timestamp']);
                                    if ($i == $month_dummy)
                                        ;
                                    $status = $row1['status'];
                                endforeach;
                                ?>
                                <td style="text-align: center;">
            <?php if ($status == 1) { ?>
                                        <i class="entypo-record" style="color: #00a651;"></i>
                            <?php } else if ($status == 2) { ?>
                                        <i class="entypo-record" style="color: #ee4749;"></i>
            <?php } ?>
                                </td>

        <?php } ?>
    <?php endforeach; ?>

                    </tr>

    <?php ?>

                </tbody>
            </table>
            <center>
                <a href="<?php echo base_url(); ?>index.php?accountant/attendance_report_print_view/<?php echo $class_id; ?>/<?php echo $section_id; ?>/<?php echo $month; ?>" 
                   class="btn btn-primary" target="_blank">
    <?php echo get_phrase('print_attendance_sheet'); ?>
                </a>
            </center>
        </div>
    </div>
<?php endif; ?>

<script type="text/javascript">

    // ajax form plugin calls at each modal loading,
    $(document).ready(function() {

        // SelectBoxIt Dropdown replacement
        if($.isFunction($.fn.selectBoxIt))
        {
            $("select.selectboxit").each(function(i, el)
            {
                var $this = $(el),
                    opts = {
                        showFirstOption: attrDefault($this, 'first-option', true),
                        'native': attrDefault($this, 'native', false),
                        defaultText: attrDefault($this, 'text', ''),
                    };

                $this.addClass('visible');
                $this.selectBoxIt(opts);
            });
        }
    }); 

</script>

<script type="text/javascript">

    function select_section(class_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?accountant/get_section/' + class_id,
            success: function (response)
            {

                jQuery('#section_holder').html(response);
            }
        });
    }

</script>