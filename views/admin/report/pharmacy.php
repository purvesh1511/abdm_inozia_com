<?php
$currency_symbol = $this->customlib->getHospitalCurrencyFormat();
?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary border0 mb0">
                    <?php $this->load->view('admin/report/_pharmacy');?>
                </div>
            </div>  
        </div>   
   </section>
</div>
