<table id="offerProfile" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th width="">Name</th>
        <th width="">String</th>
        <th width="">Number</th>
        <th width="">Datetime</th>
    </tr>
    </thead>
    <tbody>
    <?php
    //var_dump($getOfferAttibute);
    foreach($getOfferAttibute as $key=>$value){
    ?>
    <tr>
        <td><?php echo $value[2]; //Name?></td>
        <td><?php echo $value[3]; //String?></td>
        <td><?php echo $value[4]; //Number?></td>
        <td><?php
            //var_dump($value[5]);
            if(!is_null($value[5])): $resultDate = date_format($value[5], 'Y M d');
            else: $resultDate = 'NULL';
            endif;
            echo $resultDate;
            // echo date_format($value[5], 'Y M d'); //Datetime
            ?></td>
    </tr>
    <?php }//END: foreach ?>
    <tr>
        <td>Marketing Score</td>
        <td></td>
        <td><?php echo $getOfferMarketingScore[2]; ?></td>
        <td></td>
    </tr>


    </tbody>
</table>