<?php
/* Location view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php $get_animate = $this->Xin_model->get_content_animate();?>
<?php $role_resources_ids = $this->Xin_model->user_role_resource(); ?>
<?php if(in_array('394',$role_resources_ids)) {?>
<div class="box mb-4 <?php echo $get_animate;?>">
  <div id="accordion">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo $this->lang->line('xin_add_new');?> <?php echo $this->lang->line('xin_hrsale_custom_field');?></h3>
      <div class="box-tools pull-right"> <a class="text-dark collapsed" data-toggle="collapse" href="#add_form" aria-expanded="false">
        <button type="button" class="btn btn-xs btn-primary"> <span class="ion ion-md-add"></span> <?php echo $this->lang->line('xin_add_new');?></button>
        </a> </div>
    </div>
    <div id="add_form" class="collapse add-form <?php echo $get_animate;?>" data-parent="#accordion" style="">
      <div class="box-body">
        <?php $attributes = array('name' => 'add_custom_field', 'id' => 'xin-form', 'autocomplete' => 'off', 'class' => 'm-b-1 add');?>
        <?php $hidden = array('user_id' => $session['user_id']);?>
        <?php echo form_open('admin/custom_fields/add_custom_field', $attributes, $hidden);?>
        <div class="form-body">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="name"><?php echo $this->lang->line('xin_name');?></label>
                <input class="form-control" placeholder="<?php echo $this->lang->line('xin_name');?>" name="attribute" type="text">
              </div>
             </div>
             <div class="col-md-3"> 
              <div class="form-group">
                <label for="email"><?php echo $this->lang->line('xin_hrsale_field_label');?></label>
                <input class="form-control" placeholder="<?php echo $this->lang->line('xin_hrsale_field_label');?>" name="attribute_label" type="text">
              </div>
          </div>
          <div class="col-md-3">
              
                <div class="form-group">
                    <label for="priority"><?php echo $this->lang->line('xin_p_priority');?></label>
                    <input class="form-control" placeholder="<?php echo $this->lang->line('xin_p_priority');?>" name="priority" type="text">
                  </div>
                  
                </div>
                <div class="col-md-3">  
                  <div class="form-group">
                    <label for="xin_faxn"><?php echo $this->lang->line('xin_hrsale_field_validation');?></label>
                    <select class="form-control" id="validation" name="validation" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_select_one');?>">
                    <option value="0">None</option>
                    <option value="1">Required</option>
                    </select>
                  </div>
             </div>
          </div>
          <div class="row">
             <div class="col-md-3">      
              <div class="form-group">
                    <label for="phone"><?php echo $this->lang->line('xin_hrsale_field_types');?></label>
                    <select class="form-control" id="attribute_type" name="attribute_type" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_select_one');?>">
                    <option value="text">Text Field</option>
                    <option value="textarea">Text Area</option>
                    <option value="select">Select</option>
                    <option value="multiselect">Multi Select</option>
                    <option value="fileupload">File Upload</option>
                    <option value="date">Date</option>
                    </select>
                  </div>
            </div>
            <div class="col-md-3">      
              <div class="form-group" id="add_items" style="display:none;">
                    <label for="more_items">&nbsp;</label><br />
                    <button type="button" class="btn btn-primary add" onclick="new_link();">Add Labels</button>
                  </div>
            </div>
            </div>
            <div class="row" id="newlinktpl" style="display:none">
              <div class="col-md-6"> 
                  <div class="form-group">
                    <label for="field_label"><?php echo $this->lang->line('xin_field_label');?></label>
                    <input class="form-control" placeholder="<?php echo $this->lang->line('xin_field_label');?>" name="select_value[]" type="text">
                  </div>
              </div>
            </div>
            <div class="row" id="newlink" style="display:block"></div>
        </div>
        <div class="form-actions box-footer">
          <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('xin_save');?> </button>
        </div>
        <?php echo form_close(); ?> </div>
    </div>
  </div>
</div>
<?php } ?>
<div class="box <?php echo $get_animate;?>">
  <div class="box-header with-border">
    <h3 class="box-title"> <?php echo $this->lang->line('xin_list_all');?> <?php echo $this->lang->line('xin_hrsale_custom_fields');?> </h3>
  </div>
  <div class="box-body">
    <div class="card-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="xin_table">
        <thead>
          <tr>
            <th><?php echo $this->lang->line('xin_action');?></th>
            <th><?php echo $this->lang->line('xin_name');?></th>
            <th><?php echo $this->lang->line('xin_hrsale_field_label');?></th>
            <th><?php echo $this->lang->line('xin_hrsale_field_types');?></th>
            <th><?php echo $this->lang->line('xin_hrsale_field_validation');?></th>
            <th><?php echo $this->lang->line('xin_p_priority');?></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
<style>
   #newlink {width:600px}
</style>