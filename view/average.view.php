<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $pageTitle = 'Averages';

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

            th {
                font-size: 16px;
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
                    <div class="averageHeader">Averages</div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="pull-right" id="uxBudgetYearOption"></div>
                </div>
            </div>
            <div id="uxBudgetAverage">
            </div>
        </div>

        <script id="tmplBudgetAverage" type="text/x-handlebars-template">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <strong>
                                <table class="table table-striped table-bordered table-hover table-condensed small">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th class="custom-hidden-xs hidden-sm">Actual</th>
                                            <th>Average</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {{#each Category}}
                                        <tr>
                                            <td><a class="normalLink" href="javascript:GoToSection('{{BudgetCategoryID}}');">{{BudgetCategory}}</a></td>
                                        {{#if IsExpenseFlg}}
                                            <td class="custom-hidden-xs hidden-sm amount-red">${{NumberCommaFormat CategoryActual}}</td>
                                            <td class="amount-red">${{NumberCommaFormat CategoryAverage}}</td>
                                        {{else}}
                                            <td class="custom-hidden-xs hidden-sm">${{NumberCommaFormat CategoryActual}}</td>
                                            <td class="">${{NumberCommaFormat CategoryAverage}}</td>
                                        {{/if}}
                                        </tr>
                                    {{/each}}
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><h4><strong>TOTAL</strong></h4></td>
                                        {{#if IsTotalIncomeVsExpenseActualNegative}}
                                            <td class="custom-hidden-xs hidden-sm amount-red"><h4><strong>${{NumberCommaFormat TotalIncomeVsExpenseActual}}</strong></h4></td>
                                        {{else}}
                                            <td class="custom-hidden-xs hidden-sm"><h4><strong>${{NumberCommaFormat TotalIncomeVsExpenseActual}}</strong></h4></td>
                                        {{/if}}

                                        {{#if IsTotalIncomeVsExpenseAverageNegative}}
                                            <td class="amount-red"><h4><strong>${{NumberCommaFormat TotalIncomeVsExpenseAverage}}</strong></h4></td>
                                        {{else}}
                                            <td><h4><strong>${{NumberCommaFormat TotalIncomeVsExpenseAverage}}</strong></h4></td>
                                        {{/if}}
                                        </tr>
                                    </tfoot>
                                </table>
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Transactions</h3>
                    {{#each Category}}
                        {{#if TransactionTypeID}}
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title" id="{{BudgetCategoryID}}">{{BudgetCategory}}</h3>
                        </div>
                        <div class="panel-body">
                            <strong>
                                <table class="table table-striped table-hover table-bordered table-condensed small">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th class="custom-hidden-xs hidden-sm">Transaction #</th>
                                            <th>Amount</th>
                                            <th class="custom-hidden-xs hidden-sm">Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {{#each Transaction}}
                                        <tr>
                                            <td class="transactionDetail">{{TransactionDT}}</td>
                                            <td class="transactionDetail">{{Description}}</td>
                                            <td class="custom-hidden-xs hidden-sm transactionDetail">{{TransactionNumber}}</td>
                                        {{#if IsExpenseFlg}}
                                            <td class="transactionDetail amount-red">${{NumberCommaFormat Amount}}</td>
                                        {{else}}
                                            <td class="transactionDetail">${{NumberCommaFormat Amount}}</td>
                                        {{/if}}
                                            <td class="custom-hidden-xs hidden-sm transactionDetail">{{Note}}</td>
                                        </tr>
                                    {{/each}}
                                    </tbody>
                                </table>
                            </strong>
                        </div>
                    </div>
                        {{/if}}
                    {{/each}}
                </div>
            </div>      
        </script>

        <script id="tmplBudgetYearOption" type="text/x-handlebars-template">
            {{#each BudgetYear}}
                <option value="{{YearValue}}">{{YearName}}</option>
            {{/each}}
        </script>
        
        <?php require_once('include/footer.php'); ?>

        <script type="text/javascript" src="../../../controller/average.controller.js"></script>
    </body>
</html>
