<hr />
<div class="row">
	<div class="col-md-12">
    
    	<!--FILLIMI I KONTROLL TABEVE-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('dormitory_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_dormitory');?>
                    	</a></li>
		</ul>
    	<!--MBARIMI I KONTROLL TABEVE-->
        
	
		<div class="tab-content">
        <br>
            <!--FILLON LISTIMI I TABELES-->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('dormitory_name');?></div></th>
                    		<th><div><?php echo get_phrase('number_of_room');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($dormitories as $row):?>
                        <tr>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['number_of_room'];?></td>
							<td><?php echo $row['description'];?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Veprim <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!-- NXENES NE FJETINE -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_dormitory_student/<?php echo $row['dormitory_id'];?>');">
                                            <i class="entypo-users"></i>
                                                <?php echo get_phrase('students');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- LINKU I EDITIMIT -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_dormitory/<?php echo $row['dormitory_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- LINKU I FSHIRJES -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?accountant/dormitory/delete/<?php echo $row['dormitory_id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                                    </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----MBARON LISTIMI I TABELES--->
            
            
			<!----FILLON FORMA E KRIJIMIT---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?accountant/dormitory/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('dormitory_name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name"
                                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('number_of_room');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="number_of_room"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="description"/>
                                </div>
                            </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_dormitory');?></button>
                              </div>
							</div>
                    </form>                
                </div>                
			</div>
			<!----FILLON FORMA E KRIJIMIT-->
            
		</div>
	</div>
</div>