
<style>
.m0
{
  margin:0px !important;  
}

.ml-30
{
    margin-left:30px!important;
}

.mt-15
{
    margin-top:15px!important;
}

.mb-15
{
    margin-bottom:15px!important;
}

.pl-0
{
    padding-left:0px !important;
}

.font-bold
{
    font-weight:bold!important;
}

.validation-form-box
{
    background:#eee;
    padding:5%;
    border-radius:5px;
}

.sidebar-profile
{
    background:#eee;
    padding:0px;
    border-radius:5px;  
}

.profile-img img
{
    width:100%;
}

.profile-work
{
    padding:15px 10px;
}

.profile-work ul
{
    padding-left: 4px;
    list-style: none;
}

.profile-work ul li
{
    padding: 10px 0;
    border-bottom:1px solid #ddd;
}

.profile-work ul li a
{
    text-decoration:none;
    color:#000;
}
</style>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
           
            <div class="col-md-8 col-md-offset-2">
                
                 <?php if($this->session->flashdata('success')!='') { ?>
					<div class="alert alert-success">
						<?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php } ?>
				<?php if($this->session->flashdata('error')!='')
				{
				?>
					<div class="alert alert-danger">
						<?php echo $this->session->flashdata('error'); ?>
					</div>
				<?php } ?>
				
                <div class="box box-primary">
                    
                    <div class="box-header with-border">
                        <h3 class="box-title titlefix">Reactivate ABHA</h3>
                        <div class="box-tools pull-right">
                            <a href="<?php echo base_url(); ?>admin/abhavalidation/abhanumberverification" class="btn btn-primary btn-sm"> <?php echo $this->lang->line('abha_number_validation'); ?></a> 
                            <a href="<?php echo base_url(); ?>admin/abhavalidation/searchabha" class="btn btn-primary btn-sm"> Search ABHA</a> 
                        </div>    
                    </div>
                    
                    <div class="box-body">
                        <form action="<?php echo base_url(); ?>admin/abhavalidation/reactivateAccount" method="POST">
						
						   <div class="form-check mb-15 mt-15">
        					    <label class="radio-inline">
                                  <input type="radio" onclick="selectVerificationMethod(this.value)" name="verify_by" value="abha_otp" checked> Using ABHA OTP
                                </label>
                                
                                <label class="radio-inline">
                                  <input type="radio" onclick="selectVerificationMethod(this.value)" name="verify_by" value="aadhar_otp">Using Aadhar OTP
                                </label>
                                
                                <!--label class="radio-inline">
                                  <input type="radio" onclick="selectVerificationMethod(this.value)" name="verify_by" value="password"> Using Password
                                </label-->
                                
        					</div>
							
							<div class="mb-15 mt-15" id="reasonDiv" style="display:none"
        					  <!--label for="abha_data" id="methodText">ABHA Number :</label-->
        					  <input type="text" class="form-control" id="abha_number" placeholder="ABHA Number" name="abha_number">
        					</div>
							
        					<div class="mb-15 mt-15">
        					  <!--label for="abha_data" id="methodText">ABHA Number :</label-->
        					  <input type="text" class="form-control" id="abha_data" placeholder="Enter ABHA Number" value="<?php echo $this->session->userdata('userAbhaNumber'); ?>" name="abha_data" required>
        					</div>
							
        					<div class="mb-15 mt-15 text-center">
        				    	<button type="submit" name="submit" class="btn btn-primary">Submit</button>
        					</div>
        			    </form>
                    </div>

                </div>
                
            </div>
                   
        </div><!--./row-->
       
     
    </section>
</div>
  
  
  <script>
 function selectVerificationMethod(vl)
 {
     switch(vl)
     {
         case "abha_otp":
             document.getElementById("abha_data").placeholder = "Enter your ABHA number";
             document.getElementById("abha_data").value = "";
             document.getElementById("reasonDiv").style.display = "none";
             document.getElementById("abha_number").required = false;
             //document.getElementById("methodText").innerHTML = "ABHA Number";
         break;
         
         case "password":
             document.getElementById("abha_data").placeholder = "Enter your password";
             document.getElementById("abha_data").value = "";
             document.getElementById("reasonDiv").style.display = "block";
             document.getElementById("abha_number").required = true;
            // document.getElementById("methodText").innerHTML = "Mobile Number";
         break;
         
         case "aadhar_otp":
             document.getElementById("abha_data").placeholder = "Enter your ABHA number";
             document.getElementById("abha_data").value = "";
             document.getElementById("reasonDiv").style.display = "none";
             document.getElementById("abha_number").required = false;
             //document.getElementById("methodText").innerHTML = "Aadhar Number";
         break;
         
         case "biometric":
             document.getElementById("abha_data").placeholder = "Enter your ABHA number";
             document.getElementById("reasonDiv").style.display = "none";
             document.getElementById("abha_reason").required = false;
             //document.getElementById("methodText").innerHTML = "ABHA Number";
         break;
     }
 }
</script>
