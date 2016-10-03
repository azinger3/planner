<!DOCTYPE html>
<html lang="en">

<head>
    <title>Planner</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/planner.css">
</head>
<body>

    <!--Navigation Bar START-->

    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">Planner
                </a>
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse" id="navbar-main">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Budget
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#">Plan</a>
                            </li>
                            <li>
                                <a href="#">Transactions</a>
                            </li>
                            <li>
                                <a href="#">Calculator</a>
                            </li>
                            <li>
                                <a href="#">Summaries</a>
                            </li>

                            <li>
                                <a href="#">History</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">To Do List</a>
                    </li>
                    <li>
                        <a href="#">Tracker</a>
                    </li>
                    <li>
                        <a href="#">Wish List</a>
                    </li>
                    <li>
                        <a href="#">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!--Navigation Bar END-->

    <div class="container">

        <!--Page Header START-->

        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-xs-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-lg-6 col-xs-6">
                    <div class="pull-right">
                        <h1 title="Add Transaction"><i class="fa fa-plus"></i></h1>
                    </div>
                </div>
            </div>
        </div>

        <!--Page Header END-->

        <!--***********************************************************************Main Content START***********************************************************************-->

        <div class="row">
            <div class="col-md-8">

                <!--Remaining Variable Funds START-->

                <div class="panel panel-primary">
                    <div class="panel-heading">Remaining Variable Funds</div>
                    <div class="panel-body">
                        <div class="currentMonth"><strong>September 2016</strong></div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="categoryWidth"></th>
                                    <th class="progressWidth"></th>
                                    <th class="remainingWidth"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Eat Out</td>
                                    <td>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar progress-bar-info" style="width: 60%"></div>
                                        </div>
                                    </td>
                                    <td class="remaining">$300.00</td>
                                </tr>
                                <tr>
                                    <td>Gas</td>
                                    <td>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar progress-bar-success" style="width: 40%"></div>
                                        </div>
                                    </td>
                                    <td class="remaining">$300.00</td>
                                </tr>
                                <tr>
                                    <td>Grocery</td>
                                    <td>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar progress-bar-warning" style="width: 30%"></div>
                                        </div>
                                    </td>
                                    <td class="remaining">$300.00</td>
                                </tr>
                                <tr>
                                    <td>Needs</td>
                                    <td>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar progress-bar-danger" style="width: 80%"></div>
                                        </div>
                                    </td>
                                    <td class="remaining">$300.00</td>
                                </tr>
                                <tr>
                                    <td>WAM</td>
                                    <td>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar progress-bar-info" style="width: 75%"></div>
                                        </div>
                                    </td>
                                    <td class="remaining">$300.00</td>
                                </tr>
                                <tr>
                                    <td>Wants</td>
                                    <td>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar progress-bar-success" style="width: 20%"></div>
                                        </div>
                                    </td>
                                    <td class="remaining">$300.00</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <h4><strong>TOTAL</strong></h4>
                                    </td>
                                    <td>
                                        <div class="progress progress-striped progress-lg">
                                            <div class="progress-bar progress-bar-danger" style="width: 20%"></div>
                                        </div>
                                    </td>
                                    <td class="remaining">
                                        <h4><strong>$1860.00</strong></h4>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
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

        <!--***************************************************************************Main Content END***************************************************************************-->

    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/js-signals/1.0.0/js-signals.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crossroads/0.12.2/crossroads.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/react@15.3.2/dist/react.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/react-dom@15.3.2/dist/react-dom.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
