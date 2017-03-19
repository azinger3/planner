<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $pageTitle = 'Planning';

            require_once('include/header.php');

            require_once('include/icon.budget.php');
        ?>

        <style>
            .budgetMonthHeader {
                font-size: 30px; 
                margin-bottom: 20px;
                margin-top: -5px;
            }

            .pager li > a, .pager li > span {
                background-color: #3498db !important;
                margin: 6px !important;
            }

            .pager {
                margin-bottom: -5px;
            }

            h1 {
                margin-top: 15px !important;
                margin-bottom: 48.5px !important;
            }

            .planningContainer {
                margin-top: 8%;
            }

            .section-default {
                padding: 1px 20px 10px 20px;
            }

            .leftToBudget {
                margin-bottom: 15px;
            }

            .leftToBudget.text {
                font-size: 20px; 
                margin: 5px;
            }

            .addCategoryLink {
                color: #ffffff;
                font-size: 16px;
                margin-left: 20px;
            }

            .addGroupLink {
                color: #2c3e50;
                font-size: 16px;
                margin-left: 20px;
            }

            .label {
                font-size: 89%;
            }

            .planDetail {
                width: 8.6%;
            }

            .leftoverTable {
                margin-bottom: 2px;
            }

            .page-header {
                margin-bottom: 10px !important;
            }

            .well-sm {
                padding: 8px !important;
            }

            .well {
                margin-bottom: 25px !important;
            }
            
            .incomeTotal {
                text-align: center; 
                font-size: 20px; 
                font-weight: bold;
            }

            .plannedHours {
                text-align: center;
            }
            
            .payCycle {
                display: inline-block; 
                font-weight: normal; 
                font-size: 12px; 
                margin-top: 3px;
            }
                                    
            @media (max-width:414px) {
                .budgetMonthHeader {
                    font-size: 26px;
                    margin-bottom: 20px;
                    margin-top: -5px;
                }

                .budgetMonthNav {
                    font-size: 12px;
                }

                .pager {
                    margin: 5px 0;
                }

                .pager li > a, .pager li > span {
                    margin-top: 3px !important;
                }

                .planningContainer {
                    margin-top: 15%;
                }

                .leftToBudget {
                    margin-bottom: 15px;
                }

                .leftToBudget.text {
                    font-size: 15px; 
                    margin: 5px;
                }

                .page-header {
                    padding-bottom: 0;
                }

                .planDetail {
                    width: 30%;
                }
            }

            @media (min-width: 414px) and (max-width: 667px) {
                .planDetail {
                    width: 15%;
                }
            }

            .showMore {
                color: #2c3e50;
                font-size: 15px;
            }

            a.showMore:hover, a.showMore:focus {
                color: #2c3e50 !important;
                text-decoration: none !important;
            }

            .budgetMonthSummaryScroll {
                position: fixed;
                top: 65px;
                display: none;
                left: 0;
                right: 0;
                text-align: center;
                z-index: 9999;
            }

            #uxBudgetMonthScroll {
                margin-top: 4px;
            }

            .summaryExpense.pad {
                padding-left: 19px;
            }
        </style>
    </head>
    <body>
        <input type="hidden" id="hdnBudgetMonth" value="" />
        <input type="hidden" id="hdnBudgetNumber" value="" />

        <!--Navigation START-->
        <?php require_once('include/navigation.budget.php'); ?>
        <!--Navigation END-->

        <!--Container START-->
        <div class="container">
            <!--**********************************************************Main Content START**********************************************************-->
            
            <!--Page Header START-->
            <div class="page-header">
                <div class="row text-center">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8">
                        <div id="uxBudgetMonthNavigation">
                        </div>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
            </div>
            <!--Page Header END-->

            <!--Content START-->
            <div id="uxBudgetStart">
            </div>
            <!--Content END-->

            <!--**********************************************************Main Content END**********************************************************-->
        </div>
        <!--Container END-->

        <div id="uxBudgetComponent">
        </div>
        
        <!--Modals-->

        <!--Income Modal-->
        <div class="modal fade" id="mdlIncomeCalculator" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="uxIncomeModalTitle"></h4>
                    </div>
                    <div class="modal-body">
                        <!--All-->
                        <div class="form-group">
                            <label for="uxIncomeName" class="small">Name:</label>
                            <input type="text" class="form-control input-sm" id="uxIncomeName" placeholder="" style="text-align: center;">
                        </div>
                        <div class="row">
                            <div id="IncomeHardErrorMessage"></div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="uxIncomeType" class="small">Type:</label>
                                    <select class="form-control input-sm" id="uxIncomeType">
                                        <option value="">Select One...</option>
                                        <option value="1">Salary</option>
                                        <option value="2">Hourly</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="uxPayCycle" class="small">Pay Cycle:</label>
                                    <select class="form-control input-sm" id="uxPayCycle">
                                        <option value="">Select One...</option>
                                        <option value="1">Bi-Weekly</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="uxPlannedHours" class="small">Planned Hours:</label>
                            <input type="number" class="form-control input-sm incomeCalculator" id="uxPlannedHours" placeholder="" style="text-align: center;">
                        </div>
                        <!--Salary-->
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="uxSalary" class="small">Salary $:</label>
                                    <input type="number" class="form-control input-sm incomeCalculator" id="uxSalary" placeholder="$">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="uxTakeHomePay" class="small">Take Home Pay $:</label>
                                    <input type="number" class="form-control input-sm incomeCalculator" id="uxTakeHomePay" placeholder="$">
                                </div>
                            </div>
                        </div>
                        <!--Hourly-->
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="uxHourlyRate" class="small">Hourly Rate $:</label>
                                    <input type="number" class="form-control input-sm incomeCalculator" id="uxHourlyRate" placeholder="$">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="uxYearDeduct" class="small">Year Deduct %:</label>
                                    <input type="number" class="form-control input-sm incomeCalculator" id="uxYearDeduct" placeholder="%">
                                </div>
                            </div>
                        </div>
                        <!--TOTAL-->
                        <div class="form-group">
                            <label for="uxIncomeTotal" class="small">Total:</label>
                            <div class="text-center small pull-right payCycle" id="uxPayCycleDescription"></div>
                            <input type="text" class="form-control incomeTotal" id="uxIncomeTotal" disabled value="$2,185">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-info btn-sm" id="uxIncomeSave" data-budget-income-id="">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!--END Income Modal-->

        <!--Expense Modal-->
        <div class="modal fade" id="mdlExpense" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="uxExpenseModalTitle"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div id="ExpenseHardErrorMessage"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="uxBudgetGroup">Group:</label>
                                    <input type="text" class="form-control input-sm" id="uxBudgetGroup" data-group-id="0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="uxBudgetCategory">Category:</label>
                                    <input type="text" class="form-control input-sm" id="uxBudgetCategory" data-category-id="0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="uxAmount">Amount $:</label>
                                    <input type="number" class="form-control input-sm" id="uxAmount" placeholder="$">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="javascript:void(0);" title="Show More" class="showMore" data-toggle="collapse" data-target="#MoreOptions">
                                    <label><i class="fa fa-plus"></i> More Options</label>
                                </a>
                                <div class="well collapse" id="MoreOptions">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="uxDescription" class="small">Description:</label>
                                                <textarea rows="2" class="form-control input-sm" id="uxDescription" style="resize: none;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="uxNote" class="small">Note:</label>
                                                <textarea rows="2" class="form-control input-sm" id="uxNote" style="resize: none;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="small">
                                                    <input type="checkbox" id="uxIsEssential"> Essential Expense
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="small">
                                                    <input type="checkbox" id="uxHasSpotlight"> Variable Fund
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="small"><input type="checkbox" id="uxHasFundFlg"> Savings Fund</label>
                                                <input type="text" class="form-control input-sm" id="uxFundName" placeholder="Fund Name" data-fund-id="0">
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="uxStartingBalance" class="small">Starting Balance:</label>
                                                <input type="number" class="form-control input-sm" id="uxStartingBalance" placeholder="$">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-info btn-sm" id="uxExpenseSave" data-budget-item-id="">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!--END Expense Modal-->

        <!--END Modals-->

        <!--Templates-->
        <script id="tmplBudgetMonthNavigation" type="text/x-handlebars-template">
            <ul class="pager">
                <li class="previous">
                    <a href="plan?BudgetMonth={{MonthPreviousDT}}" class="budgetMonthNav">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        <span class="custom-hidden-xs">&nbsp;&nbsp;{{MonthPrevious}}</span>
                    </a>
                </li>
                <li class="budgetMonthHeader" id="uxBudgetMonthHeader" style="cursor: pointer;" onclick="javascript:BudgetByMonthDelete();">{{MonthCurrent}}
                </li>
                <li class="next">
                    <a href="plan?BudgetMonth={{MonthNextDT}}" class="budgetMonthNav">
                        <span class="custom-hidden-xs">{{MonthNext}}&nbsp;&nbsp;</span>
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </script>

        <script id="tmplBudgetStart" type="text/x-handlebars-template">
            <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-10 planningContainer">
                    <div class="jumbotron text-center">
                        <h1>Start Planning for {{Month}}</h1>
                        <p><a href="javascript:BudgetByMonthInsert();" class="btn btn-info btn-lg btn-block">Go</a></p>
                    </div>
                </div>
                <div class="col-md-1" >
                </div>
            </div>
        </script>

         <script id="tmplBudgetComponent" type="text/x-handlebars-template">
            <section class="section-default">
                <div id="uxBudgetMonthSummary">
                </div>
                <div id="uxBudgetIncomeByMonth">
                </div>
                <div id="uxBudgetExpenseByMonth">
                </div>
                <div id="uxBudgetGroupAdd">
                </div>
            </section>
        </script>

        <script id="tmplBudgetMonthSummary" type="text/x-handlebars-template">
            <p id="uxBudgetMonthScroll" style="display: none;">
                <span class="label label-success">{{MonthCurrent}}</span>
            </p>
            <div class="container">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="well well-sm">
                        <table class="table table-condensed leftoverTable">
                            <thead>
                                <tr>
                                    <th class="text-center">Income</th>
                                    <th class="text-center summaryExpense">Expenses</th>
                                    <th class="text-center">Leftover</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center text-success">${{NumberCommaFormat TotalIncomeMonthly}}</td>
                                    <td class="text-center text-danger summaryExpense">${{NumberCommaFormat TotalExpenseMonthly}}</td>
                                {{#if IsBalanceMonthlyNegative}}
                                    <td class="text-center"><span class="label label-danger">${{NumberCommaFormat BalanceMonthly}}</span></td>
                                {{else}}
                                    <td class="text-center"><span class="label label-success">${{NumberCommaFormat BalanceMonthly}}</span></td>
                                {{/if}}
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </script>

        <script id="tmplBudgetIncomeByMonth" type="text/x-handlebars-template">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Income
                    <div class="pull-right">
                        <a href="javascript:BudgetIncomeDetailModalShow(0);" title="Add Income" class="addCategoryLink"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover table-condensed small">
                        <thead>
                            <tr>
                                <th class="planDetail">Name</th>
                                <th class="planDetail text-center">Monthly</th>
                                <th class="planDetail text-center">Bi-Weekly</th>
                                <th class="planDetail custom-hidden-xs text-center">Weekly</th>
                                <th class="planDetail custom-hidden-xs text-center">6 Month</th>
                                <th class="planDetail custom-hidden-xs text-center">Year (Net)</th>
                                <th class="planDetail hidden-xs hidden-sm text-center">Year (Gross)</th>
                                <th class="planDetail hidden-xs text-center">Hourly Rate</th>
                                <th class="planDetail hidden-xs hidden-sm text-center">Year Deduct %</th>
                                <th class="planDetail hidden-xs hidden-sm text-center">Planned Hours</th>
                                <th class="planDetail hidden-xs hidden-sm text-center">Type</th>
                                <th class="planDetail"></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{#each Income}}
                            <tr>
                                <td class="planDetail">{{IncomeName}}</td>
                                <td class="planDetail text-center text-success">${{NumberCommaFormat IncomeMonthly}}</td>
                                <td class="planDetail text-center">${{NumberCommaFormat IncomeBiWeekly}}</td>
                                <td class="planDetail custom-hidden-xs text-center">${{NumberCommaFormat IncomeWeekly}}</td>
                                <td class="planDetail custom-hidden-xs text-center">${{NumberCommaFormat IncomeBiYearly}}</td>
                                <td class="planDetail custom-hidden-xs text-center">${{NumberCommaFormat IncomeYearly}}</td>
                                <td class="planDetail hidden-xs hidden-sm text-center">${{NumberCommaFormat Salary}}</td>
                                <td class="planDetail hidden-xs text-center">${{NumberCommaFormat HourlyRate}}</td>
                                <td class="planDetail hidden-xs hidden-sm text-center">{{YearDeduct}}%</td>
                                <td class="planDetail hidden-xs hidden-sm text-center">{{PlannedHours}}</td>
                                <td class="planDetail hidden-xs hidden-sm text-center">{{IncomeType}}</td>
                                <td class="planDetail text-right">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="javascript:BudgetIncomeDetailModalShow({{BudgetIncomeID}});">Edit</a></li>
                                            <li><a href="javascript:BudgetIncomeRemove({{BudgetIncomeID}});">Remove</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            {{/each}}
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="planDetail"><h5><strong>TOTAL</strong></h5></td>
                                <td class="planDetail text-center text-success"><h5><strong>${{NumberCommaFormat TotalIncomeMonthly}}</strong></h5></td>
                                <td class="planDetail text-center"><h5><strong>${{NumberCommaFormat TotalIncomeBiWeekly}}</strong></h5></td>
                                <td class="planDetail custom-hidden-xs text-center"><h5><strong>${{NumberCommaFormat TotalIncomeWeekly}}</strong></h5></td>
                                <td class="planDetail custom-hidden-xs text-center"><h5><strong>${{NumberCommaFormat TotalIncomeBiYearly}}</strong></h5></td>
                                <td class="planDetail custom-hidden-xs text-center"><h5><strong>${{NumberCommaFormat TotalIncomeYearly}}</strong></h5></td>
                                <td class="planDetail hidden-xs hidden-sm text-center"><h5><strong>${{NumberCommaFormat TotalIncomeYearlyGross}}</strong></h5></td>
                                <td class="planDetail hidden-xs text-center"></td>
                                <td class="planDetail hidden-xs hidden-sm text-center"></td>
                                <td class="planDetail hidden-xs hidden-sm text-center"></td>
                                <td class="planDetail hidden-xs hidden-sm text-center"></td>
                                <td class="planDetail"></td>
                            </tr>
                        </tfoot>
                    </table> 
                </div>
            </div>
        </script>

        <script id="tmplBudgetExpenseByMonth" type="text/x-handlebars-template">
            {{#each Expense}}
            <div class="panel panel-primary">
                <div class="panel-heading">
                    {{BudgetGroup}}
                    <div class="pull-right">
                        <a href="javascript:BudgetExpenseGroupModalShow({{BudgetGroupID}}, '{{BudgetGroup}}');" title="Add Expense" class="addCategoryLink"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover table-condensed small">
                        <thead>
                            <tr>
                                <th class="planDetail">Category</th>
                                <th class="planDetail text-center">Monthly</th>
                                <th class="planDetail hidden-xs text-center">Bi-Weekly</th>
                                <th class="planDetail hidden-xs text-center">Weekly</th>
                                <th class="planDetail hidden-xs text-center">6 Month</th>
                                <th class="planDetail hidden-xs text-center">Year</th>
                                <th class="planDetail text-center">Average</th>
                                <th class="planDetail custom-hidden-xs hidden-sm text-center">Percentage</th>
                                <th class="planDetail custom-hidden-xs hidden-sm text-center">Ranking</th>
                                <th class="planDetail custom-hidden-xs hidden-sm text-center">Description</th>
                                <th class="planDetail hidden-xs hidden-sm text-center">Comment</th>
                                <th class="planDetail"></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{#each BudgetItem}}
                            <tr>
                                <td class="planDetail">{{BudgetCategory}}</td>
                                <td class="planDetail text-center text-danger">${{NumberCommaFormat AmountMonthly}}</td>
                                <td class="planDetail hidden-xs text-center">${{NumberCommaFormat AmountBiWeekly}}</td>
                                <td class="planDetail hidden-xs text-center">${{NumberCommaFormat AmountWeekly}}</td>
                                <td class="planDetail hidden-xs text-center">${{NumberCommaFormat AmountBiYearly}}</td>
                                <td class="planDetail hidden-xs text-center">${{NumberCommaFormat AmountYearly}}</td>
                                <td class="planDetail text-center">${{NumberCommaFormat TransactionAverage}}</td>
                                <td class="planDetail custom-hidden-xs hidden-sm text-center">{{Percentage}}%</td>
                                <td class="planDetail custom-hidden-xs hidden-sm text-center">#{{RANK}}</td>
                                <td class="planDetail custom-hidden-xs hidden-sm text-center">
                                {{#if Description}}
                                    <i class="fa fa-comment fa-lg" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{Description}}"></i>
                                {{else}}
                                    <span>--</span>
                                {{/if}}
                                </td>
                                <td class="planDetail hidden-xs hidden-sm text-center">
                                {{#if Note}}
                                    <i class="fa fa-comment fa-lg" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{Note}}"></i>
                                {{else}}
                                    <span>--</span>
                                {{/if}}
                                </td>
                                <td class="planDetail text-right">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="javascript:BudgetExpenseDetailModalShow({{BudgetItemID}});">Edit</a></li>
                                            <li><a href="javascript:BudgetExpenseRemove({{BudgetItemID}});">Remove</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            {{/each}}
                        </tbody>
                    </table> 
                </div>
            </div>
            {{/each}}
        </script>

        <script id="tmplBudgetGroupAdd" type="text/x-handlebars-template">   
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add Group
                    <div class="pull-right">
                        <a href="javascript:BudgetExpenseDetailModalShow(0);" title="Add Group" class="addGroupLink"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </script>
        <!--END Templates-->

        <!--Footer-->
        <?php 
            require_once('include/footer.php');
        ?>
        <!--END Footer-->

        <!--Javascript-->
        <script>
            var api = "http://api.jordanandrobert.com/budget";
            var data = new Object();

            var budgetMonth = "";

            var objBudgetMonth = new Object();
            objBudgetMonth.Month = "";
            objBudgetMonth.MonthCurrent = "";
            objBudgetMonth.MonthCurrentDT = "";
            objBudgetMonth.MonthPreviousDT = "";
            objBudgetMonth.MonthPrevious = "";
            objBudgetMonth.MonthNextDT = "";
            objBudgetMonth.MonthNext = "";          
            
            var objBudgetIncome = new Object();            
            objBudgetIncome.TotalIncomeMonthly = "";
            objBudgetIncome.TotalIncomeBiWeekly = "";
            objBudgetIncome.TotalIncomeWeekly = "";
            objBudgetIncome.TotalIncomeBiYearly = "";
            objBudgetIncome.TotalIncomeYearly = "";
            objBudgetIncome.TotalIncomeYearlyGross = "";
            objBudgetIncome.Income = "";

            var objBudgetExpense = new Object();
            objBudgetExpense.BudgetItemID = "";
            objBudgetExpense.BudgetNumber = "";
            objBudgetExpense.BudgetGroup = "";
            objBudgetExpense.BudgetGroupID = "";
            objBudgetExpense.BudgetCategory = "";
            objBudgetExpense.BudgetCategoryID = "";
            objBudgetExpense.Amount = "";
            objBudgetExpense.Description = "";
            objBudgetExpense.Note = "";
            objBudgetExpense.HasSpotlight = "";
            objBudgetExpense.IsEssential = "";
            objBudgetExpense.HasFundFlg = "";
            objBudgetExpense.FundName = "";
            objBudgetExpense.FundID = "";
            objBudgetExpense.StartingBalance = "";
            objBudgetExpense.Expense = "";

            var objBudgetGroup = new Object();
            objBudgetGroup.BudgetGroupID = "";
            objBudgetGroup.BudgetGroup = "";
            objBudgetGroup.BudgetItem = "";

            var objBudgetItem = new Object();
            objBudgetItem.BudgetItemID = "";
            objBudgetItem.BudgetNumber = "";
            objBudgetItem.BudgetCategoryID = "";
            objBudgetItem.BudgetCategory = "";
            objBudgetItem.AmountMonthly = "";
            objBudgetItem.AmountBiWeekly = "";
            objBudgetItem.AmountWeekly = "";
            objBudgetItem.AmountBiYearly = "";
            objBudgetItem.AmountYearly = "";
            objBudgetItem.TransactionAverage = "";
            objBudgetItem.Percentage = "";
            objBudgetItem.RANK = "";
            objBudgetItem.Description = "";
            objBudgetItem.Note = "";

            var objBudgetMonthSummary = new Object();
            objBudgetMonthSummary.TotalIncomeMonthly = "";
            objBudgetMonthSummary.TotalExpenseMonthly = "";
            objBudgetMonthSummary.BalanceMonthly = "";
            objBudgetMonthSummary.IsBalanceMonthlyNegative = "";

            var objAutoComplete = new Object();

            var objAutoFill = new Object();

            $(document).ready(function () {
                console.log("Ready!");

                if ($.urlParam("BudgetMonth") != undefined) {
                    budgetMonth = $.urlParam("BudgetMonth"); 
                    data.BudgetMonth = $.urlParam("BudgetMonth"); 
                }
                else {
                    budgetMonth = Date.today().toString("yyyy-MM-01"); 
                    data.BudgetMonth = budgetMonth;
                }

                $("#hdnBudgetMonth").val(budgetMonth);
                
                BudgetMonthNavigationGet();
                BudgetByMonthValidate();

                $("#uxIncomeSave").click(function (event) {
                    var budgetIncomeID = $(this).data("budget-income-id");

                    objBudgetIncome.BudgetIncomeID = budgetIncomeID;
                    objBudgetIncome.BudgetNumber = $("#hdnBudgetNumber").val();
                    objBudgetIncome.IncomeName = $("#uxIncomeName").val();
                    objBudgetIncome.IncomeTypeID = $("#uxIncomeType option:selected").val();
                    objBudgetIncome.IncomeType = $("#uxIncomeType option:selected").text();
                    objBudgetIncome.PayCycleID = $("#uxPayCycle option:selected").val();
                    objBudgetIncome.PayCycle = $("#uxPayCycle option:selected").text();
                    objBudgetIncome.TakeHomePay = $("#uxTakeHomePay").val();
                    objBudgetIncome.HourlyRate = $("#uxHourlyRate").val();
                    objBudgetIncome.PlannedHours = $("#uxPlannedHours").val();
                    objBudgetIncome.Salary = $("#uxSalary").val();
                    objBudgetIncome.YearDeduct = $("#uxYearDeduct").val();

                    if (ValidateIncome()) {
                        if (budgetIncomeID > 0) {
                            BudgetIncomeUpdate();
                        }
                        else {
                            BudgetIncomeInsert();
                        }

                        $("#mdlIncomeCalculator").modal("toggle");
                    }
                });

                $("#uxIncomeType").change(function() {
                    var IncomeTypeID = $("#uxIncomeType option:selected").val();

                    BudgetIncomeDetailModalTextboxSet(IncomeTypeID);
                });

                $("#uxPayCycle").change(function() {
                    var PayCycleDescription = "Every 2 Weeks";
                    var PayCycleID = $("#uxPayCycle option:selected").val();

                    $("#uxPayCycleDescription").html(PayCycleDescription);

                    BudgetIncomeCalculate();
                });

                $(".incomeCalculator").focusout(function() {
                    BudgetIncomeCalculate();
                });

                $("#uxExpenseSave").click(function (event) {
                    var budgetItemID = $(this).data("budget-item-id");

                    objBudgetExpense.BudgetItemID = budgetItemID;
                    objBudgetExpense.BudgetNumber = $("#hdnBudgetNumber").val();
                    objBudgetExpense.BudgetGroup = $("#uxBudgetGroup").val();
                    objBudgetExpense.BudgetGroupID = $("#uxBudgetGroup").data("group-id");
                    objBudgetExpense.BudgetCategory = $("#uxBudgetCategory").val();
                    objBudgetExpense.BudgetCategoryID = $("#uxBudgetCategory").data("category-id");
                    objBudgetExpense.Amount = $("#uxAmount").val();
                    objBudgetExpense.Description = $("#uxDescription").val();
                    objBudgetExpense.Note = $("#uxNote").val();

                    if ($("#uxHasSpotlight").prop("checked")) {
                        objBudgetExpense.HasSpotlight = "1";
                    }
                    else {
                        objBudgetExpense.HasSpotlight = "0";
                    }

                    if ($("#uxIsEssential").prop("checked")) {
                        objBudgetExpense.IsEssential = "1";
                    }
                    else {
                        objBudgetExpense.IsEssential = "0";
                    }
                    
                    if ($("#uxHasFundFlg").prop("checked")) {
                        objBudgetExpense.HasFundFlg = "1";
                        objBudgetExpense.FundName = $("#uxFundName").val();
                        objBudgetExpense.FundID = $("#uxFundName").data("fund-id");
                        objBudgetExpense.StartingBalance = $("#uxStartingBalance").val();
                    }
                    else {
                        objBudgetExpense.HasFundFlg = "0";
                        objBudgetExpense.FundName = "";
                        objBudgetExpense.FundID = "";
                        objBudgetExpense.StartingBalance = "";
                    }

                    if (ValidateExpense()) {
                        BudgetExpenseUpdate();
                        
                        $("#mdlExpense").modal("toggle");
                    }
                });

                $('#uxBudgetGroup').autocomplete({
                    minChars: 1,
                    noCache: true,
                    lookup: function (query, done) {
                        objAutoComplete.Keyword = query;

                        var result = {};

                        $.ajax({
                            type: "GET",
                            url: api + "/group/description",
                            cache: false,
                            data: objAutoComplete,
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                            async: true,
                            success: function (msg) {
                                var Group = $.map(msg, function (item) {
                                    return { BudgetGroupID: item.BudgetGroupID,
                                            BudgetGroup: item.BudgetGroup };
                                });
                                
                                objAutoFill.Group = Group;
                                
                                var suggestions = $.map(msg, function (item) {
                                    return { value: item.BudgetGroup, data: item.BudgetGroupID };
                                });

                                result.suggestions = suggestions;
                                
                                if (result.suggestions.length == 0) {
                                    $("#uxBudgetGroup").data("group-id", "0");
                                }

                                done(result);
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
                    },
                    onSelect: function (suggestion) {
                        $.map(objAutoFill.Group, function (group) {
                            if (group.BudgetGroupID == suggestion.data) {   
                                $("#uxBudgetGroup").data("group-id", group.BudgetGroupID);                
                            }
                        });
                    }
                });

                $('#uxBudgetCategory').autocomplete({
                    minChars: 1,
                    noCache: true,
                    lookup: function (query, done) {
                        objAutoComplete.Keyword = query;

                        var result = {};

                        $.ajax({
                            type: "GET",
                            url: api + "/category/description",
                            cache: false,
                            data: objAutoComplete,
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                            async: true,
                            success: function (msg) {
                                var Category = $.map(msg, function (item) {
                                    return { BudgetCategoryID: item.BudgetCategoryID,
                                            BudgetCategory: item.BudgetCategory };
                                });
                                
                                objAutoFill.Category = Category;
                                
                                var suggestions = $.map(msg, function (item) {
                                    return { value: item.BudgetCategory, data: item.BudgetCategoryID };
                                });

                                result.suggestions = suggestions;
                                
                                if (result.suggestions.length == 0) {
                                    $("#uxBudgetCategory").data("category-id", "0");
                                }

                                done(result);
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
                    },
                    onSelect: function (suggestion) {
                        $.map(objAutoFill.Category, function (category) {
                            if (category.BudgetCategoryID == suggestion.data) {   
                                $("#uxBudgetCategory").data("category-id", category.BudgetCategoryID);                
                            }
                        });
                    }
                });

                $('#uxFundName').autocomplete({
                    minChars: 1,
                    noCache: true,
                    lookup: function (query, done) {
                        objAutoComplete.Keyword = query;

                        var result = {};

                        $.ajax({
                            type: "GET",
                            url: api + "/fund/description",
                            cache: false,
                            data: objAutoComplete,
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                            async: true,
                            success: function (msg) {
                                var Fund = $.map(msg, function (item) {
                                    return { FundID: item.FundID,
                                            FundName: item.FundName,
                                            StartingBalance: item.StartingBalance };
                                });
                                
                                objAutoFill.Fund = Fund;
                                
                                var suggestions = $.map(msg, function (item) {
                                    return { value: item.FundName, data: item.FundID };
                                });

                                result.suggestions = suggestions;
                                
                                if (result.suggestions.length == 0) {
                                    $("#uxFundName").data("fund-id", "0");
                                }

                                done(result);
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
                    },
                    onSelect: function (suggestion) {
                        $.map(objAutoFill.Fund, function (fund) {
                            if (fund.FundID == suggestion.data) {   
                                $("#uxFundName").data("fund-id", fund.FundID); 
                                $("#uxStartingBalance").val(fund.StartingBalance);                
                            }
                        });
                    }
                });

                $(".back-to-top").remove();
            });

            function BudgetMonthNavigationGet() {
                objBudgetMonth.Month = Date.parse(budgetMonth).toString("MMMM");
                objBudgetMonth.MonthCurrent = Date.parse(budgetMonth).toString("MMMM yyyy");
                objBudgetMonth.MonthCurrentDT = budgetMonth;
                objBudgetMonth.MonthPreviousDT = Date.parse(budgetMonth).add(-1).month().toString("yyyy-MM-01");
                objBudgetMonth.MonthNextDT = Date.parse(budgetMonth).add(1).month().toString("yyyy-MM-01");
                objBudgetMonth.MonthPrevious = Date.parse(budgetMonth).add(-1).month().toString("MMM yyyy");
                objBudgetMonth.MonthNext = Date.parse(budgetMonth).add(1).month().toString("MMM yyyy");

                BudgetMonthNavigationRender();
            }

            // $$$$$$\  $$$$$$$\ $$$$$$\        $$$$$$\   $$$$$$\  $$\       $$\       
            //$$  __$$\ $$  __$$\\_$$  _|      $$  __$$\ $$  __$$\ $$ |      $$ |      
            //$$ /  $$ |$$ |  $$ | $$ |        $$ /  \__|$$ /  $$ |$$ |      $$ |      
            //$$$$$$$$ |$$$$$$$  | $$ |        $$ |      $$$$$$$$ |$$ |      $$ |      
            //$$  __$$ |$$  ____/  $$ |        $$ |      $$  __$$ |$$ |      $$ |      
            //$$ |  $$ |$$ |       $$ |        $$ |  $$\ $$ |  $$ |$$ |      $$ |      
            //$$ |  $$ |$$ |     $$$$$$\       \$$$$$$  |$$ |  $$ |$$$$$$$$\ $$$$$$$$\ 
            //\__|  \__|\__|     \______|       \______/ \__|  \__|\________|\________|
                                                                         
            function BudgetByMonthValidate() {
                var result = {};

                $.ajax({
                    type: "GET",
                    url: api + "/validate",
                    cache: false,
                    data: data,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        result = msg;

                        if (result[0].HasBudgetFlg == "1") {
                            BudgetComponentRender();
                            
                            BudgetIncomeByMonthGet();
                            BudgetExpenseByMonthGet();
                        }
                        else {
                            BudgetStartRender();
                            
                            $("#uxBudgetMonthHeader").attr("style", "cursor: default;");
                            $("#uxBudgetComponent").html("");
                        }
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

            function BudgetByMonthInsert() {
                $.ajax({
                    type: "POST",
                    url: api,
                    cache: false,
                    data: JSON.stringify(data),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        BudgetMonthNavigationGet();
                        BudgetByMonthValidate();

                        $("#uxBudgetStart").html("");
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

            function BudgetByMonthDelete() {
                if ($("#hdnBudgetNumber").val().length > 0) {
                    if (confirm("Delete this month? Are you sure?")) {
                        $.ajax({
                            type: "DELETE",
                            url: api + "/" + $("#hdnBudgetNumber").val(),
                            cache: false,
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                            async: true,
                            success: function (msg) {
                                BudgetByMonthValidate();
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
                }
            }

            function BudgetIncomeByMonthGet() {
                var result = {};

                $.ajax({
                    type: "GET",
                    url: api + "/income",
                    cache: false,
                    data: data,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        result = msg;

                        objBudgetIncome.TotalIncomeMonthly = result[0].TotalIncomeMonthly;
                        objBudgetIncome.TotalIncomeBiWeekly = result[0].TotalIncomeBiWeekly;
                        objBudgetIncome.TotalIncomeWeekly = result[0].TotalIncomeWeekly;
                        objBudgetIncome.TotalIncomeBiYearly = result[0].TotalIncomeBiYearly;
                        objBudgetIncome.TotalIncomeYearly = result[0].TotalIncomeYearly;
                        objBudgetIncome.TotalIncomeYearlyGross = result[0].TotalIncomeYearlyGross;
                        objBudgetIncome.Income = result;

                        BudgetIncomeByMonthRender();
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

            function BudgetIncomeDetailGet(BudgetIncomeID) {              
                var result = {};

                $.ajax({
                    type: "GET",
                    url: api + "/income/" + BudgetIncomeID,
                    cache: false,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        result = msg;
                        
                        $("#uxIncomeType option[value='"+ result[0].IncomeTypeID + "']").prop("selected", true);
                        $("#uxPayCycle option[value='"+ result[0].PayCycleID + "']").prop("selected", true);
                        $("#uxIncomeName").val(result[0].IncomeName);
                        $("#uxPlannedHours").val(result[0].PlannedHours);
                        $("#uxSalary").val(result[0].Salary);
                        $("#uxTakeHomePay").val(result[0].TakeHomePay);
                        $("#uxHourlyRate").val(result[0].HourlyRate);
                        $("#uxYearDeduct").val(result[0].YearDeduct);
                        $("#uxPayCycleDescription").html(result[0].PayCycleDescription);
                        $("#uxIncomeTotal").val("$" + NumberCommaFormat(result[0].TakeHomePay));
                        
                        BudgetIncomeDetailModalTextboxSet(result[0].IncomeTypeID);
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

            function BudgetIncomeUpdate() {
                $.ajax({
                    type: "PUT",
                    url: api + "/income/" + objBudgetIncome.BudgetIncomeID,
                    cache: false,
                    data: JSON.stringify(objBudgetIncome),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        BudgetIncomeByMonthGet();
                        BudgetExpenseByMonthGet();
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

            function BudgetIncomeInsert() {
                $.ajax({
                    type: "POST",
                    url: api + "/income",
                    cache: false,
                    data: JSON.stringify(objBudgetIncome),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        BudgetIncomeByMonthGet();
                        BudgetExpenseByMonthGet();
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

            function BudgetIncomeDelete() {
                $.ajax({
                    type: "DELETE",
                    url: api + "/income/" + objBudgetIncome.BudgetIncomeID,
                    cache: false,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        BudgetIncomeByMonthGet();
                        BudgetExpenseByMonthGet();
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

            function BudgetExpenseByMonthGet() {               
                var result = {};

                $.ajax({
                    type: "GET",
                    url: api + "/expense",
                    cache: false,
                    data: data,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        result = msg;

                        $("#hdnBudgetNumber").val(result[0].BudgetNumber);
                                               
                        objBudgetMonthSummary.TotalIncomeMonthly = result[0].TotalIncomeMonthly;
                        objBudgetMonthSummary.TotalExpenseMonthly = result[0].TotalExpenseMonthly;
                        objBudgetMonthSummary.BalanceMonthly = result[0].BalanceMonthly;
                        objBudgetMonthSummary.IsBalanceMonthlyNegative = result[0].IsBalanceMonthlyNegative;
                        objBudgetMonthSummary.MonthCurrent = objBudgetMonth.MonthCurrent;
                        BudgetMonthSummaryRender();

                        BudgetExpenseByMonthContextSet(result);
                        BudgetExpenseByMonthRender();
                        
                        BudgetGroupAddRender();
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

            function BudgetExpenseDetailGet(BudgetItemID) {              
                var result = {};

                $.ajax({
                    type: "GET",
                    url: api + "/expense/" + BudgetItemID,
                    cache: false,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        result = msg;
                        
                        $("#uxBudgetGroup").val(result[0].BudgetGroup);
                        $("#uxBudgetGroup").data("group-id", result[0].BudgetGroupID);
                        $("#uxBudgetCategory").val(result[0].BudgetCategory);
                        $("#uxBudgetCategory").data("category-id", result[0].BudgetCategoryID);
                        $("#uxAmount").val(result[0].Amount);
                        $("#uxDescription").val(result[0].Description);
                        $("#uxNote").val(result[0].Note);
                        
                        if (result[0].HasSpotlight == "1") {
                            $("#uxHasSpotlight").prop("checked", true);
                        }
                        else {
                            $("#uxHasSpotlight").prop("checked", false);
                        }

                        if (result[0].IsEssential == "1") {
                            $("#uxIsEssential").prop("checked", true);
                        }
                        else {
                            $("#uxIsEssential").prop("checked", false);
                        }

                        if (result[0].HasFundFlg == "1") {
                            $("#uxHasFundFlg").prop("checked", true);
                        }
                        else {
                            $("#uxHasFundFlg").prop("checked", false);
                        }

                        $("#uxFundName").val(result[0].FundName);
                        $("#uxFundName").data("fund-id", result[0].FundID);
                        $("#uxStartingBalance").val(result[0].StartingBalance);
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

            function BudgetExpenseUpdate() {
                $.ajax({
                    type: "PUT",
                    url: api + "/expense",
                    cache: false,
                    data: JSON.stringify(objBudgetExpense),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        BudgetIncomeByMonthGet();
                        BudgetExpenseByMonthGet();
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

            function BudgetExpenseDelete() {
                $.ajax({
                    type: "DELETE",
                    url: api + "/expense/" + objBudgetItem.BudgetItemID,
                    cache: false,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        BudgetIncomeByMonthGet();
                        BudgetExpenseByMonthGet();
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

            //$$$$$$$$\ $$\    $$\ $$$$$$$$\ $$\   $$\ $$$$$$$$\  $$$$$$\  
            //$$  _____|$$ |   $$ |$$  _____|$$$\  $$ |\__$$  __|$$  __$$\ 
            //$$ |      $$ |   $$ |$$ |      $$$$\ $$ |   $$ |   $$ /  \__|
            //$$$$$\    \$$\  $$  |$$$$$\    $$ $$\$$ |   $$ |   \$$$$$$\  
            //$$  __|    \$$\$$  / $$  __|   $$ \$$$$ |   $$ |    \____$$\ 
            //$$ |        \$$$  /  $$ |      $$ |\$$$ |   $$ |   $$\   $$ |
            //$$$$$$$$\    \$  /   $$$$$$$$\ $$ | \$$ |   $$ |   \$$$$$$  |
            //\________|    \_/    \________|\__|  \__|   \__|    \______/ 
             
            function BudgetIncomeDetailModalShow(BudgetIncomeID) {
                BudgetIncomeDetailModalReset();

                $("#uxIncomeSave").data("budget-income-id", BudgetIncomeID);
                
                if (BudgetIncomeID > 0) {
                    $("#uxIncomeModalTitle").html("Edit Income");
                    
                    BudgetIncomeDetailGet(BudgetIncomeID);
                }
                else {
                    $("#uxIncomeModalTitle").html("Add Income");
                }

                $("#mdlIncomeCalculator").modal("toggle");
            }

            function BudgetIncomeDetailModalReset() {
                $("#uxIncomeType option[value='']").prop("selected", true);
                $("#uxPayCycle option[value='']").prop("selected", true);
                $("#uxIncomeName").val("");
                $("#uxPlannedHours").val("");
                $("#uxSalary").val("");
                $("#uxTakeHomePay").val("");
                $("#uxHourlyRate").val("");
                $("#uxYearDeduct").val("");
                $("#uxPayCycleDescription").html("");
                $("#uxIncomeTotal").val("");
                
                $("#uxSalary").prop("disabled", false);
                $("#uxTakeHomePay").prop("disabled", false);
                $("#uxHourlyRate").prop("disabled", false);
                $("#uxYearDeduct").prop("disabled", false);

                $("#IncomeHardErrorMessage").html("");
            }

            function BudgetIncomeDetailModalTextboxSet(IncomeTypeID) {
                switch(IncomeTypeID) {
                    case "1":
                        $("#uxSalary").prop("disabled", false);
                        $("#uxTakeHomePay").prop("disabled", false);
                        $("#uxHourlyRate").prop("disabled", true);
                        $("#uxYearDeduct").prop("disabled", true);
                        break;
                    case "2":
                        $("#uxSalary").prop("disabled", true);
                        $("#uxTakeHomePay").prop("disabled", true);
                        $("#uxHourlyRate").prop("disabled", false);
                        $("#uxYearDeduct").prop("disabled", false);
                        break;
                }
            }

            function BudgetIncomeCalculate() {
                var objIncome = new Object();

                objIncome.IncomeTypeID = $("#uxIncomeType option:selected").val();
                objIncome.PayCycleID = $("#uxPayCycle option:selected").val();
                objIncome.PlannedHours = parseInt($("#uxPlannedHours").val());
                objIncome.Salary = parseInt($("#uxSalary").val());
                objIncome.TakeHomePay = parseInt($("#uxTakeHomePay").val());
                objIncome.HourlyRate = parseInt($("#uxHourlyRate").val());
                objIncome.YearDeduct = parseInt($("#uxYearDeduct").val());
                
                if (objIncome.IncomeTypeID.length > 0 && objIncome.PayCycleID.length > 0 ) {
                    objIncome.PayCycle = 26;

                    if (objIncome.IncomeTypeID == "1" 
                            && $("#uxPlannedHours").val().length > 0 
                            && $("#uxSalary").val().length > 0 
                            && $("#uxTakeHomePay").val().length > 0) {
                        objIncome.HourlyRate = (objIncome.Salary / 52) / objIncome.PlannedHours;
                        objIncome.YearNet = objIncome.TakeHomePay * objIncome.PayCycle;
                        objIncome.YearDeduct = (1 - (objIncome.YearNet / objIncome.Salary)) * 100;
                        
                        objIncome.IncomeTotal = objIncome.TakeHomePay;

                        $("#uxHourlyRate").val(objIncome.HourlyRate.toFixed(2));
                        $("#uxYearDeduct").val(objIncome.YearDeduct.toFixed(2));
                        $("#uxIncomeTotal").val("$" + NumberCommaFormat(objIncome.IncomeTotal));
                    }

                    if (objIncome.IncomeTypeID == "2" 
                            && $("#uxPlannedHours").val().length > 0 
                            && $("#uxHourlyRate").val().length > 0 
                            && $("#uxYearDeduct").val().length > 0) {
                        objIncome.Salary = (objIncome.HourlyRate * objIncome.PlannedHours) * 52;
                        objIncome.YearNet = objIncome.Salary * (1 - (objIncome.YearDeduct / 100));
                        objIncome.TakeHomePay = Math.round(objIncome.YearNet / objIncome.PayCycle);
                        
                        objIncome.IncomeTotal = objIncome.TakeHomePay;

                        $("#uxSalary").val(objIncome.Salary);
                        $("#uxTakeHomePay").val(objIncome.TakeHomePay);
                        $("#uxIncomeTotal").val("$" + NumberCommaFormat(objIncome.IncomeTotal));
                    }
                }  
            }

            function BudgetIncomeRemove(BudgetIncomeID) {  
                if(ConfirmAction()) {
                    objBudgetIncome.BudgetIncomeID = BudgetIncomeID

                    BudgetIncomeDelete();
                }
            }

            function BudgetExpenseDetailModalShow(BudgetItemID) {
                BudgetExpenseDetailModalReset();

                $("#uxExpenseSave").data("budget-item-id", BudgetItemID);
                
                if (BudgetItemID > 0) {
                    $("#uxExpenseModalTitle").html("Edit Expense");
                    
                    BudgetExpenseDetailGet(BudgetItemID);
                }
                else {
                    $("#uxExpenseModalTitle").html("Add Expense");
                }

                $("#mdlExpense").modal("toggle");
            }

            function BudgetExpenseGroupModalShow(BudgetGroupID, BudgetGroup) {
                BudgetExpenseDetailModalReset();

                $("#uxExpenseSave").data("budget-item-id", "0");
                $("#uxBudgetGroup").val(BudgetGroup);
                $("#uxBudgetGroup").data("group-id", BudgetGroupID);
                
                $("#uxExpenseModalTitle").html("Add Expense");

                $("#mdlExpense").modal("toggle");
            }

            function BudgetExpenseDetailModalReset() {
                $("#uxBudgetGroup").val("");
                $("#uxBudgetGroup").data("group-id", "0");
                $("#uxBudgetCategory").val("");
                $("#uxBudgetCategory").data("category-id", "0");
                $("#uxAmount").val("");
                $("#uxDescription").val("");
                $("#uxNote").val("");
                $("#uxHasSpotlight").prop("checked", false) ;
                $("#uxIsEssential").prop("checked", false);
                $("#uxHasFundFlg").prop("checked", false);
                $("#uxFundName").val("");
                $("#uxFundName").data("fund-id", "0");
                $("#uxStartingBalance").val("");

                $("#ExpenseHardErrorMessage").html("");

                $("#MoreOptions").collapse("hide");
            }

            function BudgetExpenseRemove(BudgetItemID) {  
                if(ConfirmAction()) {
                    objBudgetItem.BudgetItemID = BudgetItemID
                    
                    BudgetExpenseDelete();
                }
            }

            function BudgetExpenseByMonthContextSet(result) {
                objBudgetExpense = {};

                var tmpBudgetGroup = $.map(result, function (item) {
                    return {
                        BudgetGroupID: item.BudgetGroupID,
                        BudgetGroup: item.BudgetGroup,
                    };
                });

                var uniqBudgetGroup = _.uniqWith(tmpBudgetGroup, _.isEqual);
                
                var arrBudgetGroup = [];

                $.map(uniqBudgetGroup, function (group) {
                    var arrBudgetItem = [];

                    $.map(result, function (budgetItem) {
                        if (group.BudgetGroupID == budgetItem.BudgetGroupID) {
                            objBudgetItem = {};
                            objBudgetItem.BudgetItemID = budgetItem.BudgetItemID;
                            objBudgetItem.BudgetNumber = budgetItem.BudgetNumber;
                            objBudgetItem.BudgetCategoryID = budgetItem.BudgetCategoryID;
                            objBudgetItem.BudgetCategory = budgetItem.BudgetCategory;
                            objBudgetItem.AmountMonthly = budgetItem.AmountMonthly;
                            objBudgetItem.AmountBiWeekly = budgetItem.AmountBiWeekly;
                            objBudgetItem.AmountWeekly = budgetItem.AmountWeekly;
                            objBudgetItem.AmountBiYearly = budgetItem.AmountBiYearly;
                            objBudgetItem.AmountYearly = budgetItem.AmountYearly;
                            objBudgetItem.TransactionAverage = budgetItem.TransactionAverage;
                            objBudgetItem.Percentage = budgetItem.Percentage;
                            objBudgetItem.RANK = budgetItem.RANK;
                            objBudgetItem.Description = budgetItem.Description;
                            objBudgetItem.Note = budgetItem.Note;

                            arrBudgetItem.push(objBudgetItem);
                        }
                    });

                    objBudgetGroup = {};
                    objBudgetGroup.BudgetGroupID = group.BudgetGroupID;
                    objBudgetGroup.BudgetGroup = group.BudgetGroup;
                    objBudgetGroup.BudgetItem = arrBudgetItem;
                    
                    arrBudgetGroup.push(objBudgetGroup);
                });

                objBudgetExpense.Expense = arrBudgetGroup;
            }

            //$$$$$$$\  $$$$$$$$\ $$\   $$\ $$$$$$$\  $$$$$$$$\ $$$$$$$\  
            //$$  __$$\ $$  _____|$$$\  $$ |$$  __$$\ $$  _____|$$  __$$\ 
            //$$ |  $$ |$$ |      $$$$\ $$ |$$ |  $$ |$$ |      $$ |  $$ |
            //$$$$$$$  |$$$$$\    $$ $$\$$ |$$ |  $$ |$$$$$\    $$$$$$$  |
            //$$  __$$< $$  __|   $$ \$$$$ |$$ |  $$ |$$  __|   $$  __$$< 
            //$$ |  $$ |$$ |      $$ |\$$$ |$$ |  $$ |$$ |      $$ |  $$ |
            //$$ |  $$ |$$$$$$$$\ $$ | \$$ |$$$$$$$  |$$$$$$$$\ $$ |  $$ |
            //\__|  \__|\________|\__|  \__|\_______/ \________|\__|  \__|
                                                           
            function BudgetMonthNavigationRender() {
                var source = $("#tmplBudgetMonthNavigation").html();
                var template = Handlebars.compile(source);

                var context = objBudgetMonth;
                var html = template(context);

                $("#uxBudgetMonthNavigation").html(html);
            }
            
            function BudgetStartRender() {
                var source = $("#tmplBudgetStart").html();
                var template = Handlebars.compile(source);

                var context = objBudgetMonth;
                var html = template(context);

                $("#uxBudgetStart").html(html);
            }

            function BudgetComponentRender() {
                var source = $("#tmplBudgetComponent").html();
                var template = Handlebars.compile(source);

                var context = "";
                var html = template(context);

                $("#uxBudgetComponent").html(html);
            }

            function BudgetIncomeByMonthRender() {
                var source = $("#tmplBudgetIncomeByMonth").html();
                var template = Handlebars.compile(source);

                var context = objBudgetIncome;
                var html = template(context);

                $("#uxBudgetIncomeByMonth").html(html);
            }

            function BudgetExpenseByMonthRender() {
                var source = $("#tmplBudgetExpenseByMonth").html();
                var template = Handlebars.compile(source);

                var context = objBudgetExpense;
                var html = template(context);

                $("#uxBudgetExpenseByMonth").html(html);

                $('[data-toggle="tooltip"]').tooltip();
            }

            function BudgetMonthSummaryRender() {
                var source = $("#tmplBudgetMonthSummary").html();
                var template = Handlebars.compile(source);

                var context = objBudgetMonthSummary;
                var html = template(context);

                $("#uxBudgetMonthSummary").html(html);
            }

            function BudgetGroupAddRender() {
                var source = $("#tmplBudgetGroupAdd").html();
                var template = Handlebars.compile(source);

                var context = "";
                var html = template(context);

                $("#uxBudgetGroupAdd").html(html);
            }

            function ConfirmAction() {
                if (confirm("Are you sure?")) {
                    return true;
                }
                else {
                    return false;
                }
            }

            function ValidateIncome() {
                var error = "";
                var numRegEx = /^-{0,1}\d*\.{0,1}\d+$/;

                if ($("#uxIncomeType option:selected").val().length == 0) { error += "<li>Income Type is required.</li>"; }
                if ($("#uxPayCycle option:selected").val().length == 0) { error += "<li>Pay Cycle is required.</li>"; }
                if ($("#uxIncomeName").val().length == 0) { error += "<li>Name is required.</li>"; }
                if ($("#uxPlannedHours").val().length == 0) { error += "<li>Planned Hours is required.</li>"; }
                if ($("#uxPlannedHours").val().length > 0) { if (!numRegEx.test($("#uxPlannedHours").val())) { error += "<li>Planned Hours must be numeric.</li>"; } }
                if ($("#uxSalary").val().length == 0) { error += "<li>Salary is required.</li>"; }
                if ($("#uxSalary").val().length > 0) { if (!numRegEx.test($("#uxSalary").val())) { error += "<li>Salary must be numeric.</li>"; } }
                if ($("#uxTakeHomePay").val().length == 0) { error += "<li>Take Home Pay is required.</li>"; }
                if ($("#uxTakeHomePay").val().length > 0) { if (!numRegEx.test($("#uxTakeHomePay").val())) { error += "<li>Take Home Pay must be numeric.</li>"; } }
                if ($("#uxHourlyRate").val().length == 0) { error += "<li>Hourly Rate is required.</li>"; }
                if ($("#uxHourlyRate").val().length > 0) { if (!numRegEx.test($("#uxHourlyRate").val())) { error += "<li>Hourly Rate must be numeric.</li>"; } }
                if ($("#uxYearDeduct").val().length == 0) { error += "<li>Year Deduct is required.</li>"; }
                if ($("#uxYearDeduct").val().length > 0) { if (!numRegEx.test($("#uxYearDeduct").val())) { error += "<li>Year Deduct must be numeric.</li>"; } }

                if (error.length > 0) {
                    error = "<div class=\"alert alert-danger\" role=\"alert\"><ul>" + error + "</ul></div>";
                    
                    $("#IncomeHardErrorMessage").html(error);
                    
                    return false;
                }
                else {
                    return true;
                }
            }

            function ValidateExpense() {
                var error = "";
                var numRegEx = /^-{0,1}\d*\.{0,1}\d+$/;

                if ($("#uxBudgetGroup").val().length == 0) { error += "<li>Group is required.</li>"; }
                if ($("#uxBudgetCategory").val().length == 0) { error += "<li>Category is required.</li>"; }
                if ($("#uxAmount").val().length == 0) { error += "<li>Amount is required.</li>"; }
                if ($("#uxAmount").val().length > 0) { if (!numRegEx.test($("#uxAmount").val())) { error += "<li>Amount must be numeric.</li>"; } }

                if (error.length > 0) {
                    error = "<div class=\"alert alert-danger\" role=\"alert\"><ul>" + error + "</ul></div>";
                    
                    $("#ExpenseHardErrorMessage").html(error);
                    
                    return false;
                }
                else {
                    return true;
                }
            }

            $(window).scroll(function() {
                var budgetMonthSummary = $("#uxBudgetMonthSummary");
                var budgetMonthSummaryScroll = "budgetMonthSummaryScroll";
                var elementHeight = $("#uxBudgetMonthSummary").height();

                if ($(this).scrollTop() > elementHeight) {
                    budgetMonthSummary.addClass(budgetMonthSummaryScroll).fadeIn("slow");
                    $("#uxBudgetMonthScroll").show();
                    $(".summaryExpense").addClass("pad");
                }
                else if ($(this).scrollTop() == 0) {
                    budgetMonthSummary.removeClass(budgetMonthSummaryScroll).removeAttr("style");
                    $("#uxBudgetMonthScroll").hide();
                    $(".summaryExpense").removeClass("pad");
                }
            });
        </script>
        <!--END Javascript-->
    </body>
</html>
