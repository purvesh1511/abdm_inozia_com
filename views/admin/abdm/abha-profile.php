
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
           
            <div class="col-md-12">
                 
                
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
                        <h3 class="box-title titlefix">Verify OTP</h3>    
                    </div>
                    
                    <div class="box-body">
                        
                 
                 <?php 
	    if($profile_type=="abhaNumber")
	    {
	    ?>
	    <div class="col-md-3 sidebar-profile">
		    <div class="profile-img">
		        <?php 
		          $profilePic=$getProfile['profilePhoto'];
                ?>
                <img src="data:image/png;base64,<?php echo $profilePic; ?>" alt=""/>
            </div>
            
			<div class="profile-work">
			    <p style="font-weight:bold;margin-top:10px">Change Photo</p>
			    <form action="<?php echo base_url(); ?>admin/abhavalidation/uploadPhoto" method="POST" enctype="multipart/form-data">
                    <input type="file" name="cover_image" style="float: left;width: 75%;opacity:1">
                    <button type="submit" name="submit" class="btn btn-sm btn-primary">Submit</button>
                </form>
                <ul>
                    <li style="margin-top: 15px;"><h6>PROFILE MANAGEMENT</h6></li>
                    <li><a style="cursor:pointer" onclick="updateProfile('profile_update')"><i class="fa fa-angle-double-right"></i> Update Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>admin/abhavalidation/downloadAbhaCard"><i class="fa fa-angle-double-right"></i> Download ABHA Card</a></li>
                    <li><a href="<?php echo base_url(); ?>admin/abhavalidation/changePassword"><i class="fa fa-angle-double-right"></i> Change Password</a></li>
                    <li><a href="<?php echo base_url(); ?>admin/abhavalidation/deactivateAccount"><i class="fa fa-angle-double-right"></i> Deactivate Account</a></li>
                    <li><a href="<?php echo base_url(); ?>admin/abhavalidation/deleteAccount"><i class="fa fa-angle-double-right"></i> Delete Account</a></li>
                    <li><a href="<?php echo base_url(); ?>admin/abhavalidation/logout"><i class="fa fa-angle-double-right"></i> Logout</a></li>
                    
                    <!--li style="margin-top: 20px;"><h6>HEALTH MANAGEMENT</h6></li>
                    <li><a href="<?php echo base_url(); ?>facility-search"><i class="fa fa-angle-double-right"></i> Search Facility</a></li-->
                </ul>
            </div>
						
		</div>
		<?php 
		}
		?>
		
		<div class="col-md-9 <?php if($profile_type=="abhaAddress") { ?> offset-md-2 <?php } ?>">
		    
		    
		    <div class="validation-form-box profileBox" id="profileData">
		          <div class="row">
                        				    <?php
                        				    switch($profile_type)
                        				    {
                        				        case "abhaAddress":
                        				            $abhaNumber=$getProfile['abhaNumber'];
                        				            $abhaAddress=$getProfile['abhaAddress'];
                        				            $name=$getProfile['fullName'];
                        				            $pincode=$getProfile['pinCode'];
                        				        break;
                        				            
                        				        case "abhaNumber":
                        				            $abhaNumber=$getProfile['ABHANumber'];
                        				            $abhaAddress=$getProfile['preferredAbhaAddress'];
                        				            $name=$getProfile['name'];
                        				            $pincode=$getProfile['pincode'];
                        				        break;
                        				    }
                        				    $this->session->set_userdata('userAbhaNumber',$abhaNumber);
                        				    ?>
                                            <div class="col-md-6">
                                                <label class="font-bold">ABHA Number</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $abhaNumber; ?></p>
                                            </div>
                                        </div>
                                        
                                                                                <div class="row">
                                            <div class="col-md-6">
                                                <label class="font-bold">ABHA Address</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $abhaAddress; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="font-bold">Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $name; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="font-bold">Mobile</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $getProfile['mobile']; ?></p>
                                            </div>
                                        </div>
                                        <?php 
                                        if(isset($getProfile['email']))
                                        {
                                        ?>
                                         <div class="row">
                                            <div class="col-md-6">
                                                <label class="font-bold">Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $getProfile['email']; ?></p>
                                            </div>
                                        </div>
                                        <?php 
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="font-bold">Date of Birth</label>
                                            </div>
                                            <?php
                                               $yearOfBirth=$getProfile['yearOfBirth'];
                                               $dayOfBirth=$getProfile['dayOfBirth'];
                                               $monthOfBirth=$getProfile['monthOfBirth'];
                                               $dob=$yearOfBirth.'-'.$monthOfBirth.'-'.$dayOfBirth;
                                               $dateOfBirth=date('F j,Y',strtotime($dob));
                                            ?>
                                            <div class="col-md-6">
                                                <p><?php echo $dateOfBirth?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="font-bold">Gender</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $getProfile['gender']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="font-bold">Address</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $getProfile['address']; ?> , <?php echo $pincode; ?></p>
                                            </div>
                                        </div>
                                        <?php 
                                          if($profile_type=="abhaAddress") 
                                          {
                                        ?>
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <a class="btn btn-sm btn-success" href="<?php echo base_url(); ?>admin/abhavalidation/abhaaddressverification">Back</a>
                                                    <a class="btn btn-sm btn-success" href="<?php echo base_url(); ?>admin/abhavalidation/downloadAbhaAddressCard">Download ABHA Card</a>
                                                </div>
                                            </div>
                                        <?php 
                                          }
                                          else
                                          {
                                              ?>
                                                <div class="row">
                                				    <div class="col-md-12 text-center">
                                				        <form action="<?php echo base_url(); ?>admin/abhavalidation/reKycOtp" method="POST">
                                				            <input type="hidden" name="abha_data" value="<?php echo $abhaNumber ?>">
                                				            <button type="submit" class="btn btn-sm btn-success" name="submit">Request OTP for Re-KYC</button>
                                				        </form>
                                				    </div>
                            				    </div>
                                              <?php
                                          }
                                        ?>
                                        
                                        
		        </div>
		        
		        
		        
		        <div class="validation-form-box profileBox" id="updateProfile" style="display:none"> 
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
			    <h2 class="text-center">Update Profile</h2>
			    <form action="<?php echo base_url(); ?>admin/abhavalidation/updateProfile" method="POST">
			        
                  <div class="form-check mb-15 mt-15">
        				<label class="radio-inline">
                             <input type="radio" onclick="selectUpdateData(this.value)" name="profile_data" value="email" checked> Update Email
                        </label>
                                
                        <label class="radio-inline">
                             <input type="radio" onclick="selectUpdateData(this.value)" name="profile_data" value="mobile_no"> Update Mobile Number
                        </label>         
        		</div>
                  
					<div class="mb-3 mt-3">
					  <!--label for="abha_data" id="methodText">ABHA Number:</label-->
					  <input type="text" class="form-control" id="abha_data" placeholder="Enter Email" name="abha_data" required>
					  <p id="noteMsg" style="display:none"><small>This will be used as communication mobile number</small></p>
					</div>
					
					<!--div class="form-check mb-3">
					  <label class="form-check-label">
						<input class="form-check-input" type="checkbox" name="remember"> Remember me
					  </label>
					</div-->
					<div class="mb-3 mt-3 text-center" style="margin-top:10px">
				    	<button type="submit" name="submit" class="btn btn-primary">Submit</button>
				    	<button type="button" onclick="cancelUpdateProfile()" class="btn btn-danger">Cancel</button>
					</div>
			    </form>
			</div>
			
		        </div>
                    </div>

                </div>
                
            </div>
                   
        </div><!--./row-->
       
     
    </section>
</div>
  
  
  
<script>
 function selectUpdateData(vl)
 {
     switch(vl)
     {
         case "email":
             document.getElementById("abha_data").placeholder = "Enter your email";
             document.getElementById("noteMsg").style.display = "none";
             //document.getElementById("methodText").innerHTML = "ABHA Number";
         break;
         
         case "mobile_no":
             document.getElementById("abha_data").placeholder = "Enter your registered mobile number";
             document.getElementById("noteMsg").style.display = "block";
            // document.getElementById("methodText").innerHTML = "Mobile Number";
         break;
     }
 }
 
 function updateProfile(typ)
 {
     $('.profileBox').hide();
     
     switch(typ)
     {
         case "profile_update":
             document.getElementById('updateProfile').style.display="block";
         break;
             
         case "reKyc":
             document.getElementById('reKyc').style.display="block";
         break;
     }
     
 }
 
  function cancelUpdateProfile()
 {
     $('.profileBox').hide();
     document.getElementById('profileData').style.display="block";
 }
</script>
