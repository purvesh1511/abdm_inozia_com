
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
                        <h3 class="box-title titlefix">ABHA List</h3>    
                    </div>
                    
                    <div class="box-body">
          
		             <div class="col-md-12">
                       <form action="<?php echo base_url(); ?>admin/abhavalidation/sendSearchOtp" method="POST">
                           <table class="table table-bordered">
                               <thead>
                                   <th>ABHA Number</th>
                                   <th>Name</th>
                                   <th>Gender</th>
                                   <th></th>
                               </thead>
                               <tbody>
                                   <?php 
                                   foreach($abhaList as $usr)
                                   {
                                       ?>
                                          <tr>
                                              <input type="hidden" value="<?php echo $usr['index']; ?>" name="abha_data">
                                              <td><?php echo $usr['ABHANumber']; ?></td>
                                              <td><?php echo $usr['name']; ?></td>
                                              <td><?php echo $usr['gender']; ?></td>
                                              <td><button type="submit" name="submit" class="btn btn-sm btn-success">Send OTP</button></td>
                                          </tr>
                                       <?php
                                   }
                                   ?>
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
  
 