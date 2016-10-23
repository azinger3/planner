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

    .recentTransactionContainter {
        overflow: hidden;
        overflow-y: scroll;
        height: 520px;
    }

    .input-amount-edit {
        width: 90px;
    }

    .input-transaction-date-edit {
        width: 110px;
    }

    @media (max-width: 768px) {
      .recentTransactionContainter {
          overflow: auto;
          overflow-y: auto;
          height: auto;
      }
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

      <!--**********************************************************Main Content START**********************************************************-->

      <div class="row">
          <div class="col-md-4">
              <div class="well">
                <form>
                  <fieldset>
                    <legend>Add Transaction</legend>
                    <div class="form-group">
                      <div class="btn-group btn-group-justified btn-group-sm" data-toggle="buttons">
                        <label class="btn btn-info active">
                          <input type="radio" class="uxTransactionType" data-transaction-type-id="2" />
                          Expense
                        </label>
                        <label class="btn btn-info">
                          <input type="radio" class="uxTransactionType" data-transaction-type-id="1" />
                          Income
                        </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" id="uxTransactionDT" class="form-control input-datepicker" placeholder="MM/DD/YYYY" />
                    </div>
                    <div class="form-group">
                        <input type="text" id="uxDescription" class="form-control" placeholder="Description" />
                    </div>
                    <div class="form-group">
                        <input type="text" id="uxAmount" class="form-control" placeholder="$" />
                    </div>
                    <div class="form-group">
                        <select class="form-control placeholder" id="uxBudgetCategory">
                          <option value="" selected="selected" class="optionHide">Category</option>
                          <option value="1">Giving</option>
                          <option value="2">Car Replacement</option>
                          <option value="3">Mortgage</option>
                          <option value="4">Home Owners Fee</option>
                          <option value="5">Needs</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" id="uxTransactionNumber" class="form-control" placeholder="Transaction #" />
                    </div>
                    <div class="form-group">
                        <input type="text" id="uxNote" class="form-control" placeholder="Note" />
                    </div>
                    <div class="form-group pull-right">
                        <button type="button" class="btn btn-default" id="uxClear">Clear</button>
                        <button type="button" class="btn btn-info" id="uxAdd">Add</button>
                    </div>
                  </fieldset>
                </form>
              </div>
          </div>
          <div class="">
            <div class="col-md-8">
              <div class="panel panel-primary">
                  <div class="panel-heading">Recent Transactions</div>
                  <div class="panel-body recentTransactionContainter">
                    <table class="table table-striped table-hover small">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Description</th>
                          <th class="hidden-xs">Category</th>
                          <th>Amount</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="uxEdit" data-transaction-id="1">
                          <td>09/25/2016</td>
                          <td>Trader Joes</td>
                          <td class="hidden-xs">Grocery</td>
                          <td>$128.86</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="2">
                          <td>09/23/2016</td>
                          <td>Dinner</td>
                          <td class="hidden-xs">Wants</td>
                          <td>$18.61</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit editing" data-transaction-id="3">
                          <td>
                            <input type="text" class="form-control input-sm input-transaction-date-edit input-datepicker uxTransactionDTEdit" value="09/19/2016" />
                          </td>
                          <td>
                            <input type="text" class="form-control input-sm uxDescriptionEdit" value="Cash Withdrawl" />
                          </td>
                          <td class="hidden-xs">
                            <select class="form-control input-sm uxBudgetCategoryEdit">
                              <option value="1">Mustard</option>
                              <option value="2" selected="selected">Ketchup</option>
                              <option value="3">Relish</option>
                              <option value="4">Tent</option>
                              <option value="5">Flashlight</option>
                              <option value="6">Toilet Paper</option>
                            </select>
                          </td>
                          <td>
                            <input type="text" class="form-control input-sm input-amount-edit uxAmountEdit" value="20.00" />
                          </td>
                          <td><a href="javascript:void(0);" class="uxSave"><i class="fa fa-floppy-o" aria-hidden="true"></i></a></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="4">
                          <td>09/18/2016</td>
                          <td>Netflix</td>
                          <td class="hidden-xs">Netflix</td>
                          <td>$9.99</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="5">
                          <td>09/16/2016</td>
                          <td>iTunes</td>
                          <td class="hidden-xs">Wants</td>
                          <td>$10.59</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="6">
                          <td>09/14/2016</td>
                          <td>Vanguard IRA</td>
                          <td class="hidden-xs">Vanguard IRA</td>
                          <td>$40.00</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="7">
                          <td>09/12/2016</td>
                          <td>Lunch</td>
                          <td class="hidden-xs">Eat Out</td>
                          <td>$16.11</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="8">
                          <td>09/07/2016</td>
                          <td>Cat- Feeders Supply</td>
                          <td class="hidden-xs">Needs</td>
                          <td>$22.25</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="9">
                          <td>09/18/2016</td>
                          <td>Netflix</td>
                          <td class="hidden-xs">Netflix</td>
                          <td>$9.99</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="10">
                          <td>09/16/2016</td>
                          <td>iTunes</td>
                          <td class="hidden-xs">Wants</td>
                          <td>$10.59</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="4">
                          <td>09/18/2016</td>
                          <td>Netflix</td>
                          <td class="hidden-xs">Netflix</td>
                          <td>$9.99</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="5">
                          <td>09/16/2016</td>
                          <td>iTunes</td>
                          <td class="hidden-xs">Wants</td>
                          <td>$10.59</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="6">
                          <td>09/14/2016</td>
                          <td>Vanguard IRA</td>
                          <td class="hidden-xs">Vanguard IRA</td>
                          <td>$40.00</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="7">
                          <td>09/12/2016</td>
                          <td>Lunch</td>
                          <td class="hidden-xs">Eat Out</td>
                          <td>$16.11</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="8">
                          <td>09/07/2016</td>
                          <td>Cat- Feeders Supply</td>
                          <td class="hidden-xs">Needs</td>
                          <td>$22.25</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="4">
                          <td>09/18/2016</td>
                          <td>Netflix</td>
                          <td class="hidden-xs">Netflix</td>
                          <td>$9.99</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="5">
                          <td>09/16/2016</td>
                          <td>iTunes</td>
                          <td class="hidden-xs">Wants</td>
                          <td>$10.59</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="6">
                          <td>09/14/2016</td>
                          <td>Vanguard IRA</td>
                          <td class="hidden-xs">Vanguard IRA</td>
                          <td>$40.00</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="7">
                          <td>09/12/2016</td>
                          <td>Lunch</td>
                          <td class="hidden-xs">Eat Out</td>
                          <td>$16.11</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="8">
                          <td>09/07/2016</td>
                          <td>Cat- Feeders Supply</td>
                          <td class="hidden-xs">Needs</td>
                          <td>$22.25</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="9">
                          <td>09/18/2016</td>
                          <td>Netflix</td>
                          <td class="hidden-xs">Netflix</td>
                          <td>$9.99</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="10">
                          <td>09/16/2016</td>
                          <td>iTunes</td>
                          <td class="hidden-xs">Wants</td>
                          <td>$10.59</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="4">
                          <td>09/18/2016</td>
                          <td>Netflix</td>
                          <td class="hidden-xs">Netflix</td>
                          <td>$9.99</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="5">
                          <td>09/16/2016</td>
                          <td>iTunes</td>
                          <td class="hidden-xs">Wants</td>
                          <td>$10.59</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="6">
                          <td>09/14/2016</td>
                          <td>Vanguard IRA</td>
                          <td class="hidden-xs">Vanguard IRA</td>
                          <td>$40.00</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="7">
                          <td>09/12/2016</td>
                          <td>Lunch</td>
                          <td class="hidden-xs">Eat Out</td>
                          <td>$16.11</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="8">
                          <td>09/07/2016</td>
                          <td>Cat- Feeders Supply</td>
                          <td class="hidden-xs">Needs</td>
                          <td>$22.25</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="4">
                          <td>09/18/2016</td>
                          <td>Netflix</td>
                          <td class="hidden-xs">Netflix</td>
                          <td>$9.99</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="5">
                          <td>09/16/2016</td>
                          <td>iTunes</td>
                          <td class="hidden-xs">Wants</td>
                          <td>$10.59</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="6">
                          <td>09/14/2016</td>
                          <td>Vanguard IRA</td>
                          <td class="hidden-xs">Vanguard IRA</td>
                          <td>$40.00</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="7">
                          <td>09/12/2016</td>
                          <td>Lunch</td>
                          <td class="hidden-xs">Eat Out</td>
                          <td>$16.11</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="8">
                          <td>09/07/2016</td>
                          <td>Cat- Feeders Supply</td>
                          <td class="hidden-xs">Needs</td>
                          <td>$22.25</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="9">
                          <td>09/18/2016</td>
                          <td>Netflix</td>
                          <td class="hidden-xs">Netflix</td>
                          <td>$9.99</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="10">
                          <td>09/16/2016</td>
                          <td>iTunes</td>
                          <td class="hidden-xs">Wants</td>
                          <td>$10.59</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="4">
                          <td>09/18/2016</td>
                          <td>Netflix</td>
                          <td class="hidden-xs">Netflix</td>
                          <td>$9.99</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="5">
                          <td>09/16/2016</td>
                          <td>iTunes</td>
                          <td class="hidden-xs">Wants</td>
                          <td>$10.59</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="6">
                          <td>09/14/2016</td>
                          <td>Vanguard IRA</td>
                          <td class="hidden-xs">Vanguard IRA</td>
                          <td>$40.00</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="7">
                          <td>09/12/2016</td>
                          <td>Lunch</td>
                          <td class="hidden-xs">Eat Out</td>
                          <td>$16.11</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="8">
                          <td>09/07/2016</td>
                          <td>Cat- Feeders Supply</td>
                          <td class="hidden-xs">Needs</td>
                          <td>$22.25</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="4">
                          <td>09/18/2016</td>
                          <td>Netflix</td>
                          <td class="hidden-xs">Netflix</td>
                          <td>$9.99</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="5">
                          <td>09/16/2016</td>
                          <td>iTunes</td>
                          <td class="hidden-xs">Wants</td>
                          <td>$10.59</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="6">
                          <td>09/14/2016</td>
                          <td>Vanguard IRA</td>
                          <td class="hidden-xs">Vanguard IRA</td>
                          <td>$40.00</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="7">
                          <td>09/12/2016</td>
                          <td>Lunch</td>
                          <td class="hidden-xs">Eat Out</td>
                          <td>$16.11</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="8">
                          <td>09/07/2016</td>
                          <td>Cat- Feeders Supply</td>
                          <td class="hidden-xs">Needs</td>
                          <td>$22.25</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="9">
                          <td>09/18/2016</td>
                          <td>Netflix</td>
                          <td class="hidden-xs">Netflix</td>
                          <td>$9.99</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="10">
                          <td>09/16/2016</td>
                          <td>iTunes</td>
                          <td class="hidden-xs">Wants</td>
                          <td>$10.59</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="4">
                          <td>09/18/2016</td>
                          <td>Netflix</td>
                          <td class="hidden-xs">Netflix</td>
                          <td>$9.99</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="5">
                          <td>09/16/2016</td>
                          <td>iTunes</td>
                          <td class="hidden-xs">Wants</td>
                          <td>$10.59</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="6">
                          <td>09/14/2016</td>
                          <td>Vanguard IRA</td>
                          <td class="hidden-xs">Vanguard IRA</td>
                          <td>$40.00</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="7">
                          <td>09/12/2016</td>
                          <td>Lunch</td>
                          <td class="hidden-xs">Eat Out</td>
                          <td>$16.11</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="8">
                          <td>09/07/2016</td>
                          <td>Cat- Feeders Supply</td>
                          <td class="hidden-xs">Needs</td>
                          <td>$22.25</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="4">
                          <td>09/18/2016</td>
                          <td>Netflix</td>
                          <td class="hidden-xs">Netflix</td>
                          <td>$9.99</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="5">
                          <td>09/16/2016</td>
                          <td>iTunes</td>
                          <td class="hidden-xs">Wants</td>
                          <td>$10.59</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="6">
                          <td>09/14/2016</td>
                          <td>Vanguard IRA</td>
                          <td class="hidden-xs">Vanguard IRA</td>
                          <td>$40.00</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="7">
                          <td>09/12/2016</td>
                          <td>Lunch</td>
                          <td class="hidden-xs">Eat Out</td>
                          <td>$16.11</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="8">
                          <td>09/07/2016</td>
                          <td>Cat- Feeders Supply</td>
                          <td class="hidden-xs">Needs</td>
                          <td>$22.25</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="9">
                          <td>09/18/2016</td>
                          <td>Netflix</td>
                          <td class="hidden-xs">Netflix</td>
                          <td>$9.99</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="10">
                          <td>09/16/2016</td>
                          <td>iTunes</td>
                          <td class="hidden-xs">Wants</td>
                          <td>$10.59</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="4">
                          <td>09/18/2016</td>
                          <td>Netflix</td>
                          <td class="hidden-xs">Netflix</td>
                          <td>$9.99</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="5">
                          <td>09/16/2016</td>
                          <td>iTunes</td>
                          <td class="hidden-xs">Wants</td>
                          <td>$10.59</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="6">
                          <td>09/14/2016</td>
                          <td>Vanguard IRA</td>
                          <td class="hidden-xs">Vanguard IRA</td>
                          <td>$40.00</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="7">
                          <td>09/12/2016</td>
                          <td>Lunch</td>
                          <td class="hidden-xs">Eat Out</td>
                          <td>$16.11</td>
                          <td></td>
                        </tr>
                        <tr class="uxEdit" data-transaction-id="8">
                          <td>09/07/2016</td>
                          <td>Cat- Feeders Supply</td>
                          <td class="hidden-xs">Needs</td>
                          <td>$22.25</td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>

      <!--**********************************************************Main Content END**********************************************************-->

  </div>

  <?php require_once('include/footer.php'); ?>

  <script type="text/babel" src="../../../component/navigation.js"></script>

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
