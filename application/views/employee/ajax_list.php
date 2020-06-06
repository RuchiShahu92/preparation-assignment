<?php
/*
  @Description: Employee list
  @Author: Ruchi Shahu 
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<?php
$viewname = $this->router->uri->segments[1];
$path_comman = $this->config->item('employee_base_url') . $viewname . '/';
?>

<table class="table table-striped table-bordered table-hover table-highlight table-checkable dataTable-helper dataTable datatable-columnfilter" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
    <thead>
        <tr role="row">
   			<th><?php echo $this->lang->line('employee_name') ?></th>
			<th><?php echo $this->lang->line('employee_salary') ?></th>
			<th><?php echo $this->lang->line('department_name') ?></th>
			<th><?php echo $this->lang->line('gender') ?></th>
			<th><?php echo $this->lang->line('address') ?></th>
			<th ><?php echo $this->lang->line('common_label_action') ?></th>
		</tr>
	</thead>

<tbody role="alert" aria-live="polite" aria-relevant="all">
    <?php
    if (!empty($datalist) && count($datalist) > 0) {

        $i = !empty($this->router->uri->segments[3]) ? $this->router->uri->segments[3] + 1 : 1;
?>
        <tr>
            <td><input type="text" onchange="search_text('name')" id="name" name="search_text"
             value="<?=!empty($search_field) && (!empty($search_keyword)) && ($search_field =='name') ? $search_keyword:'';?>"/></td>
            <td><input type="text" onchange="search_text('salary')" id="salary" name="search_text"
                 value="<?=!empty($search_field) && (!empty($search_keyword)) && ($search_field =='salary') ? $search_keyword:'';?>"/></td>
            <td><input type="text" onchange="search_text('deptName')" id="deptName" name="search_text"
                 value="<?=!empty($search_field) && (!empty($search_keyword)) && ($search_field =='deptName') ? $search_keyword:'';?>"/></td>
            <td><input type="text" onchange="search_text('gender')" id="gender" name="search_text"
                 value="<?=!empty($search_field) && (!empty($search_keyword)) && ($search_field =='gender') ? $search_keyword:'';?>"/></td>
            <td><input type="text" onchange="search_text('address')" id="address" name="search_text"
                 value="<?=!empty($search_field) && (!empty($search_keyword)) && ($search_field =='address') ? $search_keyword:'';?>"/></td>
        </tr>
        <?php 
        foreach ($datalist as $row) {
            ?>
            <tr <? if ($i % 2 == 1) { ?>class="bgtitle" <? } ?> >
                
                <td class="hidden-xs hidden-sm "><?php echo ucfirst($row['name']) ?></td>
                <td class="hidden-xs hidden-sm "><?php echo $row['salary'] ?></td>
                <td class="hidden-xs hidden-sm "><?php echo ucfirst($row['deptName']) ?></td>
                <td class="hidden-xs hidden-sm "><?php echo $row['gender'] ?></td>
                <td class="hidden-xs hidden-sm "><?php echo $row['address'] ?></td>
                <td class="hidden-xs hidden-sm text-left">
                    <a class="btn btn-xs btn-success" href="<?= $this->config->item('employee_base_url') . $viewname; ?>/edit_data/<?= $row['id'] ?>" title="<?php echo $this->lang->line('edit_record'); ?>">Edit</a>
                    <button class="btn btn-xs btn-primary" title="<?php echo $this->lang->line('delete_record'); ?>"  onclick="deletepopup('<?php echo $row['id'] ?>', '<?php echo rawurlencode(ucfirst(strtolower($row['name']))) ?>', '<?= $path_comman ?>');"> Delete </button>
                </td>
            </tr>
        <?php
        }
    } else {
        ?>
        <tr>
            <td class="text-center" colspan="100%">
                No Emloyee Found
            </td>
        </tr> 
<?php } ?>
</tbody>
</table>
<div class="row dt-rb">
    <div class="col-sm-6"> </div>
    <div class="col-sm-6">
        <div class="dataTables_paginate  paging_bootstrap float-right" id="common_tb">
            <?php
            if (isset($pagination)) {
                echo $pagination;
            }
            ?>
        </div>
    </div>
</div>
