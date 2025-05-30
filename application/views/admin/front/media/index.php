<style type="text/css">
    #div_fade {
    display: none;
    position:absolute;
    top: 0%;
    left: 0%;
    width: 100%;
    height: 100%;
    background-color: #edededcc;
    z-index: 1001;
    -moz-opacity: 0.8;
    opacity: .6;
    filter: alpha(opacity=80);
}

#div_modal {
    display: none;
    position: absolute;
    top: 35%;
    left: 45%;
    z-index: 1002;
    text-align: center;
    overflow: auto;
}
   
    .modal-lg{width: 1100px;}
    @media (max-width:767px){
        .modal-lg{width:100%;}
    } 
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
if ($this->rbac->hasPrivilege('media_manager', 'can_add')) {
    ?>
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('media_manager'); ?></h3>
                        </div>
                        <div class="box-body">
                        <form action="<?php echo site_url('admin/front/media/addVideo'); ?>" id="video_form" method="POST">
                            <div class="row">
                            <div class="col-md-5 col-sm-5 col-lg-5">
                                    <div class="mailbox-controls">
                                        <form method="post" action="#" id="fileupload">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('upload_your_file'); ?></label>
                                                <div class="files">
                                                    <input type="file" name="files[]" class="filestyle form-control" id="file" multiple="">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div><!--./col-md-6-->
                                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                    <div class="text-center form-group">
                                        <label class="displayblock opacity d-sm-none sm-hide-block">&nbsp;</label>
                                        <div class="orline"><span>or</span></div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-5 col-lg-5">                                     
                                        <div class="form-group">
                                            <label for="video_url"><?php echo $this->lang->line('upload_youtube_video'); ?></label><small class="req"> *</small>
                                            <input type="text" class="form-control" name="video_url" id="video_url" placeholder="<?php echo $this->lang->line('url') ?>">
                                            <span class="text text-danger file_error"></span>
                                        </div>
                                        <button type="submit" class="btn btn-info pull-right video_submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('loading'); ?>"><?php echo $this->lang->line('submit'); ?></button>
                                    </form>
                                </div>
                            </div>
                        </div><!--./box-body-->
                    <?php }?>
                    <div class="">
                        <!-- general form elements -->
                        <div class="box border0" id="holist">
                            <div class="tabsborderbg"></div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="row">
                                            <form class="ptt10">
                                                <div class="form-group col-sm-6 col-md-6">
                                                    <label for="name" class="control-label"><?php echo $this->lang->line('search_by_file_name'); ?></label>
                                                    <input type="text" value='' class="form-control search_text" id="" placeholder="<?php echo $this->lang->line('enter_keyword'); ?>">
                                                </div>
                                                <div class="form-group col-sm-6 col-md-6">
                                                    <label for="name" class="control-label"><?php echo $this->lang->line('filter_by_file_type'); ?></label>
                                                    <select class="form-control file_type">
                                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                        <?php
foreach ($mediaTypes as $type_key => $type_value) {
    ?>
                                                            <option value="<?php echo $type_value; ?>"><?php echo $type_value; ?></option>

                                                            <?php
}
?>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="mediarow">
                                            <div class="row" id="media_div"></div></div>
                                        <div class="text-right" id="pagination_link"></div>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                        </div><!--/.col (left) -->
                    </div>
                </div>
            </div><!--./col-md-12-->
            <!-- left column -->
            <div class="row">
                <div class="col-md-12">
                </div><!--/.col (right) -->
            </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
        load(1);
        $(document).on("click", ".pagination li a", function (event) {
            event.preventDefault();
            var page = $(this).data("ci-pagination-page");
            load(page);
        });
		
        $(".search_text").keyup(function () {
            load(1);
        });
		
        $(".file_type").change(function () {
            load(1);
        });
		
        $('#postdate').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });
		
        $("#confirm-delete").modal({
            backdrop: false,
            show: false
        });
		
        $('#confirm-delete').on('show.bs.modal', function (e) {
            var record_id = $(e.relatedTarget).data('record_id');
            $('#record_id').val(0).val(record_id);			
			$('.del_modal_title').html("<?php echo $this->lang->line('delete_confirm'); ?>");
            $('.del_modal_body').html('<p><?php echo $this->lang->line('are_you_sure_want_to_delete'); ?></p>');			
        });
		
        $('#detail').on('show.bs.modal', function (e) {
            var data = $(e.relatedTarget).data();
            var media_content_path = "<a href='" + data.source + "' target='_blank'>" + data.source + "</a>";
            $('#modal_media_name').text("").text(data.media_name);
            $('#modal_media_path').html("").html(media_content_path);
            $('#modal_media_type').text("").text(data.media_type);            
			$('#modal_media_size').text("").text((data.media_type == "video") ? "<?php echo $this->lang->line('n_a'); ?>" :convertSize(data.media_size));			
            updateMediaDetailPopup(data.media_type, data.source, data.image);
        });

        function updateMediaDetailPopup(media_type, url, thumb_path) {
            var content_popup = "";
            if (media_type == "video") {
                var youtubeID = YouTubeGetID(url);
                content_popup = '<object data="https://www.youtube.com/embed/' + youtubeID + '" width="100%" height="400"></object>';
            } else {
                content_popup = '<img src="' + thumb_path + '" class="img-responsive">';
            }
            $('.popup_image').html("").html(content_popup);
        }

        function YouTubeGetID(url) {
            var ID = '';
            url = url.replace(/(>|<)/gi, '').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
            if (url[2] !== undefined) {
                ID = url[2].split(/[^0-9a-z_\-]/i);
                ID = ID[0];
            } else {
                ID = url;
            }
            return ID;
        }        

        $("#video_form").submit(function (e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var url = $(this).attr("action");
            var $this = $('.video_submit');
            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                cache: false,
                contentType: false,
                 processData: false,
                  data: new FormData(this),
                beforeSend: function () {
                    $this.button('loading');
                    $("[class$='_error']").html("");
                },
                success: function (data) {
                        console.log(data);
                 if (!data.status) {
                   var message = "";
                   $.each(data.error, function (index, value) {
                   message += value;
                   });
                   errorMsg(message);
                   } else {
                    reset_form('#video_form');
                    $('#video_form').find(".dropify-clear").trigger('click');
                    successMsg(data.msg);
                   load(1);
              }

                },
                error: function (xhr) { // if error occured
                    $this.button('reset');
                },
                complete: function () {
                    $this.button('reset');
                },
            });
        });
    });
	
    function load(page) {
        var keyword = $('.search_text').val();
        var file_type = $('.file_type').val();
        var is_gallery = 0;
        $.ajax({
            url: "<?php echo base_url(); ?>admin/front/media/getPage/" + page,
            method: "GET",
            data: {'keyword': keyword, 'file_type': file_type, 'is_gallery': is_gallery},
            dataType: "json",
            beforeSend: function () {
                $('#media_div').empty();
            },

            success: function (data)
            {
                $('#media_div').empty();
                if (data.result_status === 1) {
                    $.each(data.result, function (index, value) {
                        $("#media_div").append(data.result[index]);
                    });
                    $('#pagination_link').html(data.pagination_link);
                } else {
                }
            },
            complete: function () {

            }
        });
    }

    $(document).on('click', '.btn_delete', function () {
        var $this = $('.btn_delete');
        var record_id = $('#record_id').val();
        $.ajax({
            url: "<?php echo site_url('admin/front/media/deleteItem') ?>",
            type: "POST",
            data: {'record_id': record_id},
            dataType: 'Json',
            beforeSend: function () {
                $this.button('loading');
            },
            success: function (data, textStatus, jqXHR)
            {
                if (data.status === 1) {
                    successMsg(data.msg);
                    load(1);
                } else {
                    errorMsg(data.msg);
                }
                $("#confirm-delete").modal('hide');
            },
            complete: function () {
                $this.button('reset');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {

            }
        });
    });

    function convertSize(bytes, decimalPoint) {
        if (bytes == 0)
            return '0 Bytes';
        var k = 1024,
                dm = decimalPoint || 2,
                sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
                i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

</script>

<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content fullshadow mx-2">
            <button type="button" class="ukclose" data-dismiss="modal">&times;</button>
            <div class="smcomment-header">
                <div class="row">
                    <div class="col-md-8 col-sm-8 popup_image">
                    </div>
                    <div class="col-md-4 col-sm-4 smcomment-title">
                        <dl class="mediaDL">
                            <dt><?php echo $this->lang->line('media_name'); ?></dt>
                            <dd id="modal_media_name"></dd>
                            <dt><?php echo $this->lang->line('media_type'); ?></dt>
                            <dd id="modal_media_type"></dd>
                            <dt><?php echo $this->lang->line('media_path'); ?></dt>
                            <dd id="modal_media_path"></dd>
                            <dt><?php echo $this->lang->line('media_size'); ?></dt>
                            <dd id="modal_media_size"></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content mx-2">
            <input type="hidden" id="record_id" name="record_id" value="0">
            <div class="modal-header">
                <h4 class="modal-title del_modal_title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body del_modal_body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                <a class="btn btn_delete btn-danger" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait.."><?php echo $this->lang->line('delete'); ?></a>
            </div>
        </div>
    </div>
</div>