<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $pageTitle = 'Summaries';

            require_once('include/header.php');
        ?>

        <style>
            .optionHide {
                display: none;
            }

            .nav-tabs {
                margin-bottom: 0;
            }

            .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
                color: #3498db;
                background-color: #ecf0f1;
            }

            .nav-tabs>li>a {
                color: #2c3e50;
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
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#BudgetSummary" data-toggle="tab" aria-expanded="true">Summary</a></li>
                        <li class=""><a href="#BudgetAverage" data-toggle="tab" aria-expanded="true">Averages</a></li>
                        <li class=""><a href="#ExpenseBreakdown" data-toggle="tab" aria-expanded="false">Breakdown</a></li>
                    </ul>
                    <div id="tabContent" class="tab-content">
                        <div class="tab-pane fade active in" id="BudgetSummary">
                            <div class="well">
                                <form>
                                    <fieldset>
                                        <div class="form-group col-md-3">
                                            <label for="3">Month:</label>
                                            <select class="form-control placeholder" id="3">
                                                <option value="" selected="selected">Select One...</option>
                                                <option value="1">November 2016</option>
                                                <option value="2">October 2016</option>
                                                <option value="3">September 2016</option>
                                                <option value="4">August 2016</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>&nbsp;</label>
                                            <button type="button" class="form-control btn btn-info col-md-2">Search</button>
                                        </div>
                                        <div class="form-group col-md-3 hidden-xs hidden-sm">
                                        </div>
                                        <div class="form-group col-md-3 hidden-xs hidden-sm">
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Budget Summary</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="BudgetAverage">
                            <div class="well">
                                <form>
                                    <fieldset>
                                        <div class="form-group col-md-3">
                                            <label for="3">Year:</label>
                                            <select class="form-control placeholder" id="3">
                                                <option value="" selected="selected">Select One...</option>
                                                <option value="1">Year 3</option>
                                                <option value="2">Year 2</option>
                                                <option value="3">Year 1</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>&nbsp;</label>
                                            <button type="button" class="form-control btn btn-info col-md-2">Search</button>
                                        </div>
                                        <div class="form-group col-md-3 hidden-xs hidden-sm">
                                        </div>
                                        <div class="form-group col-md-3 hidden-xs hidden-sm">
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div id="uxSummary">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ExpenseBreakdown">
                            <div class="well">
                                <form>
                                    <fieldset>
                                        <div class="form-group col-md-3">
                                            <label for="3">Year:</label>
                                            <select class="form-control placeholder" id="3">
                                                <option value="" selected="selected">Select One...</option>
                                                <option value="1">Year 3</option>
                                                <option value="2">Year 2</option>
                                                <option value="3">Year 1</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>&nbsp;</label>
                                            <button type="button" class="form-control btn btn-info col-md-2">Search</button>
                                        </div>
                                        <div class="form-group col-md-3 hidden-xs hidden-sm">
                                        </div>
                                        <div class="form-group col-md-3 hidden-xs hidden-sm">
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <canvas id="myChart" width="400" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Content END-->

            <!--**********************************************************Main Content END**********************************************************-->
        </div>
        <!--Container END-->

        <!--Templates START-->
        <script id="tmplSummary" type="text/x-handlebars-template">
            <div class="row">
                <div class="col-md-12">
                    <h2>Budget Averages</h2>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Summary</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th class="hidden-xs hidden-sm">Actual</th>
                                        <th class="hidden-xs hidden-sm">Budgeted</th>
                                        <th>Balance</th>
                                        <th>Average</th>
                                    </tr>
                                </thead>
                                <tbody>
                                {{#each Category}}
                                    <tr>
                                        <td>{{BudgetCategory}}</td>
                                        <td class="hidden-xs hidden-sm">${{CategoryActual}}</td>
                                        <td class="hidden-xs hidden-sm">${{CategoryBudget}}</td>
                                        <td>${{CategoryActualVsBudget}}</td>
                                        <td>${{CategoryAverage}}</td>
                                    </tr>
                                {{/each}}
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><h4><strong>TOTAL</strong></h4></td>
                                        <td class="hidden-xs hidden-sm"><h4><strong>${{TotalIncomeVsExpenseActual}}</strong></h4></td>
                                        <td class="hidden-xs hidden-sm"><h4><strong>${{TotalIncomeVsExpenseBudget}}</strong></h4></td>
                                        <td><h4><strong>${{TotalIncomeVsExpenseActualVsBudget}}</strong></h4></td>
                                        <td><h4><strong>${{TotalIncomeVsExpenseAverage}}</strong></h4></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>Details</h2>
                    {{#each Category}}
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{BudgetCategory}}</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-hover table-bordered small">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th class="hidden-xs hidden-sm">Transaction #</th>
                                        <th>Amount</th>
                                        <th class="hidden-xs hidden-sm">Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                {{#each Transaction}}
                                    <tr>
                                        <td>{{TransactionDT}}</td>
                                        <td>{{Description}}</td>
                                        <td class="hidden-xs hidden-sm">{{TransactionNumber}}</td>
                                        <td>${{Amount}}</td>
                                        <td class="hidden-xs hidden-sm">{{Note}}</td>
                                    </tr>
                                {{/each}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{/each}}
                </div>
            </div>      
        </script>
        <!--Templates END-->

        <!--Footer START-->
        <?php 
            require_once('include/footer.php'); 
        ?>
        <!--Footer END-->

        <!--Javascript START-->
        <script>
            var apiUrl = "http://api.jordanandrobert.com/budget/transaction/summary";
            var apiData = {};

            apiData.BudgetCategoryID = "";
            apiData.Keyword = "";
            apiData.StartDT = "";
            apiData.EndDT = "";

            var objSummary = {};
            objSummary.TotalIncomeVsExpenseActual = "";
            objSummary.TotalIncomeVsExpenseBudget = "";
            objSummary.TotalIncomeVsExpenseActualVsBudget = "";
            objSummary.TotalIncomeVsExpenseAverage = "";
            objSummary.Category = "";

            var objCategory = {};
            objCategory.BudgetCategoryID = "";
            objCategory.BudgetCategory = "";
            objCategory.CategoryActual = "";
            objCategory.CategoryBudget = "";
            objCategory.CategoryActualVsBudget = "";
            objCategory.CategoryAverage = "";
            objCategory.Transaction = "";

            var objTransaction = {};
            objTransaction.TransactionID = "";
            objTransaction.TransactionDT = "";
            objTransaction.TransactionTypeID = "";
            objTransaction.TransactionType = "";
            objTransaction.TransactionNumber = "";
            objTransaction.Description = "";
            objTransaction.Amount = "";
            objTransaction.Note = "";

            $(document).ready(function() {
                console.log("ready!");

                $.urlParam = function (name, url) {
                    if (!url) {
                        url = window.location.href;
                    }
                    var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(url);
                    if (!results) {
                        return undefined;
                    }
                    return results[1] || undefined;
                }

                var dateRange = "";
                var startDT = "";
                var endDT = "";

                if ($.urlParam("DateRange") != undefined) {
                    dateRange = $.urlParam("DateRange");

                    if(dateRange == "CurrentMonth") {
                        startDT = Date.today().moveToFirstDayOfMonth().toString("yyyy-MM-dd");
                        endDT = Date.today().moveToLastDayOfMonth().toString("yyyy-MM-dd");
                    }
                    else if(dateRange == "CurrentYear") {
                        startDT = Date.today().moveToMonth(3, -1).toString("yyyy-MM-01");
                        endDT = Date.today().moveToLastDayOfMonth().toString("yyyy-MM-dd");
                    }
                    else {
                        startDT = Date.today().moveToMonth(3, -1).toString("yyyy-MM-01");
                        endDT = Date.today().moveToLastDayOfMonth().toString("yyyy-MM-dd");
                    }
                }
                else {
                    startDT = Date.today().moveToMonth(3, -1).toString("yyyy-MM-01");
                    endDT = Date.today().moveToLastDayOfMonth().toString("yyyy-MM-dd");
                }

                apiData.StartDT = startDT;
                apiData.EndDT = endDT;

                TransactionSummaryGet();

                // Date Range Picker
                var startDate = startDT.split("-");
                var endDate = endDT.split("-");

                $('.input-daterangepicker').daterangepicker({
                    "startDate": startDate[1] + "/" + startDate[2] + "/" + startDate[0],
                    "endDate": endDate[1] + "/" + endDate[2] + "/" + endDate[0]
                });
            });

            function TransactionSummaryGet() {
                var result = {};

                $.ajax({
                    type: "GET",
                    url: apiUrl,
                    cache: false,
                    data: apiData,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        result = msg;

                        TransactionSummaryContextSet(result);
                        TransactionSummaryTemplateSet();
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

            function TransactionSummaryContextSet(result) {
                objSummary = {};

                var tmpCategory = $.map(result, function (item) {
                    return {
                        BudgetCategoryID: item.BudgetCategoryID,
                        BudgetCategory: item.BudgetCategory,
                        CategoryActual: item.CategoryActual,
                        CategoryBudget: item.CategoryBudget,
                        CategoryActualVsBudget: item.CategoryActualVsBudget,
                        CategoryAverage: item.CategoryAverage
                    };
                });

                var uniqCategory = _.uniqWith(tmpCategory, _.isEqual);

                var arrayCategory = [];

                $.map(uniqCategory, function (category) {
                    var arrayTransaction = [];

                    $.map(result, function (transaction) {
                        if (category.BudgetCategoryID == transaction.BudgetCategoryID) {
                            objTransaction = {};
                            objTransaction.TransactionID = transaction.TransactionID;
                            objTransaction.TransactionDT = transaction.TransactionDT;
                            objTransaction.TransactionTypeID = transaction.TransactionTypeID;
                            objTransaction.TransactionType = transaction.TransactionType;
                            objTransaction.TransactionNumber = transaction.TransactionNumber;
                            objTransaction.Description = transaction.Description;
                            objTransaction.Amount = transaction.Amount;
                            objTransaction.Note = transaction.Note;

                            arrayTransaction.push(objTransaction);
                        }
                    });

                    objCategory = {};
                    objCategory.BudgetCategoryID = category.BudgetCategoryID;
                    objCategory.BudgetCategory = category.BudgetCategory;
                    objCategory.CategoryActual = category.CategoryActual;
                    objCategory.CategoryBudget = category.CategoryBudget;
                    objCategory.CategoryActualVsBudget = category.CategoryActualVsBudget;
                    objCategory.CategoryAverage = category.CategoryAverage;
                    objCategory.Transaction = arrayTransaction;

                    arrayCategory.push(objCategory);
                });

                objSummary.TotalIncomeVsExpenseActual = result[0].TotalIncomeVsExpenseActual;
                objSummary.TotalIncomeVsExpenseBudget = result[0].TotalIncomeVsExpenseBudget;
                objSummary.TotalIncomeVsExpenseActualVsBudget = result[0].TotalIncomeVsExpenseActualVsBudget;
                objSummary.TotalIncomeVsExpenseAverage = result[0].TotalIncomeVsExpenseAverage;
                objSummary.Category = arrayCategory;
            }

            function TransactionSummaryTemplateSet() {
                var source = $("#tmplSummary").html();
                var template = Handlebars.compile(source);

                var context = objSummary;
                var html = template(context);

                $("#uxSummary").html(html);
            }
        </script>
        <!--Javascript END-->
    </body>
</html>
