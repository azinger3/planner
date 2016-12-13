<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $pageTitle = 'Summary';

            require_once('include/header.php');
        ?>

        <style>
            .amount-red {
                color: red;
            }

            .transactionDetail {
                width: 20%;
            }

            .summaryHeader {
                font-size: 28px; 
                margin-bottom: 20px;
                margin-top: -5px;
            }

            #uxBudgetMonth {
                width: 175px;
            }

            th {
                font-size: 14px;
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
                    <div class="summaryHeader">Summary</div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="pull-right" id="uxBudgetMonthOption"></div>
                </div>
            </div>
            <div id="uxBudgetSummary">
            </div>
            <!--Content END-->

            <!--**********************************************************Main Content END**********************************************************-->
        </div>
        <!--Container END-->

        <!--Templates START-->
        <script id="tmplBudgetSummary" type="text/x-handlebars-template">
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
                                            <th class="custom-hidden-xs hidden-sm">Budget</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {{#each Category}}
                                        <tr>
                                            <td>{{BudgetCategory}}</td>
                                        {{#if IsExpenseFlg}}
                                            <td class="custom-hidden-xs hidden-sm amount-red">${{CategoryActual}}</td>
                                            <td class="custom-hidden-xs hidden-sm amount-red">${{CategoryBudget}}</td>
                                        {{else}}
                                            <td class="custom-hidden-xs hidden-sm">${{CategoryActual}}</td>
                                            <td class="custom-hidden-xs hidden-sm">${{CategoryBudget}}</td>
                                        {{/if}}
                                            
                                        {{#if IsCategoryActualVsBudgetNegative}}
                                            <td class="amount-red">${{CategoryActualVsBudget}}</td>
                                        {{else}}
                                            <td>${{CategoryActualVsBudget}}</td>
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

                                        {{#if IsTotalIncomeVsExpenseBudgetNegative}}
                                            <td class="custom-hidden-xs hidden-sm amount-red"><h4><strong>${{TotalIncomeVsExpenseBudget}}</strong></h4></td>
                                        {{else}}
                                            <td class="custom-hidden-xs hidden-sm"><h4><strong>${{TotalIncomeVsExpenseBudget}}</strong></h4></td>
                                        {{/if}}

                                        {{#if IsTotalIncomeVsExpenseActualVsBudgetNegative}}
                                            <td class="amount-red"><h4><strong>${{TotalIncomeVsExpenseActualVsBudget}}</strong></h4></td>
                                        {{else}}
                                            <td><h4><strong>${{TotalIncomeVsExpenseActualVsBudget}}</strong></h4></td>
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

        <script id="tmplBudgetMonthOption" type="text/x-handlebars-template">
            {{#each Budget}}
                <option value="{{BudgetMonthSummaryUrl}}">{{BudgetMonthSummary}}</option>
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

            var budgetMonth = "";

            var objSummary = new Object();
            objSummary.TotalIncomeVsExpenseActual = "";
            objSummary.TotalIncomeVsExpenseBudget = "";
            objSummary.TotalIncomeVsExpenseActualVsBudget = "";
            objSummary.IsTotalIncomeVsExpenseActualNegative = "";
            objSummary.IsTotalIncomeVsExpenseBudgetNegative = "";
            objSummary.IsTotalIncomeVsExpenseActualVsBudgetNegative = "";
            objSummary.Category = "";

            var objCategory = new Object();
            objCategory.BudgetCategoryID = "";
            objCategory.BudgetCategory = "";
            objCategory.CategoryActual = "";
            objCategory.CategoryBudget = "";
            objCategory.CategoryActualVsBudget = "";
            objCategory.IsCategoryActualVsBudgetNegative = "";
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

            var objBudget = new Object();
            objBudget.Budget = "";

            $(document).ready(function() {
                console.log("Ready!");

                if ($.urlParam("BudgetMonth") != undefined) {
                    budgetMonth = $.urlParam("BudgetMonth"); 
                    data.BudgetMonth = $.urlParam("BudgetMonth"); 

                    BudgetSummaryGet();
                }
                else {
                    budgetMonth = Date.today().toString("yyyy-MM-01"); 
                    data.BudgetMonth = budgetMonth;

                    BudgetSummaryGet();
                }   

                BudgetGet();          
            });

            function BudgetSummaryGet() {
                var result = {};

                $.ajax({
                    type: "GET",
                    url: api + "/summary",
                    cache: false,
                    data: data,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        result = msg;

                        BudgetSummaryContextSet(result);
                        BudgetSummaryRender();
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

            function BudgetGet() {
                var result = {};

                $.ajax({
                    type: "GET",
                    url: api,
                    cache: false,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        result = msg;

                        objBudget.Budget = result;

                        BudgetMonthOptionRender();

                        $("#uxBudgetMonth option[value='" + budgetMonth + "']").prop("selected", true);

                        $("#uxBudgetMonth").change(function() {
                            data.BudgetMonth = $("#uxBudgetMonth option:selected").val();

                            window.location.href = "summary?BudgetMonth=" + data.BudgetMonth;
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

            function BudgetSummaryContextSet(result) {
                objSummary = {};

                var tmpCategory = $.map(result, function (item) {
                    return {
                        BudgetCategoryID: item.BudgetCategoryID,
                        BudgetCategory: item.BudgetCategory,
                        CategoryActual: item.CategoryActual,
                        CategoryBudget: item.CategoryBudget,
                        CategoryActualVsBudget: item.CategoryActualVsBudget,
                        IsCategoryActualVsBudgetNegative: item.IsCategoryActualVsBudgetNegative,
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
                    objCategory.CategoryBudget = category.CategoryBudget;
                    objCategory.CategoryActualVsBudget = category.CategoryActualVsBudget;
                    objCategory.IsCategoryActualVsBudgetNegative = category.IsCategoryActualVsBudgetNegative;
                    objCategory.TransactionTypeID = category.TransactionTypeID;
                    objCategory.IsExpenseFlg = category.IsExpenseFlg;
                    objCategory.Transaction = arrTransaction;
                    
                    arrCategory.push(objCategory);
                });

                objSummary.BudgetMonth = result[0].BudgetMonth;
                objSummary.TotalIncomeVsExpenseActual = result[0].TotalIncomeVsExpenseActual;
                objSummary.TotalIncomeVsExpenseBudget = result[0].TotalIncomeVsExpenseBudget;
                objSummary.TotalIncomeVsExpenseActualVsBudget = result[0].TotalIncomeVsExpenseActualVsBudget;
                objSummary.IsTotalIncomeVsExpenseActualNegative = result[0].IsTotalIncomeVsExpenseActualNegative;
                objSummary.IsTotalIncomeVsExpenseBudgetNegative = result[0].IsTotalIncomeVsExpenseBudgetNegative;
                objSummary.IsTotalIncomeVsExpenseActualVsBudgetNegative = result[0].IsTotalIncomeVsExpenseActualVsBudgetNegative;
                objSummary.Category = arrCategory;
            }

            function BudgetSummaryRender() {
                var source = $("#tmplBudgetSummary").html();
                var template = Handlebars.compile(source);

                var context = objSummary;
                var html = template(context);

                $("#uxBudgetSummary").html(html);
            }

            function BudgetMonthOptionRender() {
                var source = $("#tmplBudgetMonthOption").html();
                var template = Handlebars.compile(source);

                var context = objBudget;
                var html = template(context);

                var dropdown = "<select class='form-control input-sm' id='uxBudgetMonth'>" 
                            + html 
                            + "</select>";

                $("#uxBudgetMonthOption").html(dropdown);
            }
        </script>
        <!--Javascript END-->
    </body>
</html>
