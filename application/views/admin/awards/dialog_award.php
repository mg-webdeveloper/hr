<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['award_id']) && $_GET['data']=='award'){
?>
<?php $session = $this->session->userdata('username');?>
<?php $user_info = $this->Xin_model->read_user_info($session['user_id']);?>
<div class="modal-header">
  <?php echo form_button(array('aria-label' => 'Close', 'data-dismiss' => 'modal', 'type' => 'button', 'class' => 'close', 'content' => '<span aria-hidden="true">×</span>')); ?>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('xin_edit_award');?></h4>
</div>
<?php $attributes = array('name' => 'edit_award', 'id' => 'edit_award', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', '_token' => $award_id, 'ext_name' => $award_type_id);?>
<?php echo form_open('admin/awards/update/'.$award_id, $attributes, $hidden);?>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-6">
        <?php if($user_info[0]->user_role_id==1){ ?>
        <div class="form-group">
          <label for="first_name"><?php echo $this->lang->line('left_company');?></label>
          <select class="form-control" name="company_id" id="ajx_company" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('left_company');?>">
            <option value=""></option>
            <?php foreach($get_all_companies as $company) {?>
            <option value="<?php echo $company->company_id?>" <?php if($company->company_id==$company_id):?> selected <?php endif; ?>><?php echo $company->name?></option>
            <?php } ?>
          </select>
        </div>
        <?php } else {?>
        <?php $ecompany_id = $user_info[0]->company_id;?>
        <div class="form-group">
          <label for="first_name"><?php echo $this->lang->line('left_company');?></label>
          <select class="form-control" name="company_id" id="ajx_company" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('left_company');?>">
            <option value=""></option>
            <?php foreach($get_all_companies as $company) {?>
            <?php if($ecompany_id == $company->company_id):?>
            <option value="<?php echo $company->company_id?>" <?php if($company->company_id==$company_id):?> selected <?php endif; ?>><?php echo $company->name?></option>
            <?php endif;?>
            <?php } ?>
          </select>
        </div>
        <?php } ?>
        <div class="form-group" id="employee_ajx">
          <?php $result = $this->Department_model->ajax_company_employee_info($company_id);?>
          <label for="employee"><?php echo $this->lang->line('dashboard_single_employee');?></label>
          <select name="employee_id" id="select2-demo-6" class="form-control" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_choose_an_employee');?>">
            <option value=""></option>
            <?php foreach($result as $employee) {?>
            <option value="<?php echo $employee->user_id;?>" <?php if($employee->user_id==$employee_id):?> selected <?php endif; ?>> <?php echo $employee->first_name.' '.$employee->last_name;?></option>
            <?php } ?>
          </select>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="award_type"><?php echo $this->lang->line('xin_award_type');?></label>
              <select name="award_type_id" id="select2-demo-6" class="form-control" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_award_type');?>">
                <option value=""></option>
                <?php foreach($all_award_types as $award_type) {?>
                <option value="<?php echo $award_type->award_type_id;?>" <?php if($award_type->award_type_id==$award_type_id):?> selected <?php endif; ?>><?php echo $award_type->award_type;?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="award_date"><?php echo $this->lang->line('xin_e_details_date');?></label>
              <input class="form-control d_award_date" placeholder="<?php echo $this->lang->line('xin_award_date');?>" readonly="true" name="award_date" type="text" value="<?php echo $created_at;?>">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                  <label for="description"><?php echo $this->lang->line('xin_description');?></label>
                  <textarea class="form-control textarea" placeholder="<?php echo $this->lang->line('xin_description');?>" name="description" cols="30" rows="5" id="description2"><?php echo $description;?></textarea>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="month_year"><?php echo $this->lang->line('xin_award_month_year');?></label>
              <input class="form-control d_month_year" placeholder="<?php echo $this->lang->line('xin_award_month_year');?>" readonly="true" name="month_year" type="text" value="<?php echo $award_month_year;?>">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for="gift"><?php echo $this->lang->line('xin_gift');?></label>
          <input class="form-control" placeholder="<?php echo $this->lang->line('xin_gift');?>" name="gift" type="text" value="<?php echo $gift_item;?>">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="cash"><?php echo $this->lang->line('xin_cash');?></label>
          <input class="form-control" placeholder="<?php echo $this->lang->line('xin_cash');?>" name="cash" type="text" value="<?php echo $cash_price;?>">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <fieldset class="form-group">
            <label for="logo"><?php echo $this->lang->line('xin_award_photo');?></label>
            <input type="file" class="form-control-file" id="award_picture" name="award_picture">
            <small><?php echo $this->lang->line('xin_company_file_type');?></small>
          </fieldset>
        </div>
      </div>
      <div class="col-md-3">
        <div class='form-group'>
          <?php if($award_photo!='' && $award_photo!='no file') {?>
          <img src="<?php echo base_url().'uploads/award/'.$award_photo;?>" width="70px" id="u_file"> <a href="<?php echo site_url()?>admin/download?type=award&filename=<?php echo $award_photo;?>"><?php echo $this->lang->line('xin_download');?></a>
          <?php } else {?>
          <p>&nbsp;</p>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="award_information"><?php echo $this->lang->line('xin_award_info');?></label>
      <textarea class="form-control" placeholder="<?php echo $this->lang->line('xin_award_info');?>" name="award_information" cols="30" rows="3" id="award_information"><?php echo $award_information;?></textarea>
    </div>
  </div>
  <div class="modal-footer"> <?php echo form_button(array('data-dismiss' => 'modal', 'type' => 'button', 'class' => 'btn btn-secondary', 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('xin_close'))); ?> <?php echo form_button(array('name' => 'hrsale_form', 'type' => 'submit', 'class' => $this->Xin_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('xin_update'))); ?> </div>
<?php echo form_close(); ?>
<script type="text/javascript">
 $(document).ready(function(){
						
		jQuery("#ajx_company").change(function(){
			jQuery.get(base_url+"/get_employees/"+jQuery(this).val(), function(data, status){
				jQuery('#employee_ajx').html(data);
			});
		});
		
		$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
		$('[data-plugin="select_hrm"]').select2({ width:'100%' });	 
		// Award Date
		$('.d_award_date').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat:'yy-mm-dd',
		yearRange: '1900:' + (new Date().getFullYear() + 15),
		beforeShow: function(input) {
			$(input).datepicker("widget").show();
		}
		});
		// Award Month & Year
		$('.d_month_year').datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat:'yy-mm',
		yearRange: '1900:' + (new Date().getFullYear() + 15),
		beforeShow: function(input) {
			$(input).datepicker("widget").addClass('hide-calendar');
		},
		onClose: function(dateText, inst) {
			var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
			var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
			$(this).datepicker('setDate', new Date(year, month, 1));
			$(this).datepicker('widget').removeClass('hide-calendar');
			$(this).datepicker('widget').hide();
		}
			
		});
		
		$("#edit_award").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("edit_type", 'award');
		fd.append("form", action);
		e.preventDefault();
		$('.icon-spinner3').show();
		$('.save').prop('disabled', true);
		$.ajax({
			url: e.target.action,
			type: "POST",
			data:  fd,
			contentType: false,
			cache: false,
			processData:false,
			success: function(JSON)
			{
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
						$('.save').prop('disabled', false);
						$('.icon-spinner3').hide();
				} else {
					// On page load: datatable
					var xin_table = $('#xin_table').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("admin/awards/award_list") ?>",
							type : 'GET'
						},
						dom: 'lBfrtip',
						"buttons": ['csv', 'excel', 'pdf', 'print'], // colvis > if needed
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					xin_table.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
					$('.icon-spinner3').hide();
					$('.edit-modal-data').modal('toggle');
					$('.save').prop('disabled', false);
				}
			},
			error: function() 
			{
				toastr.error(JSON.error);
				$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
				$('.icon-spinner3').hide();
				$('.save').prop('disabled', false);
			} 	        
	   });
	});
	});	
  </script>
<?php } else if(isset($_GET['jd']) && isset($_GET['award_id']) && $_GET['data']=='view_award'){
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('xin_view_award');?></h4>
</div>
<form class="m-b-1">
  <div class="modal-body">
    <table class="footable-details table table-striped table-hover toggle-circle">
      <tbody>
        <tr>
          <th><?php echo $this->lang->line('module_company_title');?></th>
          <td style="display: table-cell;"><?php foreach($get_all_companies as $company) {?>
            <?php if($company_id==$company->company_id):?>
            <?php echo $company->name;?>
            <?php endif;?>
            <?php } ?></td>
        </tr>
        <tr>
          <th><?php echo $this->lang->line('dashboard_single_employee');?></th>
          <td style="display: table-cell;"><?php foreach($all_employees as $employee) {?>
            <?php if($employee_id==$employee->user_id):?>
            <?php echo $employee->first_name.' '.$employee->last_name;?>
            <?php endif;?>
            <?php } ?></td>
        </tr>
        <tr>
          <th><?php echo $this->lang->line('xin_award_type');?></th>
          <td style="display: table-cell;"><?php foreach($all_award_types as $award_type) {?>
            <?php if($award_type_id==$award_type->award_type_id):?>
            <?php echo $award_type->award_type;?>
            <?php endif;?>
            <?php } ?></td>
        </tr>
        <tr>
          <th><?php echo $this->lang->line('xin_e_details_date');?></th>
          <td style="display: table-cell;"><?php echo $this->Xin_model->set_date_format($created_at);?></td>
        </tr>
        <tr>
          <th><?php echo $this->lang->line('xin_award_month_year');?></th>
          <td style="display: table-cell;"><?php echo $award_month_year;?></td>
        </tr>
        <tr>
          <th><?php echo $this->lang->line('xin_gift');?></th>
          <td style="display: table-cell;"><?php echo $gift_item;?></td>
        </tr>
        <tr>
          <th><?php echo $this->lang->line('xin_cash');?></th>
          <td style="display: table-cell;"><?php echo $this->Xin_model->currency_sign($cash_price);?></td>
        </tr>
        <tr>
          <th><?php echo $this->lang->line('xin_award_photo');?></th>
          <td style="display: table-cell;"><?php if($award_photo!='' && $award_photo!='no file') {?>
            <img src="<?php echo base_url().'uploads/award/'.$award_photo;?>" width="70px" id="u_file">&nbsp; <a href="<?php echo site_url()?>admin/download?type=award&filename=<?php echo $award_photo;?>"><?php echo $this->lang->line('xin_download');?></a>
            <?php } ?></td>
        </tr>
        <tr>
          <th><?php echo $this->lang->line('xin_award_info');?></th>
          <td style="display: table-cell;"><?php echo html_entity_decode($award_information);?></td>
        </tr>
        <tr>
          <th><?php echo $this->lang->line('xin_description');?></th>
          <td style="display: table-cell;"><?php echo html_entity_decode($description);?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('xin_close');?></button>
  </div>
<?php echo form_close(); ?>
<?php }
?>
