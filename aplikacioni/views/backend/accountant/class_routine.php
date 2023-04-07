<div class="row">
    <div class="col-md-12">
    
        <!------FILLIMI I KONTROLL TABEVE------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('class_routine_list');?>
                        </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_class_routine');?>
                        </a></li>
        </ul>
        <!------MBARIMI I KONTROLL TABEVE------>
        
    
        <div class="tab-content">
        <br>
            <!----FILLON LISTIMI I TABELES-->
            <div class="tab-pane active" id="list">
                <div class="panel-group joined" id="accordion-test-2">
                    <?php 
                    $toggle = true;
                    $classes = $this->db->get('class')->result_array();
                    foreach($classes as $row):
                        ?>
                        
                
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapse<?php echo $row['class_id'];?>">
                                        <i class="entypo-rss"></i> Klasa <?php echo $row['name'];?>
                                    </a>
                                    </h4>
                                </div>
                
                                <div id="collapse<?php echo $row['class_id'];?>" class="panel-collapse collapse <?php if($toggle){echo 'in';$toggle=false;}?>">
                                    <div class="panel-body">
                                        <?php
                                            $query_for_section = $this->db->get_where('section' , array(
                                                'class_id' => $row['class_id']));
                                            if($query_for_section->num_rows() <= 0):
                                        ?>

                                        <table cellpadding="0" cellspacing="0" border="0"  class="table table-bordered">
                                            <tbody>
                                                <?php 
                        							for($d=1;$d<=7;$d++):
                        
                        							if($d==1)$day='E DIEL';
                        							else if($d==2)$day='E HENE';
                        							else if($d==3)$day='E MARTE';
                       	 							else if($d==4)$day='E MERKURE';
                        							else if($d==5)$day='E ENJTE';
                        							else if($d==6)$day='E PREMTE';
                        							else if($d==7)$day='E SHTUNE';
                        						?>
                                                <tr class="gradeA">
                                                    <td width="100"><?php echo strtoupper($day);?></td>
                                                    <td>
                                                        <?php
                                                        $this->db->order_by("time_start", "asc");
                                                        $this->db->where('day' , $day);
                                                        $this->db->where('class_id' , $row['class_id']);
                                                        $routines   =   $this->db->get('class_routine')->result_array();
                                                        foreach($routines as $row2):
                                                        ?>
                                                        <div class="btn-group">
                                                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                                <?php echo $this->crud_model->get_subject_name_by_id($row2['subject_id']);?>
                                                                <?php
                                                                    if ($row2['time_start_min'] == 0 && $row2['time_end_min'] == 0) 
                                                                        echo '('.$row2['time_start'].'-'.$row2['time_end'].')';
                                                                    if ($row2['time_start_min'] != 0 || $row2['time_end_min'] != 0)
                                                                        echo '('.$row2['time_start'].':'.$row2['time_start_min'].'-'.$row2['time_end'].':'.$row2['time_end_min'].')';
                                                                ?>
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_class_routine/<?php echo $row2['class_routine_id'];?>');">
                                                                    <i class="entypo-pencil"></i>
                                                                        <?php echo get_phrase('edit');?>
                                                                                </a>
                                                         </li>
                                                         
                                                         <li>
                                                            <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?accountant/class_routine/delete/<?php echo $row2['class_routine_id'];?>');">
                                                                <i class="entypo-trash"></i>
                                                                    <?php echo get_phrase('delete');?>
                                                                </a>
                                                            </li>
                                                            </ul>
                                                        </div>
                                                        <?php endforeach;?>

                                                    </td>
                                                </tr>
                                                <?php endfor;?>
                                                
                                            </tbody>
                                        </table>


                                        <?php endif;?>
                                        
                                    </div>
                                </div>
                            </div>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
            <!----FILLON LISTIMI I TABELES--->
            
            
            <!----FILLON FORMA E KRIJIMIT---->
            <div class="tab-pane box" id="add" style="padding: 5px">
            <br><br>
                <div class="box-content">
                    <?php echo form_open(base_url() . 'index.php?accountant/class_routine/create' , array('class' => 'form-horizontal form-groups validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                                <div class="col-sm-5">
                                    <select name="class_id" class="form-control" style="width:100%;"
                                        onchange="return get_class_section_subject(this.value)">
                                        <option value=""><?php echo get_phrase('select_class');?></option>
                                        <?php 
                                        $classes = $this->db->get('class')->result_array();
                                        foreach($classes as $row):
                                        ?>
                                            <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div id="section_subject_selection_holder"></div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('day');?></label>
                                <div class="col-sm-5">
                                    <select name="day" class="form-control selectboxit" style="width:100%;">
                                        <option value="E DIEL">e diel</option>
                        				<option value="E HENE">e hene</option>
                        				<option value="E MARTE">e marte</option>
                        				<option value="E MERKURE">e merkure</option>
                        				<option value="E ENJTE">e enjte</option>
                        				<option value="E PREMTE">e premte</option>
                        				<option value="E SHTUNE">e shtune</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('starting_time');?></label>
                                <div class="col-sm-9">
                                    <div class="col-md-3">
                                        <select name="time_start" class="form-control selectboxit">
                                            <option value=""><?php echo get_phrase('hour');?></option>
                                            <?php for($i = 0; $i <= 12 ; $i++):?>
                                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                            <?php endfor;?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="time_start_min" class="form-control selectboxit">
                                            <option value=""><?php echo get_phrase('minutes');?></option>
                                            <?php for($i = 0; $i <= 11 ; $i++):?>
                                                <option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
                                            <?php endfor;?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="starting_ampm" class="form-control selectboxit">
                                            <option value="1">am</option>
                                            <option value="2">pm</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('ending_time');?></label>
                                <div class="col-sm-9">
                                    <div class="col-md-3">
                                        <select name="time_end" class="form-control selectboxit">
                                            <option value=""><?php echo get_phrase('hour');?></option>
                                            <?php for($i = 0; $i <= 12 ; $i++):?>
                                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                            <?php endfor;?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="time_end_min" class="form-control selectboxit">
                                            <option value=""><?php echo get_phrase('minutes');?></option>  
                                            <?php for($i = 0; $i <= 11 ; $i++):?>
                                                <option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
                                            <?php endfor;?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="ending_ampm" class="form-control selectboxit">
                                            <option value="1">am</option>
                                            <option value="2">pm</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_class_routine');?></button>
                              </div>
                            </div>
                    </form>                
                </div>                
            </div>
            <!----MBARON FORMA E KRIJIMIT-->
            
        </div>
    </div>
</div>

<script type="text/javascript">
    function get_class_section_subject(class_id) {
        $.ajax({
            url: '<?php echo base_url();?>index.php?accountant/get_class_section_subject/' + class_id ,
            success: function(response)
            {
                jQuery('#section_subject_selection_holder').html(response);
            }
        });
    }
</script>

