<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- left column -->
                <form id="form1" action="<?php echo base_url() ?>admin/notification/add" id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                    <div class="box box-primary modal-text-white">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('compose_new_message'); ?></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">  
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg');
                                    $this->session->unset_userdata('msg'); ?>
                                <?php } ?>
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('title'); ?></label><small class="req"> *</small>
                                        <input id="title" name="title" placeholder="" type="text" class="form-control"  value="<?php echo set_value('title'); ?>" />
                                        <span class="text-danger"><?php echo form_error('title'); ?></span>
                                    </div>
                                    <div class="form-group"><label><?php echo $this->lang->line('message'); ?></label><small class="req"> *</small>
                                        <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px">
                                            <?php echo set_value('message'); ?>
                                        </textarea>
                                        <span class="text-danger"><?php echo form_error('message'); ?></span>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="">
                                        <?php
                                        if (isset($error_message)) {
                                            echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                        }
                                        ?>    
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('notice_date'); ?></label><small class="req"> *</small>
                                            <input id="date" name="date" placeholder="" type="text" class="form-control date" value="<?php echo set_value('date'); ?>" />
                                            <span class="text-danger"><?php echo form_error('date'); ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('publish_on'); ?></label><small class="req"> *</small>
                                            <input id="publish_date" name="publish_date" placeholder="" type="text" class="form-control date" value="<?php echo set_value('publish_date'); ?>" />
                                            <span class="text-danger"><?php echo form_error('publish_date'); ?></span>
                                        </div>
                                        <div class="form-horizontal">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('message_to'); ?></label>

                                            <?php
                                            foreach ($roles as $role_key => $role_value) {
                                                $userdata = $this->customlib->getUserData();
                                                $role_id = $userdata["role_id"];
                                                ?>
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="visible[]" value="<?php echo $role_value['id']; ?>" <?php
                                                        if ($role_value["id"] == $role_id) {
                                                            echo "checked onclick='return false;'";
                                                        }
                                                        ?>  <?php echo set_checkbox('visible[]', $role_value['id'], false) ?> /> <b><?php echo $role_value['name']; ?></b> </label>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                        <span class="text-danger"><?php echo form_error('visible[]'); ?></span>

                                    </div>
                                </div>  
                            </div>    
                        </div>  
                                                
                            <div class="modal-footer">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> <?php echo $this->lang->line('send'); ?></button>
                                </div>
                            </div>                          
                                              
                    </div>
                </form>              
            </div>
        </div><!--./wrapper-->
        <div class="row">            
            <div class="col-md-12">
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getHospitalDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

        $('.date').datepicker({
            format: date_format,
            autoclose: true
        });
        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });

    });
</script>
<script>
    $(function () {
        $("#compose-textarea").wysihtml5({
            toolbar: {
                "image": false,
            }
        });
    });
</script>