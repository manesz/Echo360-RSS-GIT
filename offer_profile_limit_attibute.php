<table id="offerProfile" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th width="200">OfferCode</th>
        <th width="200">Limit Setup</th>
        <th width="200">Limit Use</th>
        <th width="200">Status</th>
    </tr>
    </thead>
    <tbody>

    <tr>
        <td><?php echo $substrOfferCode; //OfferCode?></td>
        <td><?php echo number_format($getOfferLimit[1]); //Limit Setup?></td>
        <td><?php echo number_format($getOfferLimit[2]); //Limit Use?></td>
        <td><?php
            if($getOfferLimit[3] == 1): echo "<span style='color: green'>Open</span>";
            elseif($getOfferLimit[3] == 0): echo "<span style='color: red'>Close</span>";
            endif;
            //Status?></td>
    </tr>

    </tbody>
</table>