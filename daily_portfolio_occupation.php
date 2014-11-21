<?php include_once("libs/class/account.class.php"); ?>
<?php
$accountClass = new accountClass();
$getDailyPortfolioIncomeAcAcd = $accountClass->getDailyPortfolio('Income_Range_Cd', array('AC', 'ACD'), '');
$getDailyPortfolioIncomeAc = $accountClass->getDailyPortfolio('Income_Range_Cd', array('AC'), '');
$getDailyPortfolioIncomeAp = $accountClass->getDailyPortfolio('Income_Range_Cd', array('AP'), '');

//var_dump($getDailyPortfolioIncomeAcAcd);exit();
?>

<div id="IncomeAcAcd" class="col-lg-12" style="padding-bottom: 10px; border-bottom: 1px #ddd solid;">
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
            $('#containerIncomeAcAcd').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Gender : AC and ACD'
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
                        ['<?php if(is_null($getDailyPortfolioIncomeAcAcd[0][0])): echo 'NULL'; else: echo $getDailyPortfolioIncomeAcAcd[0][0]; endif; ?>',   <?php echo $getDailyPortfolioIncomeAcAcd[0][1]; ?>]
                        ,['<?php echo $getDailyPortfolioIncomeAcAcd[1][0]; ?>',   <?php echo $getDailyPortfolioIncomeAcAcd[1][1]; ?>]
                        ,['<?php echo $getDailyPortfolioIncomeAcAcd[2][0]; ?>',   <?php echo $getDailyPortfolioIncomeAcAcd[2][1]; ?>]
                        ,['<?php echo $getDailyPortfolioIncomeAcAcd[3][0]; ?>',   <?php echo $getDailyPortfolioIncomeAcAcd[3][1]; ?>]
                    ]
                }]
            });
        });
    </script>
    <div id="containerIncomeAcAcd" class="col-lg-8" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    <div class="table-responsive col-lg-4">

        <table id="" class="table table-striped">
            <thead>
            <tr>
                <th>Income</th>
                <th>per man</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($getDailyPortfolioIncomeAcAcd as $key=>$value):?>
                <tr>
                    <td><?php if( is_null($value[0])): echo 'NULL'; else: echo $value[0]; endif; ?></td>
                    <td><?php echo number_format($value[1])." คน"; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div><!-- DIV#IncomeAcAcd -->

<?php exit();?>
<div id="IncomeAc" class="col-lg-12" style="padding-bottom: 10px; border-bottom: 1px #ddd solid;">
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
            $('#containerIncomeAc').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Gender : AC'
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
                        ['<?php if($getDailyPortfolioIncomeAc == ''): echo 'NULL'; else: echo $getDailyPortfolioIncomeAc[0][0]; endif;; ?>',   <?php echo $getDailyPortfolioIncomeAc[0][1]; ?>],
                        ['<?php echo $getDailyPortfolioIncomeAc[1][0]; ?>',   <?php echo $getDailyPortfolioIncomeAc[1][1]; ?>]
                    ]
                }]
            });
        });
    </script>
    <div class="table-responsive col-lg-4">

        <table id="" class="table table-striped">
            <thead>
            <tr>
                <th>อายุ</th>
                <th>จำนวน/คน</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($getDailyPortfolioIncomeAc as $key=>$value):?>
                <tr>
                    <td><?php echo $value[0]; ?></td>
                    <td><?php echo number_format($value[1])." คน"; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div id="containerIncomeAc" class="col-lg-8" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
</div><!-- DIV#IncomeAc -->
<div id="IncomeAp" class="col-lg-12" style="padding-bottom: 10px; border-bottom: 1px #ddd solid;">
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
            $('#containerIncomeAp').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Gender : AC'
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
                        ['<?php echo $getDailyPortfolioIncomeAp[0][0]; ?>',   <?php echo $getDailyPortfolioIncomeAp[0][1]; ?>],
                        ['<?php echo $getDailyPortfolioIncomeAp[1][0]; ?>',   <?php echo $getDailyPortfolioIncomeAp[1][1]; ?>]
                    ]
                }]
            });
        });
    </script>
    <div id="containerIncomeAp" class="col-lg-8" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    <div class="table-responsive col-lg-4">

        <table id="" class="table table-striped">
            <thead>
            <tr>
                <th>อายุ</th>
                <th>จำนวน/คน</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($getDailyPortfolioIncomeAp as $key=>$value):?>
                <tr>
                    <td><?php echo $value[0]; ?></td>
                    <td><?php echo number_format($value[1])." คน"; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div><!-- DIV#IncomeAp -->