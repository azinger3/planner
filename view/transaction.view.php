<!DOCTYPE html>
<html lang="en">

<head>

<?php
  $pageTitle = 'Transactions';

  require_once('include/header.php');
?>

<style>
    .optionHide {
        display: none;
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
              <div class="col-lg-12 visible-lg">
                  <h1>Transactions</h1>
              </div>
          </div>
      </div>

      <!--Page Header END-->

      <!--***********************************************************************Main Content START***********************************************************************-->

      <div class="row">
          <div class="col-md-4">
            <!--<div class="panel panel-primary">
                <div class="panel-heading">Add Transaction</div>
                <div class="panel-body">-->
                <div class="well">
                  <form>
                    <fieldset>
                      <legend>Add Transaction</legend>
                      <div class="form-group">
                        <div class="btn-group btn-group-justified btn-group-sm" data-toggle="buttons">
                          <label class="btn btn-success active">
                            <input type="radio" id="uxTransactionTypeExpense" name="uxTransactionType" />
                            Expense
                          </label>
                          <label class="btn btn-success">
                            <input type="radio" id="uxTransactionTypeIncome" name="uxTransactionType" />
                            Income
                          </label>
                          </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <input type="text" id="uxTransactionDT" class="form-control" placeholder="Transaction Date" />
                          <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        </div>
                      </div>
                      <div class="form-group">
                          <input type="text" id="uxDescription" class="form-control" placeholder="Description" />
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <input type="text" id="uxAmount" class="form-control" placeholder="Amount" />
                          <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                        </div>
                      </div>
                      <div class="form-group">
                          <select class="form-control placeholder" id="uxBudgetCategory">
                            <option value="" selected="selected" class="optionHide">Budget Category</option>
                            <option value="1">Giving</option>
                            <option value="2">Car Replacement</option>
                            <option value="3">Mortgage</option>
                            <option value="4">Home Owners Fee</option>
                            <option value="5">Needs</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <input type="text" id="uxTransactionNumber" class="form-control" placeholder="Transaction Number" />
                      </div>
                      <div class="form-group">
                          <input type="text" id="uxNote" class="form-control" placeholder="Note" />
                      </div>
                      <div class="form-group pull-right">
                          <!-- <button type="button" class="btn btn-danger">Delete</button>
                          <button type="button" class="btn btn-info">Update</button> -->
                          <button type="button" class="btn btn-default">Clear</button>
                          <button type="button" class="btn btn-success">Add</button>
                      </div>
                    </fieldset>
                  </form>
                </div>
                <!--</div>
            </div>-->
          </div>
          <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Recent Transactions</div>
                <div class="panel-body">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>09/25/2016</td>
                        <td>Trader Joes</td>
                        <td>$128.86</td>
                      </tr>
                      <tr>
                        <td>09/23/2016</td>
                        <td>Dinner</td>
                        <td>$18.61</td>
                      </tr>
                      <tr>
                        <td>09/19/2016</td>
                        <td>Cash Withdrawl</td>
                        <td>$20.00</td>
                      </tr>
                      <tr>
                        <td>09/18/2016</td>
                        <td>Netflix</td>
                        <td>$9.99</td>
                      </tr>
                      <tr>
                        <td>09/16/2016</td>
                        <td>iTunes</td>
                        <td>$10.59</td>
                      </tr>
                      <tr>
                        <td>09/14/2016</td>
                        <td>Vanguard IRA</td>
                        <td>$40.00</td>
                      </tr>
                      <tr>
                        <td>09/12/2016</td>
                        <td>Lunch</td>
                        <td>$16.11</td>
                      </tr>
                      <tr>
                        <td>09/07/2016</td>
                        <td>Cat- Feeders Supply</td>
                        <td>$22.25</td>
                      </tr>
                    </tbody>
                  </table>
            </div>
          </div>
      </div>

      <!--***************************************************************************Main Content END*********************************************************************-->

  </div>

  <?php require_once('include/footer.php'); ?>

  <script type="text/babel" src="../../../component/navigation.js"></script>

</body>
</html>
