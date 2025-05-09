
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
                        <h3 class="box-title titlefix">ABHA Address List</h3>    
                    </div>
                    
                    <div class="box-body">
          
		             <div class="col-md-12">
                       <form action="<?php echo base_url(); ?>admin/abhavalidation/sendAbhaAddressVerifyOtp" method="POST">
                           <table class="table table-bordered">
                               <thead>
                                   <th>ABHA Number</th>
                                   <th>ABHA Address</th>
                                   <th>Name</th>
                                   <th>Mobile</th>
                                   <th></th>
                               </thead>
                               <tbody>
                                          <tr>
                                              <input type="hidden" value="<?php echo $getData['abhaAddress']; ?>" name="abha_data">
                                              <input type="hidden" value="<?php echo $verify_by; ?>" name="verify_by">
                                              <td><?php echo $getData['healthIdNumber']; ?></td>
                                              <td><?php echo $getData['abhaAddress']; ?></td>
                                              <td><?php echo $getData['fullName']; ?></td>
                                              <td><?php echo $getData['mobile']; ?></td>
                                              <td><button type="submit" name="submit" class="btn btn-sm btn-success">Send OTP</button></td>
                                          </tr>
                                       
                               </tbody>
                           </table>
                       </form>
                    </div>
                    </div>

                </div>
                
            </div>
                   
        </div><!--./row-->
       
     
    </section>
</div>
  
 