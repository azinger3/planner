<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $pageTitle = 'Fund';

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

            .fundHeader {
                font-size: 28px; 
                margin-bottom: 20px;
                margin-top: -5px;
            }

            #uxFund {
                width: 180px;
            }

            th {
                font-size: 16px;
            }

            .amount-fund {
                font-size: 12px;
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
                    <div class="fundHeader">Funds</div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="pull-right" id="uxBudgetFundOption"></div>
                </div>
            </div>
            <div id="uxBudgetFundSummary">
            </div>
        </div>
        
        <script id="tmplBudgetFundSummary" type="text/x-handlebars-template">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <strong>
                                <table class="table table-striped table-bordered table-hover table-condensed small">
                                    <thead>
                                        <tr>
                                            <th>Fund</th>
                                            <th class="custom-hidden-xs hidden-sm">Starting Balance</th>
                                            <th class="custom-hidden-xs hidden-sm">Saved</th>
                                            <th class="custom-hidden-xs hidden-sm">Spent</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{FundName}}</td>
                                            <td class="custom-hidden-xs hidden-sm text-info">${{NumberCommaFormat StartingBalance}}</td>
                                            <td class="custom-hidden-xs hidden-sm text-success">${{NumberCommaFormat FundReceived}}</td>
                                            <td class="custom-hidden-xs hidden-sm text-danger">${{NumberCommaFormat FundSpent}}</td>
                                            <td>${{NumberCommaFormat FundSpentVsReceived}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Transactions</h3>
                    {{#ifgreaterthan FundReceived 0}}
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{FundName}}</h3>
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
                                        {{#ifequal TransactionTypeID '3'}}
                                            <td class="transactionDetail"><span class="label label-success amount-fund" title="Saved">${{NumberCommaFormat Amount}}</span></td>
                                        {{else}}
                                            <td class="transactionDetail"><span class="label label-danger amount-fund" title="Spent">${{NumberCommaFormat Amount}}</span></td>
                                        {{/ifequal}}
                                            <td class="custom-hidden-xs hidden-sm transactionDetail">{{Note}}</td>
                                        </tr>
                                    {{/each}}
                                    </tbody>
                                </table>
                            </strong>
                        </div>
                    </div>
                    {{/ifgreaterthan}}
                </div>
            </div>      
        </script>

        <script id="tmplBudgetFundOption" type="text/x-handlebars-template">
            {{#each Fund}}
                <option value="{{FundID}}">{{FundName}}</option>
            {{/each}}
        </script>

        <?php require_once('include/footer.php'); ?>
       
        <script type="text/javascript" src="../../../controller/fund.controller.js"></script>
    </body>
</html>
