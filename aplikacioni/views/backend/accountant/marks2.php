<div class="row">
	<div class="col-md-12">
    
    	<!---FILLIMI I KONTROLL TABEVE--->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('manage_marks');?>
                    	</a></li>
		</ul>
    	<!--MBARIMI I KONTROLL TABEVE-->
        
	
            <!--FILLON LISTIMI I TABELES-->
            <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">
				<center>
                <?php echo form_open(base_url() . 'index.php?accountant/marks2');?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                	<tr>
                        <td><?php echo get_phrase('select_exam');?></td>
                        <td><?php echo get_phrase('select_class');?></td>
                        <td><?php echo get_phrase('select_subject');?></td>
                        <td>&nbsp;</td>
                	</tr>
                	<tr>
                        <td>
                        	<select name="exam_id" class="form-control"  style="float:left;">
                                <option value=""><?php echo get_phrase('select_an_exam');?></option>
                                <?php
                                $this->db->where('year' , $running_year); 
                                $exams = $this->db->get('exam')->result_array();
                                foreach($exams as $row):
                                ?>
                                    <option value="<?php echo $row['exam_id'];?>"
                                        <?php if($exam_id == $row['exam_id'])echo 'selected';?>>
                                            <?php echo get_phrase('class');?> <?php echo $row['name'];?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </td>
                        <td>
                        	<select name="class_id" class="form-control"  onchange="show_subjects(this.value)"  style="float:left;">
                                <option value=""><?php echo get_phrase('select_a_class');?></option>
                                <?php 
                                $classes = $this->db->get('class')->result_array();
                                foreach($classes as $row):
                                ?>
                                    <option value="<?php echo $row['class_id'];?>"
                                        <?php if($class_id == $row['class_id'])echo 'selected';?>>
                                            Klasa <?php echo $row['name'];?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </td>
                        <td>
                        	<!---ZGJIDHET LENDA NE PERPUTHJE ME KLASEN E ZGJEDHUR--->
							<?php 
                                $classes	=	$this->crud_model->get_classes(); 
                                foreach($classes as $row): ?>
                                
                                <select name="<?php if($class_id == $row['class_id'])echo 'subject_id';else echo 'temp';?>" 
                                      id="subject_id_<?php echo $row['class_id'];?>" 
                                          style="display:<?php if($class_id == $row['class_id'])echo 'block';else echo 'none';?>;" class="form-control"  style="float:left;">
                                  
                                    <option value="">Lenda e klases<?php echo $row['name'];?></option>
                                    
                                    <?php
                                    $this->db->where('year' , $running_year);
                                    $this->db->where('class_id' , $row['class_id']); 
                                    $subjects	=	$this->db->get('subject')->result_array(); 
                                    foreach($subjects as $row2): ?>
                                    <option value="<?php echo $row2['subject_id'];?>"
                                        <?php if(isset($subject_id) && $subject_id == $row2['subject_id'])
                                                echo 'selected="selected"';?>><?php echo $row2['name'];?>
                                    </option>
                                    <?php endforeach;?>
                                    
                                    
                                </select> 
                            <?php endforeach;?>
                            
                            
                            <select name="temp" id="subject_id_0" 
                              style="display:<?php if(isset($subject_id) && $subject_id >0)echo 'none';else echo 'block';?>;" class="form-control" style="float:left;">
                                    <option value="">Zgjidh klasen me pare</option>
                            </select>
                        </td>
                        <td>
                        	<input type="hidden" name="operation" value="selection" />
                    		<input type="submit" value="<?php echo get_phrase('manage_marks');?>" class="btn btn-info" />
                        </td>
                	</tr>
                </table>
                </form>
                </center>
                
                
                <br /><br />
                
                
                <?php if($exam_id >0 && $class_id >0 && $subject_id >0 ):?>
                <?php 
						////KRIJON HYRJEN E PIKEVE VETEM NESE NUK EKZISTON////
						$students	=	$this->db->get_where('enroll' , array(
                            'year' => $running_year , 'class_id' => $class_id
                        ))->result_array();
						foreach($students as $row):
							$verify_data	=	array(	'exam_id'         => $exam_id ,
														'class_id'        => $class_id ,
														'subject_id'      => $subject_id ,
                                                        'year'            => $running_year, 
														'student_id'      => $row['student_id']);
							$query = $this->db->get_where('mark' , $verify_data);
							
							if($query->num_rows() < 1)
								$this->db->insert('mark' , $verify_data);
						 endforeach;
				?>
                <table class="table table-bordered" >
                    <thead>
                        <tr>
                            <td><?php echo get_phrase('student');?></td>
                            <td><?php echo get_phrase('mark_obtained');?>(nga gjithesej 100)</td>
                            <td><?php echo get_phrase('comment');?></td>
                        </tr>
                    </thead>
                    <tbody>
                    	
                        <?php 
						$students	=	$this->db->get_where('enroll' , array(
                            'year' => $running_year , 'class_id' => $class_id
                        ))->result_array();
						foreach($students as $row):
						
							$verify_data	=	array(	'exam_id' => $exam_id ,
														'class_id' => $class_id ,
														'subject_id' => $subject_id ,
                                                        'year' => $running_year, 
														'student_id' => $row['student_id']);
														
							$query = $this->db->get_where('mark' , $verify_data);							 
							$marks	=	$query->result_array();
							foreach($marks as $row2):
							?>
                            <?php echo form_open(base_url() . 'index.php?accountant/marks2/' . $exam_id . '/' . $class_id);?>
							<tr>
								<td>
									<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
								</td>
								<td>
									 <input type="number" value="<?php echo $row2['mark_obtained'];?>" name="mark_obtained_<?php echo $row['student_id'];?>" class="form-control" >
												
								</td>
								<td>
									<textarea name="comment_<?php echo $row['student_id'];?>" class="form-control"><?php echo $row2['comment'];?></textarea>
								</td>
                                	<input type="hidden" name="mark_id_<?php echo $row['student_id'];?>" value="<?php echo $row2['mark_id'];?>" />
                                    
                                	<input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
                                	<input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
                                	<input type="hidden" name="subject_id" value="<?php echo $subject_id;?>" />
                                    
                                	<input type="hidden" name="operation" value="update" />
							 </tr>

                            
                         	<?php 
							endforeach;
						 endforeach;
						 ?>
                     </tbody>
                  </table>

                  <center>
                      <button type="submit" class="btn btn-primary"><?php echo get_phrase('update_marks');?></button>
                  </center>
                  <?php echo form_close();?>
            
            <?php endif;?>
			</div>
            <!--MBARON LISTIMI I TABELES-->
            
		</div>
	</div>
</div>



<script type="text/javascript">
  function show_subjects(class_id)
  {
      for(i=0;i<=100;i++)
      {

          try
          {
              document.getElementById('subject_id_'+i).style.display = 'none' ;
	  		  document.getElementById('subject_id_'+i).setAttribute("name" , "temp");
          }
          catch(err){}
      }
      document.getElementById('subject_id_'+class_id).style.display = 'block' ;
	  document.getElementById('subject_id_'+class_id).setAttribute("name" , "subject_id");
  }

</script> 