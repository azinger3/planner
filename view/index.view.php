<!DOCTYPE html>
<html lang="en">

<head>

<?php
  $pageTitle = 'Planner';

  require_once('include/header.php');
?>

<style>
    .addTransactionLink {
        color: #2c3e50;
    }
</style>

</head>
<body>

  <!--Navigation START-->

  <div id="navigation"></div>

  <!--Navigation END-->

  <div class="container">

      <!--Page Header START-->

      <div class="page-header">
          <div class="row">
              <div class="col-lg-6 col-xs-6 visible-lg">
                  <h1>Dashboard</h1>
              </div>
              <div class="col-lg-6 col-xs-6">
                  <div class="pull-right">
                      <a href="budget/transaction" class="addTransactionLink"><h1 title="Add Transaction"><i class="fa fa-plus"></i></h1></a>
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

  <?php require_once('include/footer.php'); ?>

  <script type="text/babel" src="../../../component/navigation.js"></script>

</body>
</html>
