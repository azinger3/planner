var api = "http://api.jordanandrobert.com/budget";

var objBudget = new Object();
objBudget.BudgetCategorySpotlight = "";
objBudget.BudgetFundSpotlight = "";
objBudget.BudgetSummarySpotlight = "";

$(document).ready(function() {
    console.log("Ready!");
    console.log(location.protocol + "//" + location.host);

    BudgetCategorySpotlightGet();
    BudgetFundSpotlightGet();
    BudgetSummarySpotlightGet();
});

function BudgetCategorySpotlightGet() {
    var result = {};

    $.ajax({
    type: "GET",
    url: api + "/category/spotlight",
    cache: false,
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    async: true,
    beforeSend: function() {
        $("#uxBudgetCategorySpotlight").html("<div class='text-center'><i class='fa fa-refresh fa-spin fa-2x fa-fw'></i><span class='loading'>Loading...</span></div>");
    },
    success: function(msg) {
        result = msg;

        objBudget.BudgetMonth = result[0].BudgetMonth;
        objBudget.TotalCategoryActualVsBudget = result[0].TotalCategoryActualVsBudget;
        objBudget.TotalCategoryPercentageSpent = result[0].TotalCategoryPercentageSpent;
        objBudget.TotalCategoryProgressBarStyle = result[0].TotalCategoryProgressBarStyle;
        objBudget.IsTotalCategoryNegativeFlg = result[0].IsTotalCategoryNegativeFlg;
        objBudget.BudgetCategorySpotlight = result;

        BudgetCategorySpotlightRender();
        BudgetMonthPercentageSet();

        $('[data-toggle="tooltip"]').tooltip();
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
        if (XMLHttpRequest.readyState < 4) {
        return true;
        } else {
        alert('Error :' + XMLHttpRequest.responseText);
        }
    }
    });
}

function BudgetFundSpotlightGet() {
    var result = {};

    $.ajax({
    type: "GET",
    url: api + "/fund/spotlight",
    cache: false,
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    async: true,
    beforeSend: function() {
        $("#uxBudgetFundSpotlight").html("<div class='text-center'><i class='fa fa-refresh fa-spin fa-2x fa-fw'></i><span class='loading'>Loading...</span></div>");
    },
    success: function(msg) {
        result = msg;

        objBudget.TotalFundSpentVsReceived = result[0].TotalFundSpentVsReceived;
        objBudget.BudgetFundSpotlight = result;

        BudgetFundSpotlightRender();
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
        if (XMLHttpRequest.readyState < 4) {
        return true;
        } else {
        alert('Error :' + XMLHttpRequest.responseText);
        }
    }
    });
}

function BudgetSummarySpotlightGet() {
    var result = {};

    $.ajax({
    type: "GET",
    url: api + "/summary/spotlight",
    cache: false,
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    async: true,
    beforeSend: function() {
        $("#uxBudgetSummarySpotlight").html("<div class='text-center'><i class='fa fa-refresh fa-spin fa-2x fa-fw'></i><span class='loading'>Loading...</span></div>");
    },
    success: function(msg) {
        result = msg;

        objBudget.BudgetSummarySpotlight = result;

        BudgetSummarySpotlightRender();
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
        if (XMLHttpRequest.readyState < 4) {
        return true;
        } else {
        alert('Error :' + XMLHttpRequest.responseText);
        }
    }
    });
}

function BudgetMonthPercentageSet() {
    var objBudgetMonthPercentage = {};
    objBudgetMonthPercentage.monthNumber = parseInt(Date.today().toString("M")) - 1;
    objBudgetMonthPercentage.yearNumber = parseInt(Date.today().toString("yyyy"));
    objBudgetMonthPercentage.dayNumber = parseInt(Date.today().toString("dd"));
    objBudgetMonthPercentage.daysInMonth = parseInt(Date.getDaysInMonth(objBudgetMonthPercentage.yearNumber, objBudgetMonthPercentage.monthNumber));
    objBudgetMonthPercentage.monthPercentThrough = Math.round(objBudgetMonthPercentage.dayNumber / objBudgetMonthPercentage.daysInMonth * 100);

    $("#uxBudgetMonth").attr("data-toggle", "tooltip").attr("data-placement", "top").attr("data-original-title", objBudgetMonthPercentage.monthPercentThrough + "%");
}

function BudgetCategorySpotlightRender() {
    var source = $("#tmplBudgetCategorySpotlight").html();
    var template = Handlebars.compile(source);
    var context = objBudget;
    var html = template(context);

    $("#uxBudgetCategorySpotlight").html(html);
}

function BudgetFundSpotlightRender() {
    var source = $("#tmplBudgetFundSpotlight").html();
    var template = Handlebars.compile(source);
    var context = objBudget;
    var html = template(context);

    $("#uxBudgetFundSpotlight").html(html);
}

function BudgetSummarySpotlightRender() {
    var source = $("#tmplBudgetSummarySpotlight").html();
    var template = Handlebars.compile(source);
    var context = objBudget;
    var html = template(context);

    $("#uxBudgetSummarySpotlight").html(html);
}