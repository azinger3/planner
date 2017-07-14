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
                z-index: 1049;
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

        <?php require_once('include/navigation.budget.php'); ?>

        <div class="container">
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
            <div id="uxBudgetStart">
            </div>
        </div>
        <div id="uxBudgetComponent">
        </div>
        
        <!--Income Modal-->
        <div class="modal fade" id="mdlIncomeCalculator" role="dialog">
            <div class="modal-dialog">
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
                                                <textarea rows="5" class="form-control input-sm" id="uxDescription" style="resize: none;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="uxNote" class="small">Note:</label>
                                                <textarea rows="5" class="form-control input-sm" id="uxNote" style="resize: none;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="small">
                                                    <input type="checkbox" id="uxHasSpotlight"> Show on Home Page
                                                </label>
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
                <span class="label label-info">{{MonthCurrent}}</span>
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
                                <th class="planDetail text-right">Monthly</th>
                                <th class="planDetail hidden-xs hidden-sm text-right">Planned Hours</th>
                                <th class="planDetail text-right">Bi-Weekly</th>
                                <th class="planDetail custom-hidden-xs text-right">Weekly</th>
                                <th class="planDetail custom-hidden-xs text-right">6 Month</th>
                                <th class="planDetail custom-hidden-xs text-right">Year (Net)</th>
                                <th class="planDetail hidden-xs hidden-sm text-right">Year (Gross)</th>
                                <th class="planDetail hidden-xs text-right">Hourly Rate</th>
                                <th class="planDetail hidden-xs hidden-sm text-right">Year Deduct %</th>
                                <th class="planDetail hidden-xs hidden-sm text-right">Type</th>
                                <th class="planDetail"></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{#each Income}}
                            <tr>
                                <td class="planDetail">{{IncomeName}}</td>
                                <td class="planDetail text-right text-success">${{NumberCommaFormat IncomeMonthly}}</td>
                                <td class="planDetail hidden-xs hidden-sm text-right">{{PlannedHours}}</td>
                                <td class="planDetail text-right">${{NumberCommaFormat IncomeBiWeekly}}</td>
                                <td class="planDetail custom-hidden-xs text-right">${{NumberCommaFormat IncomeWeekly}}</td>
                                <td class="planDetail custom-hidden-xs text-right">${{NumberCommaFormat IncomeBiYearly}}</td>
                                <td class="planDetail custom-hidden-xs text-right">${{NumberCommaFormat IncomeYearly}}</td>
                                <td class="planDetail hidden-xs hidden-sm text-right">${{NumberCommaFormat Salary}}</td>
                                <td class="planDetail hidden-xs text-right">${{NumberCommaFormat HourlyRate}}</td>
                                <td class="planDetail hidden-xs hidden-sm text-right">{{YearDeduct}}%</td>
                                <td class="planDetail hidden-xs hidden-sm text-right">{{IncomeType}}</td>
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
                                <td class="planDetail text-right text-success"><h5><strong>${{NumberCommaFormat TotalIncomeMonthly}}</strong></h5></td>
                                <td class="planDetail hidden-xs hidden-sm text-right"></td>
                                <td class="planDetail text-right"><h5><strong>${{NumberCommaFormat TotalIncomeBiWeekly}}</strong></h5></td>
                                <td class="planDetail custom-hidden-xs text-right"><h5><strong>${{NumberCommaFormat TotalIncomeWeekly}}</strong></h5></td>
                                <td class="planDetail custom-hidden-xs text-right"><h5><strong>${{NumberCommaFormat TotalIncomeBiYearly}}</strong></h5></td>
                                <td class="planDetail custom-hidden-xs text-right"><h5><strong>${{NumberCommaFormat TotalIncomeYearly}}</strong></h5></td>
                                <td class="planDetail hidden-xs hidden-sm text-right"><h5><strong>${{NumberCommaFormat TotalIncomeYearlyGross}}</strong></h5></td>
                                <td class="planDetail hidden-xs text-right"></td>
                                <td class="planDetail hidden-xs hidden-sm text-right"></td>
                                <td class="planDetail hidden-xs hidden-sm text-right"></td>
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
                                <th class="planDetail text-right">Monthly</th>
                                <th class="planDetail text-right">Average</th>
                                <th class="planDetail hidden-xs text-right">Bi-Weekly</th>
                                <th class="planDetail hidden-xs text-right">Weekly</th>
                                <th class="planDetail hidden-xs text-right">6 Month</th>
                                <th class="planDetail custom-hidden-xs text-right">Year</th>
                                <th class="planDetail custom-hidden-xs hidden-sm text-right">Percentage</th>
                                <th class="planDetail hidden-xs hidden-sm text-right">Ranking</th>
                                <th class="planDetail custom-hidden-xs hidden-sm text-right">Description</th>
                                <th class="planDetail hidden-xs hidden-sm text-right">Comment</th>
                                <th class="planDetail"></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{#each BudgetItem}}
                            <tr>
                                <td class="planDetail">{{BudgetCategory}}</td>
                                <td class="planDetail text-right text-danger">${{NumberCommaFormat AmountMonthly}}</td>
                                <td class="planDetail text-right text-warning">${{NumberCommaFormat TransactionAverage}}</td>
                                <td class="planDetail hidden-xs text-right">${{NumberCommaFormat AmountBiWeekly}}</td>
                                <td class="planDetail hidden-xs text-right">${{NumberCommaFormat AmountWeekly}}</td>
                                <td class="planDetail hidden-xs text-right">${{NumberCommaFormat AmountBiYearly}}</td>
                                <td class="planDetail custom-hidden-xs text-right">${{NumberCommaFormat AmountYearly}}</td>
                                <td class="planDetail custom-hidden-xs hidden-sm text-right">{{Percentage}}%</td>
                                <td class="planDetail hidden-xs hidden-sm text-right">#{{RANK}}</td>
                                <td class="planDetail custom-hidden-xs hidden-sm text-right">
                                {{#if Description}}
                                    <i class="fa fa-comment fa-lg" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{Description}}"></i>
                                {{else}}
                                    <span>--</span>
                                {{/if}}
                                </td>
                                <td class="planDetail hidden-xs hidden-sm text-right">
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

        <?php require_once('include/footer.php'); ?>

        <script type="text/javascript" src="../../../controller/plan.controller.js"></script>>
    </body>
</html>
