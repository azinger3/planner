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

            .input-transaction-date-edit {
                width: 95px;
            }

            .input-amount-edit {
                width: 70px;
            }
        }
        </style>
    </head>
    <body>

        <!--Navigation START-->
        <div id="budgetNavigation"></div>
        <!--Navigation END-->

        <!--Container START-->
        <div class="container">
            <!--**********************************************************Main Content START**********************************************************-->

            <!--Page Header START-->
            <div class="page-header">
                <div class="row">
                </div>
            </div>
            <!--Page Header END-->
            
            <!--Content START-->
            <div class="row">
                <div class="col-md-4">
                    <div class="well">
                        <form>
                            <fieldset>
                                <legend>Add Transaction</legend>
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
                                    <input type="text" id="uxTransactionDT" class="form-control input-datepicker" placeholder="MM/DD/YYYY" />
                                </div>
                                <div class="form-group">
                                    <input type="text" id="uxDescription" class="form-control" placeholder="Description" />
                                </div>
                                <div class="form-group">
                                    <input type="text" id="uxAmount" class="form-control" placeholder="$" />
                                </div>
                                <div class="form-group">
                                    <div id="uxBudgetCategoryOptionAdd">
                                        <select class="form-control placeholder" id="uxBudgetCategory">
                                            <option value="" selected="selected" class="optionHide">Category</option>
                                        </select>
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
                        <div class="panel-heading">Recent Transactions</div>
                        <div class="panel-body">
                            <div id="uxTransactionRecent"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Content END-->

            <!--**********************************************************Main Content END**********************************************************-->
        </div>
        <!--Container END-->

        <!--Templates START-->
        <script id="tmplTransactionRecent" type="text/x-handlebars-template">
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
                    {{#each Transaction}}
                    <tr id="uxTransactionEdit_{{TransactionID}}">
                        <td>{{TransactionDT}}</td>
                        <td>{{Description}}</td>
                        <td class="hidden-xs">{{BudgetCategory}}</td>
                        <td>{{Amount}}</td>
                        <td>
                            <div class="btn-group">
                                <a href="#" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="javascript:TransactionEdit('{{TransactionID}}','{{TransactionDT}}','{{Description}}','{{BudgetCategoryID}}','{{BudgetCategory}}','{{Amount}}');">Edit</a></li>
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
                <input type="text" class="form-control input-sm input-transaction-date-edit input-datepicker" id="uxTransactionDT_{{TransactionID}}" value="{{TransactionDT}}" />
            </td>
            <td>
                <input type="text" class="form-control input-sm" id="uxDescription_{{TransactionID}}" value="{{Description}}" />
            </td>
            <td class="hidden-xs">
                <div id="uxBudgetCategoryOptionEdit_{{TransactionID}}"></div>
            </td>
            <td>
                <input type="text" class="form-control input-sm input-amount-edit" id="uxAmount_{{TransactionID}}" value="{{Amount}}" />
            </td>
            <td>
                <a href="javascript:TransactionSave('{{TransactionID}}');" class="btn btn-info btn-xs">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                </a>
            </td>
        </script>

        <script id="tmplBudgetCategoryOption" type="text/x-handlebars-template">
            {{#each Category}}
                <option value="{{BudgetCategoryID}}">{{BudgetCategory}}</option>
            {{/each}}
        </script>
        <!--Templates END-->

        <!--Footer START-->
        <?php require_once('include/footer.php'); ?>
        <!--Footer END-->

        <!--Javascript START-->
        <script type="text/babel" src="../../../component/budget.navigation.js"></script>

        <script>
        var api = "http://api.jordanandrobert.com/budget/";

        var objTransaction = new Object();
        objTransaction.TransactionID = ""
        objTransaction.TransactionTypeID = "";
        objTransaction.TransactionDT = "";
        objTransaction.Description = "";
        objTransaction.Amount = "";
        objTransaction.BudgetCategoryID = "";
        objTransaction.TransactionNumber = "";
        objTransaction.Note = "";

        var objBudgetCategory = new Object();
        objBudgetCategory.Category = "";

        $(document).ready(function() {
            console.log("Ready!");

            TransactionRecentRender();
            BudgetCategoryOptionAddRender();
            DatePickerSet();

            $("#uxExpense").click();
        });

        function TransactionRecentGet() {
            var result = {};

            $.ajax({
                type: "GET",
                url: api + "transaction/recent",
                cache: false,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                async: false,
                success: function (msg) {
                    result = msg;

                    objTransaction.Transaction = result;
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    if (XMLHttpRequest.readyState < 4) {
                        return true;
                    }
                    else {
                        alert('Error :' + XMLHttpRequest.responseText);
                    }
                }
            });
        }

        function TransactionInsert() {
            $.ajax({
                type: "POST",
                url: api + "transaction",
                cache: false,
                data: JSON.stringify(objTransaction),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                async: false,
                success: function (msg) {
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    if (XMLHttpRequest.readyState < 4) {
                        return true;
                    }
                    else {
                        alert('Error :' + XMLHttpRequest.responseText);
                    }
                }
            });
        }

        function TransactionUpdate() {
            $.ajax({
                type: "PUT",
                url: api + "transaction/" + objTransaction.TransactionID,
                cache: false,
                data: JSON.stringify(objTransaction),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                async: false,
                success: function (msg) {
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    if (XMLHttpRequest.readyState < 4) {
                        return true;
                    }
                    else {
                        alert('Error :' + XMLHttpRequest.responseText);
                    }
                }
            });
        }

        function TransactionDelete() {
            $.ajax({
                type: "DELETE",
                url: api + "transaction/" + objTransaction.TransactionID,
                cache: false,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                async: false,
                success: function (msg) {
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    if (XMLHttpRequest.readyState < 4) {
                        return true;
                    }
                    else {
                        alert('Error :' + XMLHttpRequest.responseText);
                    }
                }
            });
        }

        function BudgetCategoryGet() {
            var result = {};

            $.ajax({
                type: "GET",
                url: api + "category",
                cache: false,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                async: false,
                success: function (msg) {
                    result = msg;

                    objBudgetCategory.Category = result;
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    if (XMLHttpRequest.readyState < 4) {
                        return true;
                    }
                    else {
                        alert('Error :' + XMLHttpRequest.responseText);
                    }
                }
            });
        }

        function TransactionTypeSet() {
            var transactionTypeRadio = $("input[name=uxTransactionType]:checked");

            objTransaction.TransactionTypeID = transactionTypeRadio.data("transaction-type-id");
        }

        function TransactionAdd() {        
            var transactionDT = $("#uxTransactionDT").val().split("/");
            var description = $("#uxDescription").val();
            var amount = $("#uxAmount").val();
            var budgetCategoryID = $("#uxBudgetCategory option:selected").val();
            var transactionNumber = $("#uxTransactionNumber").val();
            var note = $("#uxNote").val();

            objTransaction.TransactionDT = transactionDT[2] + "-" + transactionDT[0] + "-" + transactionDT[1];
            objTransaction.Description = description;
            objTransaction.Amount = amount;
            objTransaction.BudgetCategoryID = budgetCategoryID;
            objTransaction.TransactionNumber = transactionNumber;
            objTransaction.Note = note;

            TransactionInsert();
            TransactionRecentRender();
            TransactionClear();
        }              

        function TransactionEdit(TransactionID, TransactionDT, Description, BudgetCategoryID, BudgetCategory, Amount) {
            objTransaction.TransactionID = TransactionID
            objTransaction.TransactionDT = TransactionDT;
            objTransaction.Description = Description;
            objTransaction.BudgetCategoryID = BudgetCategoryID;
            objTransaction.BudgetCategory = BudgetCategory;
            objTransaction.Amount = Amount;

            var source = $("#tmplTransactionEdit").html();
            var template = Handlebars.compile(source);
            var context = objTransaction;
            var html = template(context);

            $("#uxTransactionEdit_" + objTransaction.TransactionID).html(html);

            BudgetCategoryOptionEditRender(objTransaction.TransactionID, objTransaction.BudgetCategoryID, objTransaction.BudgetCategory);
            DatePickerSet();
        }

        function TransactionSave(TransactionID) {
            var transactionDT = $("#uxTransactionDT_" + TransactionID).val().split("/");
            var description = $("#uxDescription_" + TransactionID).val();
            var amount = $("#uxAmount_" + TransactionID).val();
            var budgetCategoryID = $("#uxBudgetCategory_" + TransactionID + " option:selected").val();

            objTransaction.TransactionDT = transactionDT[2] + "-" + transactionDT[0] + "-" + transactionDT[1];
            objTransaction.Description = description;
            objTransaction.Amount = amount;
            objTransaction.BudgetCategoryID = budgetCategoryID;
            objTransaction.TransactionID = TransactionID

            TransactionUpdate();
            TransactionRecentRender();
        }

        function TransactionRemove(TransactionID) {
            objTransaction.TransactionID = TransactionID

            TransactionDelete();
            TransactionRecentRender();
        }

        function TransactionClear() {
            $("#uxTransactionDT").val("");
            $("#uxDescription").val("");
            $("#uxAmount").val("");
            $("#uxBudgetCategory option[value='']").prop("selected", true);
            $("#uxTransactionNumber").val("");
            $("#uxNote").val("");
        }

        function TransactionRecentRender() {
            TransactionRecentGet();

            var source = $("#tmplTransactionRecent").html();
            var template = Handlebars.compile(source);
            var context = objTransaction;
            var html = template(context);

            $("#uxTransactionRecent").html(html);
        }

        function BudgetCategoryOptionAddRender() {
            BudgetCategoryGet();

            var source = $("#tmplBudgetCategoryOption").html();
            var template = Handlebars.compile(source);
            var context = objBudgetCategory;
            var html = template(context);

            var dropdown = "<select class='form-control placeholder' id='uxBudgetCategory'>" 
                        + "<option value='' selected='selected' class='optionHide'>Category</option>"
                        + html 
                        + "</select>"

            $("#uxBudgetCategoryOptionAdd").html(dropdown);
        }

        function BudgetCategoryOptionEditRender(TransactionID, BudgetCategoryID, BudgetCategory) {
            BudgetCategoryGet();

            var source = $("#tmplBudgetCategoryOption").html();
            var template = Handlebars.compile(source);
            var context = objBudgetCategory;
            var html = template(context);

            var dropdown = "<select class='form-control input-sm' id='uxBudgetCategory_" + TransactionID + "'>" 
                        + "<option value='" + BudgetCategoryID + "' selected='selected' class='optionHide'>" + BudgetCategory + "</option>"
                        + html 
                        + "</select>"

            $("#uxBudgetCategoryOptionEdit_" + TransactionID).html(dropdown);
        }

        function DatePickerSet() {
           $('.input-datepicker').datepicker({
                clearBtn: true,
                todayBtn: true,
                autoclose: true,
                todayHighlight: true,
                orientation: "bottom"
            });
        }
        </script>
        <!--Javascript END-->

    </body>
</html>
