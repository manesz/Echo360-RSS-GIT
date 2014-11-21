<table id="offerProfile" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th width="200">OfferCode</th>
        <th width="200">Current MPP</th>
        <th width="200">Setup MPP</th>
        <th width="200">Total Imp</th>
    </tr>
    </thead>
    <tbody>
    <tr>

        <td><?php echo $getOfferSubrLimitMpp[0]; //Name?></td>
        <td><?php echo $getOfferSubrLimitMpp[1]; //Name?></td>
        <td><?php echo $getOfferSubrLimitMpp[2]; //Name?></td>
        <td><?php echo number_format($getOfferSubrLimitMpp[9]); //Name?></td>

    </tbody>
</table>

<table id="offerProfile" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th width="200">OfferCode</th>
        <th width="200">Title</th>
        <th width="200">Current</th>
        <th width="200">New</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?php echo $getOfferSubrLimitMpp[0]; //Name?></td>
        <td><?php echo "<"; //Name?></td>
        <td><?php echo number_format($getOfferSubrLimitMpp[3]); //Name?></td>
        <td><?php echo number_format($getOfferSubrLimitMpp[4]); //Name?></td>
    </tr>
    <tr>
        <td><?php echo $getOfferSubrLimitMpp[0]; //Name?></td>
        <td><?php echo "="; //Name?></td>
        <td><?php echo number_format($getOfferSubrLimitMpp[5]); //Name?></td>
        <td><?php echo number_format($getOfferSubrLimitMpp[6]); //Name?></td>
    </tr>
    <tr>
        <td><?php echo $getOfferSubrLimitMpp[0]; //Name?></td>
        <td><?php echo ">"; //Name?></td>
        <td><?php echo number_format($getOfferSubrLimitMpp[7]); //Name?></td>
        <td><?php echo number_format($getOfferSubrLimitMpp[8]); //Name?></td>
    </tr>
    </tbody>
</table>