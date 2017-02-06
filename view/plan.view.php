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
                <div class="row text-center">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8">
                        <ul class="pager">
                            <li class="previous">
                                <a href="javascript:void(0);" class="budgetMonthNav">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                    <span class="custom-hidden-xs">&nbsp;&nbsp;Aug 2017</span>
                                </a>
                            </li>
                            <li class="budgetMonthHeader">September 2017</li>
                            <li class="next">
                                <a href="javascript:void(0);" class="budgetMonthNav">
                                    <span class="custom-hidden-xs">Oct 2017&nbsp;&nbsp;</span>
                                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
            </div>
            <!--Page Header END-->

            <!--Content START-->
            <!--<div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-10 planningContainer">
                    <div class="jumbotron text-center">
                        <h1>Start Planning for September</h1>
                        <p><a href="#" class="btn btn-info btn-lg btn-block">Go</a></p>
                    </div>
                </div>
                <div class="col-md-1" >
                </div>
            </div>-->
            <!--Content END-->

            <!--**********************************************************Main Content END**********************************************************-->
        </div>
        <!--Container END-->

        <section class="section-default">
            <div class="container">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="well well-sm">
                        <table class="table table-condensed leftoverTable">
                            <thead>
                                <tr>
                                    <th class="text-center">Income</th>
                                    <th class="text-center">Expenses</th>
                                    <th class="text-center">Leftover</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">$1,000</td>
                                    <td class="text-center text-danger">$1,000</td>
                                    <td class="text-center"><span class="label label-info">$1,000</span></td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Income
                    <div class="pull-right">
                        <a href="javascript:void(0);" title="Add Income" class="addCategoryLink"><i class="fa fa-plus"></i></a>
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
                                <th class="planDetail custom-hidden-xs text-center">Half-Year</th>
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
                            <tr>
                                <td class="planDetail">Income 1</td>
                                <td class="planDetail text-center">$1,000</td>
                                <td class="planDetail text-center">$1,000</td>
                                <td class="planDetail custom-hidden-xs text-center">$1,000</td>
                                <td class="planDetail custom-hidden-xs text-center">$1,000</td>
                                <td class="planDetail custom-hidden-xs text-center">$1,000</td>
                                <td class="planDetail hidden-xs hidden-sm text-center">$85,035</td>
                                <td class="planDetail hidden-xs text-center">$40.88</td>
                                <td class="planDetail hidden-xs hidden-sm text-center">33.19%</td>
                                <td class="planDetail hidden-xs hidden-sm text-center">40</td>
                                <td class="planDetail hidden-xs hidden-sm text-center">Salary</td>
                                <td class="planDetail text-right">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="javascript:ModalOpen();">Edit</a></li>
                                            <li><a href="javascript:void(0);">Remove</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="planDetail">Income 1</td>
                                <td class="planDetail text-center">$1,000</td>
                                <td class="planDetail text-center">$1,000</td>
                                <td class="planDetail custom-hidden-xs text-center">$1,000</td>
                                <td class="planDetail custom-hidden-xs text-center">$1,000</td>
                                <td class="planDetail custom-hidden-xs text-center">$1,000</td>
                                <td class="planDetail hidden-xs hidden-sm text-center">$42,432</td>
                                <td class="planDetail hidden-xs text-center">$24.00</td>
                                <td class="planDetail hidden-xs hidden-sm text-center">31.00%</td>
                                <td class="planDetail hidden-xs hidden-sm text-center">34</td>
                                <td class="planDetail hidden-xs hidden-sm text-center">Hourly</td>
                                <td class="planDetail text-right">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="javascript:ModalOpen();">Edit</a></li>
                                            <li><a href="javascript:void(0);">Remove</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="planDetail"><h5><strong>TOTAL</strong></h5></td>
                                <td class="planDetail text-center"><h5><strong>$1,000</strong></h5></td>
                                <td class="planDetail text-center"><h5><strong>$1,000</strong></h5></td>
                                <td class="planDetail custom-hidden-xs text-center"><h5><strong>$1,000</strong></h5></td>
                                <td class="planDetail custom-hidden-xs text-center"><h5><strong>$1,000</strong></h5></td>
                                <td class="planDetail custom-hidden-xs text-center"><h5><strong>$1,000</strong></h5></td>
                                <td class="planDetail hidden-xs hidden-sm text-center"><h5><strong>$127,467</strong></h5></td>
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
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Strategic
                    <div class="pull-right">
                        <a href="javascript:void(0);" title="Add Category" class="addCategoryLink"><i class="fa fa-plus"></i></a>
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
                                <th class="planDetail hidden-xs text-center">Half-Year</th>
                                <th class="planDetail hidden-xs text-center">Year</th>
                                <th class="planDetail text-center">Average</th>
                                <th class="planDetail custom-hidden-xs hidden-sm text-center">Percentage</th>
                                <th class="planDetail custom-hidden-xs hidden-sm text-center">Ranking</th>
                                <th class="planDetail hidden-xs hidden-sm text-center">Comment</th>
                                <th class="planDetail custom-hidden-xs hidden-sm text-center">Description</th>
                                <th class="planDetail"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="planDetail">Giving</td>
                                <td class="planDetail text-center">$1,000</td>
                                <td class="planDetail hidden-xs text-center">$1,000</td>
                                <td class="planDetail hidden-xs text-center">$1,000</td>
                                <td class="planDetail hidden-xs text-center">$1,000</td>
                                <td class="planDetail hidden-xs text-center">$1,000</td>
                                <td class="planDetail text-center">$1,000</td>
                                <td class="planDetail custom-hidden-xs hidden-sm text-center">40.61%</td>
                                <td class="planDetail custom-hidden-xs hidden-sm text-center">#17</td>
                                <td class="planDetail hidden-xs hidden-sm text-center">
                                    <i class="fa fa-comment fa-lg" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Variable expense, A guideline"></i>
                                </td>
                                <td class="planDetail custom-hidden-xs hidden-sm text-center">
                                    <i class="fa fa-comment fa-lg" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="(1) Examples include clothes, hygiene, toiletries, home care, cleaning supplies, yard care, pet expenses, school supplies, office supplies, shipping, legal fees, and legal services"></i>
                                </td>
                                <td class="planDetail text-right">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="javascript:void(0);">Edit</a></li>
                                            <li><a href="javascript:void(0);">Remove</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="planDetail">Car Replacement</td>
                                <td class="planDetail text-center">$1,000</td>
                                <td class="planDetail hidden-xs text-center">$1,000</td>
                                <td class="planDetail hidden-xs text-center">$1,000</td>
                                <td class="planDetail hidden-xs text-center">$1,000</td>
                                <td class="planDetail hidden-xs text-center">$1,000</td>
                                <td class="planDetail text-center">$1,000</td>
                                <td class="planDetail custom-hidden-xs hidden-sm text-center">40.61%</td>
                                <td class="planDetail custom-hidden-xs hidden-sm text-center">#17</td>
                                <td class="planDetail hidden-xs hidden-sm text-center">
                                    <i class="fa fa-comment fa-lg" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Variable expense, A guideline"></i>
                                </td>
                                <td class="planDetail custom-hidden-xs hidden-sm text-center">
                                    <i class="fa fa-comment fa-lg" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="(1) Examples include clothes, hygiene, toiletries, home care, cleaning supplies, yard care, pet expenses, school supplies, office supplies, shipping, legal fees, and legal services"></i>
                                </td>
                                <td class="planDetail text-right">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="javascript:void(0);">Edit</a></li>
                                            <li><a href="javascript:void(0);">Remove</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table> 
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add Group
                    <div class="pull-right">
                        <a href="javascript:void(0);" title="Add Category" class="addGroupLink"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <!--Modals-->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Income Calculator</h4>
                        <input type="hidden" id="hdnIncomeMethod" value="POST">
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <!--constant-->
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="uxIncomeType">Type:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="uxIncomeType">
                                        <option value="Choice 1">Salary</option>
                                        <option value="Choice 2">Hourly</option>
                                    </select>
                                </div>
                            </div>
                            <!--constant-->
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="uxIncomePayCycle">Pay Cycle:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="2">
                                        <option value="Choice 1">Bi-Weekly</option>
                                        <option value="Choice 2">Weekly</option>
                                    </select>
                                </div>
                            </div>
                            <!--only Salary-->
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="uxSalary">Salary:</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="uxSalary" placeholder="$">
                                </div>
                            </div>
                            <!--both-->
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="uxPlannedHours">Planned Hours:</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="uxPlannedHours" placeholder="">
                                </div>
                            </div>
                            <!--only Hourly-->
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="uxYearDeduct">Year Deduct %:</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="uxYearDeduct" placeholder="%">
                                </div>
                            </div>
                            <!--only Hourly-->
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="uxHourlyRate">Hourly Rate:</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="uxHourlyRate" placeholder="$">
                                </div>
                            </div>
                            <!--only Salary-->
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="uxTakeHomePay">Take Home Pay:</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="uxTakeHomePay" placeholder="$">
                                </div>
                            </div>
                            <br />
                            <!--TOTAL-->
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="alert alert-success text-center" id="uxIncomeTotal" style="margin-bottom: 0; font-size: 24px;">
                                        <strong>$2,185</strong> every 2 weeks
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-info">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!--END Modals-->

        <!--Templates-->
        <script id="tmpl" type="text/x-handlebars-template">

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

            $(document).ready(function () {
                console.log("Ready!");

                $('[data-toggle="tooltip"]').tooltip();
            });

            function ModalOpen() {
                $("#myModal").modal("toggle");
            }
        </script>
        <!--END Javascript-->
    </body>
</html>
