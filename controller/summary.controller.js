var api = $.apiUrl() + "/budget";
var data = new Object();

var budgetMonth = "";

var objSummary = new Object();
objSummary.TotalIncomeVsExpenseActual = "";
objSummary.TotalIncomeVsExpenseBudget = "";
objSummary.TotalIncomeVsExpenseActualVsBudget = "";
objSummary.IsTotalIncomeVsExpenseActualNegative = "";
objSummary.IsTotalIncomeVsExpenseBudgetNegative = "";
objSummary.IsTotalIncomeVsExpenseActualVsBudgetNegative = "";
objSummary.Category = "";

var objCategory = new Object();
objCategory.BudgetCategoryID = "";
objCategory.BudgetCategory = "";
objCategory.CategoryActual = "";
objCategory.CategoryBudget = "";
objCategory.CategoryActualVsBudget = "";
objCategory.IsCategoryActualVsBudgetNegative = "";
objCategory.TransactionTypeID = "";
objCategory.Transaction = "";

var objTransaction = new Object();
objTransaction.TransactionID = "";
objTransaction.TransactionDT = "";
objTransaction.TransactionTypeID = "";
objTransaction.TransactionType = "";
objTransaction.TransactionNumber = "";
objTransaction.Description = "";
objTransaction.Amount = "";
objTransaction.Note = "";

var objBudget = new Object();
objBudget.Budget = "";

$(document).ready(function() {
    console.log("Ready!");

    if ($.urlParam("BudgetMonth") != undefined) {
        budgetMonth = $.urlParam("BudgetMonth"); 
        data.BudgetMonth = $.urlParam("BudgetMonth"); 

        BudgetSummaryGet();
    }
    else {
        budgetMonth = Date.today().toString("yyyy-MM-01"); 
        data.BudgetMonth = budgetMonth;

        BudgetSummaryGet();
    }   

    BudgetGet();          
});

function BudgetSummaryGet() {
    var result = {};

    $.ajax({
        type: "GET",
        url: api + "/summary",
        cache: false,
        data: data,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        beforeSend: function() {
            $("#uxBudgetSummary").html("<div class='text-center'><i class='fa fa-refresh fa-spin fa-2x fa-fw'></i><span class='loading'>Loading...</span></div>");
        },
        success: function (msg) {
            result = msg;

            BudgetSummaryContextSet(result);
            BudgetSummaryRender();
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

function BudgetGet() {
    var result = {};

    $.ajax({
        type: "GET",
        url: api,
        cache: false,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        success: function (msg) {
            result = msg;

            objBudget.Budget = result;

            BudgetMonthOptionRender();

            $("#uxBudgetMonth option[value='" + budgetMonth + "']").prop("selected", true);

            $("#uxBudgetMonth").change(function() {
                data.BudgetMonth = $("#uxBudgetMonth option:selected").val();

                window.location.href = "summary?BudgetMonth=" + data.BudgetMonth;
            });
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

function BudgetSummaryContextSet(result) {
    objSummary = {};

    var tmpCategory = $.map(result, function (item) {
        return {
            BudgetCategoryID: item.BudgetCategoryID,
            BudgetCategory: item.BudgetCategory,
            CategoryActual: item.CategoryActual,
            CategoryBudget: item.CategoryBudget,
            CategoryActualVsBudget: item.CategoryActualVsBudget,
            IsCategoryActualVsBudgetNegative: item.IsCategoryActualVsBudgetNegative,
            TransactionTypeID: item.TransactionTypeID,
            IsExpenseFlg: item.IsExpenseFlg
        };
    });

    var uniqCategory = _.uniqWith(tmpCategory, _.isEqual);

    var arrCategory = [];

    $.map(uniqCategory, function (category) {
        var arrTransaction = [];

        $.map(result, function (transaction) {
            if (category.BudgetCategoryID == transaction.BudgetCategoryID) {
                objTransaction = {};
                objTransaction.TransactionID = transaction.TransactionID;
                objTransaction.TransactionDT = transaction.TransactionDT;
                objTransaction.TransactionTypeID = transaction.TransactionTypeID;
                objTransaction.TransactionType = transaction.TransactionType;
                objTransaction.TransactionNumber = transaction.TransactionNumber;
                objTransaction.Description = transaction.Description;
                objTransaction.Amount = transaction.Amount;
                objTransaction.Note = transaction.Note;
                objTransaction.IsExpenseFlg = transaction.IsExpenseFlg;

                arrTransaction.push(objTransaction);
            }
        });

        objCategory = {};
        objCategory.BudgetCategoryID = category.BudgetCategoryID;
        objCategory.BudgetCategory = category.BudgetCategory;
        objCategory.CategoryActual = category.CategoryActual;
        objCategory.CategoryBudget = category.CategoryBudget;
        objCategory.CategoryActualVsBudget = category.CategoryActualVsBudget;
        objCategory.IsCategoryActualVsBudgetNegative = category.IsCategoryActualVsBudgetNegative;
        objCategory.TransactionTypeID = category.TransactionTypeID;
        objCategory.IsExpenseFlg = category.IsExpenseFlg;
        objCategory.Transaction = arrTransaction;
        
        arrCategory.push(objCategory);
    });

    objSummary.BudgetMonth = result[0].BudgetMonth;
    objSummary.TotalIncomeVsExpenseActual = result[0].TotalIncomeVsExpenseActual;
    objSummary.TotalIncomeVsExpenseBudget = result[0].TotalIncomeVsExpenseBudget;
    objSummary.TotalIncomeVsExpenseActualVsBudget = result[0].TotalIncomeVsExpenseActualVsBudget;
    objSummary.IsTotalIncomeVsExpenseActualNegative = result[0].IsTotalIncomeVsExpenseActualNegative;
    objSummary.IsTotalIncomeVsExpenseBudgetNegative = result[0].IsTotalIncomeVsExpenseBudgetNegative;
    objSummary.IsTotalIncomeVsExpenseActualVsBudgetNegative = result[0].IsTotalIncomeVsExpenseActualVsBudgetNegative;
    objSummary.Category = arrCategory;
}

function BudgetSummaryRender() {
    var source = $("#tmplBudgetSummary").html();
    var template = Handlebars.compile(source);

    var context = objSummary;
    var html = template(context);

    $("#uxBudgetSummary").html(html);
}

function BudgetMonthOptionRender() {
    var source = $("#tmplBudgetMonthOption").html();
    var template = Handlebars.compile(source);

    var context = objBudget;
    var html = template(context);

    var dropdown = "<select class='form-control input-sm' id='uxBudgetMonth'>" 
                + html 
                + "</select>";

    $("#uxBudgetMonthOption").html(dropdown);
}

function GoToSection(ElementID) {
    var uxElement = document.getElementById(ElementID);
    var topPosition = uxElement.offsetTop;

    $("html,body").animate({
        scrollTop: topPosition + 835
    }, 400);
}