<style>
    .panel-custom {
        border: 1px solid #ccc;
        margin-top: 20px;
    }

    .panel-heading-custom {
        background-color: #6c757d;
        color: white;
        padding: 10px;
    }

    .tab-header {
        background-color: #222533;
        color: white;
        padding: 10px;
        cursor: pointer;
    }

    .form-inline .form-group {
        margin-right: 15px;
    }

    .search-icon {
        color: red;
        font-size: 20px;
        cursor: pointer;
    }

    .section-title {
        font-weight: bold;
        margin-top: 15px;
    }

    .form-section {
        border: 1px solid #ccc;
        padding: 15px;
        margin-top: 10px;
        background-color: #f9f9f9;
    }

    .form-section label {
        font-weight: bold;
    }

    .go-back-btn {
        float: right;
        margin: 10px;
    }

    .cpanel .panel-heading span {
        font-size: 18px;
        margin: 15px 10px;
        display: inline-block;
    }
    #gtmloader{
      display:none;
    }
</style>
<?php
$userdata = $this->session->flashdata('abha_userdata');
?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="cpanel panel panel-default panel-custom">
                    <div class="panel-heading panel-heading-custom">
                        <span>HIP Initiating Linking</span>
                        <button class="btn btn-teal btn-sm go-back-btn">Go Back</button>
                    </div>
                    <div class="tab-header">Abha Address/Number</div>
                    <div class="panel-body">
                        <form class="form-inline" action="<?php echo base_url(); ?>admin/abhacreate/searchava" method="post">
                            <div class="form-group">
                                <label for="abhaType">ABHA Type:</label>
                                <select id="abhaType" name="avatype" class="form-control">
                                    <option value="1">ABHA Address</option>
                                    <option value="2">ABHA Number</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="ava" placeholder="veer_chaudhary1211@sbx">
                                <!-- <span class="glyphicon glyphicon-search search-icon"></span> -->
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                            <div class="form-group">
                                <label for="authMode">Mode(s) of Record Linking:</label>
                                <select id="authMode" class="form-control">
                                    <option>DEMOGRAPHY</option>
                                </select>
                            </div>

                         <input type="hidden" class="form-control" id="avha_address" name="avha_address" value="<?php if(isset($userdata)){ echo $userdata->avha_address ; } ?>">
                         <input type="hidden" class="form-control" id="avha_no" name="avha_no" value="<?php if(isset($userdata)){ echo $userdata->avha_no ; } ?>">
                         <input type="hidden" class="form-control" id="fname" name="fname" value="<?php if(isset($userdata)){ echo $userdata->firstName ; } ?>">
                         <input type="hidden" class="form-control" id="lname" name="lname" value="<?php if(isset($userdata)){ echo $userdata->lastName ; } ?>">
                         <input type="hidden" class="form-control" id="dob" name="dob" value="<?php if(isset($userdata)){ echo $userdata->dob ; } ?>">
                         <input type="hidden" class="form-control" id="gender" name="gender" value="<?php if(isset($userdata)){ echo $userdata->gender ; } ?>">



                           <div class="form-group">
                                <button type="button" class="btn btn-primary" onclick="generateToken()">Generate Token</button>
                            </div>
                            <div class="spinner-border" id="gtmloader" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>

                        </form>
                        <div class="form-section">
                            <h4 class="section-title">Patient Details</h4>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p><label>ABHA Address:</label><?php if(isset($userdata)){ echo $userdata->avha_address ; } ?> </p>
                                    <p><label>Patient Name:</label><?php if(isset($userdata)){ echo $userdata->firstName ; } ?> <?php if(isset($userdata)){ echo $userdata->lastName ; } ?> </p>
                                    <p><label>Gender:</label> <?php if(isset($userdata)){ echo $userdata->gender ; } ?></p>
                                   <!--  <p><label>Address:</label> </p> -->
                                </div>
                                <div class="col-sm-6">
                                    <p><label>ABHA Number:</label> <?php if(isset($userdata)){ echo $userdata->avha_no ; } ?></p>
                                    <p><label>DOB:</label><?php if(isset($userdata)){ echo $userdata->dob ; } ?> </p>
                                    <!-- <p><label>Mobile No.:</label> </p> -->
                                    <p><label>Linking:</label> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    
function generateToken(){
   $("#gtmloader").fadeIn();
        var avha_address = $("#avha_address").val();
        var avha_no = $("#avha_no").val();
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var dob = $("#dob").val();
        var gender = $("#gender").val();
        //alert(adhar_no);
        $.ajax({
            url: baseurl + 'admin/abhacreate/linktokengen',
            type: "POST",
            data: {
                 avha_address: avha_address,
                 avha_no: avha_no,
                 fname: fname,
                 lname: lname,
                 dob: dob,
                 gender: gender
            },
            dataType: 'json',
            success: function(res) {
                if (res.status == '1') {
                    $("#gtmloader").hide();

                    //$("#adhar_no").val("");
                    successMsg(res.message);
                    //table.ajax.reload();
                } else if (res.status == '0') {
                    $("#gtmloader").hide();

                    //$("#adhar_no").val("");
                    errorMsg(res.message);
                }
            }
        })

}

</script>