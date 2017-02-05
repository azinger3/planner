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

            .autocomplete-suggestions { 
                border: 1px solid #999; 
                background: #FFF; 
                overflow: auto; 
            }

            .autocomplete-suggestion { 
                padding: 2px 5px; 
                white-space: nowrap; 
                overflow: hidden; 
            }

            .autocomplete-selected { 
                background: #F0F0F0; 
            }
            .autocomplete-suggestions strong { 
                font-weight: normal; 
                color: #3399FF; 
            }

            .autocomplete-group { 
                padding: 2px 5px; 
            }

            .autocomplete-group strong { 
                display: block; 
                border-bottom: 1px solid #000; 
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
                font-size: 18px;
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

        <!--Navigation START-->
        <?php require_once('include/navigation.budget.php'); ?>
        <!--Navigation END-->

        <!--Container START-->
        <section class="section-default">
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
                                    <input type="text" id="uxTransactionDT" class="form-control input-datepicker" readonly="true" />
                                </div>
                                <div class="form-group">
                                    <input type="text" id="uxDescription" class="form-control" placeholder="Description" />
                                </div>
                                <div class="form-group">
                                    <input type="number" id="uxAmount" class="form-control" placeholder="Amount $" pattern="\d*" />
                                </div>
                                <div class="form-group">
                                    <div id="uxBudgetCategoryOptionAdd">
                                        <select class="form-control placeholder" id="uxBudgetCategory">
                                            <option value="" selected="selected" class="optionHide">Select a Category...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <a href="javascript:void(0);" title="Show More" class="showMore" data-toggle="collapse" data-target="#MoreInfo">
                                        <span class="moreOption">
                                            <i class="fa fa-plus"></i>
                                            More Options
                                        </span>
                                    </a>
                                </div>
                                <div id="MoreInfo" class="collapse">
                                    <div class="form-group">
                                        <input type="text" id="uxTransactionNumber" class="form-control" placeholder="Transaction #" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="uxNote" class="form-control" placeholder="Note" />
                                    </div>
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
            <!--Content END-->

            <!--**********************************************************Main Content END**********************************************************-->
        </section>
        <!--Container END-->

        <!--Templates START-->
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
                <input type="text" class="form-control input-sm input-transaction-date-edit input-datepicker" id="uxTransactionDT_{{TransactionID}}" value="{{TransactionDT}}" />
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
        <!--Templates END-->

        <!--Footer START-->
        <?php require_once('include/footer.php'); ?>
        <!--Footer END-->

        <!--Javascript START-->
        <script>
            var api = "http://api.jordanandrobert.com/budget";

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

            var objDescription = new Object();
            objDescription.Keyword = "";

            var objAutoFill = new Object();
            objAutoFill.Transaction = "";

            $(document).ready(function() {
                console.log("Ready!");

                $("#uxExpense").click();

                $("#uxTransactionDT").val(Date.today().moveToLastDayOfMonth().toString("MM/dd/yyyy"));

                $('#uxDescription').autocomplete({
                    minChars: 1,
                    noCache: true,
                    lookup: function (query, done) {
                        objDescription.Keyword = query;

                        var result = {};

                        $.ajax({
                            type: "GET",
                            url: api + "/transaction/description",
                            cache: false,
                            data: objDescription,
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                            async: true,
                            success: function (msg) {
                                var Transaction = $.map(msg, function (item) {
                                    return { TransactionID: item.TransactionID,
                                            Amount: item.Amount,
                                            BudgetCategoryID: item.BudgetCategoryID };
                                });

                                objAutoFill.Transaction = Transaction;
                                
                                var suggestions = $.map(msg, function (item) {
                                    return { value: item.Description, data: item.TransactionID };
                                });

                                result.suggestions = suggestions;

                                done(result);
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
                    },
                    onSelect: function (suggestion) {
                        $.map(objAutoFill.Transaction, function (transaction) {
                            if (transaction.TransactionID == suggestion.data) {   
                                if ($("#uxAmount").val().length == 0) {
                                    $("#uxAmount").val(transaction.Amount);
                                }                    
                                
                                $("#uxBudgetCategory option[value='" + transaction.BudgetCategoryID + "']").prop("selected", true);
                            }
                        });
                    }
                });

                BudgetCategoryGet(1);
                DatePickerSet();
                TransactionRecentGet();
            });

            function TransactionRecentGet() {
                var result = {};

                $.ajax({
                    type: "GET",
                    url: api + "/transaction/recent",
                    cache: false,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        result = msg;

                        objTransaction.Transaction = result;

                        TransactionRecentRender();
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
                    url: api + "/transaction",
                    cache: false,
                    data: JSON.stringify(objTransaction),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        TransactionRecentGet();
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
                    url: api + "/transaction/" + objTransaction.TransactionID,
                    cache: false,
                    data: JSON.stringify(objTransaction),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        TransactionRecentGet();
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
                    url: api + "/transaction/" + objTransaction.TransactionID,
                    cache: false,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        TransactionRecentGet();
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

            function BudgetCategoryGet(renderType) {
                var result = {};

                $.ajax({
                    type: "GET",
                    url: api + "/category",
                    cache: false,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    async: true,
                    success: function (msg) {
                        result = msg;

                        objBudgetCategory.Category = result;
                        
                        if (renderType == "1") {
                            BudgetCategoryOptionAddRender();
                        }
                        else if (renderType == "2") {
                            BudgetCategoryOptionEditRender(objTransaction.TransactionID, objTransaction.BudgetCategoryID, objTransaction.BudgetCategory);
                        }
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

                if(objTransaction.TransactionTypeID == "1") {
                    var dropdown = "<select class='form-control placeholder' id='uxBudgetCategory'>" 
                        + "<option value='29' selected='selected'>Income</option>" 
                        + "</select>"

                    $("#uxBudgetCategoryOptionAdd").html(dropdown);
                }
                else {
                    BudgetCategoryGet(1);
                }
            }

            function TransactionClear() {
                $("#uxDescription").val("");
                $("#uxAmount").val("");
                $("#uxBudgetCategory option[value='']").prop("selected", true);
                $("#uxTransactionNumber").val("");
                $("#uxNote").val("");
                $("#HardErrorMessage").html("");
            }

            function TransactionAdd() {    
                if(ValidateAdd()) {
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
                    TransactionClear();
                }    
            }              

            function TransactionEdit(TransactionID, TransactionDT, Description, BudgetCategoryID, BudgetCategory, Amount, TransactionNumber, Note) {
                objTransaction.TransactionID = TransactionID
                objTransaction.TransactionDT = TransactionDT;
                objTransaction.Description = Description;
                objTransaction.BudgetCategoryID = BudgetCategoryID;
                objTransaction.BudgetCategory = BudgetCategory;
                objTransaction.Amount = Amount;
                objTransaction.TransactionNumber = TransactionNumber;
                objTransaction.Note = Note;

                var source = $("#tmplTransactionEdit").html();
                var template = Handlebars.compile(source);
                var context = objTransaction;
                var html = template(context);

                $("#uxTransactionEdit_" + objTransaction.TransactionID).html(html);

                BudgetCategoryGet(2);
                DatePickerSet();
            }

            function TransactionRemove(TransactionID) {
                if(ConfirmAction()) {
                    objTransaction.TransactionID = TransactionID

                    TransactionDelete();
                }
            }

            function TransactionSave(TransactionID) {
                if(ValidateEdit(TransactionID)) {
                    var transactionDT = $("#uxTransactionDT_" + TransactionID).val().split("/");
                    var description = $("#uxDescription_" + TransactionID).val();
                    var amount = $("#uxAmount_" + TransactionID).val();
                    var budgetCategoryID = $("#uxBudgetCategory_" + TransactionID + " option:selected").val();
                    var transactionNumber = $("#uxTransactionNumber_" + TransactionID).val();
                    var note = $("#uxNote_" + TransactionID).val();

                    objTransaction.TransactionDT = transactionDT[2] + "-" + transactionDT[0] + "-" + transactionDT[1];
                    objTransaction.Description = description;
                    objTransaction.Amount = amount;
                    objTransaction.BudgetCategoryID = budgetCategoryID;
                    objTransaction.TransactionNumber = transactionNumber;
                    objTransaction.Note = note;
                    objTransaction.TransactionID = TransactionID

                    TransactionUpdate();  
                }
            }

            function TransactionRecentRender() {
                var source = $("#tmplTransactionRecent").html();
                var template = Handlebars.compile(source);
                var context = objTransaction;
                var html = template(context);

                $("#uxTransactionRecent").html(html);

                $.tablefilter({
                    inputElement: "#TransactionRecentFilter",
                    tableElement: "#TransactionRecentTable"
                });
            }

            function BudgetCategoryOptionAddRender() {
                var source = $("#tmplBudgetCategoryOption").html();
                var template = Handlebars.compile(source);
                var context = objBudgetCategory;
                var html = template(context);

                var dropdown = "<select class='form-control placeholder' id='uxBudgetCategory'>" 
                            + "<option value='' selected='selected' class='optionHide'>Select a Category...</option>"
                            + html 
                            + "</select>";

                $("#uxBudgetCategoryOptionAdd").html(dropdown);
            }

            function BudgetCategoryOptionEditRender(TransactionID, BudgetCategoryID, BudgetCategory) {
                var source = $("#tmplBudgetCategoryOption").html();
                var template = Handlebars.compile(source);
                var context = objBudgetCategory;
                var html = template(context);

                var dropdown = "<select class='form-control input-sm' id='uxBudgetCategory_" + TransactionID + "'>" 
                            + "<option value='" + BudgetCategoryID + "' selected='selected' class='optionHide'>" + BudgetCategory + "</option>"
                            + html 
                            + "</select>";

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

            function ConfirmAction() {
                if (confirm("Are you sure?")) {
                    return true;
                }
                else {
                    return false;
                }
            }

            function ValidateAdd() {
                var error = "";
                var numRegEx = /^-{0,1}\d*\.{0,1}\d+$/;

                if ($("#uxTransactionDT").val().length == 0) { error += "<li>Date is required.</li>"; }
                if ($("#uxDescription").val().length == 0) { error += "<li>Description is required.</li>"; }
                if ($("#uxAmount").val().length == 0) { error += "<li>Amount is required.</li>"; }
                if ($("#uxAmount").val().length > 0) { if (!numRegEx.test($("#uxAmount").val())) { error += "<li>Amount must be numeric.</li>"; } }
                if ($("#uxBudgetCategory option:selected").val().length == 0) { error += "<li>Category is required.</li>"; }

                if (error.length > 0) {
                    error = "<div class=\"alert alert-danger\" role=\"alert\"><ul>" + error + "</ul></div>";
                    
                    $("#HardErrorMessage").html(error);
                    
                    return false;
                }
                else {
                    return true;
                }
            }

            function ValidateEdit(TransactionID) {
                var error = "";
                var numRegEx = /^-{0,1}\d*\.{0,1}\d+$/;

                if ($("#uxTransactionDT_" + TransactionID).val().length == 0) { error += "<li>Date is required.</li>"; }
                if ($("#uxDescription_" + TransactionID).val().length == 0) { error += "<li>Description is required.</li>"; }
                if ($("#uxAmount_" + TransactionID).val().length == 0) { error += "<li>Amount is required.</li>"; }
                if ($("#uxAmount_" + TransactionID).val().length > 0) { if (!numRegEx.test($("#uxAmount_" + TransactionID).val())) { error += "<li>Amount must be numeric.</li>"; } }
                if ($("#uxBudgetCategory_" + TransactionID + " option:selected").val().length == 0) { error += "<li>Category is required.</li>"; }

                if (error.length > 0) {
                    error = "<div class=\"alert alert-danger\" role=\"alert\"><ul>" + error + "</ul></div>";
                    
                    $("#HardErrorMessageEdit").html(error);
                    
                    return false;
                }
                else {
                    return true;
                }
            }
        </script>
        <!--Javascript END-->

    </body>
</html>
