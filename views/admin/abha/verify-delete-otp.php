
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
                        <h3 class="box-title titlefix">Verify OTP</h3>    
                    </div>
                    
                    <div class="box-body">
                        <form action="<?php echo base_url(); ?>admin/abhavalidation/verifyDeleteOtp" method="POST">
        					
        					<div class="mb-15 mt-15">
            					 <label for="abha_otp">Enter OTP:</label>
    					         <input type="text" class="form-control" id="abha_otp" placeholder="Enter OTP" name="abha_otp" required>
        					</div>
                          
                           <div class="mb-15 mt-15" id="reasonDiv">
        					  <!--label for="abha_data" id="methodText">ABHA Number:</label-->
        					  <input type="text" class="form-control" id="abha_reason" placeholder="Reason for deletion"  name="delete_reason" required>
        					</div>
                          
        					<div class="mb-15 mt-15 text-center">
        				    	<button type="submit" name="submit" class="btn btn-primary">Verify OTP</button>
        					</div>
        			    </form>
                    </div>

                </div>
                
            </div>
                   
        </div><!--./row-->
       
     
    </section>
</div>
  