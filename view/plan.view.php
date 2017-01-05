<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $pageTitle = 'Planning';

            require_once('include/header.php');
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

            .quickLink {
                color: #ffffff;
                font-size: 16px;
                margin: 7px;
            }

            @media (max-width:414px) {
                .budgetMonthHeader {
                    font-size: 16px;
                    margin-bottom: 20px;
                    margin-top: -5px;
                }

                .budgetMonthNav {
                    font-size: 12px;
                }

                .pager li > a, .pager li > span {
                    margin-top: -2px !important;
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
                            <li class="previous"><a href="javascript:void(0);" class="budgetMonthNav">&larr;&nbsp;&nbsp;Aug 2017</a></li>
                            <li class="budgetMonthHeader">September 2017</li>
                            <li class="next"><a href="javascript:void(0);" class="budgetMonthNav">Oct 2017&nbsp;&nbsp;&rarr;</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
            </div>
            <!--Page Header END-->

            <!--Content START-->
            <div class="row">
                <!--<div class="col-md-1">
                </div>
                <div class="col-md-10 planningContainer">
                    <div class="jumbotron text-center">
                        <h1>Start Planning for September</h1>
                        <p><a href="#" class="btn btn-info btn-lg btn-block">Go</a></p>
                    </div>
                </div>
                <div class="col-md-1" >
                </div>-->
            </div>
            <!--Content END-->

            <!--**********************************************************Main Content END**********************************************************-->
        </div>
        <!--Container END-->

        <section class="section-default">
            <div class="text-center leftToBudget">
                <div class="leftToBudget text">
                    <strong>Left to Budget</strong>
                </div>
                <div class="leftToBudget text">
                    <strong>$1,000</strong>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    Income
                    <div class="pull-right">
                        <a href="javascript:void(0);" title="Add Category" class="quickLink"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Monthly</th>
                                <th class="hidden-xs">Bi-Weekly</th>
                                <th class="hidden-xs">Weekly</th>
                                <th class="hidden-xs">Half-Year</th>
                                <th class="hidden-xs">Year</th>
                                <th>Average</th>
                                <th class="hidden-xs text-center">Comment</th>
                                <th class="hidden-xs text-center">Description</th>
                                <th class="hidden-xs">Percentage</th>
                                <th class="hidden-xs">Ranking</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Income</td>
                                <td>$1,000</td>
                                <td class="hidden-xs">$1,000</td>
                                <td class="hidden-xs">$1,000</td>
                                <td class="hidden-xs">$1,000</td>
                                <td class="hidden-xs">$1,000</td>
                                <td>$1,000</td>
                                <td class="hidden-xs text-center"><i class="fa fa-comment fa-lg" aria-hidden="true"></i></td>
                                <td class="hidden-xs text-center"><i class="fa fa-sticky-note fa-lg" aria-hidden="true"></i></td>
                                <td class="hidden-xs">40.61%</td>
                                <td class="hidden-xs">#17</td>
                                <td>
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
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Strategic</h3>
                </div>
                <div class="panel-body">
                </div>
            </div>
        </section>

        <!--Templates START-->
        <script id="tmpl" type="text/x-handlebars-template">

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

            $(document).ready(function() {
                console.log("Ready!");

               
            });

           
        </script>
        <!--Javascript END-->
    </body>
</html>
