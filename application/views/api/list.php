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