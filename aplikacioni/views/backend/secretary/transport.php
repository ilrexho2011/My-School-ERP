<hr />
<div class="row">
	<div class="col-md-12">
    
    	<!---FILLIMI I KONTROLL TABEVE-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('transport_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_transport');?>
                    	</a></li>
		</ul>
    	<!---MBARIMI I KONTROLL TABEVE-->
        
	
		<div class="tab-content">
        <br>
            <!--FILLON LISTIMI I TABELES-->
            <div class="tab-pane box active" id="list">
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('route_name');?></div></th>
                    		<th><div><?php echo get_phrase('number_of_vehicle');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                    		<th><div><?php echo get_phrase('route_fare');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($transports as $row):?>
                        <tr>
							<td><?php echo $row['route_name'];?></td>
							<td><?php echo $row['number_of_vehicle'];?></td>
							<td><?php echo $row['description'];?></td>
							<td><?php echo $row['route_fare'];?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!-- NXENES NE TRANSPORT -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_transport_student/<?php echo $row['transport_id'];?>');">
                                            <i class="entypo-users"></i>
                                                <?php echo get_phrase('students');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- LINKU I EDITIMIT -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_transport/<?php echo $row['transport_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- LINKU I FSHIRJES -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?secretary/transport/delete/<?php echo $row['transport_id'];?>');">
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
            <!--MBARON LISTIMI I TABELES-->
            
            
			<!--FILLON FORMA E KRIJIMIT-->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?secretary/transport/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('route_name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="route_name"
                                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('number_of_vehicle');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="number_of_vehicle"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="description"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('route_fare');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="route_fare"/>
                                </div>
                            </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_transport');?></button>
                              </div>
							</div>
                    </form>                
                </div>                
			</div>
			<!--MBARON FORMA E KRIJIMIT-->
            
		</div>
	</div>
</div>