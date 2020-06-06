<?php
/*
  @Description: employee List
  @Author: Ruchi Shahu 
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$viewname = $this->router->uri->segments[1];
$path_comman =base_url($viewname ). '/';
?> 
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery.blockUI.js"></script>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery.confirm.js"></script>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>bootstrap.js"></script>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>parsley.js"></script>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>App.js"></script>

<link rel="stylesheet" href="<?= $this->config->item('css_path') ?>css.css" type="text/css">
<link rel="stylesheet" href="<?= $this->config->item('css_path') ?>runtime.css" type="text/css">
<link rel="stylesheet" href="<?= $this->config->item('css_path') ?>font-awesome.css" type="text/css">
<link rel="stylesheet" href="<?= $this->config->item('css_path') ?>bootstrap.css" type="text/css">
<link rel="stylesheet" href="<?= $this->config->item('css_path') ?>App.css" type="text/css">
<link rel="stylesheet" href="<?= $this->config->item('css_path') ?>jquery.confirm.css" type="text/css">
<link rel="stylesheet" href="<?= $this->config->item('css_path') ?>buttons.css" type="text/css">


<div id="content">
    <div id="content-header">
        <h1><?= $this->lang->line('employee') ?></h1>
    </div>
    <div id="content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet">
                    <div class="portlet-header">
                        <h3> <i class="fa fa-user"></i>
<?= $this->lang->line('employee') ?>
                        </h3>
                    </div>
                    <div class="portlet-content">
                        <div class="table-responsive">
                            <div role="grid" class="dataTables_wrapper" id="DataTables_Table_0_wrapper">
                                <div class="row">
                                                  
                                    <div class="col-sm-10" style="padding: 10px;float: right;"> 
                                <a class="btn  pull-right btn-success howler" title="Shape" href="<?= base_url(); ?>">
 Home </a>  &nbsp;&nbsp;
                                        <a class="btn  pull-right btn-success howler" title="<?= $this->lang->line('add_record') ?>" href="<?= base_url($viewname . '/add'); ?>">Add New
<?= $this->lang->line('employee'); ?> </a> </div>
                                    
                                </div>
                                <div class="row dt-rt">
                                    
                                  
                                    
                                </div>
                                <div id="common_div">
<?= $this->load->view($viewname . '/ajax_list', '', true) ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.table-responsive --> 

                    </div>
                    <!-- /.portlet-content --> 
                </div>
            </div>
        </div>
    </div>
    <!-- #content-header --> 
    <!-- /#content-container --> 
</div>
<!-- #content --> 
<script>


$('body').on('click', '#common_tb a', function(e) {
        $.ajax({
            type: "POST",
            url: $(this).attr('href'),
            data: {
                result_type: 'ajax', search_keyword: $("#search_keyword").val(), perpage: $("#perpage").val(),
            },
            beforeSend: function() {
                $.blockUI({message: '<?= '<img src="' . base_url('images') . '/ajaxloader.gif" border="0" align="absmiddle"/>' ?> Please Wait...'});
            },
            success: function(html) {

                $("#common_div").html(html);
                $.unblockUI();
            }
        });
        return false;

    });

function search_text(search_field){  
    $.ajax({
            type: "POST",
            url: '<?php echo  $path_comman ?>',
            data: {
                result_type: 'ajax', search_keyword: $("#"+search_field).val(),search_field: search_field, perpage: $("#perpage").val(),
            },
            beforeSend: function() {
                $.blockUI({message: '<?= '<img src="' . base_url('images') . '/ajaxloader.gif" border="0" align="absmiddle"/>' ?> Please Wait...'});
            },
            success: function(html) {
 
                $("#common_div").html(html);
                $.unblockUI();
            }
        });
        return false;
}




function deletepopup(id, viewname,path)
{ 
    $.confirm({'title': 'CONFIRM', 'message': " <strong> Are You Sure want to delete?  " + "<strong></strong>", 'buttons': {'Yes': {'class': '',
                'action': function() {
                
                    $.ajax({
                        type: "POST",
                        url: path + "delete_data",
                        //dataType: 'json',
                        async: false,
                        data: {id: id},
                        success: function(data) {
                            $.ajax({
                                type: "POST",
                                url: path + "/" + data,
                                data: {
                                    result_type: 'ajax', allflag: '',id : id,
                                },
                                beforeSend: function() {
                                    $('#common_div').block({message: 'Loading...'});
                                },
                                success: function(html) {
                                 
                                    $("#common_div").html(html);
                                    $('#common_div').unblock();
                                    $("#div_msg").css('display', 'block');

                                }
                            });
                            return false;
                        }
                    });
                }}, 'No': {'class': 'special'}}});
}


</script>
