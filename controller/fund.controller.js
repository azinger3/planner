var api = "http://api.jordanandrobert.com/budget/fund";
var data = new Object();

var fundID = "";

var objFund = new Object();
objFund.FundID = "";
objFund.FundName = "";
objFund.FundReceived = "";
objFund.FundSpent = "";
objFund.FundSpentVsReceived = "";
objFund.StartingBalance = "";
objFund.Transaction = "";

var objTransaction = new Object();
objTransaction.TransactionID = "";
objTransaction.TransactionDT = "";
objTransaction.TransactionTypeID = "";
objTransaction.TransactionType = "";
objTransaction.TransactionNumber = "";
objTransaction.Description = "";
objTransaction.Amount = "";
objTransaction.Note = "";

$(document).ready(function() {
    console.log("Ready!");
    
    if ($.urlParam("FundID") != undefined) {
        fundID = $.urlParam("FundID"); 
        data.FundID = $.urlParam("FundID"); 

        BudgetFundSummaryGet();
    }
    else {
        fundID = 1;
        data.FundID = fundID;

        BudgetFundSummaryGet();
    }   

    BudgetFundGet();  
});

function BudgetFundSummaryGet() {
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
            $("#uxBudgetFundSummary").html("<div class='text-center'><i class='fa fa-refresh fa-spin fa-2x fa-fw'></i><span class='loading'>Loading...</span></div>");
        },
        success: function (msg) {
            result = msg;

            BudgetFundSummaryContextSet(result);
            BudgetFundSummaryRender();
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

function BudgetFundGet() {
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
            
            objFund.Fund = result;

            BudgetFundOptionRender();

            $("#uxFund option[value='" + fundID + "']").prop("selected", true);

            $("#uxFund").change(function() {
                data.FundID = $("#uxFund option:selected").val();

                window.location.href = "fund?FundID=" + data.FundID;
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

function BudgetFundSummaryContextSet(result) {
    objFund = {};

    objFund.FundID = result[0].FundID;
    objFund.FundName = result[0].FundName;
    objFund.FundReceived = result[0].FundReceived;
    objFund.FundSpent = result[0].FundSpent;
    objFund.FundSpentVsReceived = result[0].FundSpentVsReceived;
    objFund.StartingBalance = result[0].StartingBalance;
    objFund.Transaction = result;
}

function BudgetFundSummaryRender() {
    var source = $("#tmplBudgetFundSummary").html();
    var template = Handlebars.compile(source);

    var context = objFund;
    var html = template(context);

    $("#uxBudgetFundSummary").html(html);
}

function BudgetFundOptionRender() {
    var source = $("#tmplBudgetFundOption").html();
    var template = Handlebars.compile(source);

    var context = objFund;
    var html = template(context);

    var dropdown = "<select class='form-control input-sm' id='uxFund'>" 
                + html 
                + "</select>";

    $("#uxBudgetFundOption").html(dropdown);
}