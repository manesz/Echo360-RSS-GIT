<?php include_once("libs/class/account.class.php"); ?>
<?php
    $accountClass = new accountClass();
    $getDailyPortfolioGenderAcAcd = $accountClass->getDailyPortfolio('Gender', array('AC', 'ACD'), '');
    $getDailyPortfolioGenderAc = $accountClass->getDailyPortfolio('Gender', array('AC'), '');
    $getDailyPortfolioGenderAp = $accountClass->getDailyPortfolio('Gender', array('AP'), '');
?>

<div id="GenderAcAcd" class="col-lg-12" style="padding-bottom: 10px; border-bottom: 1px #ddd solid;">
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
            $('#containerGenderAcAcd').highcharts({
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
                        ['<?php echo $getDailyPortfolioGenderAcAcd[0][0]; ?>',   <?php echo $getDailyPortfolioGenderAcAcd[0][1]; ?>],
                        ['<?php echo $getDailyPortfolioGenderAcAcd[1][0]; ?>',   <?php echo $getDailyPortfolioGenderAcAcd[1][1]; ?>]
                    ]
                }]
            });
        });
    </script>
    <div id="containerGenderAcAcd" class="col-lg-8" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    <div class="table-responsive col-lg-4">

        <table id="" class="table table-striped">
            <thead>
            <tr>
                <th>Gender</th>
                <th>per person</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($getDailyPortfolioGenderAcAcd as $key=>$value):?>
                <tr>
                    <td><?php echo $value[0]; ?></td>
                    <td><?php echo number_format($value[1])." คน"; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div><!-- DIV#GenderAcAcd -->
<div id="GenderAc" class="col-lg-12" style="padding-bottom: 10px; border-bottom: 1px #ddd solid;">
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
            $('#containerGenderAc').highcharts({
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
                        ['<?php echo $getDailyPortfolioGenderAc[0][0]; ?>',   <?php echo $getDailyPortfolioGenderAc[0][1]; ?>],
                        ['<?php echo $getDailyPortfolioGenderAc[1][0]; ?>',   <?php echo $getDailyPortfolioGenderAc[1][1]; ?>]
                    ]
                }]
            });
        });
    </script>
    <div class="table-responsive col-lg-4">

        <table id="" class="table table-striped">
            <thead>
            <tr>
                <th>Gender</th>
                <th>per person</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($getDailyPortfolioGenderAc as $key=>$value):?>
                <tr>
                    <td><?php echo $value[0]; ?></td>
                    <td><?php echo number_format($value[1])." คน"; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div id="containerGenderAc" class="col-lg-8" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
</div><!-- DIV#GenderAc -->
<div id="GenderAp" class="col-lg-12" style="padding-bottom: 10px; border-bottom: 1px #ddd solid;">
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
            $('#containerGenderAp').highcharts({
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
                        ['<?php echo $getDailyPortfolioGenderAp[0][0]; ?>',   <?php echo $getDailyPortfolioGenderAp[0][1]; ?>],
                        ['<?php echo $getDailyPortfolioGenderAp[1][0]; ?>',   <?php echo $getDailyPortfolioGenderAp[1][1]; ?>]
                    ]
                }]
            });
        });
    </script>
    <div id="containerGenderAp" class="col-lg-8" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    <div class="table-responsive col-lg-4">

        <table id="" class="table table-striped">
            <thead>
            <tr>
                <th>Gender</th>
                <th>per person</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($getDailyPortfolioGenderAp as $key=>$value):?>
                <tr>
                    <td><?php echo $value[0]; ?></td>
                    <td><?php echo number_format($value[1])." คน"; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div><!-- DIV#GenderAp -->