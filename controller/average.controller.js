var api = $.apiUrl() + "/budget";
var data = new Object();

var budgetYear = "";
var startDT = "";
var endDT = "";

var objAverage = new Object();
objAverage.TotalIncomeVsExpenseActual = "";
objAverage.TotalIncomeVsExpenseAverage = "";
objAverage.IsTotalIncomeVsExpenseActualNegative = "";
objAverage.IsTotalIncomeVsExpenseAverageNegative = "";
objAverage.Category = "";

var objCategory = new Object();
objCategory.BudgetCategoryID = "";
objCategory.BudgetCategory = "";
objCategory.CategoryActual = "";
objCategory.CategoryAverage = "";
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

var objBudgetYear = new Object();
objBudgetYear.BudgetYear = "";

$(document).ready(function() {
    console.log("Ready!");

    if ($.urlParam("StartDT") != undefined && $.urlParam("EndDT") != undefined) {
        startDT = $.urlParam("StartDT"); 
        endDT = $.urlParam("EndDT"); 

        budgetYear = startDT + "|" + endDT;

        data.StartDT = $.urlParam("StartDT"); 
        data.EndDT = $.urlParam("EndDT"); 

        BudgetAverageGet();
    }
    else {
        if (Date.today().toString("M") == "4") {
            startDT = Date.today().toString("yyyy-MM-01");
        }
        else {
            startDT = Date.today().moveToMonth(3, -1).toString("yyyy-MM-01"); 
        }
        
        endDT = Date.today().addMonths(1).toString("yyyy-MM-01"); 

        budgetYear = startDT + "|" + endDT;

        data.StartDT = startDT;
        data.EndDT = endDT;

        BudgetAverageGet();
    }   

    BudgetYearGet();          
});

function BudgetAverageGet() {
    var result = {};

    $.ajax({
        type: "GET",
        url: api + "/average",
        cache: false,
        data: data,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        beforeSend: function() {
            $("#uxBudgetAverage").html("<div class='text-center'><i class='fa fa-refresh fa-spin fa-2x fa-fw'></i><span class='loading'>Loading...</span></div>");
        },
        success: function (msg) {
            result = msg;

            BudgetAverageContextSet(result);
            BudgetAverageRender();
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

function BudgetYearGet() {
    var result = {};

    $.ajax({
        type: "GET",
        url: api + "/year",
        cache: false,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        success: function (msg) {
            result = msg;

            objBudgetYear.BudgetYear = result;

            BudgetYearOptionRender();

            $("#uxBudgetYear option[value='" + budgetYear + "']").prop("selected", true);

            $("#uxBudgetYear").change(function() {
                budgetYear = $("#uxBudgetYear option:selected").val();
                
                var res = budgetYear.split("|");

                data.StartDT = res[0];
                data.EndDT = res[1];

                window.location.href = "average?StartDT=" + data.StartDT + "&EndDT=" + data.EndDT;
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

function BudgetAverageContextSet(result) {
    objAverage = {};

    var tmpCategory = $.map(result, function (item) {
        return {
            BudgetCategoryID: item.BudgetCategoryID,
            BudgetCategory: item.BudgetCategory,
            CategoryActual: item.CategoryActual,
            CategoryAverage: item.CategoryAverage,
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
        objCategory.CategoryAverage = category.CategoryAverage;
        objCategory.TransactionTypeID = category.TransactionTypeID;
        objCategory.IsExpenseFlg = category.IsExpenseFlg;
        objCategory.Transaction = arrTransaction;
        
        arrCategory.push(objCategory);
    });

    objAverage.TotalIncomeVsExpenseActual = result[0].TotalIncomeVsExpenseActual;
    objAverage.TotalIncomeVsExpenseAverage = result[0].TotalIncomeVsExpenseAverage;
    objAverage.IsTotalIncomeVsExpenseActualNegative = result[0].IsTotalIncomeVsExpenseActualNegative;
    objAverage.IsTotalIncomeVsExpenseAverageNegative = result[0].IsTotalIncomeVsExpenseAverageNegative;
    objAverage.Category = arrCategory;
}

function BudgetAverageRender() {
    var source = $("#tmplBudgetAverage").html();
    var template = Handlebars.compile(source);

    var context = objAverage;
    var html = template(context);

    $("#uxBudgetAverage").html(html);
}

function BudgetYearOptionRender() {
    var source = $("#tmplBudgetYearOption").html();
    var template = Handlebars.compile(source);

    var context = objBudgetYear;
    var html = template(context);

    var dropdown = "<select class='form-control input-sm' id='uxBudgetYear'>" 
                + html 
                + "</select>";

    $("#uxBudgetYearOption").html(dropdown);
}

function GoToSection(ElementID) {
    var uxElement = document.getElementById(ElementID);
    var topPosition = uxElement.offsetTop;

    $("html,body").animate({
        scrollTop: topPosition + 1055
    }, 400);
}