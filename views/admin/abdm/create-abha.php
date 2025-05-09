<style>
    .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1.25rem;
    }

    .ml-5 {
        margin-left: 5px !important;
    }

    .ml-8 {
        margin-left: 8px !important;
    }

    .ml-12 {
        margin-left: 12px !important;
    }

    .mt-8 {
        margin-top: 8px !important;
    }

    .mb-12 {
        margin-bottom: 12px !important;
    }

    .mb-5 {
        margin-bottom: 5px !important;
    }

    .mb-8 {
        margin-bottom: 8px !important;
    }

    .mb-12 {
        margin-bottom: 12px !important;
    }

    .border-primary {
        border: 1px solid #337ab7 !important;
    }

    /* Blue */
    .border-success {
        border: 1px solid #5cb85c !important;
    }

    /* Green */
    .border-danger {
        border: 1px solid #d9534f !important;
    }

    /* Red */
    .border-warning {
        border: 1px solid #f0ad4e !important;
    }

    /* Yellow */
    .border-info {
        border: 1px solid #5bc0de !important;
    }

    /* Light Blue */

    #loader {
        display: none;
    }

    #enloader {
        display: none;
    }

    #sloader {
        display: none;
    }

    #mloader {
        display: none;
    }

    #mvloader {
        display: none;
    }

    #cvloader {
        display: none;
    }

    #dlmloader {
        display: none;
    }

    #dlmnloader {
        display: none;
    }

    .input[type=file] {
        opacity: 1 !important;
        display: block;
        width: 100%;
        height: 28px;
        padding: 3px 10px;
        font-size: 10pt;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
    }

    .form-control {
        height: 32px;
    }

    .input-group {
        display: flex;
    }
    #toggleAadhar {
    border: none;
    background: none;
    cursor: pointer;
}

#toggleAadhar i {
    font-size: 1.2rem;
    color: #555;
}
</style>

<div class="row">

    <!-- /.col -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <!-- <li class="nav-item active"><a class="nav-link" href="#activity" data-toggle="tab">Personal Info</a></li> -->

                    <li class="nav-item active"><a class="nav-link" href="#abha-settings" data-toggle="tab">Abha create with Adhar</a></li>
                    <li class="nav-item"><a class="nav-link" href="#abha-timeline" data-toggle="tab">Abha create With DL</a></li>
                    <li class="nav-item"><a class="nav-link" href="#abha-carecontent" data-toggle="tab">Abha Care Content</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">

                    <!-- /.tab-pane -->

                    <div class="active tab-pane" id="abha-settings">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-0">
                                <div class="form-section">
                                    <h3>OTP Verification</h3>

                                    <div class="row mt-8">
                                        <!-- Aadhaar Section -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Aadhaar Number <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input class="form-control" type="password" id="adhar_no" maxlength="14" placeholder="XXXXXXXXXXXX">
                                                    <button class="btn btn-outline-secondary" type="button" id="toggleAadhar">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                                <small id="aadhaar-error" class="text-danger" style="display: none;">Please enter a valid 12-digit Aadhaar number.</small>
                                            </div>
                                            <button type="button" onclick="sendOtp()" class="btn btn-primary btn-otp">Send OTP</button>
                                            <div id="sloader" class="spinner-border text-primary" role="status" style="display: none;">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>

                                        <!-- Verify OTP Section -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Verify OTP</label>
                                                <input class="form-control onlynumber" type="text" maxlength="6" id="otp" placeholder="Enter OTP">
                                            </div>
                                            <button type="button" onclick="verifyOtp()" class="btn btn-success btn-otp">Verify OTP</button>

                                            <div id="loader" class="spinner-border text-primary" role="status" style="display: none;">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-8">
                                        <!-- Mobile Section -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mobile Number</label>
                                                <input class="form-control onlynumber" type="text" id="mobile" maxlength="10" placeholder="Enter Mobile Number">
                                            </div>
                                            <button type="button" class="btn btn-primary btn-otp" onclick="verifyavaenOtp()">Send Mobile OTP</button>

                                            <div id="mloader" class="spinner-border text-primary" role="status" style="display: none;">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>

                                        <!-- Mobile OTP Verify Section -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Verify Mobile OTP</label>
                                                <input class="form-control onlynumber" type="text" id="otp1" maxlength="6" placeholder="Enter Mobile OTP">
                                            </div>
                                            <button type="button" class="btn btn-success btn-otp" onclick="verifyavmobileavaOtp()">Verify Mobile OTP</button>

                                            <div id="mvloader" class="spinner-border text-primary" role="status" style="display: none;">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ABHA Address Section -->
                                    <div class="abha-section mt-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>ABHA Address</label>
                                                    <input class="form-control" type="text" id="ava_address" placeholder="Enter ABHA Address">
                                                </div>
                                                <button type="button" class="btn btn-info btn-otp" onclick="createCustomava()">Save</button>

                                                <div id="cvloader" class="spinner-border text-primary" role="status" style="display: none;">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="abha-timeline">

                        <div class="timeliness">
                            <form action="<?php echo base_url(); ?>admin/abhacreate/avhadrivingenrolment" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <!-- Aadhaar Number (Full Width) -->
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <div class="form-group">
                                            <label class="required-field">Mobile No</label>
                                            <div class="d-flex">
                                                <div class="input-group me-2" style="flex: 1;">
                                                    <input type="number" class="form-control onlynumber" name="mobile" id="mobile1" maxlength="10" value="" placeholder="Enter 10-digitmobile No.">
                                                    <!-- <div class="input-group-append">
                                                                <span class="input-group-text toggle-visibility" id="toggleAadhaar">
                                                                    <i class="fas fa-eye"></i>
                                                                </span>
                                                            </div> -->
                                                    <!--  <div class="input-group-addon" id="toggleAadhaar">
                                                                <a href="#"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                            </div> -->
                                                </div>
                                                <button type="button" class="btn btn-primary btn-otp ml-5" onclick="sendOtpdl()">Send Mobile OTP</button>
                                                <div id="dlmloader" class="spinner-border text-primary" role="status" style="display: none;">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <div class="form-group">
                                            <label class="required-field">Verify OTP</label>
                                            <div class="d-flex">
                                                <div class="input-group me-2" style="flex: 1;">
                                                    <input type="number" class="form-control onlynumber" id="otp2" value="">
                                                </div>
                                                <button type="button" class="btn btn-success btn-otp ml-5" onclick="verifyOtpdl()">Verify Mobile OTP</button>
                                                <div id="dlmnloader" class="spinner-border text-primary" role="status" style="display: none;">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">


                                        <!-- Left Column -->

                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <!-- First Name -->
                                                <div class="form-group">
                                                    <label class="required-field">First Name</label>
                                                    <input type="text" class="form-control" name="firstName" value="">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <!-- Middle Name -->
                                                <div class="form-group">
                                                    <label>Middle Name</label>
                                                    <input type="text" class="form-control" name="middleName" value="">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <!-- Last Name -->
                                                <div class="form-group">
                                                    <label class="required-field">Last Name</label>
                                                    <input type="text" class="form-control" name="lastName" value="">
                                                </div>
                                            </div>

                                            <!-- Right Column -->
                                            <div class="col-md-4">
                                                <!-- Gender -->
                                                <div class="form-group">
                                                    <label class="required-field">Gender</label>
                                                    <select class="form-control" name="gender">
                                                        <option value="M">Male</option>
                                                        <option value="F">Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <!-- DOB -->
                                                <div class="form-group">
                                                    <label class="required-field">DOB</label>
                                                    <input type="text" class="form-control datepicker" name="dob" value="28-03-1986" placeholder="YYYY-MM-DD">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <!-- First Name -->
                                                <div class="form-group">
                                                    <label class="required-field">Driving License No</label>
                                                    <input type="text" class="form-control" name="dlicence_no" value="">
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="lastName" class="form-label">Licence Front Side Photo<small class="text-danger">*</small></label>
                                                <input type="file" class="form-control" name="fontside" required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="lastName" class="form-label">Licence Back Side Photo<small class="text-danger">*</small></label>
                                                <input type="file" class="form-control" name="backside" required>
                                            </div>

                                            <div class="col-md-12 mb-5">
                                                <label for="address" class="form-label">Address <small class="text-danger">*</small></label>
                                                <textarea name="address" id="address" class="form-control" rows="2" required></textarea>
                                            </div>
                                            <div class="col-md-6 mb-5">
                                                <label for="state" class="form-label">State <small class="text-danger">*</small></label>
                                                <input type="text" name="state" id="state" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-5">
                                                <label for="district" class="form-label">District <small class="text-danger">*</small></label>
                                                <input type="text" name="district" id="district" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-5" style="margin-bottom: 10px;">
                                                <label for="pinCode" class="form-label">Pin Code <small class="text-danger">*</small></label>
                                                <input type="text" name="pinCode" id="pinCode" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button (Centered) -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="form-group text-center" style="padding-top: 30px;">
                                                    <button type="submit" name="dlsub" class="btn btn-primary btn-block">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                    <div class="tab-pane" id="abha-carecontent">
                        <div class="card">
                            <div class="card-body">
                                <form>
                                    <div class="row mb-3">
                                        <!-- OTP Type (First Row) -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="otp_type" class="form-label">OTP Type</label>
                                                <select class="form-control" id="otp_type">
                                                    <option>MOBILE_OTP</option>
                                                    <!-- Add other options if needed -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row mb-3">
                                        <!-- ABHA Address (Second Row) -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="abha_number" class="required-field form-label">ABHA Address*</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="abha_number" maxlength="25" placeholder="Enter ABHA Number">
                                                    <button class="btn btn-outline-secondary" type="button" id="toggleAbha">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Purpose (Second Row) -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="purpose" class="required-field form-label">Purpose</label>
                                                <select class="form-control" id="purpose">
                                                    <option>KYC_AND_LINK</option>
                                                    <!-- Add other options if needed -->
                                                </select>
                                                <button type="button" class="btn btn-primary mt-5">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />

                                    <div class="row mb-3">
                                        <!-- Verify OTP (Third Row) -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="verify_otp" class="required-field form-label">Verify OTP</label>
                                                <input type="text" class="form-control" id="verify_otp" maxlength="6" placeholder="Enter OTP">
                                                <button type="button" class="btn btn-primary mt-5">Confirm</button>
                                            </div>
                                        </div>

                                        <!-- Add Care Content (Third Row) -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="care_content" class="required-field form-label">Add Care Content</label>
                                                <input type="text" class="form-control" id="care_content" maxlength="100" placeholder="Enter care content">
                                                <button type="button" class="btn btn-primary mt-5">Add Care Content</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php
$msg = $this->session->flashdata('msg');
if (isset($msg)) {
?>

    <script>
        swal({
            title: "Success",
            text: "<?php echo $msg; ?>",
            icon: "success",
            button: "Ok",
        });
    </script>
<?php } ?>

<?php
$msg1 = $this->session->flashdata('msg1');
if (isset($msg1)) {
?>

    <script>
        swal({
            title: "Failed",
            text: "<?php echo $msg1; ?>",
            icon: "error",
            button: "Ok",
        });
    </script>
<?php } ?>


<script type="text/javascript">
    let isMasked = true;
    let rawAadhaar = "";
    let aadhaarError;

    // Function to mask Aadhaar number
    function maskAadharNumber(aadhar) {
        if (aadhar.length === 12) {
            return 'XXXXXXXXXXXX'; // Mask all 12 digits
        }
        return aadhar; // Return as is if not 12 digits
    }

    // Function to validate Aadhaar number
    function validateAadharNumber(aadhar) {
        const regex = /^\d{12}$/; // Only 12 digits allowed
        return regex.test(aadhar);
    }

    

    $(document).ready(function() {
    const adharInput = $('#adhar_no');
    const toggleButton = $('#toggleAadhar');
    const toggleIcon = toggleButton.find('i');
    aadhaarError = $('#aadhaar-error');

    // Event listener for input masking and validation
    adharInput.on('input', function () {
        let value = $(this).val().replace(/[^0-9]/g, ''); // Remove non-digit characters
        if (value.length > 12) value = value.slice(0, 12); // Limit to 12 digits
        rawAadhaar = value; // Store the raw Aadhaar number
        if (isMasked) {
            $(this).val(maskAadharNumber(value));
        } else {
            $(this).val(value);
        }
        aadhaarError.hide(); // Hide error message on input
    });

    // Event listener for toggle button
    toggleButton.on('click', function () {
        const currentValue = adharInput.val().replace(/[^0-9]/g, ''); // Get raw value
        if (isMasked) {
            adharInput.val(rawAadhaar); // Show full Aadhaar number
            adharInput.attr('type', 'text'); // Change input type to text
            toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            adharInput.val(maskAadharNumber(rawAadhaar)); // Mask Aadhaar number
            adharInput.attr('type', 'password'); // Change input type to password
            toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
        isMasked = !isMasked; // Toggle the masking state
    });
     // Store the raw Aadhaar number
        $('#toggleAbha').on('click', function() {
            const abhaInput = $('#abha_number');
            const icon = $(this).find('i');

            console.log(abhaInput);

            if (abhaInput.attr('type') === 'password') {
                abhaInput.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                abhaInput.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        $('.onlynumber').on('input', function() {
            // Remove all non-digit characters
            this.value = this.value.replace(/[^0-9]/g, '');
        });

    });

    function sendOtp() {
        const adhar_no = rawAadhaar; // Use the raw Aadhaar number
        if (!validateAadharNumber(adhar_no)) {
            aadhaarError.text('Please enter a valid 12-digit Aadhaar number.').show();
            return;
        }

        $("#sloader").fadeIn();
        $.ajax({
            url: baseurl + 'admin/abhacreate/sendadharotp',
            type: "POST",
            data: {
                adhar_no: adhar_no
            },
            dataType: 'json',
            success: function (res) {
                $("#sloader").fadeOut();
                if (res.status == '1') {
                    successMsg(res.message);
                } else if (res.status == '0') {
                    errorMsg(res.message);
                }
            },
            error: function () {
                $("#sloader").fadeOut();
                errorMsg("An error occurred while sending OTP.");
            }
        });
    }

    function verifyOtp() {
        $("#loader").fadeIn();
        var otp = $("#otp").val();
        var adhar_no = $("#adhar_no").val();
        var mobile = $("#mobile").val();
        if (mobile == '') {
            errorMsg('Please enter mobile no !!');
        } else {
            //alert(adhar_no);
            $.ajax({
                url: baseurl + 'admin/abhacreate/verifyadharotp',
                type: "POST",
                data: {
                    otp: otp,
                    adhar_no: adhar_no,
                    mobile: mobile
                },
                dataType: 'json',
                success: function(res) {
                    if (res.status == '1') {
                        $("#loader").fadeOut();
                        //$("#adhar_no").val("");
                        successMsg(res.message);
                        //table.ajax.reload();
                    } else if (res.status == '0') {
                        $("#loader").fadeOut();
                        //$("#adhar_no").val("");
                        errorMsg(res.message);
                    }
                }
            })
        }

    }


    function verifyavaenOtp() {
        $("#mnloader").fadeIn();
        var adhar_no = $("#adhar_no").val();
        var mobile = $("#mobile").val();
        //alert(adhar_no);
        $.ajax({
            url: baseurl + 'admin/abhacreate/verifymobileensendotp',
            type: "POST",
            data: {
                mobile: mobile,
                adhar_no: adhar_no
            },
            dataType: 'json',
            success: function(res) {
                if (res.status == '1') {
                    $("#mnloader").fadeOut();
                    successMsg(res.message);
                    //table.ajax.reload();
                } else if (res.status == '0') {
                    $("#mnloader").fadeOut();
                    errorMsg(res.message);
                }
            }
        })


    }

    function verifyavmobileavaOtp() {
        $("#mvnloader").fadeIn();
        var adhar_no = $("#adhar_no").val();
        var otp1 = $("#otp1").val();
        var mobile = $("#mobile").val();
        //alert(adhar_no);
        $.ajax({
            url: baseurl + 'admin/abhacreate/verifymobileotpverify',
            type: "POST",
            data: {
                otp1: otp1,
                adhar_no: adhar_no
            },
            dataType: 'json',
            success: function(res) {
                if (res.status == '1') {
                    /* $("#adhar_no").val("");
                     $("#otp1").val("");
                     $("#mobile").val("");*/
                    $("#mvnloader").fadeOut();
                    successMsg(res.message);
                    //table.ajax.reload();
                } else if (res.status == '0') {
                    $("#mvnloader").fadeOut();
                    errorMsg(res.message);
                }
            }
        })

    }


    function createCustomava() {
        $("#cnloader").fadeIn();
        var ava_address = $("#ava_address").val();
        var adhar_no = $("#adhar_no").val();
        //alert(adhar_no);
        $.ajax({
            url: baseurl + 'admin/abhacreate/customavaCreate',
            type: "POST",
            data: {
                ava_address: ava_address,
                adhar_no: adhar_no
            },
            dataType: 'json',
            success: function(res) {
                if (res.status == '1') {
                    /* $("#adhar_no").val("");
                     $("#otp1").val("");
                     $("#mobile").val("");*/
                    $("#cnloader").fadeOut();
                    successMsg(res.message);
                    //table.ajax.reload();
                } else if (res.status == '0') {
                    $("#cnloader").fadeOut();
                    errorMsg(res.message);
                }
            }
        })

    }

    function sendOtpdl() {
        $("#dlmloader").fadeIn();
        var mobile = $("#mobile1").val();
        //alert(adhar_no);
        $.ajax({
            url: baseurl + 'admin/abhacreate/sendotpdl',
            type: "POST",
            data: {
                mobile: mobile
            },
            dataType: 'json',
            success: function(res) {
                if (res.status == '1') {
                    $("#dlmloader").fadeOut();
                    successMsg(res.message);
                    //table.ajax.reload();
                } else if (res.status == '0') {
                    $("#dlmloader").fadeOut();
                    errorMsg(res.message);
                }
            }
        })

    }


    function verifyOtpdl() {
        $("#dlmnloader").fadeIn();
        var mobile = $("#mobile1").val();
        var otp = $("#otp2").val();
        $.ajax({
            url: baseurl + 'admin/abhacreate/sendotpverifydl',
            type: "POST",
            data: {
                mobile: mobile,
                otp: otp
            },
            dataType: 'json',
            success: function(res) {
                if (res.status == '1') {
                    $("#dlmnloader").fadeOut();
                    successMsg(res.message);
                    //table.ajax.reload();
                } else if (res.status == '0') {
                    $("#dlmnloader").fadeOut();
                    errorMsg(res.message);
                }
            }
        })

    }
</script>