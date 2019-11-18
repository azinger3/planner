var api = $.apiUrl() + "/budget";
var data = {};

var objBudget = {};
objBudget.BudgetCategorySpotlight = "";
objBudget.BudgetFundSpotlight = "";
objBudget.BudgetSummarySpotlight = "";
objBudget.TransactionSpotlight = "";

$(document).ready(function () {
	console.log("Ready!");

	data.EffectiveDT = Date.today().toString("yyyy-MM-dd");

	BudgetCategorySpotlightGet();
	BudgetFundSpotlightGet();
	BudgetSummarySpotlightGet();
	TransactionSpotlightGet();
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
		beforeSend: function () {
			$("#uxBudgetCategorySpotlight").html("<div class='text-center'><i class='fa fa-refresh fa-spin fa-2x fa-fw'></i><span class='loading'>Loading...</span></div>");
		},
		success: function (msg) {
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
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			if (XMLHttpRequest.readyState < 4) {
				return true;
			} else {
				alert('Error :' + XMLHttpRequest.responseText);
			}
		}
	});
}

function BudgetCategorySpotlightRender() {
	var source = $("#tmplBudgetCategorySpotlight").html();
	var template = Handlebars.compile(source);
	var context = objBudget;
	var html = template(context);

	$("#uxBudgetCategorySpotlight").html(html);
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
		beforeSend: function () {
			$("#uxBudgetFundSpotlight").html("<div class='text-center'><i class='fa fa-refresh fa-spin fa-2x fa-fw'></i><span class='loading'>Loading...</span></div>");
		},
		success: function (msg) {
			result = msg;

			objBudget.TotalFundSpentVsReceived = result[0].TotalFundSpentVsReceived;
			objBudget.BudgetFundSpotlight = result;

			BudgetFundSpotlightRender();
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			if (XMLHttpRequest.readyState < 4) {
				return true;
			} else {
				alert('Error :' + XMLHttpRequest.responseText);
			}
		}
	});
}

function BudgetFundSpotlightRender() {
	var source = $("#tmplBudgetFundSpotlight").html();
	var template = Handlebars.compile(source);
	var context = objBudget;
	var html = template(context);

	$("#uxBudgetFundSpotlight").html(html);
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
		beforeSend: function () {
			$("#uxBudgetSummarySpotlight").html("<div class='text-center'><i class='fa fa-refresh fa-spin fa-2x fa-fw'></i><span class='loading'>Loading...</span></div>");
		},
		success: function (msg) {
			result = msg;

			objBudget.BudgetSummarySpotlight = result;

			BudgetSummarySpotlightRender();
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			if (XMLHttpRequest.readyState < 4) {
				return true;
			} else {
				alert('Error :' + XMLHttpRequest.responseText);
			}
		}
	});
}

function BudgetSummarySpotlightRender() {
	var source = $("#tmplBudgetSummarySpotlight").html();
	var template = Handlebars.compile(source);
	var context = objBudget;
	var html = template(context);

	$("#uxBudgetSummarySpotlight").html(html);
}

function TransactionSpotlightGet() {
	var result = {};

	$.ajax({
		type: "GET",
		url: api + "/transaction/spotlight",
		cache: false,
		data: data,
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		async: true,
		beforeSend: function () {
			$("#uxTransactionSpotlight").html("<div class='text-center'><i class='fa fa-refresh fa-spin fa-2x fa-fw'></i><span class='loading'>Loading...</span></div>");
		},
		success: function (msg) {
			result = msg;

			objBudget.TransactionSpotlight = result[0];

			TransactionSpotlightRender();
			TransactionSpotlightWeeklyChartRender();
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			if (XMLHttpRequest.readyState < 4) {
				return true;
			} else {
				alert('Error :' + XMLHttpRequest.responseText);
			}
		}
	});
}

function TransactionSpotlightRender() {
	var source = $("#tmplTransactionSpotlight").html();
	var template = Handlebars.compile(source);
	var context = objBudget.TransactionSpotlight;
	var html = template(context);

	$("#uxTransactionSpotlight").html(html);
}

function TransactionSpotlightWeeklyChartRender() {
	var ctx = document.getElementById("uxTransactionSpotlightWeeklyChart").getContext('2d');

	var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: [1500, 1600, 1700, 1750, 1800, 1850, 1900, 1950, 1999, 2050],
			datasets: [{
				data: [86, 114, 106, 106, 107, 111, 133, 221, 783, 2478],
				label: "Africa",
				borderColor: "#3e95cd",
				fill: false
			}, {
				data: [282, 350, 411, 502, 635, 809, 947, 1402, 3700, 5267],
				label: "Asia",
				borderColor: "#8e5ea2",
				fill: false
			}, {
				data: [168, 170, 178, 190, 203, 276, 408, 547, 675, 734],
				label: "Europe",
				borderColor: "#3cba9f",
				fill: false
			}, {
				data: [40, 20, 10, 16, 24, 38, 74, 167, 508, 784],
				label: "Latin America",
				borderColor: "#e8c3b9",
				fill: false
			}, {
				data: [6, 3, 2, 2, 7, 26, 82, 172, 312, 433],
				label: "North America",
				borderColor: "#c45850",
				fill: false
			}
			]
		},
		options: {
			title: {
				display: true,
				text: 'World population per region (in millions)'
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