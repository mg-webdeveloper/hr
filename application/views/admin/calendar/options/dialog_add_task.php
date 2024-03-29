<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['is_ajax']) && $_GET['data']=='event'){
$session = $this->session->userdata('username');
?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"> <?php echo $this->lang->line('xin_add_new');?> <?php echo $this->lang->line('xin_task');?></h4>
</div>
<?php $attributes = array('name' => 'add_task', 'id' => 'xin-form', 'autocomplete' => 'off', 'class' => 'm-b-1');?>
<?php $hidden = array('user_id' => $session['user_id']);?>
<?php echo form_open('admin/timesheet/add_task', $attributes, $hidden);?>
  <div class="modal-body">
    <div class="bg-white">
      <div class="box-block">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="company_name"><?php echo $this->lang->line('module_company_title');?></label>
              <select class="form-control" name="company_id" id="aj_company" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('module_company_title');?>">
                <option value=""><?php echo $this->lang->line('xin_select_one');?></option>
                <?php foreach($all_companies as $company) {?>
                <option value="<?php echo $company->company_id;?>"> <?php echo $company->name;?></option>
                <?php } ?>
              </select>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="start_date"><?php echo $this->lang->line('xin_start_date');?></label>
                  <input class="form-control edate" placeholder="<?php echo $this->lang->line('xin_start_date');?>" readonly name="start_date" type="text" value="<?php echo $_GET['event_date'];?>" id="start_date">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="end_date"><?php echo $this->lang->line('xin_end_date');?></label>
                  <input class="form-control edate" placeholder="<?php echo $this->lang->line('xin_end_date');?>" readonly name="end_date" type="text" value="<?php echo $_GET['event_date'];?>" id="end_date">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group" id="project_ajax">
                  <label for="project_ajax" class="control-label"><?php echo $this->lang->line('xin_project');?></label>
                  <select class="form-control" name="project_id" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_project');?>">
                    <option value=""></option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="task_name"><?php echo $this->lang->line('dashboard_xin_title');?></label>
                  <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_xin_title');?>" id="task_name" name="task_name" type="text" value="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="task_hour" class="control-label"><?php echo $this->lang->line('xin_estimated_hour');?></label>
                  <input class="form-control" placeholder="<?php echo $this->lang->line('xin_estimated_hour');?>" name="task_hour" type="text" value="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group" id="employee_ajax">
                  <label for="employees" class="control-label"><?php echo $this->lang->line('xin_assigned_to');?></label>
                  <select multiple class="form-control" name="assigned_to[]" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('dashboard_single_employee');?>">
                    <option value=""></option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="description"><?php echo $this->lang->line('xin_description');?></label>
                <textarea class="form-control textarea" placeholder="<?php echo $this->lang->line('xin_description');?>" name="description" id="description"></textarea>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('xin_close');?></button>
    <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('xin_save');?> </button>
  </div>
<?php echo form_close(); ?>
<script type="application/javascript">
$(document).ready(function() {
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });
	$('#description').trumbowyg({
		btns: [
			['formatting'],
			'btnGrp-semantic',
			['superscript', 'subscript'],
			['removeformat'],
		],
		autogrowOnEnter: true
	});
	// Date
	$('.edate').datepicker({
	  changeMonth: true,
	  changeYear: true,
	  dateFormat:'yy-mm-dd',
	  yearRange: new Date().getFullYear() + ':' + (new Date().getFullYear() + 10),
	});
	jQuery("#aj_company").change(function(){
		jQuery.get(site_url+"timesheet/get_company_project/"+jQuery(this).val(), function(data, status){
			jQuery('#project_ajax').html(data);
		});
		jQuery.get(site_url+"timesheet/get_company_employees/"+jQuery(this).val(), function(data, status){
			jQuery('#employee_ajax').html(data);
		});
	});
	/* Add data */ /*Form Submit*/
	$("#xin-form").submit(function(e){
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=1&add_type=task&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					var myCalendar = $('#calendar_hr'); 
					myCalendar.fullCalendar();
					var myEvent = {
					  task_id: JSON.re_last_id,
					  unq: '7',	
					  title: $('#task_name').val(),
					  start: $('#start_date').val(),
					  end: $('#end_date').val(),
					  color: '#6C5B7B'
					};
					myCalendar.fullCalendar( 'renderEvent', myEvent );
					$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
					$('.view-modal-data').modal('toggle');
					$('#module-opt').hide();
					window.location = '';
				}
			}
		});
	});
});
</script>
<?php } ?>
