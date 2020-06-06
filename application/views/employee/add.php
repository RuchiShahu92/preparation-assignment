<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$viewname = $this->router->uri->segments[1];
$formAction = !empty($editRecord) ? 'update_data' : 'insert_data';
$path = $viewname . '/' . $formAction;

?>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>bootstrap.js"></script>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>parsley.js"></script>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>App.js"></script>

<link rel="stylesheet" href="<?= $this->config->item('css_path') ?>css.css" type="text/css">
<link rel="stylesheet" href="<?= $this->config->item('css_path') ?>bootstrap.css" type="text/css">
<link rel="stylesheet" href="<?= $this->config->item('css_path') ?>App.css" type="text/css">
        
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Demo</title>
</head>
<body>

<div id="container">
	

	<div id="body" class="row">
		<div class="col-md-12">
            <div class="portlet">
                <div class="portlet-header" id="">
                    <h3> <i class="fa fa-user"></i><?= !empty($editRecord)?'Edit Employee':' Add Employee' ?></h3>
                </div>
            </div>
            <div class="col-sm-8">
            	<?php
                    $attributes = array('class' => 'form parsley-form', 'id' => $viewname, 'name' => $viewname);
                    echo form_open_multipart($this->config->item('employee_base_url') . '' . $path, $attributes);
                ?>   
                <div class="form-group">
                    <label for="select-multi-input"><?= $this->lang->line('employee_name') ?><span style="color:#F00">*</span></label>
                    <input id="name" name="empname" placeholder="Name" class="form-control parsley-validated" type="text" data-required="required" value="<?=!empty($editRecord[0]['name']) ? $editRecord[0]['name'] : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="select-multi-input"><?= $this->lang->line('department_name') ?><span style="color:#F00">*</span></label>
                     <select name="department" class="form-control parsley-validated"  data-required="required" >
                         <option value="">Select Department</option>
                     <?php 
                     	if(!empty($dept_list))
                     	{
                     		foreach($dept_list as $row)
                     		{	?>

                     			<option value="<?php echo $row['deptId'] ?>" <?php echo!empty($editRecord[0]['deptId']) ? ($editRecord[0]['deptId'] == $row['deptId']) ? 'selected=selected' : '' : ''; ?>><?=$row['deptName']?></option>
                 <?php		}
                     	}
                     ?></select>
                </div>
               
                 <div class="form-group">
                    <label for="select-multi-input"><?= $this->lang->line('address') ?></label>
                    <textarea id="address" name="address" placeholder="Address" class="form-control parsley-validated" ><?=!empty($editRecord[0]['address']) ? $editRecord[0]['address'] : ''; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="select-multi-input"><?= $this->lang->line('employee_salary') ?><span style="color:#F00">*</span></label>
                    <input id="salary" name="empsalary" placeholder="Employee Salary" maxlength="10" onkeypress="return isNumberKey(event)" class="form-control parsley-validated" type="text" data-required="required" value="<?=!empty($editRecord[0]['salary']) ? $editRecord[0]['salary'] : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="select-multi-input"><?= $this->lang->line('gender') ?><span style="color:#F00">*</span></label>
                    <input name="gender" class="parsley-validated" type="radio" data-required="required" value='Female'<?=!empty($editRecord[0]['gender'])?($editRecord[0]['gender']=='Female')?'checked=checked':'':'';?>>Female
                    <input name="gender" class="parsley-validated" type="radio" data-required="required" value='Male' <?=!empty($editRecord[0]['gender'])?($editRecord[0]['gender']=='Male')?'checked=checked':'':'';?>>Male
                </div>

                <div class="form-group">
                    <input type="hidden" name="id" id="exiting_id" value="<?= !empty($editRecord[0]['empId']) ? $editRecord[0]['empId'] : ''; ?>" />
                    <button type="submit"  class="btn btn-primary" id="save" title="Save" value="submitForm" name="save">Save</button>
                    <a class="btn btn-primary" id="Back"  href="<?= base_url($viewname . '/'); ?>"title="Back">Back</a>
                </div>
			</div>
	</div>

</body>
</html>
<script type="text/javascript">

//validation for numeric key
 function isNumberKey(evt)
    {
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;

            return true;
    }


//state wise city
function change_city(id)
{ 

   $('#cityid').html("<option value=''>Select City </option>");

   $.ajax({
             type: "POST",
             url: '<?php echo base_url().$viewname."/select_city"?>',
             dataType:'json',
             data: {
                result_type: 'ajax', stateid: id,
            },
            success: function(cities) //json response cities
            {  
                var select_city = 0;
                var selectedid = 0;
                <?php 
                // selected city when you are update the code

                    if(!empty($editRecord[0]['cityId']))
                    { ?>
                        select_city = "<?=$editRecord[0]['cityId']?>";
                        selectedid = 1;
              <?php }
                ?>
                $.each(cities,function(i,item) {
                    var opt = $('<option />'); 
                    opt.attr('value',item.cityId).text(this.cityName);

                    if(select_city == item.cityId && selectedid == 1)
                        opt.attr("selected","selected");

                    $('#cityid').append(opt); //append with dropdown 
                });
            }
         
    }); 
}
</script> 