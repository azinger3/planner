<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $pageTitle = 'Breakdown';

            require_once('include/header.php');

            require_once('include/icon.budget.php');
        ?>

        <style>
            .amount-red {
                color: red;
            }

            .transactionDetail {
                width: 20%;
            }

            .averageHeader {
                font-size: 28px; 
                margin-bottom: 20px;
                margin-top: -5px;
            }

            .breakdownContainer {
                margin-top: 25px;
            }
        </style>
    </head>
    <body>
        <?php require_once('include/navigation.budget.php'); ?>

        <div class="container">
            <div class="page-header">
                <div class="row">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="averageHeader">Breakdown</div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="pull-right" id="uxBudgetYearOption"></div>
                </div>
            </div>
            <div class="row">
                <div class="breakdownContainer">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <canvas id="uxBudgetBreakdownChart"></canvas>
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>
            </div>
        </div>

        <script id="tmplBudgetYearOption" type="text/x-handlebars-template">
            {{#each BudgetYear}}
                <option value="{{YearValue}}">{{YearName}}</option>
            {{/each}}
        </script>

        <?php require_once('include/footer.php'); ?>

        <script>
            var api = "http://api.jordanandrobert.com/budget";
            var data = new Object();

            var budgetYear = "";
            var startDT = "";
            var endDT = "";

            var categoryExpenseTotal = "";
            var chartLabel = [];
            var chartBackgroundColor = [];
            var chartData = [];

            var objBudgetYear = new Object();
            objBudgetYear.BudgetYear = "";

            $(document).ready(function() {
                console.log("Ready!");

                if ($.urlParam("StartDT") != undefined && $.urlParam("EndDT") != undefined) {
                    startDT = $.urlParam("StartDT"); 
                    endDT = $.urlParam("EndDT"); 

                    budgetYear = startDT + "|" + endDT;

                    data.StartDT = $.urlParam("StartDT"); 
                    data.EndDT = $.urlParam("EndDT"); 

                    BudgetBreakdownGet();
                }
                else {
                    if (Date.today().toString("M") == "4") {
                        startDT = Date.today().toString("yyyy-MM-01");
                    }
                    else {
                        startDT = Date.today().moveToMonth(3, -1).toString("yyyy-MM-01"); 
                    }
                    
                    endDT = Date.today().addMonths(1).toString("yyyy-MM-01"); 

                    budgetYear = startDT + "|" + endDT;

                    data.StartDT = startDT;
                    data.EndDT = endDT;

                    BudgetBreakdownGet();
                }   

                BudgetYearGet();          
            });

            function BudgetBreakdownGet() {
                var result = {};

                $.ajax({
                    type: "GET",
                    url: api + "/breakdown",
                    cache: false,
                    data: data,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        result = msg;

                        categoryExpenseTotal = result[0].CategoryExpenseTotal;

                        BudgetBreakdownChartLabelSet(result);
                        BudgetBreakdownChartBackgroundColorSet(result);
                        BudgetBreakdownChartDataSet(result);
                        BudgetBreakdownChartRender();
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        if (XMLHttpRequest.readyState < 4) {
                            return true;
                        }
                        else {
                            alert('Error :' + XMLHttpRequest.responseText);
                        }
                    }
                });
            }

            function BudgetYearGet() {
                var result = {};

                $.ajax({
                    type: "GET",
                    url: api + "/year",
                    cache: false,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        result = msg;

                        objBudgetYear.BudgetYear = result;

                        BudgetYearOptionRender();

                        $("#uxBudgetYear option[value='" + budgetYear + "']").prop("selected", true);

                        $("#uxBudgetYear").change(function() {
                            budgetYear = $("#uxBudgetYear option:selected").val();
                            
                            var res = budgetYear.split("|");

                            data.StartDT = res[0];
                            data.EndDT = res[1];

                            window.location.href = "breakdown?StartDT=" + data.StartDT + "&EndDT=" + data.EndDT;
                        });
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        if (XMLHttpRequest.readyState < 4) {
                            return true;
                        }
                        else {
                            alert('Error :' + XMLHttpRequest.responseText);
                        }
                    }
                });
            }

            function BudgetBreakdownChartLabelSet(result) {
                $.each(result, function(index, value) {
                    chartLabel.push(value.CategoryLabel);
                });
            }

            function BudgetBreakdownChartBackgroundColorSet(result) {
                $.each(result, function(index, value) {
                    chartBackgroundColor.push(value.ColorHighlight);
                });  
            }

            function BudgetBreakdownChartDataSet(result) {
                $.each(result, function(index, value) {
                    chartData.push(value.CategoryTotal);
                });
            }

            function BudgetBreakdownChartRender() {
                var ctx = document.getElementById("uxBudgetBreakdownChart").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: chartLabel,
                        datasets: [
                            {
                                backgroundColor: chartBackgroundColor,
                                data: chartData
                            }
                        ]
                    },
                    options: {
                        legend: {
                            display: true,
                            position: "bottom",
                            labels: {
                                fontColor: "#2c3e50",
                                fontFamily: "Lato",
                                fontStyle: "bold",
                                fontSize: 12,
                                padding: 15,
                                boxWidth: 20
                            }
                        },
                        tooltips: {
                            enabled: true,
                            bodyFontFamily: "Lato",
                            bodyFontSize: 12,
                            callbacks: {
                                label: function(tooltipItem, data) {                                    
                                    var categoryPercentage = data.labels[tooltipItem.index];
                                    var categoryTotal = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];

                                    return  "  " + categoryPercentage + " :  $" + NumberCommaFormat(categoryTotal);
                                },
                                labelColor: function(tooltipItem, chartInstance) {
                                    var colorHightlight = chartInstance.config.data.datasets[tooltipItem.datasetIndex].backgroundColor[tooltipItem.index];
                                    
                                    var labelColor = new Object();
                                    labelColor.borderColor = "#ffffff";
                                    labelColor.backgroundColor = colorHightlight;

                                    return labelColor;
                                }
                            }
                        }
                    }
                });
            }

            function BudgetYearOptionRender() {
                var source = $("#tmplBudgetYearOption").html();
                var template = Handlebars.compile(source);

                var context = objBudgetYear;
                var html = template(context);

                var dropdown = "<select class='form-control input-sm' id='uxBudgetYear'>" 
                            + html 
                            + "</select>";

                $("#uxBudgetYearOption").html(dropdown);
            }
        </script>
    </body>
</html>
