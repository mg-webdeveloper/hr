<?php $theme = $this->Xin_model->read_theme_info(1);?>
<?php $company = $this->Xin_model->read_company_setting_info(1);?>
<link rel="stylesheet" href="<?php echo base_url();?>skin/hrsale_assets/vendor/orgchart/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>skin/hrsale_assets/vendor/orgchart/css/jquery.orgchart.css">
<link rel="stylesheet" href="<?php echo base_url();?>skin/hrsale_assets/vendor/orgchart/css/style.css">
<style type="text/css">
.orgchart {
	background: #fff;
}
#chart-container {
 <?php if($theme[0]->org_chart_layout=='t2b' || $theme[0]->org_chart_layout=='b2t'):?>  text-align: center !important;
 <?php elseif($theme[0]->org_chart_layout=='l2r'):?>  text-align: left !important;
 <?php elseif($theme[0]->org_chart_layout=='r2l'):?>  text-align: right !important;
 <?php endif;
?>
}
</style>
<script type="text/javascript" src="<?php echo base_url();?>skin/hrsale_assets/vendor/orgchart/js/html2canvas.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>skin/hrsale_assets/vendor/orgchart/js/jquery.orgchart.js"></script>
<?php $department = get_main_departments_employees();?>
<script type="text/javascript">
    $(function() {
    var datascource = {
      'name': '<?php echo $company[0]->company_name;?>',
      'title': '<?php echo $this->lang->line('xin_company_administrator');?>',
      'children': [
	  <?php foreach($department as $r){ ?>
		{ 'name': '<?php echo $r->first_name.' '.$r->first_name;?>', 'title': '<?php echo $r->department_name;?>',
		<?php $subdepartment = get_sub_departments_employees($r->department_id,$r->employee_id);?>
		'children': [
			<?php foreach($subdepartment as $sr){ ?>
			{ 'name': '<?php echo $sr->first_name.' '.$sr->first_name;?>', 'title': '<?php echo $sr->department_name;?>',
				<?php $subdesign = get_sub_departments_designations($sr->designation_id,$sr->employee_id,$r->employee_id);?>
				'children': [
					<?php foreach($subdesign as $sdesign){ ?>
					{ 'name': '<?php echo $sdesign->first_name.' '.$sdesign->first_name;?>', 'title': '<?php echo $sdesign->designation_name;?>',
					},
					<?php }?>
				]
			},
			<?php }?>
			]
		},
		<?php }?>
	  ]
	  
    };

    $('#chart-container').orgchart({
      'data' : datascource,
      'visibleLevel': 4,
      'nodeContent': 'title',
      'exportButton': <?php echo $theme[0]->export_orgchart;?>,
      'exportFilename': '<?php echo $theme[0]->export_file_title;?>',
	  'pan': <?php echo $theme[0]->org_chart_pan;?>,
      'zoom': <?php echo $theme[0]->org_chart_zoom;?>,
      'direction': '<?php echo $theme[0]->org_chart_layout;?>'
    });

  });
  </script>
