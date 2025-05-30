<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>
<?php
$currency_symbol = $this->customlib->getHospitalCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <?php $this->load->view('admin/report/_finance');?>  
                     <div class="box-header ptbnull"></div>
                    <div class="box-header with-border">                        
                        <h3 class="box-title"><?php echo $this->lang->line('income_report'); ?></h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body pb0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <form id="form1" action="" method="post">
                                        <div class="box-body row">
                                            <?php echo $this->customlib->getCSRF(); ?>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line('search_type'); ?></label><small class="req"> *</small>
                                                    <select class="form-control" name="search_type" onchange="showdate(this.value)">
                                                        <option value=""><?php echo $this->lang->line('select') ?></option>
                                                        <?php foreach ($searchlist as $key => $search) {
                                                         ?>
                                                            <option value="<?php echo $key ?>" <?php
                                                    if ((isset($search_type)) && ($search_type == $key)) {
                                                            echo "selected";
                                                        }
                                                        ?>><?php echo $search ?></option>
                                                                <?php }?>
                                                    </select>
                                                    <span class="text-danger" id="error_search_type"><?php echo form_error('search_type'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4" id="fromdate" style="display: none">
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line('date_from'); ?></label>
                                                    <input id="date_from" name="date_from" placeholder="" type="text" class="form-control date" value="<?php echo set_value('date_from', date($this->customlib->getHospitalDateFormat())); ?>"  />
                                                    <span class="text-danger"><?php echo form_error('date_from'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4" id="todate" style="display: none">
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line('date_to'); ?></label>
                                                    <input id="date_to" name="date_to" placeholder="" type="text" class="form-control date" value="<?php echo set_value('date_to', date($this->customlib->getHospitalDateFormat())); ?>"  />
                                                    <span class="text-danger"><?php echo form_error('date_to'); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>          

                        <div class="tabsborderbg"></div>
                        <div class="box-body table-responsive">
                            <div class="download_label"><?php echo $this->lang->line('income_report'); ?></div>
                            <table class="table table-striped table-bordered table-hover allajaxlist" data-export-title="<?php echo $this->lang->line('income_report'); ?>">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('invoice_number'); ?></th>
                                        <th><?php echo $this->lang->line('income_head'); ?></th>
                                        <th><?php echo $this->lang->line('date'); ?></th>
                                        <?php 
                                        if (!empty($fields)) {
                                            foreach ($fields as $fields_key => $fields_value) {
                                                ?>
                                                <th><?php echo $fields_value->name; ?></th>
                                                <?php
                                            } 
                                            }
                                        ?>  
                                        <th class="text-right"><?php echo $this->lang->line('amount'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>                                  
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                </div>   <!-- /.row -->
                </section><!-- /.content -->
            </div>
			
            <script type="text/javascript">
                $(document).ready(function () {
                    var date_format = '<?php echo $result = strtr($this->customlib->getHospitalDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';                    
                    $(".date").datepicker({                       
                        format: date_format,
                        autoclose: true,
                        todayHighlight: true
                    });
                });
            </script> 
			
            <script type="text/javascript">
                var base_url = '<?php echo base_url() ?>';

                function printDiv(elem) {
                    popup(jQuery(elem).html());
                }                
            </script>
			
            <script type="text/javascript">               

                function showdate(value) {

                    if (value == 'period') {
                        $('#fromdate').show();
                        $('#todate').show();
                    } else {
                        $('#fromdate').hide();
                        $('#todate').hide();
                    }
                }
            </script> 
			
<script>
    $(document).ready(function (e) {      
        emptyDatatable('allajaxlist', 'data');
    });    
    
( function ( $ ) {
    'use strict';
    $(document).ready(function () {
       $('#form1').on('submit', (function (e) {
        e.preventDefault();
        var search= 'search_filter';
        var formData = new FormData(this);
        formData.append('search', 'search_filter');
        $.ajax({
            url: '<?php echo base_url(); ?>admin/income/checkvalidationincome',
            type: "POST",
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.status == "fail") {
                   $.each(data.error, function(key, value) {
                        $('#error_' + key).html(value);
                    });
                } else {
                    $("#error_search_type").html('');                
					initDatatable('allajaxlist', 'admin/income/incomereports/',data.param,[],100,[                            
                            { "aTargets": [ -1 ] ,'sClass': 'dt-body-right'}
                        ]);
                }
            }
        });
        }
       ));
   });
} ( jQuery ) );

</script>