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
              <div class="well">
                <form>
                  <fieldset>
                    <legend>Add Transaction</legend>
                    <div class="form-group">
                      <div class="btn-group btn-group-justified btn-group-sm" id="uxTransactionType" data-toggle="buttons">
                        <label class="btn btn-success active">
                          <input type="radio" id="uxTransactionTypeExpense" />
                          Expense
                        </label>
                        <label class="btn btn-success">
                          <input type="radio" id="uxTransactionTypeIncome" />
                          Income
                        </label>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group date datepicker">
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
                        <button type="button" class="btn btn-default" id="uxClear">Clear</button>
                        <button type="button" class="btn btn-success" id="uxAdd">Add</button>
                    </div>
                  </fieldset>
                </form>
              </div>
          </div>
          <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">Recent Transactions</div>
                <div class="panel-body">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th class="visible-lg">Category</th>
                        <th>Amount</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>09/25/2016</td>
                        <td>Trader Joes</td>
                        <td class="visible-lg">Grocery</td>
                        <td>$128.86</td>
                        <td><a href="javascript:void(0);" class="uxEdit" data-transaction-id="1"><i class="fa fa-pencil" aria-hidden="true"></i></td>
                      </tr>
                      <tr>
                        <td>09/23/2016</td>
                        <td>Dinner</td>
                        <td class="visible-lg">Wants</td>
                        <td>$18.61</td>
                        <td><a href="javascript:void(0);" class="uxEdit" data-transaction-id="2"><i class="fa fa-pencil" aria-hidden="true"></i></td>
                      </tr>
                      <tr>
                        <td><input type="text" class="form-control input-sm datepicker uxTransactionDTEdit" value="09/19/2016" /></td>
                        <td><input type="text" class="form-control input-sm uxDescriptionEdit" value="Cash Withdrawl" /></td>
                        <td class="visible-lg">
                          <select class="form-control input-sm uxBudgetCategoryEdit">
                            <option value="1">Mustard</option>
                            <option value="2" selected="selected">Ketchup</option>
                            <option value="3">Relish</option>
                            <option value="4">Tent</option>
                            <option value="5">Flashlight</option>
                            <option value="6">Toilet Paper</option>
                          </select>
                        </td>
                        <td><input type="text" class="form-control input-sm uxAmountEdit"  value="20.00" /></td>
                        <td><a href="javascript:void(0);" class="uxSave" data-transaction-id="3"><i class="fa fa-floppy-o" aria-hidden="true"></i></a></td>
                      </tr>
                      <tr>
                        <td>09/18/2016</td>
                        <td>Netflix</td>
                        <td class="visible-lg">Netflix</td>
                        <td>$9.99</td>
                        <td><a href="javascript:void(0);" class="uxEdit" data-transaction-id="4"><i class="fa fa-pencil" aria-hidden="true"></i></td>
                      </tr>
                      <tr>
                        <td>09/16/2016</td>
                        <td>iTunes</td>
                        <td class="visible-lg">Wants</td>
                        <td>$10.59</td>
                        <td><a href="javascript:void(0);" class="uxEdit" data-transaction-id="5"><i class="fa fa-pencil" aria-hidden="true"></i></td>
                      </tr>
                      <tr>
                        <td>09/14/2016</td>
                        <td>Vanguard IRA</td>
                        <td class="visible-lg">Vanguard IRA</td>
                        <td>$40.00</td>
                        <td><a href="javascript:void(0);" class="uxEdit" data-transaction-id="6"><i class="fa fa-pencil" aria-hidden="true"></i></td>
                      </tr>
                      <tr>
                        <td>09/12/2016</td>
                        <td>Lunch</td>
                        <td class="visible-lg">Eat Out</td>
                        <td>$16.11</td>
                        <td><a href="javascript:void(0);" class="uxEdit" data-transaction-id="7"><i class="fa fa-pencil" aria-hidden="true"></i></td>
                      </tr>
                      <tr>
                        <td>09/07/2016</td>
                        <td>Cat- Feeders Supply</td>
                        <td class="visible-lg">Needs</td>
                        <td>$22.25</td>
                        <td><a href="javascript:void(0);" class="uxEdit" data-transaction-id="8"><i class="fa fa-pencil" aria-hidden="true"></i></td>
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

  <script>
    $(document).ready(function() {
      console.log("ready!");

      $('.datepicker').datepicker({
          clearBtn: true,
          autoclose: true,
          todayHighlight: true,
          orientation: "bottom"
      });
    });
  </script>

</body>
</html>
