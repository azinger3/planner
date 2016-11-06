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

    .nav-pills>li.active>a, .nav-pills>li.active>a:hover, .nav-pills>li.active>a:focus {
        color: #3498db;
        background-color: #ecf0f1;
    }

    .nav-pills>li>a {
        color: #2c3e50;
    }
</style>

</head>
<body>

  <!--Navigation START-->

  <div id="budgetNavigation"></div>

  <!--Navigation END-->

  <!--Container START-->

  <div class="container">

      <!--Page Header START-->

      <div class="page-header">
          <div class="row">
          </div>
      </div>

      <!--Page Header END-->

      <!--**********************************************************Main Content START**********************************************************-->

      <div class="row">
          <div class="col-md-12">
              <ul class="nav nav-pills">
                  <li class="active"><a href="#BudgetSummary" data-toggle="tab" aria-expanded="true">Budget Summary</a></li>
                  <li class=""><a href="#ExpenseBreakdown" data-toggle="tab" aria-expanded="false">Expense Breakdown</a></li>
              </ul>
              <div id="tabContent" class="tab-content">
                  <div class="tab-pane fade active in" id="BudgetSummary">
                      <div class="well">
                          <form>
                              <fieldset>
                                  <div class="form-group col-md-3">
                                      <label for="1">Date Range:</label>
                                      <input type="text" class="form-control" id="1">
                                  </div>
                                  <div class="form-group col-md-3">
                                      <label for="2">Keyword:</label>
                                      <input type="text" class="form-control" id="2">
                                  </div>
                                  <div class="form-group col-md-3">
                                      <label for="3">Category:</label>
                                      <select class="form-control placeholder" id="3">
                                          <option value="" selected="selected" class="optionHide">Category</option>
                                          <option value="1">Giving</option>
                                          <option value="2">Car Replacement</option>
                                          <option value="3">Mortgage</option>
                                          <option value="4">Home Owners Fee</option>
                                          <option value="5">Needs</option>
                                      </select>
                                  </div>
                                  <div class="form-group col-md-3">
                                      <label>&nbsp;</label>
                                      <button type="button" class="form-control btn btn-info col-md-2">Search</button>
                                  </div>
                              </fieldset>
                          </form>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                              <h2>Summary</h2>
                              <div class="panel panel-primary">
                                  <div class="panel-body">
                                      <table class="table table-striped table-bordered table-hover small">
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
                                              <tr>
                                                  <td>Income</td>
                                                  <td class="hidden-xs hidden-sm">$3,983.09</td>
                                                  <td class="hidden-xs hidden-sm">$7,288.00</td>
                                                  <td>($3,304.91)</td>
                                                  <td>$7,717.82</td>
                                              </tr>
                                              <tr>
                                                  <td>AAA</td>
                                                  <td class="hidden-xs hidden-sm">$3,983.09</td>
                                                  <td class="hidden-xs hidden-sm">$7,288.00</td>
                                                  <td>($3,304.91)</td>
                                                  <td>$7,717.82</td>
                                              </tr>
                                              <tr>
                                                  <td>Car Insurance</td>
                                                  <td class="hidden-xs hidden-sm">$3,983.09</td>
                                                  <td class="hidden-xs hidden-sm">$7,288.00</td>
                                                  <td>($3,304.91)</td>
                                                  <td>$7,717.82</td>
                                              </tr>
                                              <tr>
                                                  <td>Car Registration</td>
                                                  <td class="hidden-xs hidden-sm">$3,983.09</td>
                                                  <td class="hidden-xs hidden-sm">$7,288.00</td>
                                                  <td>($3,304.91)</td>
                                                  <td>$7,717.82</td>
                                              </tr>
                                              <tr>
                                                  <td>Emergencies</td>
                                                  <td class="hidden-xs hidden-sm">$3,983.09</td>
                                                  <td class="hidden-xs hidden-sm">$7,288.00</td>
                                                  <td>($3,304.91)</td>
                                                  <td>$7,717.82</td>
                                              </tr>
                                              <tr>
                                                  <td>Gas</td>
                                                  <td class="hidden-xs hidden-sm">$3,983.09</td>
                                                  <td class="hidden-xs hidden-sm">$7,288.00</td>
                                                  <td>($3,304.91)</td>
                                                  <td>$7,717.82</td>
                                              </tr>
                                              <tr>
                                                  <td>Gifts</td>
                                                  <td class="hidden-xs hidden-sm">$3,983.09</td>
                                                  <td class="hidden-xs hidden-sm">$7,288.00</td>
                                                  <td>($3,304.91)</td>
                                                  <td>$7,717.82</td>
                                              </tr>
                                              <tr>
                                                  <td>Mortgage</td>
                                                  <td class="hidden-xs hidden-sm">$3,983.09</td>
                                                  <td class="hidden-xs hidden-sm">$7,288.00</td>
                                                  <td>($3,304.91)</td>
                                                  <td>$7,717.82</td>
                                              </tr>
                                              <tr>
                                                  <td>Needs</td>
                                                  <td class="hidden-xs hidden-sm">$3,983.09</td>
                                                  <td class="hidden-xs hidden-sm">$7,288.00</td>
                                                  <td>($3,304.91)</td>
                                                  <td>$7,717.82</td>
                                              </tr>
                                              <tr>
                                                  <td>Phone Cell</td>
                                                  <td class="hidden-xs hidden-sm">$3,983.09</td>
                                                  <td class="hidden-xs hidden-sm">$7,288.00</td>
                                                  <td>($3,304.91)</td>
                                                  <td>$7,717.82</td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                              <h2>Details</h2>
                              <div class="panel panel-primary">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">Income</h3>
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
                                              <tr>
                                                <td>10/01/2016</td>
                                                <td>ATR-2016-10-1</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                                <td>$2,104.84</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                              </tr>
                                              <tr>
                                                <td>10/01/2016</td>
                                                <td>ATR-2016-10-1</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                                <td>$2,104.84</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                              </tr>
                                              <tr>
                                                <td>10/01/2016</td>
                                                <td>ATR-2016-10-1</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                                <td>$2,104.84</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                              </tr>
                                              <tr>
                                                <td>10/01/2016</td>
                                                <td>ATR-2016-10-1</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                                <td>$2,104.84</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                              </tr>
                                              <tr>
                                                <td>10/01/2016</td>
                                                <td>ATR-2016-10-1</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                                <td>$2,104.84</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                              <div class="panel panel-primary">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">Eat Out</h3>
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
                                              <tr>
                                                <td>10/01/2016</td>
                                                <td>Lunch</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                                <td>$2,104.84</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                              </tr>
                                              <tr>
                                                <td>10/01/2016</td>
                                                <td>Lunch</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                                <td>$2,104.84</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                              </tr>
                                              <tr>
                                                <td>10/01/2016</td>
                                                <td>Lunch</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                                <td>$2,104.84</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                              </tr>
                                              <tr>
                                                <td>10/01/2016</td>
                                                <td>Lunch</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                                <td>$2,104.84</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                              </tr>
                                              <tr>
                                                <td>10/01/2016</td>
                                                <td>Lunch</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                                <td>$2,104.84</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                              <div class="panel panel-primary">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">Giving</h3>
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
                                              <tr>
                                                <td>10/01/2016</td>
                                                <td>Giving</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                                <td>$2,104.84</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                              </tr>
                                              <tr>
                                                <td>10/01/2016</td>
                                                <td>Giving</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                                <td>$2,104.84</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                              </tr>
                                              <tr>
                                                <td>10/01/2016</td>
                                                <td>Giving</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                                <td>$2,104.84</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                              </tr>
                                              <tr>
                                                <td>10/01/2016</td>
                                                <td>Giving</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                                <td>$2,104.84</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                              </tr>
                                              <tr>
                                                <td>10/01/2016</td>
                                                <td>Giving</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                                <td>$2,104.84</td>
                                                <td class="hidden-xs hidden-sm"></td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="ExpenseBreakdown">
                      <div class="well">
                          <form>
                              <fieldset>
                                  <div class="form-group col-md-3">
                                      <label for="1">Date Range:</label>
                                      <input type="text" class="form-control" id="1">
                                  </div>
                                  <div class="form-group col-md-3">
                                      <label for="3">Type:</label>
                                      <select class="form-control placeholder" id="3">
                                          <option value="" selected="selected" class="optionHide">Category</option>
                                          <option value="1">Giving</option>
                                          <option value="2">Car Replacement</option>
                                          <option value="3">Mortgage</option>
                                          <option value="4">Home Owners Fee</option>
                                          <option value="5">Needs</option>
                                      </select>
                                  </div>
                                  <div class="form-group col-md-3 hidden-xs hidden-sm">
                                  </div>
                                  <div class="form-group col-md-3">
                                      <label>&nbsp;</label>
                                      <button type="button" class="form-control btn btn-info col-md-2">Search</button>
                                  </div>
                              </fieldset>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!--**********************************************************Main Content END**********************************************************-->

  </div>

  <!--Container END-->

  <?php require_once('include/footer.php'); ?>

  <script type="text/babel" src="../../../component/budget.navigation.js"></script>

  <script>
    $(document).ready(function() {
      console.log("ready!");

      $('.input-datepicker').datepicker({
          clearBtn: true,
          todayBtn: true,
          autoclose: true,
          todayHighlight: true,
          orientation: "bottom"
      });
    });
  </script>

</body>
</html>
