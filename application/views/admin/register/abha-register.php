<style>
    .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1.25rem;
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
    .border-primary { border: 1px solid #337ab7 !important; } /* Blue */
.border-success { border: 1px solid #5cb85c !important; } /* Green */
.border-danger { border: 1px solid #d9534f !important; } /* Red */
.border-warning { border: 1px solid #f0ad4e !important; } /* Yellow */
.border-info { border: 1px solid #5bc0de !important; } /* Light Blue */

  #loader{
    display: none;
  }
   #sloader{
    display: none;
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
                                <!-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Get Patient</a></li> -->
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Abha Generate</a></li>
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
                                <!-- <div class="tab-pane" id="timeline">
                                    
                                    <div class="timeline timeline-inverse">
                                        <div class="time-label">
                                            <span class="bg-danger">
                                                10 Feb. 2014
                                            </span>
                                        </div>
                                        <div>
                                            <i class="fas fa-envelope bg-primary"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                                <div class="timeline-body">
                                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                    quora plaxo ideeli hulu weebly balihoo...
                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <i class="fas fa-user bg-info"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                                <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                                                </h3>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="fas fa-comments bg-warning"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                                <div class="timeline-body">
                                                    Take me to your leader!
                                                    Switzerland is small and neutral!
                                                    We are more like Germany, ambitious and misunderstood!
                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="time-label">
                                            <span class="bg-success">
                                                3 Jan. 2014
                                            </span>
                                        </div>
                                        <div>
                                            <i class="fas fa-camera bg-purple"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                                <div class="timeline-body">
                                                    <img src="http://placehold.it/150x100" alt="...">
                                                    <img src="http://placehold.it/150x100" alt="...">
                                                    <img src="http://placehold.it/150x100" alt="...">
                                                    <img src="http://placehold.it/150x100" alt="...">
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div> -->
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
                                                            <input class="form-control" type="text" id="adhar_no" placeholder="Enter Aadhar Number">
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
                                                            <input class="form-control" type="text" id="otp" placeholder="Enter OTP">
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
                                                            <input class="form-control" type="text" id="mobile" placeholder="Enter Mobile Number">
                                                        </div>
                                                        <button type="button" class="btn btn-primary btn-otp">Send Mobile OTP</button>
                                                    </div>

                                                    <!-- Mobile OTP Verify Section -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Verify Mobile OTP</label>
                                                            <input class="form-control" type="text" placeholder="Enter Mobile OTP">
                                                        </div>
                                                        <button type="button" class="btn btn-success btn-otp">Verify Mobile OTP</button>
                                                    </div>
                                                </div>

                                                <!-- ABHA Address Section -->
                                                <div class="abha-section mt-8">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>ABHA Address</label>
                                                                <input class="form-control" type="text" placeholder="Enter ABHA Address">
                                                            </div>
                                                            <button type="button" class="btn btn-info btn-otp">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

<script type="text/javascript">
  function sendOtp() {
     $("#sloader").fadeIn();
    var adhar_no =  $("#adhar_no").val();
    //alert(adhar_no);
    $.ajax({
      url: baseurl+'admin/abhacreate/sendadharotp',
      type: "POST",
      data: {adhar_no: adhar_no},
      dataType: 'json',
      success: function (res) {
        if (res.status == '1') {
           $("#sloader").hide();
        
         //$("#adhar_no").val("");
          successMsg(res.message);
          //table.ajax.reload();
      }else if(res.status == '0'){
         $("#sloader").hide();
       
        //$("#adhar_no").val("");
          errorMsg(res.message);
      }
      }
    })
  
}

function verifyOtp() {
    $("#loader").fadeIn();
    var otp =  $("#otp").val();
    var adhar_no =  $("#adhar_no").val();
     var mobile =  $("#mobile").val();
    //alert(adhar_no);
    $.ajax({
      url: baseurl+'admin/abhacreate/verifyadharotp',
      type: "POST",
      data: {otp: otp,adhar_no: adhar_no,mobile:mobile},
      dataType: 'json',
      success: function (res) {
        if (res.status == '1') {
           $("#loader").fadeOut();
         $('#myModal1').modal('hide');
         $("#adhar_no").val("");
          successMsg(res.message);
          //table.ajax.reload();
      }else if(res.status == '0'){
        $("#loader").fadeOut();
        $('#myModal1').modal('hide');
        $("#adhar_no").val("");
          errorMsg(res.message);
      }
      }
    })
  
}

</script>