<?php
/* Generate Payslip view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php $user_info = $this->Xin_model->read_user_info($session['user_id']);?>
<?php $role_resources_ids = $this->Xin_model->user_role_resource();?>
<div class="row">
  <div class="col-md-7">
    <div class="box mb-4">
      <div class="box-header with-border">
        <h3 class="box-title"> <?php echo $this->lang->line('left_generate_payslip');?> </h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <?php $attributes = array('name' => 'set_salary_details', 'id' => 'set_salary_details', 'class' => 'm-b-1 add form-hrm');?>
            <?php $hidden = array('user_id' => $session['user_id']);?>
            <?php echo form_open('admin/payroll/set_salary_details', $attributes, $hidden);?>
            <div class="row">
              <?php if($user_info[0]->user_role_id==1 || in_array('314',$role_resources_ids)){ ?>
              <div class="col-md-4">
                <?php if($user_info[0]->user_role_id==1){ ?>
                <div class="form-group">
                  <label for="department"><?php echo $this->lang->line('module_company_title');?></label>
                  <select class="form-control" name="company" id="aj_company" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('module_company_title');?>" required>
                    <option value="0"><?php echo $this->lang->line('xin_all_companies');?></option>
                    <?php foreach($all_companies as $company) {?>
                    <option value="<?php echo $company->company_id;?>"> <?php echo $company->name;?></option>
                    <?php } ?>
                  </select>
                </div>
                <?php } else {?>
                <?php $ecompany_id = $user_info[0]->company_id;?>
                <div class="form-group">
                  <label for="department"><?php echo $this->lang->line('module_company_title');?></label>
                  <select class="form-control" name="company" id="aj_company" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('module_company_title');?>" required>
                    <option value=""><?php echo $this->lang->line('module_company_title');?></option>
                    <?php foreach($all_companies as $company) {?>
                    <?php if($ecompany_id == $company->company_id):?>
                    <option value="<?php echo $company->company_id;?>"> <?php echo $company->name;?></option>
                    <?php endif;?>
                    <?php } ?>
                  </select>
                </div>
                <?php } ?>
              </div>
              <div class="col-md-4">
                <div class="form-group" id="employee_ajax">
                  <label for="department"><?php echo $this->lang->line('dashboard_single_employee');?></label>
                  <select id="employee_id" name="employee_id" class="form-control" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_choose_an_employee');?>">
                    <option value="0"><?php echo $this->lang->line('xin_all_employees');?></option>
                  </select>
                </div>
              </div>
              <?php } else {?>
              <input type="hidden" name="employee_id" id="employee_id" value="<?php echo $session['user_id'];?>" />
              <?php } ?>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="month_year"><?php echo $this->lang->line('xin_select_month');?></label>
                  <input class="form-control month_year" placeholder="<?php echo $this->lang->line('xin_select_month');?>" readonly id="month_year" name="month_year" type="text" value="<?php echo date('Y-m');?>">
                </div>
              </div>
            </div>
            <?php
            if($user_info[0]->user_role_id==1 || in_array('314',$role_resources_ids)){
				$colmd = '12';
			} else {
				$colmd = '4';
			}
			?>
            <div class="row">
              <div class="col-md-<?php echo $colmd;?>">
                <div class="form-group">
                  <div class="form-actions">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('xin_search');?> </button>
                  </div>
                </div>
              </div>
            </div>
            <?php echo form_close(); ?> </div>
        </div>
      </div>
    </div>
  </div>
  <?php if($user_info[0]->user_role_id==1 || in_array('314',$role_resources_ids)){ ?>
  <div class="col-md-5">
    <div class="box mb-4">
      <div class="box-header with-border">
        <h3 class="box-title"> <?php echo $this->lang->line('xin_payroll_bulk_payment');?> </h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <?php $attributes = array('name' => 'bulk_payment', 'id' => 'bulk_payment', 'class' => 'm-b-1 add form-hrm');?>
            <?php $hidden = array('user_id' => $session['user_id']);?>
            <?php echo form_open('admin/payroll/add_pay_to_all', $attributes, $hidden);?>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="month_year"><?php echo $this->lang->line('xin_select_month');?></label>
                  <input class="form-control month_year" placeholder="<?php echo $this->lang->line('xin_select_month');?>" readonly id="bmonth_year" name="month_year" type="text" value="<?php echo date('Y-m');?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="form-actions">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('xin_payroll_bulk_payment');?> </button>
                  </div>
                </div>
              </div>
            </div>
            <?php echo form_close(); ?> </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"> <?php echo $this->lang->line('xin_payment_info_for');?> <span class="text-danger" id="p_month"><?php echo date('Y-m');?></span> </h3>
  </div>
  <div class="box-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="xin_table">
        <thead>
          <tr>
            <th width="120"><?php echo $this->lang->line('xin_action');?></th>
            <th><?php echo $this->lang->line('xin_name');?></th>
            <th><?php echo $this->lang->line('xin_salary_type');?></th>
            <th><i class="fa fa-dollar"></i> <?php echo $this->lang->line('xin_payroll_basic_salary');?></th>
            <th><i class="fa fa-dollar"></i> <?php echo $this->lang->line('xin_payroll_net_salary');?></th>
            <th><?php echo $this->lang->line('dashboard_xin_status');?></th>
            
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
<style type="text/css">
.hide-calendar .ui-datepicker-calendar { display:none !important; }
.hide-calendar .ui-priority-secondary { display:none !important; }
</style>
