var api = $.apiUrl() + "/budget";

var objTransaction = new Object();
objTransaction.TransactionID = "";
objTransaction.TransactionTypeID = "";
objTransaction.TransactionDT = "";
objTransaction.Description = "";
objTransaction.Amount = "";
objTransaction.BudgetCategoryID = "";
objTransaction.TransactionNumber = "";
objTransaction.Note = "";

var objTransactionSplit = new Object();
objTransactionSplit.Transaction = "";

var objBudgetCategory = new Object();
objBudgetCategory.Category = "";

var objDescription = new Object();
objDescription.Keyword = "";

var objAutoFill = new Object();
objAutoFill.Transaction = "";

$(document).ready(function() {
    console.log("Ready!");

    $("#uxExpense").click(); // Loads Budget Category

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
    $("#uxTransactionDT").val(Date.today().moveToLastDayOfMonth().toString("MM/dd/yyyy"));
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

function TransactionSplitAdd() {
    console.log("TransactionSplitAdd");
}

function TransactionSplitRemove() {
    console.log("TransactionSplitRemove");
}

function TransactionSplitCalculate() {
    console.log("TransactionSplitCalculate");
}

function TransactionSplitDataBind() {
    console.log("TransactionSplitDataBind");
}

function TransactionSplitRender() {
    console.log("TransactionSplitRender");
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

    // $(".clsBudgetCategoryOptionAdd").each(function () {
    //     $(this).html(dropdown);
    // });
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