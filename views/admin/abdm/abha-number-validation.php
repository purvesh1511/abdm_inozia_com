<style>
    .scheduler-border {
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 4px;
        margin-top: 20px;
    }

    .scheduler-border legend {
        font-size: 14px;
        font-weight: bold;
        text-align: left;
        width: auto;
        padding: 0 10px;
        border-bottom: none;
        margin-bottom: 0;
    }

    .spinner-border {
        display: inline-block;
        width: 1rem;
        height: 1rem;
        vertical-align: text-bottom;
        border: 0.15em solid currentColor;
        border-right-color: transparent;
        border-radius: 50%;
        animation: spinner-border 0.75s linear infinite;
    }

    @keyframes spinner-border {
        100% {
            transform: rotate(360deg);
        }
    }

    #responseMessage .alert {
        min-width: 300px;
        max-width: 400px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        opacity: 0.9;
    }

    #toggleAadhaarMobile {
        border: none;
        background: none;
        cursor: pointer;
    }

    #toggleAadhaarMobile i {
        font-size: 1.2rem;
        color: #555;
    }
</style>
<div class="col-md-12">

    <?php if ($this->session->flashdata('success') != '') { ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('error') != '') {
    ?>
        <div class="alert alert-danger">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>

    <div class="box box-primary">

        <div class="box-header with-border">
            <h3 class="box-title titlefix"> Abha Verification</h3>
            <div class="box-tools pull-right">
                <a href="<?php echo base_url(); ?>admin/abdm/hipInitiateLinking" class="btn btn-primary btn-sm"> HIP Initiating Linking</a>
                <a href="<?php echo base_url(); ?>admin/abhavalidation/searchabha" class="btn btn-primary btn-sm"> Search ABHA</a>
                <a href="<?php echo base_url(); ?>admin/abhavalidation/reactivateAccount" class="btn btn-primary btn-sm"> Reactivate ABHA</a>
            </div>
        </div>

        <div class="box-body">
            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="verifyAbhaTabs" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link" id="abha-address-tab" data-toggle="tab" href="#abha-address" role="tab" aria-controls="abha-address" aria-selected="true">Abha Address/No.</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="aadhaar-mobile-tab" data-toggle="tab" href="#aadhaar-mobile" role="tab" aria-controls="aadhaar-mobile" aria-selected="false">Aadhaar/Mobile OTP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="qr-scanner-tab" data-toggle="tab" href="#qr-scanner" role="tab" aria-controls="qr-scanner" aria-selected="false">QR Scanner</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="initiate-linking-tab" data-toggle="tab" href="#initiate-linking" role="tab" aria-controls="initiate-linking" aria-selected="false">Initiate Linking</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="verifyAbhaTabContent" style="padding-top: 3em;">
                <!-- ABHA Address/No Tab -->
                <div class="tab-pane fade in active" id="abha-address" role="tabpanel" aria-labelledby="abha-address-tab">
                    <div class="form-group row mt-3">
                        <div class="col-md-2">
                            <label for="verify_by_abha" class="form-label">ABHA Address/No:</label>
                            <select class="form-control" id="verify_by_abha" name="verify_by_abha" onchange="selectVerificationMethod(this.value)">
                                <option value="abha_no" selected>ABHA Number</option>
                                <option value="abha_address" selected>ABHA Address</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="abha_data" class="form-label">Enter ABHA Address/Number:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="abha_data" name="abha_data" placeholder="Enter ABHA Address/Number" required>
                                <div class="input-group-append">
                                    <button class="btn btn-danger" type="button" id="verifyAbhaButton">
                                        <i class="fa fa-search" id="verifyAbhaIcon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="selectAuthAbhaSection" style="display: none;">
                            <div class="col-md-2">
                                <label for="auth_mode" class="form-label">Mode of Auth:</label>
                                <select class="form-control" id="auth_mode" name="auth_mode">
                                    <option value="" selected>-- Select Auth Mode --</option>
                                </select>
                            </div>
                            <div class="col-md-1" style="margin-top: 1.7em;">
                                <button type="button" id="verifyAbhaAuthButton" class="btn btn-primary">Verify</button>
                            </div>
                        </div>
                        <div id="enterOtpSectionAbha" style="display: none; margin-top: 1.8em;">
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="verifyOtpTextAbha" name="verifyOtpTextAbha" placeholder="Enter OTP">
                            </div>
                            <div class="col-md-2">
                                <button type="button" id="verifyOtpButtonAbha" class="btn btn-primary">Verify OTP</button>
                            </div>
                        </div>
                    </div>


                    <!-- Send OTP Button -->
                    <!-- <div class="form-group text-center mt-3">
                        
                    </div> -->

                    <!-- Enter OTP Section -->
                    <!-- <div id="enterOtpSection" style="display: none; margin-top: 20px;">
                        <label for="otp">Enter OTP:</label>
                        <input type="text" class="form-control" id="verifyOtpText" name="verifyOtpText" placeholder="Enter OTP">
                        <button type="button" id="verifyOtpButton" class="btn btn-success" style="margin-top: 10px;">Verify OTP</button>
                    </div> -->
                </div>

                <!-- Aadhaar/Mobile OTP Tab -->
                <div class="tab-pane fade in" id="aadhaar-mobile" role="tabpanel" aria-labelledby="aadhaar-mobile-tab">
                    <div class="form-group row mt-3">
                        <div class="col-md-3">
                            <label for="aadhaar_mobile_type" class="form-label">Aadhaar/Mobile:</label>
                            <select class="form-control" id="aadhaar_mobile_type" name="aadhaar_mobile_type" onchange="selectVerificationMethod(this.value)">
                                <option value="aadhaar_no" selected>Aadhaar Number</option>
                                <option value="mobile_no">Mobile Number</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="aadhaar_mobile_data" class="form-label">Enter Aadhaar/Mobile No.:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="aadhaar_mobile_data" name="aadhaar_mobile_data" placeholder="Aadhaar / Mobile No." required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleAadhaarMobile">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <small id="aadhaar-error" class="text-danger" style="display: none;">Please enter a valid 12-digit Aadhaar number.</small>
                        </div>
                        <div class="col-md-2" style="margin-top: 1.8em;">
                            <button type="button" id="verifyAadhaarMobileButton" class="btn btn-primary">Verify</button>
                        </div>
                        <!-- Enter OTP Section -->
                        <div id="enterOtpSectionAdhaar" style="display: none; margin-top: 1.8em;">
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="verifyOtpText" name="verifyOtpText" placeholder="Enter OTP">
                            </div>
                            <div class="col-md-2">
                                <button type="button" id="verifyOtpButton" class="btn btn-primary">Verify OTP</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- QR Scanner Tab -->
                <div class="tab-pane fade in" id="qr-scanner" role="tabpanel" aria-labelledby="qr-scanner-tab">
                    <div class="text-center mt-3">
                        <button type="button" id="accessQrScannerButton" class="btn btn-success">
                            <i class="fa fa-qrcode"></i> Access Scanner
                        </button>
                    </div>
                </div>

                <!-- Initiate Linking Tab -->
                <div class="tab-pane fade in" id="initiate-linking" role="tabpanel" aria-labelledby="initiate-linking-tab">
                    <div class="text-center mt-3">
                        <button type="button" id="initiateLinkingButton" class="btn btn-success">
                            <i class="fa fa-link"></i> Initiate Linking
                        </button>
                    </div>
                </div>

                <!-- Note Message -->
                <div class="form-group mt-2">
                    <p id="noteMsg" style="display:none"><small>Use your communication mobile number registered with ABDM</small></p>
                </div>

                <!-- Success/Error Message -->
                <div id="responseMessage" style="position: fixed; top: 20px; right: 20px; z-index: 1050;"></div>
            </div>
        </div>
    </div>

    <!-- Patient Registration Form Section -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="<?php echo base_url(); ?>admin/abhavalidation/registerWithAadhar" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="abha_number">ABHA Number:</label>
                                <input type="text" class="form-control" id="profile_abha_number" name="abha_number" placeholder="12-1234-1234" readonly>
                            </div>
                            <div class="form-group">
                                <label for="patient_name">Patient Name:</label>
                                <div class="row">
                                    <!-- Prefix Dropdown -->
                                    <div class="col-md-4">
                                        <select class="form-control" id="profile_prefix" name="prefix" required>
                                            <option value="">-- Select Initial --</option>
                                            <option value="Mr.">Mr.</option>
                                            <option value="Mrs.">Mrs.</option>
                                            <option value="Ms.">Ms.</option>
                                            <option value="MASTER">MASTER</option>
                                            <option value="BABY">BABY</option>
                                            <option value="BABY(M)">BABY(M) Of</option>
                                            <option value="BABY(F)">BABY(F) Of</option>
                                            <option value="Transgender">Transgender</option>
                                        </select>
                                    </div>

                                    <!-- Patient Name Text Field -->
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="profile_patient_name" name="patient_name" placeholder="Enter Patient Name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <!-- Gender Field -->
                                    <div class="col-md-6">
                                        <label for="gender">Gender:</label>
                                        <input type="text" class="form-control" id="profile_gender" name="gender" placeholder="Gen" readonly>
                                    </div>

                                    <!-- Marital Status Field -->
                                    <div class="col-md-6">
                                        <label for="marital_status">Marital Status:</label>
                                        <select class="form-control" id="profile_marital_status" name="marital_status" required>
                                            <option value="">-- Select --</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Separated">Separated</option>
                                            <option value="Divorced">Divorced</option>
                                            <option value="Widowed">Widowed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <!-- Blood Group Field -->
                                    <div class="col-md-6">
                                        <label for="blood_group">Blood Group:</label>
                                        <select class="form-control" id="profile_blood_group" name="blood_group" required>
                                            <option value="NA">NA</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                        </select>
                                    </div>

                                    <!-- Religion Field -->
                                    <div class="col-md-6">
                                        <label for="religion">Religion:</label>
                                        <select class="form-control" id="profile_religion" name="religion" required>
                                            <option value="">-- Religion --</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Muslim">Muslim</option>
                                            <option value="Sikh">Sikh</option>
                                            <option value="Christian">Christian</option>
                                            <option value="Jain">Jain</option>
                                            <option value="Budh">Budh</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <!-- Mother Tongue Field -->
                                    <div class="col-md-6">
                                        <label for="mother_tongue">Mother Tongue:</label>
                                        <select class="form-control" id="profile_mother_tongue" name="mother_tongue" required>
                                            <option value="">-- Select --</option>
                                            <option value="Hindi">Hindi</option>
                                            <option value="English">English</option>
                                            <option value="Punjabi">Punjabi</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <!-- Occupation Field -->
                                    <div class="col-md-6">
                                        <label for="occupation">Occupation:</label>
                                        <select class="form-control" id="profile_occupation" name="occupation" required>
                                            <option value="">-- Select --</option>
                                            <option value="Pvt Service">Pvt Service</option>
                                            <option value="Govt Service">Govt Service</option>
                                            <option value="Self Employed">Self Employed</option>
                                            <option value="Business">Business</option>
                                            <option value="Consultant">Consultant</option>
                                            <option value="Farmer">Farmer</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="abha_address">ABHA Address:</label>
                                <input type="email" class="form-control" id="profile_abha_address" name="abha_address" placeholder="john@abdm">
                            </div>
                            <div class="form-group">
                                <label for="sdwo">S/D/W o:</label>
                                <div class="row">
                                    <!-- Prefix Dropdown -->
                                    <div class="col-md-2">
                                        <select class="form-control" id="profile_sdw_prefix" name="prefix" required>
                                            <option value="">-- Select Initial --</option>
                                            <option value="Mr.">Mr.</option>
                                            <option value="Mrs.">Mrs.</option>
                                            <option value="Ms.">Late Shree</option>
                                        </select>
                                    </div>


                                    <!-- Text Input Field -->
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="profile_relation_name" name="relation_name" placeholder="Enter Name" required>
                                    </div>

                                    <!-- Postfix Dropdown -->
                                    <div class="col-md-2">
                                        <select class="form-control" id="profile_relation_postfix" name="relation_postfix" required>
                                            <option value="">-- Select Relation --</option>
                                            <option value="Son">Son</option>
                                            <option value="Daughter">Daughter</option>
                                            <option value="Wife">Wife</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="profile_dob">DOB/Age <span class="text-danger">*</span>:</label>
                                <div class="row">
                                    <!-- DOB Field -->
                                    <div class="col-md-3">
                                        <input type="date" class="form-control" id="profile_dob" name="profile_dob" placeholder="dd/mm/yyyy" onchange="calculateAge()" required>
                                    </div>

                                    <!-- Age in Years -->
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" id="profile_age_years" name="age_years" placeholder="Age (Y)" oninput="calculateDOB()" required>
                                    </div>

                                    <!-- Age in Months -->
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" id="profile_age_months" name="age_months" placeholder="Age (M)" oninput="calculateDOB()" required>
                                    </div>

                                    <!-- Age in Days -->
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" id="profile_age_days" name="age_days" placeholder="Age (D)" oninput="calculateDOB()" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="email" class="form-control" id="profile_email" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <!-- Mobile Number Field -->
                                    <div class="col-md-6">
                                        <label for="mobile_no">Mobile No. <span class="text-danger">*</span>:</label>
                                        <input type="text" class="form-control" id="profile_mobile_no" name="mobile_no" placeholder="Mobile Number" required>
                                    </div>

                                    <!-- Attendant Mobile Number Field -->
                                    <div class="col-md-6">
                                        <label for="attendant_mobile_no">Attendant:</label>
                                        <input type="text" class="form-control" id="profile_attendant_mobile_no" name="attendant_mobile_no" placeholder="Mobile Number">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Resident Details</legend>
                                    <div class="row">
                                        <!-- State Field -->
                                        <div class="col-md-3">
                                            <label for="state">State:</label>
                                            <select class="form-control" id="profile_state" name="state" required>
                                                <option value="">-- Select State --</option>
                                                <option value="State1">State1</option>
                                                <option value="State2">State2</option>
                                                <option value="State3">State3</option>
                                            </select>
                                        </div>

                                        <!-- District Field -->
                                        <div class="col-md-3">
                                            <label for="district">District:</label>
                                            <select class="form-control" id="profile_district" name="district" required>
                                                <option value="">-- Select City --</option>
                                                <option value="City1">City1</option>
                                                <option value="City2">City2</option>
                                                <option value="City3">City3</option>
                                            </select>
                                        </div>

                                        <!-- Sub District Field -->
                                        <div class="col-md-3">
                                            <label for="sub_district">Sub District:</label>
                                            <select class="form-control" id="profile_sub_district" name="sub_district" required>
                                                <option value="">-- Select City --</option>
                                                <option value="SubCity1">SubCity1</option>
                                                <option value="SubCity2">SubCity2</option>
                                                <option value="SubCity3">SubCity3</option>
                                            </select>
                                        </div>

                                        <!-- Town/Village Field -->
                                        <div class="col-md-3">
                                            <label for="town_village">Town/Village:</label>
                                            <select class="form-control" id="profile_town_village" name="town_village" required>
                                                <option value="">-- Select City --</option>
                                                <option value="Village1">Village1</option>
                                                <option value="Village2">Village2</option>
                                                <option value="Village3">Village3</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <!-- Pincode Field -->
                                        <div class="col-md-3">
                                            <label for="pincode">Pincode <span class="text-danger">*</span>:</label>
                                            <input type="text" class="form-control" id="profile_pincode" name="pincode" placeholder="Pincode" required>
                                        </div>

                                        <!-- Address Field -->
                                        <div class="col-md-9">
                                            <label for="address">Address <span class="text-danger">*</span>:</label>
                                            <textarea class="form-control" id="profile_address" name="address" placeholder="Street/Village" rows="2" required></textarea>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Visit Details</legend>
                                    <div class="row">
                                        <!-- Visit Type Field -->
                                        <div class="col-md-6">
                                            <label for="visit_type">Visit Type <span class="text-danger">*</span>:</label>
                                            <select class="form-control" id="profile_visit_type" name="visit_type" required>
                                                <option value="">-- Select Type --</option>
                                                <option value="OPD">OPD</option>
                                                <option value="IPD">IPD</option>
                                                <option value="Emergency">Emergency</option>
                                            </select>
                                        </div>

                                        <!-- Patient Image Field -->
                                        <div class="col-md-6">
                                            <label for="patient_image">Patient Image:</label>
                                            <div class="row">
                                                <!-- File Input -->
                                                <div class="col-md-8">
                                                    <input type="file" class="form-control" id="profile_patient_image" name="patient_image">
                                                </div>
                                                <!-- Image Placeholder -->
                                                <div class="col-md-4 text-center">
                                                    <img id="profile_patient_image_preview" src="https://placehold.co/100" alt="Patient Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <!-- Link Health Record Field -->
                                        <div class="col-md-12">
                                            <label>Do You Want To Link Your Health Record With Your ABHA Address/Number <span class="text-danger">*</span>:</label>
                                            <div class="form-check-inline">
                                                <label class="radio-inline">
                                                    <input type="radio" name="link_health_record" value="yes" required> YES
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="link_health_record" value="no" required> NO
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Register</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

<script>
    function calculateAge() {
        const dob = document.getElementById("profile_dob").value;
        if (!dob) return;

        const dobDate = new Date(dob);
        const today = new Date();

        let years = today.getFullYear() - dobDate.getFullYear();
        let months = today.getMonth() - dobDate.getMonth();
        let days = today.getDate() - dobDate.getDate();

        if (days < 0) {
            months--;
            days += new Date(today.getFullYear(), today.getMonth(), 0).getDate();
        }

        if (months < 0) {
            years--;
            months += 12;
        }

        document.getElementById("profile_age_years").value = years;
        document.getElementById("profile_age_months").value = months;
        document.getElementById("profile_age_days").value = days;
    }

    function calculateDOB() {
        const years = parseInt(document.getElementById("profile_age_years").value) || 0;
        const months = parseInt(document.getElementById("profile_age_months").value) || 0;
        const days = parseInt(document.getElementById("profile_age_days").value) || 0;

        const today = new Date();
        const dob = new Date(today);

        dob.setFullYear(today.getFullYear() - years);
        dob.setMonth(today.getMonth() - months);
        dob.setDate(today.getDate() - days);

        document.getElementById("profile_dob").value = dob.toISOString().split("T")[0];
    }

    // Method to save a property to session storage
    function saveToSessionStorage(key, value) {
        if (key && value !== undefined) {
            sessionStorage.setItem(key, JSON.stringify(value));
            console.log(`Saved to session storage: ${key} =`, value);
        } else {
            console.error("Key or value is missing or invalid.");
        }
    }

    // Method to retrieve a property from session storage
    function getFromSessionStorage(key) {
        if (key) {
            const value = sessionStorage.getItem(key);
            if (value) {
                console.log(`Retrieved from session storage: ${key} =`, JSON.parse(value));
                return JSON.parse(value);
            } else {
                console.warn(`No value found in session storage for key: ${key}`);
                return null;
            }
        } else {
            console.error("Key is missing or invalid.");
            return null;
        }
    }

    // Method to remove a property from session storage
    function removeFromSessionStorage(key) {
        if (key) {
            sessionStorage.removeItem(key);
            console.log(`Removed from session storage: ${key}`);
        } else {
            console.error("Key is missing or invalid.");
        }
    }

    function verifyUser(verifyButton, enterOtpSection, url, data, type = "ABHA") {
        // Disable button and show loader
        setButtonLoading(verifyButton, true);

        const selectAuthAbhaSection = document.getElementById("selectAuthAbhaSection");

        // Make AJAX call to send OTP
        fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: data
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Display success message
                    showMessage(data.message, "success");

                    // Disable the Verify button
                    verifyButton.disabled = true;

                    if (type === "ABHA") {
                        verifyButton.innerHTML = ``;
                        verifyButton.classList.remove("btn-danger");
                        verifyButton.classList.add("btn-success");
                        verifyButton.innerHTML = `<i class="fa fa-check"></i>`;

                        // Populate the auth_mode dropdown with authMethods
                        populateAuthModes(data.data.authMethods);

                        // Save ABHA number to session storage
                        saveToSessionStorage("abhaNumber", data.data.ABHANumber);
                        // show auth methods section
                        selectAuthAbhaSection.style.display = "block";
                    } else {
                        // Show Enter OTP section
                        enterOtpSection.style.display = "block";
                    }
                } else {
                    // Hide Enter OTP section
                    enterOtpSection.style.display = "none";

                    // Display error message
                    showMessage(data.error, "danger");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                showMessage("An error occurred. Please try again.", "danger");
            })
            .finally(() => {
                // Remove loader and enable button if not disabled
                setButtonLoading(verifyButton, false);
            });
    }

    function verifyOTP(verifyOtpBtn, otp) {
        // Disable button and show loader
        setButtonLoading(verifyOtpBtn, true);

        // Make AJAX call to fetchAbhaProfile
        fetch("<?php echo base_url('admin/Abdm/fetchAbhaProfile'); ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    abha_otp: otp
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Display success message and profile data
                    showMessage("Profile fetched successfully!", "success");

                    // Populate the form with the profile data
                    populatePatientForm(data.profile);

                    // Disable the Verify OTP button
                    verifyOtpBtn.disabled = true;
                } else {
                    // Display error message
                    showMessage(data.error, "danger");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                showMessage("An error occurred. Please try again.", "danger");
            })
            .finally(() => {
                // Remove loader and enable button if not disabled
                setButtonLoading(verifyOtpBtn, false);
            });
    }

    // Helper function to show dismissable messages
    function showMessage(message, type) {
        // Create the alert element
        const alertDiv = document.createElement("div");
        alertDiv.className = `alert alert-${type} alert-dismissible fade in`;
        alertDiv.role = "alert";
        alertDiv.innerHTML = `
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                ${message}
            `;

        // Append the alert to the body or a specific container
        const container = document.getElementById("responseMessage") || document.body;
        container.appendChild(alertDiv);

        // Automatically dismiss the alert after 3 seconds
        setTimeout(() => {
            $(alertDiv).alert("close");
        }, 3000);
    }

    // Helper function to toggle button loading state
    function setButtonLoading(button, isLoading) {
        if (isLoading) {
            button.disabled = true;
            button.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ${button.innerHTML}`;
        } else {
            button.disabled = false;
            button.innerHTML = button.innerHTML.replace(/<span.*<\/span>/, "").trim();
        }
    }

    function populatePatientForm(profile) {
        // Populate fields in the Patient Registration Form
        document.getElementById("profile_abha_number").value = profile.ABHANumber || "";
        document.getElementById("profile_abha_address").value = profile.preferredAbhaAddress || "";
        document.getElementById("profile_patient_name").value = profile.name || "";
        document.getElementById("profile_gender").value = profile.gender === "M" ? "Male" : profile.gender === "F" ? "Female" : "Other";
        // Set the date in the correct format for the date input
        const dobInput = document.getElementById("profile_dob");
        if (profile.yearOfBirth && profile.dayOfBirth) {
            const formattedDate = `${profile.yearOfBirth}-${String(profile.monthOfBirth).padStart(2, '0')}-${String(profile.dayOfBirth).padStart(2, '0')}`;
            // console.log("Formatted Date:", formattedDate); // Debugging statement
            dobInput.value = formattedDate;
        } else {
            dobInput.value = ""; // Clear the field if no date is available
        }
        document.getElementById("profile_mobile_no").value = profile.mobile || "";
        document.getElementById("profile_pincode").value = profile.pincode || "";
        document.getElementById("profile_address").value = profile.address || "";

        // Populate state, district, sub-district, and town fields
        document.getElementById("profile_state").value = profile.stateName || "";
        document.getElementById("profile_district").value = profile.districtName || "";
        document.getElementById("profile_sub_district").value = profile.subdistrictName || "";
        document.getElementById("profile_town_village").value = profile.townName || "";

        // Update the patient image preview if available
        const patientImagePreview = document.getElementById("profile_patient_image_preview");
        if (profile.profilePhoto) {
            patientImagePreview.src = `data:image/jpeg;base64,${profile.profilePhoto}`;
        }
    }

    function populateAuthModes(authMethods) {
        const authModeDropdown = document.getElementById("auth_mode");

        // Clear existing options
        authModeDropdown.innerHTML = "";

        // Add a default placeholder option
        const defaultOption = document.createElement("option");
        defaultOption.value = "";
        defaultOption.textContent = "-- Select Auth Mode --";
        authModeDropdown.appendChild(defaultOption);

        // Supported methods
        const supportedMethods = ["aadhaar_otp", "mobile_otp"];

        // Append new options from authMethods
        authMethods.forEach(method => {
            const option = document.createElement("option");
            const methodValue = method.toLowerCase(); // Convert to lowercase
            option.value = methodValue;
            option.textContent = method.replace(/_/g, " "); // Replace underscores with spaces for better readability

            // Disable unsupported methods
            if (!supportedMethods.includes(methodValue)) {
                option.disabled = true;
            }

            authModeDropdown.appendChild(option);
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        const verifyAadhaarMobileButton = document.getElementById("verifyAadhaarMobileButton");
        const verifyAbhaButton = document.getElementById("verifyAbhaButton");
        const enterOtpSectionAdhaar = document.getElementById("enterOtpSectionAdhaar");
        const enterOtpSectionAbha = document.getElementById("enterOtpSectionAbha");
        const responseMessage = document.getElementById("responseMessage");
        const verifyOtpButton = document.getElementById("verifyOtpButton");
        const verifyAbhaAuthButton = document.getElementById("verifyAbhaAuthButton");
        const authModeDropdown = document.getElementById("auth_mode");
        const verifyOtpButtonAbha = document.getElementById("verifyOtpButtonAbha");
        const aadhaarMobileType = $('#aadhaar_mobile_type');
        const aadhaarMobileData = $('#aadhaar_mobile_data');
        const toggleAadhaarButton = $('#toggleAadhaarMobile');
        const aadhaarError = $('#aadhaar-error');
        let rawAadhaar = ""; // Store the raw Aadhaar number

        // Function to validate Aadhaar number
        function validateAadharNumber(aadhar) {
            const regex = /^\d{12}$/; // Only 12 digits allowed
            return regex.test(aadhar);
        }

        // Event listener for input validation
        aadhaarMobileData.on('input', function() {
            let value = $(this).val().replace(/[^0-9]/g, ''); // Remove non-digit characters
            if (value.length > 12) value = value.slice(0, 12); // Limit to 12 digits
            rawAadhaar = value; // Store the raw Aadhaar number
            $(this).val(value);
            aadhaarError.hide(); // Hide error message on input
        });

        // Event listener for toggle button
        toggleAadhaarButton.on('click', function() {
            const inputType = aadhaarMobileData.attr('type');
            if (inputType === 'password') {
                aadhaarMobileData.attr('type', 'text'); // Show Aadhaar number
                $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                aadhaarMobileData.attr('type', 'password'); // Mask Aadhaar number
                $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        // Event listener for dropdown change
        aadhaarMobileType.on('change', function() {
            if ($(this).val() === 'aadhaar_no') {
                aadhaarMobileData.attr('placeholder', 'Enter Aadhaar Number'); // Set placeholder for Aadhaar
                aadhaarMobileData.val(''); // Clear the input field
                rawAadhaar = ""; // Reset raw Aadhaar
                toggleAadhaarButton.show(); // Show the toggle button
            } else {
                aadhaarMobileData.attr('placeholder', 'Enter Mobile Number'); // Set placeholder for Mobile
                aadhaarMobileData.val(''); // Clear the input field
                rawAadhaar = ""; // Reset raw Aadhaar
                toggleAadhaarButton.hide(); // Hide the toggle button
            }
        });

        // Function to toggle the button state
        function toggleVerifyButton() {
            if (authModeDropdown.value) {
                verifyAbhaAuthButton.disabled = false; // Enable the button
            } else {
                verifyAbhaAuthButton.disabled = true; // Disable the button
            }
        }

        // Initialize button state on page load
        toggleVerifyButton();

        // Add event listener to the dropdown
        authModeDropdown.addEventListener("change", toggleVerifyButton);

        verifyAadhaarMobileButton.addEventListener("click", function() {
            // const verifyBy = document.getElementById('aadhaar_mobile_type').value;
            // const aadhaarMobileData = document.getElementById("aadhaar_mobile_data").value;
            const aadhaarMobileTypeValue = aadhaarMobileType.val();
            const aadhaarMobileDataValue = rawAadhaar; // Use the raw Aadhaar number

            if (aadhaarMobileTypeValue === 'aadhaar_no' && !validateAadharNumber(aadhaarMobileDataValue)) {
                aadhaarError.text('Please enter a valid 12-digit Aadhaar number.').show();
                return;
            }

            const url = "<?php echo base_url('admin/abdm/adhaarMobileOTPVerification'); ?>";
            const data = JSON.stringify({
                verify_by: aadhaarMobileTypeValue,
                abha_data: aadhaarMobileDataValue
            });

            // if (!aadhaarMobileData) {
            //     showMessage("Please enter the required data.", "danger");
            //     return;
            // }

            verifyUser(verifyAadhaarMobileButton, enterOtpSectionAdhaar, url, data, "ADHAAR");
        });

        verifyAbhaAuthButton.addEventListener("click", function() {
            const verifyBy = document.getElementById('auth_mode').value;
            const abhaNumber = getFromSessionStorage("abhaNumber");

            const url = "<?php echo base_url('admin/abdm/adhaarMobileOTPVerification'); ?>";
            const data = JSON.stringify({
                verify_by: verifyBy,
                abha_data: abhaNumber
            });

            if (!abhaNumber) {
                showMessage("Please reverify Abha Number/Address.", "danger");
                return;
            }

            verifyUser(verifyAbhaAuthButton, enterOtpSectionAbha, url, data, "ADHAAR");
        });

        verifyAbhaButton.addEventListener("click", function() {
            const verifyByAbha = document.getElementById('verify_by_abha').value;
            const abhaData = document.getElementById("abha_data").value;

            const url = "<?php echo base_url('admin/abdm/confirmAbha'); ?>";
            const data = JSON.stringify({
                verify_by: verifyByAbha,
                abha_data: abhaData
            });

            if (!abhaData) {
                showMessage("Please enter the required data.", "danger");
                return;
            }

            verifyUser(verifyAbhaButton, enterOtpSectionAbha, url, data);
        });

        verifyOtpButton.addEventListener("click", function() {
            const verifyOtpText = document.getElementById("verifyOtpText").value;
            //console.log("OTP Value:", verifyOtpText); // Debugging statement

            if (!verifyOtpText) {
                showMessage("Please enter the OTP.", "danger");
                return;
            }

            verifyOTP(verifyOtpButton, verifyOtpText);
        });

        verifyOtpButtonAbha.addEventListener("click", function() {
            const verifyOtpTextAbha = document.getElementById("verifyOtpTextAbha").value;
            //console.log("OTP Value:", verifyOtpText); // Debugging statement

            if (!verifyOtpTextAbha) {
                showMessage("Please enter the OTP.", "danger");
                return;
            }

            verifyOTP(verifyOtpButton, verifyOtpTextAbha);
        });
    });
</script>