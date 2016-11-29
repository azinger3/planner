<!DOCTYPE html>
<html lang="en">
    <head>

        <?php
            $pageTitle = 'Budget';

            require_once('include/header.php');
        ?>

        <style>
            .progress {
                margin-bottom: 10px;
            }

            .remaining {
                text-align: right;
            }

            .balance {
                text-align: right;
            }

            .total {
                background-color: #f2f2f2;
            }

            .categoryWidth {
                width: 15%;
            }

            .progressWidth {
                width: 70%;
            }

            .remainingWidth {
                width: 15%;
            }

            .progress-sm {
                margin-top: 5px !important;
                margin-bottom: 5px !important;
            }

            .progress-lg {
                margin-top: 15px !important;
            }

            .currentMonth {
                text-align: center;
            }

            .addTransactionLink {
                color: #ffffff;
                font-size: 17px;
            }

            .amount-red {
                color: red;
            }
        </style>
    </head>
    <body>

        <!--Navigation START-->
        <?php require_once('include/navigation.budget.php'); ?>
        <!--Navigation END-->

        <!--Container START-->
        <div class="container">
            <!--**********************************************************Main Content START**********************************************************-->

            <!--Page Header START-->
            <div class="page-header">
                <div class="row">
                </div>
            </div>
            <!--Page Header END-->       

            <!--Content START-->
            <div class="row">
                <div class="col-md-8">
                    <!--Remaining Variable Funds START-->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Remaining Variable Funds
                            <div class="pull-right">
                                <a href="budget/transaction" title="Add Transaction" class="addTransactionLink"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div id="uxBudgetCategorySpotlight"></div>
                    </div>
                    <!--Remaining Variable Funds END-->
                    <!--Savings Breakdown START-->
                    <div class="panel panel-primary">
                        <div class="panel-heading">Savings Breakdown</div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td>Emergency Fund</td>
                                        <td class="balance">$300.00</td>
                                    </tr>
                                    <tr>
                                        <td>Car Replacement</td>
                                        <td class="balance">$300.00</td>
                                    </tr>
                                    <tr>
                                        <td>Travel</td>
                                        <td class="balance">$300.00</td>
                                    </tr>
                                    <tr>
                                        <td>Christmas Fund</td>
                                        <td class="balance">$300.00</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            <h4><strong>TOTAL</strong></h4>
                                        </td>
                                        <td class="balance">
                                            <h4><strong>$30000.00</strong></h4>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!--Savings Breakdown END-->
                </div>
                <div class="col-md-4">
                    <!--Budget Summaries START-->
                    <div class="panel panel-primary">
                        <div class="panel-heading">Budget Summaries</div>
                        <div class="panel-body">
                            <div class="list-group">
                                <a class="list-group-item" href="#">September 2016</a>
                                <a class="list-group-item" href="#">August 2016</a>
                                <a class="list-group-item" href="#">July 2016</a>
                                <a class="list-group-item" href="#">June 2016</a>
                                <a class="list-group-item" href="#">May 2016</a>
                                <a class="list-group-item" href="#">April 2016</a>
                                <a class="list-group-item" href="#">March 2016</a>
                                <a class="list-group-item" href="#">February 2016</a>
                                <a class="list-group-item" href="#">January 2016</a>
                                <a class="list-group-item" href="#">December 2015</a>
                                <a class="list-group-item" href="#">November 2015</a>
                                <a class="list-group-item" href="#">October 2015</a>
                                <a class="list-group-item" href="#">September 2015</a>
                            </div>
                        </div>
                    </div>
                    <!--Budget Summaries END-->
                </div>
            </div>
            <!--Content END-->

            <!--**********************************************************Main Content END**********************************************************-->
        </div>
        <!--Container END-->

        <!--Templates START-->
        <script id="tmplBudgetCategorySpotlight" type="text/x-handlebars-template">
            <div class="panel-body">
                <div class="currentMonth"><strong>{{BudgetMonth}}</strong></div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="categoryWidth"></th>
                            <th class="progressWidth"></th>
                            <th class="remainingWidth"></th>
                        </tr>
                    </thead>
                    <tbody>
                    {{#each BudgetCategorySpotlight}}
                        <tr>
                            <td>{{BudgetCategory}}</td>
                            <td>
                                <div class="progress progress-sm">
                                    <div class="progress-bar progress-bar-{{ProgressBarStyle}}" style="width: {{CategoryPercentageSpent}}%"></div>
                                </div>
                            </td>
                            {{#if IsNegativeFlg}}
                            <td class="remaining amount-red">${{CategoryActualVsBudget}}</td>
                            {{else}}
                            <td class="remaining">${{CategoryActualVsBudget}}</td>
                            {{/if}}
                        </tr>
                    {{/each}}
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                <h4><strong>TOTAL</strong></h4>
                            </td>
                            <td>
                                <div class="progress progress-striped active progress-lg">
                                    <div class="progress-bar" style="width: {{TotalCategoryPercentageSpent}}%"></div>
                                </div>
                            </td>
                            <td class="remaining">
                                {{#if IsTotalNegativeFlg}}
                                <h4 class="amount-red"><strong>${{TotalCategoryActualVsBudget}}</strong></h4>
                                {{else}}
                                <h4><strong>${{TotalCategoryActualVsBudget}}</strong></h4>
                                {{/if}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </script>
        <!--Templates END-->

        <!--Footer START-->
        <?php require_once('include/footer.php'); ?>
        <!--Footer END-->
    
        <!--Javascript START-->  
        <script>
            var api = "http://api.jordanandrobert.com/budget/";

            var objBudget = new Object();
            objBudget.BudgetCategorySpotlight = "";
            objBudget.BudgetFundSpotlight = "";
            objBudget.BudgetSummary = "";

            $(document).ready(function() {
                console.log("ready!");

                BudgetCategorySpotlightRender();
            });

            function BudgetCategorySpotlightGet() {
                var result = {};

                $.ajax({
                    type: "GET",
                    url: api + "category/spotlight",
                    cache: false,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: false,
                    success: function (msg) {
                        result = msg;

                        objBudget.BudetMonth = result[0].BudgetMonth;
                        objBudget.TotalCategoryActualVsBudget = result[0].TotalCategoryActualVsBudget;
				        objBudget.TotalCategoryPercentageSpent = result[0].TotalCategoryPercentageSpent;
                        objBudget.IsTotalNegativeFlg = result[0].IsTotalNegativeFlg;
                        objBudget.BudgetCategorySpotlight = result;
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

            function BudgetCategorySpotlightRender() {
                BudgetCategorySpotlightGet();

                var source = $("#tmplBudgetCategorySpotlight").html();
                var template = Handlebars.compile(source);
                var context = objBudget;
                var html = template(context);

                $("#uxBudgetCategorySpotlight").html(html);
            }
        </script>
        <!--Javascript END-->

</body>
</html>
