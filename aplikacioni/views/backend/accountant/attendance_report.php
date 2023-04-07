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
                    <option value="<?php echo $row['class_id']; ?>" ><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    <?php endif; ?>


    <div id="section_holder">
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section'); ?></label>
                <select class="form-control selectboxit" name="section_id">
                    <option value=""><?php echo get_phrase('select_class_first') ?></option>

                </select>
            </div>
        </div>
    </div>
    <div class="col-md-3">
         <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
        <select name="month" class="form-control selectboxit" id="month" onchange="show_year()">
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
                      <?php if($month == $i) echo 'selected'; ?>  >
                            <?php echo $m; ?>
                </option>
                <?php
            endfor;
            ?>
        </select>
         </div>
    </div>
    <input type="hidden" name="operation" value="selection">
    <input type="hidden" name="year" value="<?php echo $running_year;?>">

	<div class="col-md-3" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info"><?php echo get_phrase('show_report');?></button>
	</div>
</div>

<?php echo form_close(); ?>







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