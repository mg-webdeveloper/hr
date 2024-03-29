<?php
/* Projects List view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php $get_animate = $this->Xin_model->get_content_animate();?>

<div class="row <?php echo $get_animate;?>">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="box box-body bg-hr-primary">
      <div class="flexbox"> <span class="fa fa-life-bouy text-primary font-size-50"></span> <span class="font-size-40 font-weight-400"><?php echo $this->Project_model->not_started_projects();?></span> </div>
      <div class="text-right"><?php echo $this->lang->line('xin_not_started');?></div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="box box-body bg-hr-danger">
      <div class="flexbox"> <span class="fa fa-server text-danger font-size-50"></span> <span class="font-size-40 font-weight-400"><?php echo $this->Project_model->inprogress_projects();?></span> </div>
      <div class="text-right"><?php echo $this->lang->line('xin_in_progress');?></div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="box box-body bg-hr-success">
      <div class="flexbox"> <span class="ion ion-thumbsup text-success font-size-50"></span> <span class="font-size-40 font-weight-400"><?php echo $this->Project_model->complete_projects();?></span> </div>
      <div class="text-right"><?php echo $this->lang->line('xin_completed');?></div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="box box-body bg-hr-yellow">
      <div class="flexbox"> <span class="fa fa-cube text-yellow font-size-50"></span> <span class="font-size-40 font-weight-400"><?php echo $this->Project_model->deffered_projects();?></span> </div>
      <div class="text-right"><?php echo $this->lang->line('xin_deffered');?></div>
    </div>
  </div>
</div>
<?php $role_resources_ids = $this->Xin_model->user_role_resource(); ?>
<?php if(in_array('315',$role_resources_ids)) {?>
<?php $user_info = $this->Xin_model->read_user_info($session['user_id']);?>
<div class="box mb-4 <?php echo $get_animate;?>">
  <div id="accordion">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo $this->lang->line('xin_add_new');?> <?php echo $this->lang->line('xin_project');?></h3>
      <div class="box-tools pull-right"> <a class="text-dark collapsed" data-toggle="collapse" href="#add_form" aria-expanded="false">
        <button type="button" class="btn btn-xs btn-primary"> <span class="ion ion-md-add"></span> <?php echo $this->lang->line('xin_add_new');?></button>
        </a> </div>
    </div>
    <div id="add_form" class="collapse add-form <?php echo $get_animate;?>" data-parent="#accordion" style="">
      <div class="box-body">
        <?php $attributes = array('name' => 'add_project', 'id' => 'xin-form', 'autocomplete' => 'off');?>
        <?php $hidden = array('user_id' => $session['user_id']);?>
        <?php echo form_open('admin/project/add_project', $attributes, $hidden);?>
        <div class="bg-white">
          <div class="box-block">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="title"><?php echo $this->lang->line('xin_title');?></label>
                  <input class="form-control" placeholder="<?php echo $this->lang->line('xin_title');?>" name="title" type="text">
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="client_id"><?php echo $this->lang->line('xin_client_name');?></label>
                      <select name="client_id" id="client_id" class="form-control" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_client_name');?>">
                        <option value=""></option>
                        <?php foreach($all_clients as $client) {?>
                        <option value="<?php echo $client->client_id;?>"> <?php echo $client->name;?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?php if($user_info[0]->user_role_id==1){ ?>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="company_id"><?php echo $this->lang->line('module_company_title');?></label>
                      <select name="company_id" id="aj_company" class="form-control" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('module_company_title');?>">
                        <option value=""></option>
                        <?php foreach($all_companies as $company) {?>
                        <option value="<?php echo $company->company_id;?>"> <?php echo $company->name;?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?php } else {?>
                  <?php $ecompany_id = $user_info[0]->company_id;?>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="company_id"><?php echo $this->lang->line('module_company_title');?></label>
                      <select name="company_id" id="aj_company" class="form-control" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('module_company_title');?>">
                        <option value=""></option>
                        <?php foreach($all_companies as $company) {?>
                        <?php if($ecompany_id == $company->company_id):?>
                        <option value="<?php echo $company->company_id;?>"> <?php echo $company->name;?></option>
                        <?php endif;?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?php } ?>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="start_date"><?php echo $this->lang->line('xin_start_date');?></label>
                      <input class="form-control date" placeholder="<?php echo $this->lang->line('xin_start_date');?>" readonly name="start_date" type="text">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="end_date"><?php echo $this->lang->line('xin_end_date');?></label>
                      <input class="form-control date" placeholder="<?php echo $this->lang->line('xin_end_date');?>" readonly name="end_date" type="text">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="employee"><?php echo $this->lang->line('xin_p_priority');?></label>
                      <select name="priority" id="select2-demo-6" class="form-control select-border-color border-warning" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_p_priority');?>">
                        <option value="1"><?php echo $this->lang->line('xin_highest');?></option>
                        <option value="2"><?php echo $this->lang->line('xin_high');?></option>
                        <option value="3"><?php echo $this->lang->line('xin_normal');?></option>
                        <option value="4"><?php echo $this->lang->line('xin_low');?></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="description"><?php echo $this->lang->line('xin_description');?></label>
                  <textarea class="form-control textarea" placeholder="<?php echo $this->lang->line('xin_description');?>" name="description" cols="30" rows="15" id="description"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group" id="employee_ajax">
                  <label for="employee"><?php echo $this->lang->line('xin_project_manager');?></label>
                  <select multiple name="assigned_to[]" id="select2-demo-6" class="form-control select-border-color border-warning" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_project_manager');?>">
                    <option value=""></option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="summary"><?php echo $this->lang->line('xin_summary');?></label>
                  <textarea class="form-control" placeholder="<?php echo $this->lang->line('xin_summary');?>" name="summary" cols="30" rows="1" id="summary"></textarea>
                </div>
              </div>
            </div>
            <div class="form-actions box-footer">
              <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('xin_save');?> </button>
            </div>
          </div>
        </div>
        <?php echo form_close(); ?> </div>
    </div>
  </div>
</div>
<?php } ?>
<div class="box <?php echo $get_animate;?>">
  <div class="box-header with-border">
    <h3 class="box-title"> <?php echo $this->lang->line('xin_list_all');?> <?php echo $this->lang->line('xin_projects');?> </h3>
  </div>
  <div class="box-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="xin_table">
        <thead>
          <tr>
            <th><?php echo $this->lang->line('xin_action');?></th>
            <th width="260"><?php echo $this->lang->line('xin_project_summary');?></th>
            <?php if(!in_array('386',$role_resources_ids)) {?>
            <th><?php echo $this->lang->line('xin_project_client');?></th>
            <?php } ?>
            <th><i class="fa fa-user"></i> <?php echo $this->lang->line('xin_project_users');?></th>
            <th><i class="fa fa-calendar"></i> <?php echo $this->lang->line('xin_p_enddate');?></th>
            <th><?php echo $this->lang->line('dashboard_xin_progress');?></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
