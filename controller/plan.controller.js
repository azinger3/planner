var api = "http://api.jordanandrobert.com/budget";
var data = new Object();

var budgetMonth = "";

var objBudgetMonth = new Object();
objBudgetMonth.Month = "";
objBudgetMonth.MonthCurrent = "";
objBudgetMonth.MonthCurrentDT = "";
objBudgetMonth.MonthPreviousDT = "";
objBudgetMonth.MonthPrevious = "";
objBudgetMonth.MonthNextDT = "";
objBudgetMonth.MonthNext = "";          

var objBudgetIncome = new Object();            
objBudgetIncome.TotalIncomeMonthly = "";
objBudgetIncome.TotalIncomeBiWeekly = "";
objBudgetIncome.TotalIncomeWeekly = "";
objBudgetIncome.TotalIncomeBiYearly = "";
objBudgetIncome.TotalIncomeYearly = "";
objBudgetIncome.TotalIncomeYearlyGross = "";
objBudgetIncome.Income = "";

var objBudgetExpense = new Object();
objBudgetExpense.BudgetItemID = "";
objBudgetExpense.BudgetNumber = "";
objBudgetExpense.BudgetGroup = "";
objBudgetExpense.BudgetGroupID = "";
objBudgetExpense.BudgetCategory = "";
objBudgetExpense.BudgetCategoryID = "";
objBudgetExpense.Amount = "";
objBudgetExpense.Description = "";
objBudgetExpense.Note = "";
objBudgetExpense.HasSpotlight = "";
objBudgetExpense.IsEssential = "";
objBudgetExpense.HasFundFlg = "";
objBudgetExpense.FundName = "";
objBudgetExpense.FundID = "";
objBudgetExpense.StartingBalance = "";
objBudgetExpense.Expense = "";

var objBudgetGroup = new Object();
objBudgetGroup.BudgetGroupID = "";
objBudgetGroup.BudgetGroup = "";
objBudgetGroup.BudgetItem = "";

var objBudgetItem = new Object();
objBudgetItem.BudgetItemID = "";
objBudgetItem.BudgetNumber = "";
objBudgetItem.BudgetCategoryID = "";
objBudgetItem.BudgetCategory = "";
objBudgetItem.AmountMonthly = "";
objBudgetItem.AmountBiWeekly = "";
objBudgetItem.AmountWeekly = "";
objBudgetItem.AmountBiYearly = "";
objBudgetItem.AmountYearly = "";
objBudgetItem.TransactionAverage = "";
objBudgetItem.Percentage = "";
objBudgetItem.RANK = "";
objBudgetItem.Description = "";
objBudgetItem.Note = "";

var objBudgetMonthSummary = new Object();
objBudgetMonthSummary.TotalIncomeMonthly = "";
objBudgetMonthSummary.TotalExpenseMonthly = "";
objBudgetMonthSummary.BalanceMonthly = "";
objBudgetMonthSummary.IsBalanceMonthlyNegative = "";

var objAutoComplete = new Object();

var objAutoFill = new Object();

$(document).ready(function () {
    console.log("Ready!");

    if ($.urlParam("BudgetMonth") != undefined) {
        budgetMonth = $.urlParam("BudgetMonth"); 
        data.BudgetMonth = $.urlParam("BudgetMonth"); 
    }
    else {
        budgetMonth = Date.today().toString("yyyy-MM-01"); 
        data.BudgetMonth = budgetMonth;
    }

    $("#hdnBudgetMonth").val(budgetMonth);
    
    BudgetMonthNavigationGet();
    BudgetByMonthValidate();

    $("#uxIncomeSave").click(function (event) {
        var budgetIncomeID = $(this).data("budget-income-id");

        objBudgetIncome.BudgetIncomeID = budgetIncomeID;
        objBudgetIncome.BudgetNumber = $("#hdnBudgetNumber").val();
        objBudgetIncome.IncomeName = $("#uxIncomeName").val();
        objBudgetIncome.IncomeTypeID = $("#uxIncomeType option:selected").val();
        objBudgetIncome.IncomeType = $("#uxIncomeType option:selected").text();
        objBudgetIncome.PayCycleID = $("#uxPayCycle option:selected").val();
        objBudgetIncome.PayCycle = $("#uxPayCycle option:selected").text();
        objBudgetIncome.TakeHomePay = $("#uxTakeHomePay").val();
        objBudgetIncome.HourlyRate = $("#uxHourlyRate").val();
        objBudgetIncome.PlannedHours = $("#uxPlannedHours").val();
        objBudgetIncome.Salary = $("#uxSalary").val();
        objBudgetIncome.YearDeduct = $("#uxYearDeduct").val();

        if (ValidateIncome()) {
            if (budgetIncomeID > 0) {
                BudgetIncomeUpdate();
            }
            else {
                BudgetIncomeInsert();
            }

            $("#mdlIncomeCalculator").modal("toggle");
        }
    });

    $("#uxIncomeType").change(function() {
        var IncomeTypeID = $("#uxIncomeType option:selected").val();

        BudgetIncomeDetailModalTextboxSet(IncomeTypeID);
    });

    $("#uxPayCycle").change(function() {
        var PayCycleDescription = "Every 2 Weeks";
        var PayCycleID = $("#uxPayCycle option:selected").val();

        $("#uxPayCycleDescription").html(PayCycleDescription);

        BudgetIncomeCalculate();
    });

    $(".incomeCalculator").focusout(function() {
        BudgetIncomeCalculate();
    });

    $("#uxExpenseSave").click(function (event) {
        var budgetItemID = $(this).data("budget-item-id");

        objBudgetExpense.BudgetItemID = budgetItemID;
        objBudgetExpense.BudgetNumber = $("#hdnBudgetNumber").val();
        objBudgetExpense.BudgetGroup = $("#uxBudgetGroup").val();
        objBudgetExpense.BudgetGroupID = $("#uxBudgetGroup").data("group-id");
        objBudgetExpense.BudgetCategory = $("#uxBudgetCategory").val();
        objBudgetExpense.BudgetCategoryID = $("#uxBudgetCategory").data("category-id");
        objBudgetExpense.Amount = $("#uxAmount").val();
        objBudgetExpense.Description = $("#uxDescription").val();
        objBudgetExpense.Note = $("#uxNote").val();

        if ($("#uxHasSpotlight").prop("checked")) {
            objBudgetExpense.HasSpotlight = "1";
        }
        else {
            objBudgetExpense.HasSpotlight = "0";
        }

        if ($("#uxIsEssential").prop("checked")) {
            objBudgetExpense.IsEssential = "1";
        }
        else {
            objBudgetExpense.IsEssential = "0";
        }
        
        if ($("#uxHasFundFlg").prop("checked")) {
            objBudgetExpense.HasFundFlg = "1";
            objBudgetExpense.FundName = $("#uxFundName").val();
            objBudgetExpense.FundID = $("#uxFundName").data("fund-id");
            objBudgetExpense.StartingBalance = $("#uxStartingBalance").val();
        }
        else {
            objBudgetExpense.HasFundFlg = "0";
            objBudgetExpense.FundName = "";
            objBudgetExpense.FundID = "";
            objBudgetExpense.StartingBalance = "";
        }

        if (ValidateExpense()) {
            BudgetExpenseUpdate();
            
            $("#mdlExpense").modal("toggle");
        }
    });

    $('#uxBudgetGroup').autocomplete({
        minChars: 1,
        noCache: true,
        lookup: function (query, done) {
            objAutoComplete.Keyword = query;

            var result = {};

            $.ajax({
                type: "GET",
                url: api + "/group/description",
                cache: false,
                data: objAutoComplete,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                async: true,
                success: function (msg) {
                    var Group = $.map(msg, function (item) {
                        return { BudgetGroupID: item.BudgetGroupID,
                                BudgetGroup: item.BudgetGroup };
                    });
                    
                    objAutoFill.Group = Group;
                    
                    var suggestions = $.map(msg, function (item) {
                        return { value: item.BudgetGroup, data: item.BudgetGroupID };
                    });

                    result.suggestions = suggestions;
                    
                    if (result.suggestions.length == 0) {
                        $("#uxBudgetGroup").data("group-id", "0");
                    }

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
            $.map(objAutoFill.Group, function (group) {
                if (group.BudgetGroupID == suggestion.data) {   
                    $("#uxBudgetGroup").data("group-id", group.BudgetGroupID);                
                }
            });
        }
    });

    $('#uxBudgetCategory').autocomplete({
        minChars: 1,
        noCache: true,
        lookup: function (query, done) {
            objAutoComplete.Keyword = query;

            var result = {};

            $.ajax({
                type: "GET",
                url: api + "/category/description",
                cache: false,
                data: objAutoComplete,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                async: true,
                success: function (msg) {
                    var Category = $.map(msg, function (item) {
                        return { BudgetCategoryID: item.BudgetCategoryID,
                                BudgetCategory: item.BudgetCategory,
                                Description: item.Description,
                                Note: item.Note,
                                IsEssential: item.IsEssential,
                                HasSpotlight: item.HasSpotlight,
                                HasFundFlg: item.HasFundFlg,
                                FundID: item.FundID,
                                FundName: item.FundName,
                                StartingBalance: item.StartingBalance };
                    });
                    
                    objAutoFill.Category = Category;
                    
                    var suggestions = $.map(msg, function (item) {
                        return { value: item.BudgetCategory, data: item.BudgetCategoryID };
                    });

                    result.suggestions = suggestions;
                    
                    if (result.suggestions.length == 0) {
                        $("#uxBudgetCategory").data("category-id", "0");
                    }

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
            $.map(objAutoFill.Category, function (category) {
                if (category.BudgetCategoryID == suggestion.data) {   
                    $("#uxBudgetCategory").data("category-id", category.BudgetCategoryID);
                    $("#uxDescription").val(category.Description);
                    $("#uxNote").val(category.Note);
                                                    
                    if (category.HasSpotlight == "1") {
                        $("#uxHasSpotlight").prop("checked", true);
                    }
                    else {
                        $("#uxHasSpotlight").prop("checked", false);
                    }

                    if (category.IsEssential == "1") {
                        $("#uxIsEssential").prop("checked", true);
                    }
                    else {
                        $("#uxIsEssential").prop("checked", false);
                    }

                    if (category.HasFundFlg == "1") {
                        $("#uxHasFundFlg").prop("checked", true);
                    }
                    else {
                        $("#uxHasFundFlg").prop("checked", false);
                    }

                    $("#uxFundName").val(category.FundName); 
                    $("#uxFundName").data("fund-id", category.FundID);
                    $("#uxStartingBalance").val(category.StartingBalance); 
                }
            });
        }
    });

    $('#uxFundName').autocomplete({
        minChars: 1,
        noCache: true,
        lookup: function (query, done) {
            objAutoComplete.Keyword = query;

            var result = {};

            $.ajax({
                type: "GET",
                url: api + "/fund/description",
                cache: false,
                data: objAutoComplete,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                async: true,
                success: function (msg) {
                    var Fund = $.map(msg, function (item) {
                        return { FundID: item.FundID,
                                FundName: item.FundName,
                                StartingBalance: item.StartingBalance };
                    });
                    
                    objAutoFill.Fund = Fund;
                    
                    var suggestions = $.map(msg, function (item) {
                        return { value: item.FundName, data: item.FundID };
                    });

                    result.suggestions = suggestions;
                    
                    if (result.suggestions.length == 0) {
                        $("#uxFundName").data("fund-id", "0");
                    }

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
            $.map(objAutoFill.Fund, function (fund) {
                if (fund.FundID == suggestion.data) {   
                    $("#uxFundName").data("fund-id", fund.FundID); 
                    $("#uxStartingBalance").val(fund.StartingBalance);                
                }
            });
        }
    });

    $(".back-to-top").remove();
});

function BudgetMonthNavigationGet() {
    objBudgetMonth.Month = Date.parse(budgetMonth).toString("MMMM");
    objBudgetMonth.MonthCurrent = Date.parse(budgetMonth).toString("MMMM yyyy");
    objBudgetMonth.MonthCurrentDT = budgetMonth;
    objBudgetMonth.MonthPreviousDT = Date.parse(budgetMonth).add(-1).month().toString("yyyy-MM-01");
    objBudgetMonth.MonthNextDT = Date.parse(budgetMonth).add(1).month().toString("yyyy-MM-01");
    objBudgetMonth.MonthPrevious = Date.parse(budgetMonth).add(-1).month().toString("MMM yyyy");
    objBudgetMonth.MonthNext = Date.parse(budgetMonth).add(1).month().toString("MMM yyyy");

    BudgetMonthNavigationRender();
}

function BudgetByMonthValidate() {
    var result = {};

    $.ajax({
        type: "GET",
        url: api + "/validate",
        cache: false,
        data: data,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        success: function (msg) {
            result = msg;

            if (result[0].HasBudgetFlg == "1") {
                BudgetComponentRender();
                
                BudgetIncomeByMonthGet();
                BudgetExpenseByMonthGet();
            }
            else {
                BudgetStartRender();
                
                $("#uxBudgetMonthHeader").attr("style", "cursor: default;");
                $("#uxBudgetComponent").html("");
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

function BudgetByMonthInsert() {
    $.ajax({
        type: "POST",
        url: api,
        cache: false,
        data: JSON.stringify(data),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        success: function (msg) {
            BudgetMonthNavigationGet();
            BudgetByMonthValidate();

            $("#uxBudgetStart").html("");
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

function BudgetByMonthDelete() {
    if ($("#hdnBudgetNumber").val().length > 0) {
        if (confirm("Delete this month? Are you sure?")) {
            $.ajax({
                type: "DELETE",
                url: api + "/" + $("#hdnBudgetNumber").val(),
                cache: false,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                async: true,
                success: function (msg) {
                    BudgetByMonthValidate();
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
    }
}

function BudgetIncomeByMonthGet() {
    var result = {};

    $.ajax({
        type: "GET",
        url: api + "/income",
        cache: false,
        data: data,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        success: function (msg) {
            result = msg;

            objBudgetIncome.TotalIncomeMonthly = result[0].TotalIncomeMonthly;
            objBudgetIncome.TotalIncomeBiWeekly = result[0].TotalIncomeBiWeekly;
            objBudgetIncome.TotalIncomeWeekly = result[0].TotalIncomeWeekly;
            objBudgetIncome.TotalIncomeBiYearly = result[0].TotalIncomeBiYearly;
            objBudgetIncome.TotalIncomeYearly = result[0].TotalIncomeYearly;
            objBudgetIncome.TotalIncomeYearlyGross = result[0].TotalIncomeYearlyGross;
            objBudgetIncome.Income = result;

            BudgetIncomeByMonthRender();
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

function BudgetIncomeDetailGet(BudgetIncomeID) {              
    var result = {};

    $.ajax({
        type: "GET",
        url: api + "/income/" + BudgetIncomeID,
        cache: false,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        success: function (msg) {
            result = msg;
            
            $("#uxIncomeType option[value='"+ result[0].IncomeTypeID + "']").prop("selected", true);
            $("#uxPayCycle option[value='"+ result[0].PayCycleID + "']").prop("selected", true);
            $("#uxIncomeName").val(result[0].IncomeName);
            $("#uxPlannedHours").val(result[0].PlannedHours);
            $("#uxSalary").val(result[0].Salary);
            $("#uxTakeHomePay").val(result[0].TakeHomePay);
            $("#uxHourlyRate").val(result[0].HourlyRate);
            $("#uxYearDeduct").val(result[0].YearDeduct);
            $("#uxPayCycleDescription").html(result[0].PayCycleDescription);
            $("#uxIncomeTotal").val("$" + NumberCommaFormat(result[0].TakeHomePay));
            
            BudgetIncomeDetailModalTextboxSet(result[0].IncomeTypeID);
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

function BudgetIncomeUpdate() {
    $.ajax({
        type: "PUT",
        url: api + "/income/" + objBudgetIncome.BudgetIncomeID,
        cache: false,
        data: JSON.stringify(objBudgetIncome),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        success: function (msg) {
            BudgetIncomeByMonthGet();
            BudgetExpenseByMonthGet();
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

function BudgetIncomeInsert() {
    $.ajax({
        type: "POST",
        url: api + "/income",
        cache: false,
        data: JSON.stringify(objBudgetIncome),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        success: function (msg) {
            BudgetIncomeByMonthGet();
            BudgetExpenseByMonthGet();
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

function BudgetIncomeDelete() {
    $.ajax({
        type: "DELETE",
        url: api + "/income/" + objBudgetIncome.BudgetIncomeID,
        cache: false,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        success: function (msg) {
            BudgetIncomeByMonthGet();
            BudgetExpenseByMonthGet();
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

function BudgetExpenseByMonthGet() {               
    var result = {};

    $.ajax({
        type: "GET",
        url: api + "/expense",
        cache: false,
        data: data,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        success: function (msg) {
            result = msg;

            $("#hdnBudgetNumber").val(result[0].BudgetNumber);
                                    
            objBudgetMonthSummary.TotalIncomeMonthly = result[0].TotalIncomeMonthly;
            objBudgetMonthSummary.TotalExpenseMonthly = result[0].TotalExpenseMonthly;
            objBudgetMonthSummary.BalanceMonthly = result[0].BalanceMonthly;
            objBudgetMonthSummary.IsBalanceMonthlyNegative = result[0].IsBalanceMonthlyNegative;
            objBudgetMonthSummary.MonthCurrent = objBudgetMonth.MonthCurrent;
            BudgetMonthSummaryRender();

            BudgetExpenseByMonthContextSet(result);
            BudgetExpenseByMonthRender();
            
            BudgetGroupAddRender();
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

function BudgetExpenseDetailGet(BudgetItemID) {              
    var result = {};

    $.ajax({
        type: "GET",
        url: api + "/expense/" + BudgetItemID,
        cache: false,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        success: function (msg) {
            result = msg;
            
            $("#uxBudgetGroup").val(result[0].BudgetGroup);
            $("#uxBudgetGroup").data("group-id", result[0].BudgetGroupID);
            $("#uxBudgetCategory").val(result[0].BudgetCategory);
            $("#uxBudgetCategory").data("category-id", result[0].BudgetCategoryID);
            $("#uxAmount").val(result[0].Amount);
            $("#uxDescription").val(result[0].Description);
            $("#uxNote").val(result[0].Note);
            
            if (result[0].HasSpotlight == "1") {
                $("#uxHasSpotlight").prop("checked", true);
            }
            else {
                $("#uxHasSpotlight").prop("checked", false);
            }

            if (result[0].IsEssential == "1") {
                $("#uxIsEssential").prop("checked", true);
            }
            else {
                $("#uxIsEssential").prop("checked", false);
            }

            if (result[0].HasFundFlg == "1") {
                $("#uxHasFundFlg").prop("checked", true);
            }
            else {
                $("#uxHasFundFlg").prop("checked", false);
            }

            $("#uxFundName").val(result[0].FundName);
            $("#uxFundName").data("fund-id", result[0].FundID);
            $("#uxStartingBalance").val(result[0].StartingBalance);
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

function BudgetExpenseUpdate() {
    $.ajax({
        type: "PUT",
        url: api + "/expense",
        cache: false,
        data: JSON.stringify(objBudgetExpense),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        success: function (msg) {
            BudgetIncomeByMonthGet();
            BudgetExpenseByMonthGet();
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

function BudgetExpenseDelete() {
    $.ajax({
        type: "DELETE",
        url: api + "/expense/" + objBudgetItem.BudgetItemID,
        cache: false,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        success: function (msg) {
            BudgetIncomeByMonthGet();
            BudgetExpenseByMonthGet();
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

function BudgetExpenseByMonthContextSet(result) {
    objBudgetExpense = {};

    var tmpBudgetGroup = $.map(result, function (item) {
        return {
            BudgetGroupID: item.BudgetGroupID,
            BudgetGroup: item.BudgetGroup,
        };
    });

    var uniqBudgetGroup = _.uniqWith(tmpBudgetGroup, _.isEqual);
    
    var arrBudgetGroup = [];

    $.map(uniqBudgetGroup, function (group) {
        var arrBudgetItem = [];

        $.map(result, function (budgetItem) {
            if (group.BudgetGroupID == budgetItem.BudgetGroupID) {
                objBudgetItem = {};
                objBudgetItem.BudgetItemID = budgetItem.BudgetItemID;
                objBudgetItem.BudgetNumber = budgetItem.BudgetNumber;
                objBudgetItem.BudgetCategoryID = budgetItem.BudgetCategoryID;
                objBudgetItem.BudgetCategory = budgetItem.BudgetCategory;
                objBudgetItem.AmountMonthly = budgetItem.AmountMonthly;
                objBudgetItem.AmountBiWeekly = budgetItem.AmountBiWeekly;
                objBudgetItem.AmountWeekly = budgetItem.AmountWeekly;
                objBudgetItem.AmountBiYearly = budgetItem.AmountBiYearly;
                objBudgetItem.AmountYearly = budgetItem.AmountYearly;
                objBudgetItem.TransactionAverage = budgetItem.TransactionAverage;
                objBudgetItem.Percentage = budgetItem.Percentage;
                objBudgetItem.RANK = budgetItem.RANK;
                objBudgetItem.Description = budgetItem.Description;
                objBudgetItem.Note = budgetItem.Note;

                arrBudgetItem.push(objBudgetItem);
            }
        });

        objBudgetGroup = {};
        objBudgetGroup.BudgetGroupID = group.BudgetGroupID;
        objBudgetGroup.BudgetGroup = group.BudgetGroup;
        objBudgetGroup.BudgetItem = arrBudgetItem;
        
        arrBudgetGroup.push(objBudgetGroup);
    });

    objBudgetExpense.Expense = arrBudgetGroup;
}
    
function BudgetIncomeDetailModalShow(BudgetIncomeID) {
    BudgetIncomeDetailModalReset();

    $("#uxIncomeSave").data("budget-income-id", BudgetIncomeID);
    
    if (BudgetIncomeID > 0) {
        $("#uxIncomeModalTitle").html("Edit Income");
        
        BudgetIncomeDetailGet(BudgetIncomeID);
    }
    else {
        $("#uxIncomeModalTitle").html("Add Income");
    }

    $("#mdlIncomeCalculator").modal("toggle");
}

function BudgetIncomeDetailModalReset() {
    $("#uxIncomeType option[value='']").prop("selected", true);
    $("#uxPayCycle option[value='']").prop("selected", true);
    $("#uxIncomeName").val("");
    $("#uxPlannedHours").val("");
    $("#uxSalary").val("");
    $("#uxTakeHomePay").val("");
    $("#uxHourlyRate").val("");
    $("#uxYearDeduct").val("");
    $("#uxPayCycleDescription").html("");
    $("#uxIncomeTotal").val("");
    
    $("#uxSalary").prop("disabled", false);
    $("#uxTakeHomePay").prop("disabled", false);
    $("#uxHourlyRate").prop("disabled", false);
    $("#uxYearDeduct").prop("disabled", false);

    $("#IncomeHardErrorMessage").html("");
}

function BudgetIncomeDetailModalTextboxSet(IncomeTypeID) {
    switch(IncomeTypeID) {
        case "1":
            $("#uxSalary").prop("disabled", false);
            $("#uxTakeHomePay").prop("disabled", false);
            $("#uxHourlyRate").prop("disabled", true);
            $("#uxYearDeduct").prop("disabled", true);
            break;
        case "2":
            $("#uxSalary").prop("disabled", true);
            $("#uxTakeHomePay").prop("disabled", true);
            $("#uxHourlyRate").prop("disabled", false);
            $("#uxYearDeduct").prop("disabled", false);
            break;
    }
}

function BudgetIncomeCalculate() {
    var objIncome = new Object();

    objIncome.IncomeTypeID = $("#uxIncomeType option:selected").val();
    objIncome.PayCycleID = $("#uxPayCycle option:selected").val();
    objIncome.PlannedHours = parseInt($("#uxPlannedHours").val());
    objIncome.Salary = parseInt($("#uxSalary").val());
    objIncome.TakeHomePay = parseInt($("#uxTakeHomePay").val());
    objIncome.HourlyRate = parseInt($("#uxHourlyRate").val());
    objIncome.YearDeduct = parseInt($("#uxYearDeduct").val());
    
    if (objIncome.IncomeTypeID.length > 0 && objIncome.PayCycleID.length > 0 ) {
        objIncome.PayCycle = 26;

        if (objIncome.IncomeTypeID == "1" 
                && $("#uxPlannedHours").val().length > 0 
                && $("#uxSalary").val().length > 0 
                && $("#uxTakeHomePay").val().length > 0) {
            objIncome.HourlyRate = (objIncome.Salary / 52) / objIncome.PlannedHours;
            objIncome.YearNet = objIncome.TakeHomePay * objIncome.PayCycle;
            objIncome.YearDeduct = (1 - (objIncome.YearNet / objIncome.Salary)) * 100;
            
            objIncome.IncomeTotal = objIncome.TakeHomePay;

            $("#uxHourlyRate").val(objIncome.HourlyRate.toFixed(2));
            $("#uxYearDeduct").val(objIncome.YearDeduct.toFixed(2));
            $("#uxIncomeTotal").val("$" + NumberCommaFormat(objIncome.IncomeTotal));
        }

        if (objIncome.IncomeTypeID == "2" 
                && $("#uxPlannedHours").val().length > 0 
                && $("#uxHourlyRate").val().length > 0 
                && $("#uxYearDeduct").val().length > 0) {
            objIncome.Salary = (objIncome.HourlyRate * objIncome.PlannedHours) * 52;
            objIncome.YearNet = objIncome.Salary * (1 - (objIncome.YearDeduct / 100));
            objIncome.TakeHomePay = Math.round(objIncome.YearNet / objIncome.PayCycle);
            
            objIncome.IncomeTotal = objIncome.TakeHomePay;

            $("#uxSalary").val(objIncome.Salary);
            $("#uxTakeHomePay").val(objIncome.TakeHomePay);
            $("#uxIncomeTotal").val("$" + NumberCommaFormat(objIncome.IncomeTotal));
        }
    }  
}

function BudgetIncomeRemove(BudgetIncomeID) {  
    if(ConfirmAction()) {
        objBudgetIncome.BudgetIncomeID = BudgetIncomeID

        BudgetIncomeDelete();
    }
}

function BudgetExpenseDetailModalShow(BudgetItemID) {
    BudgetExpenseDetailModalReset();

    $("#uxExpenseSave").data("budget-item-id", BudgetItemID);
    
    if (BudgetItemID > 0) {
        $("#uxExpenseModalTitle").html("Edit Expense");
        
        BudgetExpenseDetailGet(BudgetItemID);
    }
    else {
        $("#uxExpenseModalTitle").html("Add Expense");
    }

    $("#mdlExpense").modal("toggle");
}

function BudgetExpenseGroupModalShow(BudgetGroupID, BudgetGroup) {
    BudgetExpenseDetailModalReset();

    $("#uxExpenseSave").data("budget-item-id", "0");
    $("#uxBudgetGroup").val(BudgetGroup);
    $("#uxBudgetGroup").data("group-id", BudgetGroupID);
    
    $("#uxExpenseModalTitle").html("Add Expense");

    $("#mdlExpense").modal("toggle");
}

function BudgetExpenseDetailModalReset() {
    $("#uxBudgetGroup").val("");
    $("#uxBudgetGroup").data("group-id", "0");
    $("#uxBudgetCategory").val("");
    $("#uxBudgetCategory").data("category-id", "0");
    $("#uxAmount").val("");
    $("#uxDescription").val("");
    $("#uxNote").val("");
    $("#uxHasSpotlight").prop("checked", false) ;
    $("#uxIsEssential").prop("checked", false);
    $("#uxHasFundFlg").prop("checked", false);
    $("#uxFundName").val("");
    $("#uxFundName").data("fund-id", "0");
    $("#uxStartingBalance").val("");

    $("#ExpenseHardErrorMessage").html("");

    $("#MoreOptions").collapse("hide");
}

function BudgetExpenseRemove(BudgetItemID) {  
    if(ConfirmAction()) {
        objBudgetItem.BudgetItemID = BudgetItemID
        
        BudgetExpenseDelete();
    }
}

            function ConfirmAction() {
    if (confirm("Are you sure?")) {
        return true;
    }
    else {
        return false;
    }
}

function ValidateIncome() {
    var error = "";
    var numRegEx = /^-{0,1}\d*\.{0,1}\d+$/;

    if ($("#uxIncomeType option:selected").val().length == 0) { error += "<li>Income Type is required.</li>"; }
    if ($("#uxPayCycle option:selected").val().length == 0) { error += "<li>Pay Cycle is required.</li>"; }
    if ($("#uxIncomeName").val().length == 0) { error += "<li>Name is required.</li>"; }
    if ($("#uxPlannedHours").val().length == 0) { error += "<li>Planned Hours is required.</li>"; }
    if ($("#uxPlannedHours").val().length > 0) { if (!numRegEx.test($("#uxPlannedHours").val())) { error += "<li>Planned Hours must be numeric.</li>"; } }
    if ($("#uxSalary").val().length == 0) { error += "<li>Salary is required.</li>"; }
    if ($("#uxSalary").val().length > 0) { if (!numRegEx.test($("#uxSalary").val())) { error += "<li>Salary must be numeric.</li>"; } }
    if ($("#uxTakeHomePay").val().length == 0) { error += "<li>Take Home Pay is required.</li>"; }
    if ($("#uxTakeHomePay").val().length > 0) { if (!numRegEx.test($("#uxTakeHomePay").val())) { error += "<li>Take Home Pay must be numeric.</li>"; } }
    if ($("#uxHourlyRate").val().length == 0) { error += "<li>Hourly Rate is required.</li>"; }
    if ($("#uxHourlyRate").val().length > 0) { if (!numRegEx.test($("#uxHourlyRate").val())) { error += "<li>Hourly Rate must be numeric.</li>"; } }
    if ($("#uxYearDeduct").val().length == 0) { error += "<li>Year Deduct is required.</li>"; }
    if ($("#uxYearDeduct").val().length > 0) { if (!numRegEx.test($("#uxYearDeduct").val())) { error += "<li>Year Deduct must be numeric.</li>"; } }

    if (error.length > 0) {
        error = "<div class=\"alert alert-danger\" role=\"alert\"><ul>" + error + "</ul></div>";
        
        $("#IncomeHardErrorMessage").html(error);
        
        return false;
    }
    else {
        return true;
    }
}

function ValidateExpense() {
    var error = "";
    var numRegEx = /^-{0,1}\d*\.{0,1}\d+$/;

    if ($("#uxBudgetGroup").val().length == 0) { error += "<li>Group is required.</li>"; }
    if ($("#uxBudgetCategory").val().length == 0) { error += "<li>Category is required.</li>"; }
    if ($("#uxAmount").val().length == 0) { error += "<li>Amount is required.</li>"; }
    if ($("#uxAmount").val().length > 0) { if (!numRegEx.test($("#uxAmount").val())) { error += "<li>Amount must be numeric.</li>"; } }

    if (error.length > 0) {
        error = "<div class=\"alert alert-danger\" role=\"alert\"><ul>" + error + "</ul></div>";
        
        $("#ExpenseHardErrorMessage").html(error);
        
        return false;
    }
    else {
        return true;
    }
}
                                                
function BudgetMonthNavigationRender() {
    var source = $("#tmplBudgetMonthNavigation").html();
    var template = Handlebars.compile(source);

    var context = objBudgetMonth;
    var html = template(context);

    $("#uxBudgetMonthNavigation").html(html);
}

function BudgetStartRender() {
    var source = $("#tmplBudgetStart").html();
    var template = Handlebars.compile(source);

    var context = objBudgetMonth;
    var html = template(context);

    $("#uxBudgetStart").html(html);
}

function BudgetComponentRender() {
    var source = $("#tmplBudgetComponent").html();
    var template = Handlebars.compile(source);

    var context = "";
    var html = template(context);

    $("#uxBudgetComponent").html(html);
}

function BudgetIncomeByMonthRender() {
    var source = $("#tmplBudgetIncomeByMonth").html();
    var template = Handlebars.compile(source);

    var context = objBudgetIncome;
    var html = template(context);

    $("#uxBudgetIncomeByMonth").html(html);
}

function BudgetExpenseByMonthRender() {
    var source = $("#tmplBudgetExpenseByMonth").html();
    var template = Handlebars.compile(source);

    var context = objBudgetExpense;
    var html = template(context);

    $("#uxBudgetExpenseByMonth").html(html);

    $('[data-toggle="tooltip"]').tooltip();
}

function BudgetMonthSummaryRender() {
    var source = $("#tmplBudgetMonthSummary").html();
    var template = Handlebars.compile(source);

    var context = objBudgetMonthSummary;
    var html = template(context);

    $("#uxBudgetMonthSummary").html(html);
}

function BudgetGroupAddRender() {
    var source = $("#tmplBudgetGroupAdd").html();
    var template = Handlebars.compile(source);

    var context = "";
    var html = template(context);

    $("#uxBudgetGroupAdd").html(html);
}