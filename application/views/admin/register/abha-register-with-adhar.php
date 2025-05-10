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
    #dlmloader{
      display: none;
    }
    #dlmnloader{
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
    .form-control{
        height: 32px;
    }
    .input-group{
        display:flex;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="https://adminlte.io/themes/v3/dist/img/user4-128x128.jpg"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">Nina Mcintire</h3>

                            <!-- <p class="text-muted text-center">Software Engineer</p> -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-panel">
                                        <!-- Information Rows -->
                                        <div class="info-row">
                                            <span class="info-label">UHD:</span>
                                            <span class="info-value">[UHD Number]</span>
                                        </div>

                                        <div class="info-row">
                                            <span class="info-label">Created By:</span>
                                            <span class="info-value">[User Name]</span>
                                        </div>

                                        <div class="info-row">
                                            <span class="info-label">Reg Date & Time:</span>
                                            <span class="info-value">[Date/Time]</span>
                                        </div>

                                        <div class="info-row">
                                            <span class="info-label">Edited By:</span>
                                            <span class="info-value">[Editor Name]</span>
                                        </div>

                                        <div class="info-row">
                                            <span class="info-label">Date & Time:</span>
                                            <span class="info-value">[Edit Date/Time]</span>
                                        </div>

                                        <!-- Register/Treatment Options -->
                                        <div class="form-group mt-8">
                                            <label class="control-label">Registration Type</label>
                                            <div>
                                                <label class="radio-inline">
                                                    <input type="radio" name="registrationType" value="register"> Register
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="registrationType" value="treatment" checked> Treatment
                                                </label>
                                            </div>
                                        </div>
                                        <hr>

                                        <!-- Communication Preferences -->
                                        <div class="form-group">
                                            <h5>Transaction Communication</h5>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" checked> SMS
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" checked> Email
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <h5>Promotional Communication</h5>
                                            <label class="checkbox-inline">
                                                <input type="checkbox"> SMS
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox"> Email
                                            </label>
                                        </div>

                                        <!-- IVF Information -->
                                        <div class="form-group">
                                            <h4>IVF Information</h4>
                                            <label class="checkbox-inline">
                                                <input type="checkbox"> IVF Flag
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item active"><a class="nav-link" href="#activity" data-toggle="tab">Personal Info</a></li>

                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Abha create with Adhar</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Abha create With DL</a></li>
                                <li class="nav-item"><a class="nav-link" href="#carecontent" data-toggle="tab">Abha Care Content</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    <div class="row bordered">
                                        <div class="col-md-7">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <!-- <div class="form-header">
                                                        <h2>Personal Information</h2>
                                                    </div> -->
                                                    <!-- Unit Selection -->
                                                    <div class="row">
                                                        <!-- Left Column -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Select Unit</label>
                                                                <select class="form-control">
                                                                    <option>Unit1</option>
                                                                    <option>Unit2</option>
                                                                    <option>Unit3</option>
                                                                </select>
                                                            </div>

                                                            <!-- First Name -->
                                                            <div class="form-group">
                                                                <label class="required-field">First Name</label>
                                                                <input type="text" class="form-control" value="SUMEDH">
                                                            </div>

                                                            <!-- Mobile -->
                                                            <div class="form-group">
                                                                <label class="required-field">Mobile</label>
                                                                <input type="tel" class="form-control" value="9823714008">
                                                            </div>

                                                            <!-- Prefix -->


                                                            <!-- Gender -->
                                                            <div class="form-group">
                                                                <label class="required-field">Gender</label>
                                                                <select class="form-control">
                                                                    <option>Male</option>
                                                                    <option>Female</option>
                                                                    <option>Other</option>
                                                                </select>
                                                            </div>
                                                            <!-- Email -->
                                                            <div class="form-group">
                                                                <label>Email Id</label>
                                                                <input type="email" class="form-control" value="null">
                                                            </div>
                                                        </div>

                                                        <!-- Right Column -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="required-field">Prefix</label>
                                                                <select class="form-control">
                                                                    <option>Mr.</option>
                                                                    <option>Mrs.</option>
                                                                    <option>Ms.</option>
                                                                    <option>Dr.</option>
                                                                </select>
                                                            </div>
                                                            <!-- Last Name -->
                                                            <div class="form-group">
                                                                <label class="required-field">Last Name</label>
                                                                <input type="text" class="form-control" value="JAGTAP">
                                                            </div>

                                                            <!-- DOB -->
                                                            <div class="form-group">
                                                                <label class="required-field">DOB</label>
                                                                <input type="text" class="form-control" value="280301986">
                                                            </div>

                                                            <!-- Middle Name -->
                                                            <div class="form-group">
                                                                <label>Middle Name</label>
                                                                <input type="text" class="form-control" value="BIHMRAO">
                                                            </div>
                                                            <div class="dob-section">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>Years</label>
                                                                            <input type="text" class="form-control" value="36">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>Months</label>
                                                                            <input type="text" class="form-control" value="8">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>Days</label>
                                                                            <input type="text" class="form-control" value="18">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Age Section -->


                                                    <!-- Submit Button -->
                                                    <!-- <div class="form-group text-right">
                                                        <button class="btn btn-primary">Submit</button>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#residential" data-toggle="tab">Residential Address</a></li>
                                                        <li><a href="#permanent" data-toggle="tab">Permanent Address</a></li>
                                                    </ul>

                                                    <div class="tab-content">
                                                        <!-- Residential Address Tab -->
                                                        <div class="tab-pane active" id="residential">
                                                            <div class="address-form">
                                                                <!-- <h2>Residential Address</h2> -->
                                                                <div class="form-section">
                                                                    <!-- <h3>Address</h3> -->
                                                                    <div class="form-group">
                                                                        <label>Town</label>
                                                                        <select class="form-control">
                                                                            <option value="">SELECT-</option>
                                                                            <option>Mumbai</option>
                                                                            <option>Pune</option>
                                                                            <option>Nagpur</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="form-section">
                                                                    <table class="table table-form">
                                                                        <tr>
                                                                            <td width="50%">
                                                                                <div class="form-group">
                                                                                    <label>Taluka</label>
                                                                                    <select class="form-control">
                                                                                        <option value="">SELECT-</option>
                                                                                        <option>Taluka 1</option>
                                                                                        <option>Taluka 2</option>
                                                                                    </select>
                                                                                </div>
                                                                            </td>
                                                                            <td width="50%">
                                                                                <div class="form-group">
                                                                                    <label>District</label>
                                                                                    <select class="form-control">
                                                                                        <option value="">SELECT-</option>
                                                                                        <option>Mumbai City</option>
                                                                                        <option>Pune District</option>
                                                                                    </select>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>

                                                                <div class="form-section">
                                                                    <table class="table table-form">
                                                                        <tr>
                                                                            <td width="33%">
                                                                                <div class="form-group">
                                                                                    <label>State</label>
                                                                                    <select class="form-control">
                                                                                        <option value="">SELECT-</option>
                                                                                        <option>Maharashtra</option>
                                                                                        <option>Gujarat</option>
                                                                                    </select>
                                                                                </div>
                                                                            </td>
                                                                            <td width="33%">
                                                                                <div class="form-group">
                                                                                    <label>Country</label>
                                                                                    <input type="text" class="form-control" value="India" readonly>
                                                                                </div>
                                                                            </td>
                                                                            <td width="33%">
                                                                                <div class="form-group">
                                                                                    <label>AreaCode</label>
                                                                                    <input type="text" class="form-control" value="0">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                                <div class="same-address">
                                                                    <label>
                                                                        <input type="checkbox"> Per. Address is Same As Res. Address
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Permanent Address Tab -->
                                                        <div class="tab-pane" id="permanent">
                                                            <div class="address-form">
                                                                <!-- <h2>Residential Address</h2> -->
                                                                <div class="form-section">
                                                                    <!-- <h3>Address</h3> -->
                                                                    <div class="form-group">
                                                                        <label>Town</label>
                                                                        <select class="form-control">
                                                                            <option value="">SELECT-</option>
                                                                            <option>Mumbai</option>
                                                                            <option>Pune</option>
                                                                            <option>Nagpur</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="form-section">
                                                                    <table class="table table-form">
                                                                        <tr>
                                                                            <td width="50%">
                                                                                <div class="form-group">
                                                                                    <label>Taluka</label>
                                                                                    <select class="form-control">
                                                                                        <option value="">SELECT-</option>
                                                                                        <option>Taluka 1</option>
                                                                                        <option>Taluka 2</option>
                                                                                    </select>
                                                                                </div>
                                                                            </td>
                                                                            <td width="50%">
                                                                                <div class="form-group">
                                                                                    <label>District</label>
                                                                                    <select class="form-control">
                                                                                        <option value="">SELECT-</option>
                                                                                        <option>Mumbai City</option>
                                                                                        <option>Pune District</option>
                                                                                    </select>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>

                                                                <div class="form-section">
                                                                    <table class="table table-form">
                                                                        <tr>
                                                                            <td width="33%">
                                                                                <div class="form-group">
                                                                                    <label>State</label>
                                                                                    <select class="form-control">
                                                                                        <option value="">SELECT-</option>
                                                                                        <option>Maharashtra</option>
                                                                                        <option>Gujarat</option>
                                                                                    </select>
                                                                                </div>
                                                                            </td>
                                                                            <td width="33%">
                                                                                <div class="form-group">
                                                                                    <label>Country</label>
                                                                                    <input type="text" class="form-control" value="India" readonly>
                                                                                </div>
                                                                            </td>
                                                                            <td width="33%">
                                                                                <div class="form-group">
                                                                                    <label>AreaCode</label>
                                                                                    <input type="text" class="form-control" value="0">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-panel">
                                                        <!-- <div class="form-header">
                                                            <h3>Appointment Information</h3>
                                                        </div> -->

                                                        <!-- <form> -->
                                                        <!-- Department -->
                                                        <div class="form-group">
                                                            <label>Department</label>
                                                            <select class="form-control">
                                                                <option value="">Select-</option>
                                                                <option>Cardiology</option>
                                                                <option>Neurology</option>
                                                                <option>Orthopedics</option>
                                                                <option>Pediatrics</option>
                                                            </select>
                                                        </div>

                                                        <!-- Specialty -->
                                                        <div class="form-group">
                                                            <label>Specialty</label>
                                                            <select class="form-control">
                                                                <option value="">Select-</option>
                                                                <option>General Medicine</option>
                                                                <option>Cardiac Surgery</option>
                                                                <option>Neuro Surgery</option>
                                                            </select>
                                                        </div>

                                                        <!-- Doctor/Consultant -->
                                                        <div class="form-group">
                                                            <label>Doc/Consultant</label>
                                                            <select class="form-control">
                                                                <option value="">Select-</option>
                                                                <option>Dr. Smith (Cardiologist)</option>
                                                                <option>Dr. Johnson (Neurologist)</option>
                                                            </select>
                                                        </div>

                                                        <!-- Reason for Visit -->
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <label>Reason of Visit</label>
                                                                    <select class="form-control">
                                                                        <option value="">Select-</option>
                                                                        <option>Consultation</option>
                                                                        <option>Follow-up</option>
                                                                        <option>Treatment</option>
                                                                        <option>Test/Procedure</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Ref. Doctor</label>
                                                                    <select class="form-control">
                                                                        <option value="">Select-</option>
                                                                        <option>Dr. Williams</option>
                                                                        <option>Dr. Brown</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Reference Source -->
                                                        <div class="form-group">
                                                            <label class="required-field">Reference Source</label>
                                                            <div class="icheck-primary d-inline">
                                                                <label for="">
                                                                    <input type="radio" name="referenceSource" id="referenceSource" value="Walk-in" checked> Walk-in
                                                                </label>
                                                            </div>
                                                            <div class="icheck-primary d-inline">
                                                                <label>
                                                                    <input type="radio" name="referenceSource" id="referenceSource" value="Referral"> Referral
                                                                </label>
                                                            </div>
                                                            <div class="icheck-primary d-inline">
                                                                <label>
                                                                    <input type="radio" name="referenceSource" id="referenceSource" value="Online"> Online
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <!-- Source Details (shown when Walk-in is selected) -->

                                                        <!-- <div class="form-group text-right">
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </div> -->
                                                        <!-- </form> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.post -->
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <!-- <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputName" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName2" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form> -->
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-0">
                                            <div class="form-section">
                                                <h3>OTP Verification</h3>

                                                <div class="row mt-8">
                                                    <!-- Aadhaar Section -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Aadhar Number</label>
                                                            <input class="form-control" type="text" id="adhar_no" maxlength="14" placeholder="XXXX-XXXX-XXXX">
                                                            <span class="visually-hidden" id="aadhaar-error"></span>
                                                        </div>
                                                        <button type="button" onclick="sendOtp()" class="btn btn-primary btn-otp">Send OTP</button>
                                                        <div class="spinner-border" id="sloader" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                    </div>

                                                    <!-- Verify OTP Section -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Verify OTP</label>
                                                            <input class="form-control onlynumber" type="text" maxlength="6" id="otp" placeholder="Enter OTP">
                                                        </div>
                                                        <button type="button" onclick="verifyOtp()" class="btn btn-success btn-otp">Verify OTP</button>
                                                        <div class="spinner-border" id="loader" role="status">
                                                            <span class="visually-hidden">Loading...</span>
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
                                                        <div class="spinner-border" id="mloader" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                    </div>

                                                    <!-- Mobile OTP Verify Section -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Verify Mobile OTP</label>
                                                            <input class="form-control onlynumber" type="text" id="otp1" maxlength="6" placeholder="Enter Mobile OTP">
                                                        </div>
                                                        <button type="button" class="btn btn-success btn-otp" onclick="verifyavmobileavaOtp()">Verify Mobile OTP</button>
                                                        <div class="spinner-border" id="mvloader" role="status">
                                                            <span class="visually-hidden">Loading...</span>
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
                                                            <div class="spinner-border" id="cvloader" role="status">
                                                                <span class="visually-hidden">Loading...</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="timeline">

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
                                                            <div class="spinner-border" id="dlmloader" role="status">
                                                            <span class="visually-hidden">Loading...</span>
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
                                                           <div class="spinner-border" id="dlmnloader" role="status">
                                                            <span class="visually-hidden">Loading...</span>
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
                                <div class="tab-pane" id="carecontent">
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
                                                <hr/>
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
                                                <hr/>

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
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>

  <?php
    $msg = $this->session->flashdata('msg');
                if(isset($msg)){           
    ?>

         <script>
            swal({
                title: "Success",
                text: "<?php echo $msg;?>",
                icon: "success",
                button: "Ok",
            });
        </script>
    <?php } ?>

   <?php
    $msg1 = $this->session->flashdata('msg1');
                if(isset($msg1)){           
    ?>

         <script>
            swal({
                title: "Failed",
                text: "<?php echo $msg1;?>",
                icon: "error",
                button: "Ok",
                });

        </script>
    <?php } ?>







<script>

    $(document).ready(function() {
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
    });
</script>
<script type="text/javascript">
    $('.onlynumber').on('input', function() {
        // Remove all non-digit characters
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    function sendOtp() {
        $("#sloader").fadeIn();
        var adhar_no = $("#adhar_no").val();
        //alert(adhar_no);
        $.ajax({
            url: baseurl + 'admin/abhacreate/sendadharotp',
            type: "POST",
            data: {
                adhar_no: adhar_no
            },
            dataType: 'json',
            success: function(res) {
                if (res.status == '1') {
                    $("#sloader").hide();

                    //$("#adhar_no").val("");
                    successMsg(res.message);
                    //table.ajax.reload();
                } else if (res.status == '0') {
                    $("#sloader").hide();

                    //$("#adhar_no").val("");
                    errorMsg(res.message);
                }
            }
        })

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