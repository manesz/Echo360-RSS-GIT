<?php
    // getUserProfile in case "AC, ACD" ------------------------------------------------------------------------------------
    $getDailyPortfolioLess15 = $accountClass->getDailyPortfolio('Age', array('AC', 'ACD'), 'Age < 15');
    $getDailyPortfolio18 = $accountClass->getDailyPortfolio('Age', array('AC', 'ACD'), 'Age BETWEEN 15 AND 18');
    $getDailyPortfolio24 = $accountClass->getDailyPortfolio('Age', array('AC', 'ACD'), 'Age BETWEEN 19 AND 24');
    $getDailyPortfolio29 = $accountClass->getDailyPortfolio('Age', array('AC', 'ACD'), 'Age BETWEEN 25 AND 29');
    $getDailyPortfolio34 = $accountClass->getDailyPortfolio('Age', array('AC', 'ACD'), 'Age BETWEEN 30 AND 34');
    $getDailyPortfolio45 = $accountClass->getDailyPortfolio('Age', array('AC', 'ACD'), 'Age BETWEEN 35 AND 45');
    $getDailyPortfolio50 = $accountClass->getDailyPortfolio('Age', array('AC', 'ACD'), 'Age BETWEEN 46 AND 50');
    $getDailyPortfolioMore50 = $accountClass->getDailyPortfolio('Age', array('AC', 'ACD'), 'Age > 50');
    //


    // getUserProfile in case "AC" ------------------------------------------------------------------------------------
    $getAgeAcLess15 = $accountClass->getDailyPortfolio('Age', array('AC'), 'Age < 15');
    $getAgeAc18 = $accountClass->getDailyPortfolio('Age', array('AC'), 'Age BETWEEN 15 AND 18');
    $getAgeAc24 = $accountClass->getDailyPortfolio('Age', array('AC'), 'Age BETWEEN 19 AND 24');
    $getAgeAc29 = $accountClass->getDailyPortfolio('Age', array('AC'), 'Age BETWEEN 25 AND 29');
    $getAgeAc34 = $accountClass->getDailyPortfolio('Age', array('AC'), 'Age BETWEEN 30 AND 34');
    $getAgeAc45 = $accountClass->getDailyPortfolio('Age', array('AC'), 'Age BETWEEN 35 AND 45');
    $getAgeAc50 = $accountClass->getDailyPortfolio('Age', array('AC'), 'Age BETWEEN 46 AND 50');
    $getAgeAcMore50 = $accountClass->getDailyPortfolio('Age', array('AC'), 'Age > 50');


    // getUserProfile in case "AP" ------------------------------------------------------------------------------------
    $getAgeApLess15 = $accountClass->getDailyPortfolio('Age', array('AP'), 'Age < 15');
    $getAgeAp18 = $accountClass->getDailyPortfolio('Age', array('AP'), 'Age BETWEEN 15 AND 18');
    $getAgeAp24 = $accountClass->getDailyPortfolio('Age', array('AP'), 'Age BETWEEN 19 AND 24');
    $getAgeAp29 = $accountClass->getDailyPortfolio('Age', array('AP'), 'Age BETWEEN 25 AND 29');
    $getAgeAp34 = $accountClass->getDailyPortfolio('Age', array('AP'), 'Age BETWEEN 30 AND 34');
    $getAgeAp45 = $accountClass->getDailyPortfolio('Age', array('AP'), 'Age BETWEEN 35 AND 45');
    $getAgeAp50 = $accountClass->getDailyPortfolio('Age', array('AP'), 'Age BETWEEN 46 AND 50');
    $getAgeApMore50 = $accountClass->getDailyPortfolio('Age', array('AP'), 'Age > 50');

    $resultGetAgeAcAcdSort  = array(
        array('less 15', end($getDailyPortfolioLess15[count($getDailyPortfolioLess15)-1])),
        array('15 - 18', end($getDailyPortfolio18[count($getDailyPortfolio18)-1])),
        array('19 - 24', end($getDailyPortfolio24[count($getDailyPortfolio24)-1])),
        array('25 - 29', end($getDailyPortfolio29[count($getDailyPortfolio29)-1])),
        array('30 - 34', end($getDailyPortfolio34[count($getDailyPortfolio34)-1])),
        array('35 - 45', end($getDailyPortfolio45[count($getDailyPortfolio45)-1])),
        array('46 - 50', end($getDailyPortfolio50[count($getDailyPortfolio50)-1])),
        array('More 50', end($getDailyPortfolioMore50[count($getDailyPortfolioMore50)-1]))
    );

    $resultGetAgeAcSort  = array(
        array('less 15', end($getAgeAcLess15[count($getAgeAcLess15)-1])),
        array('15 - 18', end($getAgeAc18[count($getAgeAc18)-1])),
        array('19 - 24', end($getAgeAc24[count($getAgeAc24)-1])),
        array('25 - 29', end($getAgeAc29[count($getAgeAc29)-1])),
        array('30 - 34', end($getAgeAc34[count($getAgeAc34)-1])),
        array('35 - 45', end($getAgeAc45[count($getAgeAc45)-1])),
        array('46 - 50', end($getAgeAc50[count($getAgeAc50)-1])),
        array('More 50', end($getAgeAcMore50[count($getAgeAcMore50)-1]))
    );

    $resultGetAgeApSort  = array(
        array('less 15', end($getAgeApLess15[count($getAgeApLess15)-1])),
        array('15 - 18', end($getAgeAp18[count($getAgeAp18)-1])),
        array('19 - 24', end($getAgeAp24[count($getAgeAp24)-1])),
        array('25 - 29', end($getAgeAp29[count($getAgeAp29)-1])),
        array('30 - 34', end($getAgeAp34[count($getAgeAp34)-1])),
        array('35 - 45', end($getAgeAp45[count($getAgeAp45)-1])),
        array('46 - 50', end($getAgeAp50[count($getAgeAp50)-1])),
        array('More 50', end($getAgeApMore50[count($getAgeApMore50)-1]))
    );
?>

<div id="AgeAcAcd" class="col-lg-12" style="padding-bottom: 10px; border-bottom: 1px #ddd solid;">
    <script>
        $(function () {

            // Make monochrome colors and set them as default for all pies
            Highcharts.getOptions().plotOptions.pie.colors = (function () {
                var colors = [],
                    base = Highcharts.getOptions().colors[0],
                    i;

                for (i = 0; i < 10; i += 1) {
                    // Start out with a darkened base color (negative brighten), and end
                    // up with a much brighter color
                    colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
                }
                return colors;
            }());

            // Build the chart
            $('#container').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Age : AC and ACD'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.2f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Browser share',
                    data: [
                        ['<?php echo $resultGetAgeAcAcdSort[0][0]; ?>',   <?php echo $resultGetAgeAcAcdSort[0][1]; ?>],
                        ['<?php echo $resultGetAgeAcAcdSort[1][0]; ?>',   <?php echo $resultGetAgeAcAcdSort[1][1]; ?>],
                        ['<?php echo $resultGetAgeAcAcdSort[2][0]; ?>',   <?php echo $resultGetAgeAcAcdSort[2][1]; ?>],
                        ['<?php echo $resultGetAgeAcAcdSort[3][0]; ?>',   <?php echo $resultGetAgeAcAcdSort[3][1]; ?>],
                        ['<?php echo $resultGetAgeAcAcdSort[4][0]; ?>',   <?php echo $resultGetAgeAcAcdSort[4][1]; ?>],
                        ['<?php echo $resultGetAgeAcAcdSort[5][0]; ?>',   <?php echo $resultGetAgeAcAcdSort[5][1]; ?>],
                        ['<?php echo $resultGetAgeAcAcdSort[6][0]; ?>',   <?php echo $resultGetAgeAcAcdSort[6][1]; ?>],
                        ['<?php echo $resultGetAgeAcAcdSort[7][0]; ?>',   <?php echo $resultGetAgeAcAcdSort[7][1]; ?>]
                    ]
                }]
            });
        });
    </script>
    <div id="container" class="col-lg-8" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    <div class="table-responsive col-lg-4">


        <table id="" class="table table-striped">
            <thead>
            <tr>
                <th>Age</th>
                <th>per person</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($resultGetAgeAcAcdSort as $key=>$value):?>
                <tr>
                    <td><?php echo $value[0]; ?></td>
                    <td><?php echo number_format($value[1])." คน"; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div><!-- DIV#AgeAcAcd -->
<div id="AgeAc" class="col-lg-12" style="padding-bottom: 10px; border-bottom: 1px #ddd solid;">
    <script>
        $(function () {

            // Make monochrome colors and set them as default for all pies
            Highcharts.getOptions().plotOptions.pie.colors = (function () {
                var colors = [],
                    base = Highcharts.getOptions().colors[0],
                    i;

                for (i = 0; i < 10; i += 1) {
                    // Start out with a darkened base color (negative brighten), and end
                    // up with a much brighter color
                    colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
                }
                return colors;
            }());

            // Build the chart
            $('#container2').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Age : AC'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Browser share',
                    data: [
                        ['<?php echo $resultGetAgeAcSort[0][0]; ?>',   <?php if(isset($resultGetAgeAcSort[0][1])): echo $resultGetAgeAcSort[0][1]; else: echo 0; endif;?>],
                        ['<?php echo $resultGetAgeAcSort[1][0]; ?>',   <?php if(isset($resultGetAgeAcSort[1][1])): echo $resultGetAgeAcSort[1][1]; else: echo 0; endif;?>],
                        ['<?php echo $resultGetAgeAcSort[2][0]; ?>',   <?php if(isset($resultGetAgeAcSort[2][1])): echo $resultGetAgeAcSort[2][1]; else: echo 0; endif;?>],
                        ['<?php echo $resultGetAgeAcSort[3][0]; ?>',   <?php if(isset($resultGetAgeAcSort[3][1])): echo $resultGetAgeAcSort[3][1]; else: echo 0; endif;?>],
                        ['<?php echo $resultGetAgeAcSort[4][0]; ?>',   <?php if(isset($resultGetAgeAcSort[4][1])): echo $resultGetAgeAcSort[4][1]; else: echo 0; endif;?>],
                        ['<?php echo $resultGetAgeAcSort[5][0]; ?>',   <?php if(isset($resultGetAgeAcSort[5][1])): echo $resultGetAgeAcSort[5][1]; else: echo 0; endif;?>],
                        ['<?php echo $resultGetAgeAcSort[5][0]; ?>',   <?php if(isset($resultGetAgeAcSort[6][1])): echo $resultGetAgeAcSort[6][1]; else: echo 0; endif;?>],
                        ['<?php echo $resultGetAgeAcSort[7][0]; ?>',   <?php if(isset($resultGetAgeAcSort[7][1])): echo $resultGetAgeAcSort[7][1]; else: echo 0; endif;?>]
                    ]
                }]
            });
        });
    </script>
    <div class="table-responsive col-lg-4">
        <table id="" class="table table-striped">
            <thead>
            <tr>
                <th>Age</th>
                <th>per person</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($resultGetAgeAcSort as $key=>$value):?>
                <tr>
                    <td><?php echo $value[0]; ?></td>
                    <td><?php echo number_format($value[1])." คน"; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div id="container2" class="col-lg-8" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
</div><!-- END : Div#Ac -->
<div id="AgeAp" class="col-lg-12" style="padding-bottom: 10px; border-bottom: 1px #ddd solid;">
    <script>
        $(function () {

            // Make monochrome colors and set them as default for all pies
            Highcharts.getOptions().plotOptions.pie.colors = (function () {
                var colors = [],
                    base = Highcharts.getOptions().colors[0],
                    i;

                for (i = 0; i < 10; i += 1) {
                    // Start out with a darkened base color (negative brighten), and end
                    // up with a much brighter color
                    colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
                }
                return colors;
            }());

            // Build the chart
            $('#container3').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Age : AP'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Browser share',
                    data: [
                        ['<?php echo $resultGetAgeApSort[0][0]; ?>',   <?php if(isset($resultGetAgeApSort[0][1])): echo $resultGetAgeApSort[0][1]; else: echo 0; endif;?>],
                        ['<?php echo $resultGetAgeApSort[1][0]; ?>',   <?php if(isset($resultGetAgeApSort[1][1])): echo $resultGetAgeApSort[1][1]; else: echo 0; endif;?>],
                        ['<?php echo $resultGetAgeApSort[2][0]; ?>',   <?php if(isset($resultGetAgeApSort[2][1])): echo $resultGetAgeApSort[2][1]; else: echo 0; endif;?>],
                        ['<?php echo $resultGetAgeApSort[3][0]; ?>',   <?php if(isset($resultGetAgeApSort[3][1])): echo $resultGetAgeApSort[3][1]; else: echo 0; endif;?>],
                        ['<?php echo $resultGetAgeApSort[4][0]; ?>',   <?php if(isset($resultGetAgeApSort[4][1])): echo $resultGetAgeApSort[4][1]; else: echo 0; endif;?>],
                        ['<?php echo $resultGetAgeApSort[5][0]; ?>',   <?php if(isset($resultGetAgeApSort[5][1])): echo $resultGetAgeApSort[5][1]; else: echo 0; endif;?>],
                        ['<?php echo $resultGetAgeApSort[5][0]; ?>',   <?php if(isset($resultGetAgeApSort[6][1])): echo $resultGetAgeApSort[6][1]; else: echo 0; endif;?>],
                        ['<?php echo $resultGetAgeApSort[7][0]; ?>',   <?php if(isset($resultGetAgeApSort[7][1])): echo $resultGetAgeApSort[7][1]; else: echo 0; endif;?>]
                    ]
                }]
            });
        });
    </script>
    <div id="container3" class="col-lg-8" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    <div class="table-responsive col-lg-4">
        <table id="" class="table table-striped">
            <thead>
            <tr>
                <th>Age</th>
                <th>per person</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($resultGetAgeApSort as $key=>$value):?>
                <tr>
                    <td><?php echo $value[0]; ?></td>
                    <td><?php echo number_format($value[1])." คน"; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>