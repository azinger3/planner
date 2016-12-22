<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $pageTitle = 'Averages';

            require_once('include/header.php');
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

            #uxBudgetYear {
                width: 160px;
            }

            th {
                font-size: 16px;
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
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="averageHeader">Averages</div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="pull-right" id="uxBudgetYearOption"></div>
                </div>
            </div>
            <div id="uxBudgetAverage">
            </div>
            <!--Content END-->

            <!--**********************************************************Main Content END**********************************************************-->
        </div>
        <!--Container END-->

        <!--Templates START-->
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
                                            <td>{{BudgetCategory}}</td>
                                        {{#if IsExpenseFlg}}
                                            <td class="custom-hidden-xs hidden-sm amount-red">${{CategoryActual}}</td>
                                            <td class="amount-red">${{CategoryAverage}}</td>
                                        {{else}}
                                            <td class="custom-hidden-xs hidden-sm">${{CategoryActual}}</td>
                                            <td class="">${{CategoryAverage}}</td>
                                        {{/if}}
                                        </tr>
                                    {{/each}}
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><h4><strong>TOTAL</strong></h4></td>
                                        {{#if IsTotalIncomeVsExpenseActualNegative}}
                                            <td class="custom-hidden-xs hidden-sm amount-red"><h4><strong>${{TotalIncomeVsExpenseActual}}</strong></h4></td>
                                        {{else}}
                                            <td class="custom-hidden-xs hidden-sm"><h4><strong>${{TotalIncomeVsExpenseActual}}</strong></h4></td>
                                        {{/if}}

                                        {{#if IsTotalIncomeVsExpenseAverageNegative}}
                                            <td class="amount-red"><h4><strong>${{TotalIncomeVsExpenseAverage}}</strong></h4></td>
                                        {{else}}
                                            <td><h4><strong>${{TotalIncomeVsExpenseAverage}}</strong></h4></td>
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
                                            <th class="hidden-xs hidden-sm">Transaction #</th>
                                            <th>Amount</th>
                                            <th class="hidden-xs hidden-sm">Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {{#each Transaction}}
                                        <tr>
                                            <td class="transactionDetail">{{TransactionDT}}</td>
                                            <td class="transactionDetail">{{Description}}</td>
                                            <td class="hidden-xs hidden-sm transactionDetail">{{TransactionNumber}}</td>
                                        {{#if IsExpenseFlg}}
                                            <td class="transactionDetail amount-red">${{Amount}}</td>
                                        {{else}}
                                            <td class="transactionDetail">${{Amount}}</td>
                                        {{/if}}
                                            <td class="hidden-xs hidden-sm transactionDetail">{{Note}}</td>
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
        <!--Templates END-->

        <!--Footer START-->
        <?php 
            require_once('include/footer.php'); 
        ?>
        <!--Footer END-->

        <!--Javascript START-->
        <script>
            var api = "http://api.jordanandrobert.com/budget";
            var data = new Object();

            var budgetYear = "";
            var startDT = "";
            var endDT = "";

            var objAverage = new Object();
            objAverage.TotalIncomeVsExpenseActual = "";
            objAverage.TotalIncomeVsExpenseAverage = "";
            objAverage.IsTotalIncomeVsExpenseActualNegative = "";
            objAverage.IsTotalIncomeVsExpenseAverageNegative = "";
            objAverage.Category = "";

            var objCategory = new Object();
            objCategory.BudgetCategoryID = "";
            objCategory.BudgetCategory = "";
            objCategory.CategoryActual = "";
            objCategory.CategoryAverage = "";
            objCategory.TransactionTypeID = "";
            objCategory.Transaction = "";

            var objTransaction = new Object();
            objTransaction.TransactionID = "";
            objTransaction.TransactionDT = "";
            objTransaction.TransactionTypeID = "";
            objTransaction.TransactionType = "";
            objTransaction.TransactionNumber = "";
            objTransaction.Description = "";
            objTransaction.Amount = "";
            objTransaction.Note = "";

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

                    BudgetAverageGet();
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

                    BudgetAverageGet();
                }   

                BudgetYearGet();          
            });

            function BudgetAverageGet() {
                var result = {};

                $.ajax({
                    type: "GET",
                    url: api + "/average",
                    cache: false,
                    data: data,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    beforeSend: function() {
                        $("#uxBudgetAverage").html("<div class='text-center'><i class='fa fa-refresh fa-spin fa-2x fa-fw'></i><span class='loading'>Loading...</span></div>");
                    },
                    success: function (msg) {
                        result = msg;

                        BudgetAverageContextSet(result);
                        BudgetAverageRender();
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

                            window.location.href = "average?StartDT=" + data.StartDT + "&EndDT=" + data.EndDT;
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

            function BudgetAverageContextSet(result) {
                objAverage = {};

                var tmpCategory = $.map(result, function (item) {
                    return {
                        BudgetCategoryID: item.BudgetCategoryID,
                        BudgetCategory: item.BudgetCategory,
                        CategoryActual: item.CategoryActual,
                        CategoryAverage: item.CategoryAverage,
                        TransactionTypeID: item.TransactionTypeID,
                        IsExpenseFlg: item.IsExpenseFlg
                    };
                });

                var uniqCategory = _.uniqWith(tmpCategory, _.isEqual);

                var arrCategory = [];

                $.map(uniqCategory, function (category) {
                    var arrTransaction = [];

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
                            objTransaction.IsExpenseFlg = transaction.IsExpenseFlg;

                            arrTransaction.push(objTransaction);
                        }
                    });

                    objCategory = {};
                    objCategory.BudgetCategoryID = category.BudgetCategoryID;
                    objCategory.BudgetCategory = category.BudgetCategory;
                    objCategory.CategoryActual = category.CategoryActual;
                    objCategory.CategoryAverage = category.CategoryAverage;
                    objCategory.TransactionTypeID = category.TransactionTypeID;
                    objCategory.IsExpenseFlg = category.IsExpenseFlg;
                    objCategory.Transaction = arrTransaction;
                    
                    arrCategory.push(objCategory);
                });

                objAverage.TotalIncomeVsExpenseActual = result[0].TotalIncomeVsExpenseActual;
                objAverage.TotalIncomeVsExpenseAverage = result[0].TotalIncomeVsExpenseAverage;
                objAverage.IsTotalIncomeVsExpenseActualNegative = result[0].IsTotalIncomeVsExpenseActualNegative;
                objAverage.IsTotalIncomeVsExpenseAverageNegative = result[0].IsTotalIncomeVsExpenseAverageNegative;
                objAverage.Category = arrCategory;
            }

            function BudgetAverageRender() {
                var source = $("#tmplBudgetAverage").html();
                var template = Handlebars.compile(source);

                var context = objAverage;
                var html = template(context);

                $("#uxBudgetAverage").html(html);
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
        <!--Javascript END-->
    </body>
</html>
