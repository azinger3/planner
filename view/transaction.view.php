<!DOCTYPE html>
<html lang="en">
    <head>

        <?php
            $pageTitle = 'Transactions';

            require_once('include/header.php');

            require_once('include/icon.budget.php');
        ?>

        <style>
            .optionHide {
                display: none;
            }

            .input-transaction-date-edit {
                width: 95px;
            }

            .input-transaction-number-edit {
                width: 95px;
            }

            .input-amount-edit {
                width: 70px;
            }

            .btn-save {
                width: 80px;
            }

            .section-default {
                padding: 1px 20px 10px 20px;
            }

            .amount-red {
                color: red;
            }

            .input-filter {
                height: 25px !important;
            }

            .input-group-addon.input-filter {
                font-size: 10px !important;
            }

            .transaction-date {
                padding-right: 5px;
            }

            @media (max-width: 1337px){
                .transaction-date-input {
                    font-size: 11px;
                }
            }

            .amount {
                padding-left: 5px;
            }

            .transaction-recent-heading {
                font-size: 16px;
            }

            .showMore {
                color: #2c3e50;
                font-size: 24px;
            }

            a.showMore:hover, a.showMore:focus {
                color: #2c3e50 !important;
                text-decoration: none !important;
            }

            .moreOption {
                font-size: 12px;
            }

            .amount-fund {
                font-size: 12px;
            }

            .quickLink {
                color: #ffffff;
                font-size: 16px;
                margin-left: 20px;
            }
        </style>
    </head>
    <body>
        <?php require_once('include/navigation.budget.php'); ?>

        <section class="section-default">
            <div class="page-header">
                <div class="row">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="well">
                        <form>
                            <fieldset>
                                <legend>Add Transaction</legend>
                                <div id="HardErrorMessage"></div>
                                <div class="form-group">
                                    <div class="btn-group btn-group-justified btn-group-sm" data-toggle="buttons">
                                        <label class="btn btn-info">
                                            <input type="radio" name="uxTransactionType" id="uxExpense" data-transaction-type-id="2" onchange="TransactionTypeSet()" />
                                            Expense
                                        </label>
                                        <label class="btn btn-info">
                                            <input type="radio" name="uxTransactionType" id="uxIncome" data-transaction-type-id="1" onchange="TransactionTypeSet()" />
                                            Income
                                        </label>
                                    </div>  
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 col-xs-5 transaction-date">
                                            <input type="text" id="uxTransactionDT" class="form-control input-datepicker text-center transaction-date-input" readonly="true" />
                                        </div>
                                        <div class="col-md-8 col-xs-7 amount">
                                            <input type="number" id="uxAmount" class="form-control text-center" placeholder="Amount $" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="uxDescription" class="form-control" placeholder="Description" />
                                </div>
                                <div id="uxTransactionSplit">
                                    <div class="form-group">
                                        <div id="uxBudgetCategoryOptionAdd">
                                            <select class="form-control placeholder" id="uxBudgetCategory">
                                                <option value="" selected="selected" class="optionHide">Select a Category...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-10 col-xs-8 transaction-date">
                                                <div id="uxBudgetCategoryOptionAdd">
                                                    <select class="form-control placeholder input-sm" id="uxBudgetCategory">
                                                        <option value="" selected="selected" class="optionHide">Select a Category...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-xs-4 amount">
                                                <input type="number" id="uxAmount" class="form-control input-sm" placeholder="Amount $" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-10 col-xs-8 transaction-date">
                                                <div id="uxBudgetCategoryOptionAdd">
                                                    <select class="form-control placeholder input-sm" id="uxBudgetCategory">
                                                        <option value="" selected="selected" class="optionHide">Select a Category...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-xs-4 amount">
                                                <input type="number" id="uxAmount" class="form-control input-sm" placeholder="Amount $" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-10 col-xs-8 transaction-date">
                                                <div id="uxBudgetCategoryOptionAdd">
                                                    <select class="form-control placeholder input-sm" id="uxBudgetCategory">
                                                        <option value="" selected="selected" class="optionHide">Select a Category...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-xs-4 amount">
                                                <input type="number" id="uxAmount" class="form-control input-sm" placeholder="Amount $" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4 hidden-xs">
                                            </div>
                                            <div class="col-md-4 col-xs-6">
                                                <p class="control-label text-center">Add a Split <i class="fa fa-plus" aria-hidden="true"></i></p>
                                            </div>
                                            <div class="col-md-4 col-xs-6">
                                                <p class="control-label text-right small">Remaining: $100</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="uxTransactionNumber" class="form-control" placeholder="Transaction #" />
                                </div>
                                <div class="form-group">
                                    <input type="text" id="uxNote" class="form-control" placeholder="Note" />
                                </div>
                                <div class="form-group pull-right">
                                    <button type="button" class="btn btn-default" id="uxClear" onclick="TransactionClear()">Clear</button>
                                    <button type="button" class="btn btn-info" id="uxAdd" onclick="TransactionAdd()">Add</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="transaction-recent-heading">
                                        Recent Transactions
                                        <div class="hidden-md hidden-lg pull-right">
                                            <a href="/budget/summary" title="Summary" class="quickLink"><i class="fa fa-calendar"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 hidden-xs hidden-sm">
                                    <div class="input-group">
                                        <input type="search" class="form-control input-sm input-filter" id="TransactionRecentFilter">
                                        <span class="input-group-addon input-sm input-filter">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="uxTransactionRecent">
                                <div class='text-center'>
                                    <i class='fa fa-refresh fa-spin fa-2x fa-fw'></i>
                                    <span class='loading'>Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script id="tmplTransactionRecent" type="text/x-handlebars-template">
            <div id="HardErrorMessageEdit"></div>
            <table class="table table-striped table-hover table-condensed small" id="TransactionRecentTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th class="custom-hidden-xs">Category</th>
                        <th class="hidden-xs">#</th>
                        <th class="hidden-xs">Note</th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    {{#each Transaction}}
                    <tr id="uxTransactionEdit_{{TransactionID}}">
                        <td>{{TransactionDT}}</td>
                        <td>{{Description}}</td>
                        <td class="custom-hidden-xs">{{BudgetCategory}}</td>
                        <td class="hidden-xs">{{TransactionNumber}}</td>
                        <td class="hidden-xs">{{Note}}</td>
                        {{#if IsExpenseFlg}}
                        <td class="amount-red" title="Expense">${{NumberCommaFormat Amount}}</td>
                        {{else if IsSavedFlg}}
                        <td><span class="label label-success amount-fund" title="Saved">${{NumberCommaFormat Amount}}</span></td>
                        {{else if IsSpentFlg}}
                        <td><span class="label label-danger amount-fund" title="Spent">${{NumberCommaFormat Amount}}</span></td>
                        {{else}}
                        <td title="Income">${{NumberCommaFormat Amount}}</td>
                        {{/if}}
                        <td>
                            <div class="btn-group">
                                <a href="#" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="javascript:TransactionEdit('{{TransactionID}}','{{TransactionDT}}','{{Description}}','{{BudgetCategoryID}}','{{BudgetCategory}}','{{Amount}}','{{TransactionNumber}}','{{Note}}');">Edit</a></li>
                                    <li><a href="javascript:TransactionRemove('{{TransactionID}}');">Remove</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    {{/each}}
                </tbody>
            </table>
        </script>

        <script id="tmplTransactionEdit" type="text/x-handlebars-template">
            <td>
                <input type="text" class="form-control input-sm input-transaction-date-edit input-datepicker" readonly="true" id="uxTransactionDT_{{TransactionID}}" value="{{TransactionDT}}" />
            </td>
            <td>
                <input type="text" class="form-control input-sm" id="uxDescription_{{TransactionID}}" value="{{Description}}" />
            </td>
            <td class="custom-hidden-xs">
                <div id="uxBudgetCategoryOptionEdit_{{TransactionID}}"></div>
            </td>
            <td class="hidden-xs">
                <input type="text" class="form-control input-sm input-transaction-number-edit" id="uxTransactionNumber_{{TransactionID}}" value="{{TransactionNumber}}" />
            </td>
            <td class="hidden-xs">
                <input type="text" class="form-control input-sm" id="uxNote_{{TransactionID}}" value="{{Note}}" />
            </td>
            <td>
                <input type="text" class="form-control input-sm input-amount-edit" id="uxAmount_{{TransactionID}}" value="{{Amount}}" />
            </td>
            <td class="btn-save">
                <a href="javascript:TransactionSave('{{TransactionID}}');" class="btn btn-info btn-xs">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                </a>
                &nbsp;&nbsp;
                <a href="javascript:TransactionRecentGet();" class="btn btn-danger btn-xs">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </td>
        </script>

        <script id="tmplBudgetCategoryOption" type="text/x-handlebars-template">
            {{#each Category}}
                <option value="{{BudgetCategoryID}}">{{BudgetCategory}}</option>
            {{/each}}
        </script>

        <?php require_once('include/footer.php'); ?>

        <script type="text/javascript" src="../../../controller/transaction.controller.js"></script>
    </body>
</html>
