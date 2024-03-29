<div class="box">
	<div class="box-header">
    
    	<!------FILLIMI I KONTROLL TABEVE------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_phrase');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('phrase_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_phrase');?>
                    	</a></li>
			<li class="">
            	<a href="#add_lang" data-toggle="tab"><i class="icon-plus"></i> 
					<?php echo get_phrase('add_language');?>
                    	</a></li>
		</ul>
    	<!------MBARIMI I KONTROLL TABEVE------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
            <!----FILLIMI I TABIT TE EDTIMIT TE FRAZES-->
            <?php if (isset($edit_profile)):?>
			<div class="tab-pane box active" id="edit" style="padding: 5px">
                <div class="box-content">

<button onClick="copy_language()">copy</button>

						<div class="row-fluid">
                    	<?php 
						$current_editing_language	=	$edit_profile;
						echo form_open(base_url().'index.php?accountant/manage_language/update_phrase/'.$current_editing_language  , array('id' => 'phrase_form'));
						$count = 1;
						$language_phrases	=	$this->db->query("SELECT `phrase_id` , `phrase` , `$current_editing_language` FROM `language`")->result_array();
						foreach($language_phrases as $row)
						{
							$phrase_id			=	$row['phrase_id'];					//NUMRI ID I FRAZES
							$phrase				=	$row['phrase'];						//TEKSTI BAZIK I FRAZES
							$phrase_language	=	$row[$current_editing_language];	//FRAZA NE GJUHEN KORRENTE TE EDITIMIT
							?>
                            <!----FILLIMI I BOX-IT TE FRAZES-->
                            
                            
							<div class="span3">
                            	<div class="box">
                                	<div class="box-title">
                                       <span class="title"><i class="icon-th-list"></i> <?php echo $count++;?>. <?php echo $row['phrase'];?></span>
                                    </div>
									
                                    <div class="box-content padded">
                                    
                                          <!--TEKST BOX-I PER EDITIMIN E FRAZES------>
                                          <input type="text" name="phrase<?php echo $row['phrase_id'];?>" 	
                                          	value="<?php echo $phrase_language;?>" style="width:95%;" 
                                            	id="copy_to_<?php echo $row['phrase_id'];?>" />
                                                
          <div id="copy_from_<?php echo $row['phrase_id'];?>"><?php echo ucwords(str_replace( '_' ,' ',$row['phrase']));?></div>
                                    </div>
								</div>
                            </div>
                            <!----MBARIMI I BOX-IT TE FRAZES-->
							<?php 
						}
						?>
						</div>
                        <input type="hidden" name="total_phrase" value="<?php echo $count;?>" />
                        <input type="submit" value="<?php echo get_phrase('update_phrase');?>" onClick="document.getElementById('phrase_form').submit();" class="btn btn-blue"/>	
                        <?php
						echo form_close();
						?>
                                     
                </div>                
			</div>
            <?php endif;?>
            <script>
			function copy_language()
			{
				<?php
				foreach($language_phrases as $row)
				{
					?>
				var copy_text = document.getElementById('copy_from_<?php echo $row['phrase_id'];?>').innerHTML;
				copy_text	= copy_text.replace('<font><font>' ,'');
				copy_text	= copy_text.replace('</font></font>' ,'');
				document.getElementById('copy_to_<?php echo $row['phrase_id'];?>').value = copy_text;
				<?php
				}
				?>
			}
		</script>
            <!----MBARIMI I TABIT TE EDITIMIT TE FRAZES-->
            
            <!----FILLON LISTIMI I TABELES--->
            <div class="tab-pane box span7 <?php if(!isset($edit_profile))echo 'active';?>" id="list">
                
                
                <table cellpadding="0" cellspacing="0" border="0" class="table table-normal">
                	<thead>
                    	<tr>
                        	<th><?php echo get_phrase('language');?></th>
                        	<th><?php echo get_phrase('option');?></th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php
								$fields = $this->db->list_fields('language');
								foreach($fields as $field)
								{
									 if($field == 'phrase_id' || $field == 'phrase')continue;
									?>
                    	<tr>
                        	<td><?php echo ucwords($field);?></td>
                        	<td>
                            	<a href="<?php echo base_url();?>index.php?accountant/manage_language/edit_phrase/<?php echo $field;?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit_phrase');?>" class="btn btn-blue">
                                		<i class="icon-wrench"></i>
                                </a>
                            	<a href="<?php echo base_url();?>index.php?accountant/manage_language/delete_language/<?php echo $field;?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete_language');?>" class="btn btn-gray" onclick="return confirm('Delete Language ?');">
                                		<i class="icon-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
			</div>
            <!----MBARON LISTIMI I TABELES--->
            
            
			<!----FILLON FORMA E KRIJIMIT TE FRAZES---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(base_url().'index.php?accountant/manage_language/add_phrase/' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('phrase');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="phrase"/>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_phrase');?></button>
                        </div>
                    <?php echo form_close();?>                
                </div>                
			</div>
			<!----MBARON FORMA E KRIJIMIT TE FRAZES--->
            
        	<!----FILLON SHTIMI I GJUHES SE RE---->
			<div class="tab-pane box" id="add_lang" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(base_url().'index.php?accountant/manage_language/add_language/' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('language');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="language"/>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_language');?></button>
                        </div>
                    <?php echo form_close();?> 
                </div>
			</div>
            <!----MBARON FORMA E SHTIMIT TE GJUHES SE RE--->
            
		</div>
	</div>
</div>>>>>>>>>