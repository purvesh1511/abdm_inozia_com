<style>
    .m0 {
        margin: 0px !important;
    }

    .ml-30 {
        margin-left: 30px !important;
    }

    .mt-15 {
        margin-top: 15px !important;
    }

    .mb-15 {
        margin-bottom: 15px !important;
    }

    .pl-0 {
        padding-left: 0px !important;
    }

    .font-bold {
        font-weight: bold !important;
    }

    .validation-form-box {
        background: #eee;
        padding: 5%;
        border-radius: 5px;
    }

    .sidebar-profile {
        background: #eee;
        padding: 0px;
        border-radius: 5px;
    }

    .profile-img img {
        width: 100%;
    }

    .profile-work {
        padding: 15px 10px;
    }

    .profile-work ul {
        padding-left: 4px;
        list-style: none;
    }

    .profile-work ul li {
        padding: 10px 0;
        border-bottom: 1px solid #ddd;
    }

    .profile-work ul li a {
        text-decoration: none;
        color: #000;
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="row">

            <div class="container-fluid">
                <ul class="nav nav-tabs">
                    <!-- <li>
                        <a href="#registration" data-toggle="tab">
                            <i class="fa fa-building"></i> Registration</a>
                    </li> -->
                    <li class="active">
                        <a href="#createabha" data-toggle="tab">
                            <i class="fa fa-newspaper-o"></i> Create ABHA</a>
                    </li>
                    <li>
                        <a href="#verification" data-toggle="tab">
                            <i class="fa fa-check-circle"></i> Verification</a>
                    </li>
                    
                    <li>
                        <a href="#revisit" data-toggle="tab">
                            <i class="fa fa-calendar-plus-o"></i> Revisit
                        </a>
                    </li>
                    <li>
                        <a href="#display" data-toggle="tab">
                            <i class="fa fa-desktop"></i> Display
                        </a>
                    </li>
                    <li>
                        <a href="#reg" data-toggle="tab">
                            <i class="fa fa-flag"></i> REG</a>
                    </li>
                    <li>
                        <a href="#hip" data-toggle="tab">
                            <i class="fa fa-flag"></i> HIP</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <!-- Registration Tab -->
                <!-- <div class="tab-pane fade in " id="registration">
                    <?php //$this->load->view('admin/abdm/abha-register-with-adhar'); ?>
                </div> -->

                <!-- Create ABHA Tab -->
                <div class="tab-pane fade in active" id="createabha">
                    <?php $this->load->view('admin/abdm/create-abha'); ?>
                </div>
                <!-- Verification Tab -->
                <div class="tab-pane fade in" id="verification">
                    <?php $this->load->view('admin/abdm/abha-number-validation'); ?>
                </div>

                <!-- HIP -->
                <div class="tab-pane fade in" id="hip">
                    <?php $this->load->view('admin/abdm/abha-care'); ?>
                </div>
            </div>



        </div><!--./row-->


    </section>
</div>


<script>
    function selectVerificationMethod(value) {

        const noteMsg = document.getElementById("noteMsg");
        const abhaDataInput = document.getElementById("abha_data");
        const aadhaarMobileDataInput = document.getElementById("aadhaar_mobile_data");

        if (value == "mobile_no") {
            noteMsg.style.display = "block";
            noteMsg.innerHTML = "<small>Use your communication mobile number registered with ABDM</small>";
            aadhaarMobileDataInput.placeholder = "Enter Mobile Number";
        } else if (value == "aadhar_no") {
            noteMsg.style.display = "block";
            noteMsg.innerHTML = "<small>Use your Aadhaar Number</small>";
            aadhaarMobileDataInput.placeholder = "Enter Aadhaar Number";
        } else if (value == "abha_no"){
            noteMsg.style.display = "block";
            noteMsg.innerHTML = "<small>Use your ABHA 14 Digit Number</small>";
            abhaDataInput.placeholder = "Enter ABHA Number";
        } else if (value == "abha_address"){
            noteMsg.style.display = "block";
            noteMsg.innerHTML = "<small>Use your ABHA Address in @sbx format</small>";
            abhaDataInput.placeholder = "Enter ABHA Address";
        } else {
            noteMsg.style.display = "none";
        }
    }
</script>