
<?php
$currency_symbol = $this->customlib->getHospitalCurrencyFormat();
?>
<div class="fixed-print-header">
    <?php if (!empty($print_details[0]['print_header'])) { ?>
        <div>
            <img src="<?php
                if (!empty($print_details[0]['print_header'])) {
                echo base_url() . $print_details[0]['print_header'].img_time();
                }
            ?>" class="img-responsive" style="height:100px; width: 100%;">
        </div>
    <?php } ?>
</div>  
<table class="table-print-full" width="100%">
    <thead>
        <tr>
            <td><div class="header-space">&nbsp;</div></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <div class="content-body">  
                    <div class="print-area p-1">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">  
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <p><?php echo $this->lang->line('patient'); ?> : <?php echo composePatientName($transaction->patient_name,$transaction->patient_id); ?></p>
                                                <p><?php echo $this->lang->line('case_id'); ?> : <?php if($transaction->case_reference_id != 0){echo $transaction->case_reference_id;} ?></p>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <p><span class="text-muted"><?php echo $this->lang->line('transaction_id'); ?>: </span> <?php echo $this->customlib->getSessionPrefixByType('transaction_id').$transaction->id; ?></p>
                                                <p><span class="text-muted"><?php echo $this->lang->line('date'); ?>: </span>
                                                <?php echo date($this->customlib->getHospitalDateFormat(true, true), strtotime($transaction->payment_date)); ?></p>                  
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="col-md-12">
                                                <table class="print-table">
                                                <thead>
                                                    <tr class="line">
                                                    <td>#</td>
                                                    <td><?php echo $this->lang->line('description'); ?></td>
                                                    <td class="text-right"><?php echo $this->lang->line('amount').' ('.$currency_symbol.')'; ?></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                    <?php 
                                                    if($transaction->type == "payment"){
                                                    $payment_type= $this->lang->line("payment_received");
                                                    }elseif ($transaction->type == "refund") {
                                                    $payment_type= $this->lang->line("payment_refund");
                                                    }
                                                    ?>
                                                    <td>1</td>
                                                    <td><?php echo $payment_type; ?><br>
                                                        <?php
                                                        echo $this->lang->line("by"). ": ".$this->lang->line(strtolower($transaction->payment_mode));
                                                        if($transaction->payment_mode == "Cheque"){
                                                        echo " ".$transaction->cheque_no;
                                                        }
                                                        if($transaction->payment_mode == "Cheque"){
                                                        echo "<br>";
                                                        echo $this->customlib->YYYYMMDDTodateFormat($transaction->cheque_date);
                                                        }
                                                        ?></td>
                                                    <td class="text-right"><?php echo $transaction->amount ?></td>
                                                    </tr>
                                                    <tr>
                                                    <td colspan="1"></td>
                                                    <td class="text-right"><?php echo $this->lang->line('total'); ?></td>
                                                    <td class="text-right"><?php echo $currency_symbol.$transaction->amount ?></td>
                                                    </tr>
                                                    <tr>
                                                    <td colspan="3"><?php echo $this->lang->line('note').': '.$transaction->note ?></td> 
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </td></tr></tbody>
    <tfoot><tr><td>

    <?php
                    if (!empty($print_details[0]['print_footer'])) {
                        ?>
       <div class="footer-space">&nbsp;</div>
  <?php
}
?>



    </td></tr></tfoot>
  </table>
  <?php
                    if (!empty($print_details[0]['print_footer'])) {
                        ?>
  <div class="footer-fixed">
  
  <?php   echo $print_details[0]['print_footer'];?>
                
  </div>
  <?php
}
?>