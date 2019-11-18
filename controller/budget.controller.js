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
			labels: [
				"Aug 11 - 17",
				"Aug 18 - 24",
				"Aug 25 - 31",
				"Sep 1 - 7",
				"Sep 8 - 14",
				"Sep 15 - 21",
				"Sep 22 - 28",
				"Sep 29 - Oct 5",
				"Oct 6 - 12",
				"Oct 13 - 19",
				"Oct 20 - 26",
				"Oct 27 - Nov 2",
				"Nov 3 - 9",
				"Nov 10 - 16",
				"Nov 17 - 23"
			],
			datasets: [{
				data: [
					2345,
					2745,
					2183,
					2865,
					2834,
					2234,
					2187,
					2738,
					2965,
					2345,
					2884,
					3055,
					3156,
					2234,
					2533
				],
				fill: "start",
				backgroundColor: "#f4c247",
				borderColor: "#f4c247",
				pointBorderColor: "#000000",
				pointBackgroundColor: "#ffffff",
				pointBorderWidth: 3,
				pointRadius: 8,
				pointHoverRadius: 8
			}]
		},
		options: {
			elements: {
				line: {
					tension: 0.000001
				}
			},
			legend: {
				display: false
			},
			tooltips: {
				enabled: true,
				bodyFontFamily: "Lato",
				bodyFontStyle: "bold",
				bodyFontSize: 16,
				displayColors: false,
				callbacks: {
					label: function (tooltipItem, data) {
						var weekTotal = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];

						return "$" + NumberCommaFormat(weekTotal);
					},
					title: function (tooltipItem, data) {
						return "";
					}
				}
			},
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true,
						callback: function (value, index, values) {
							return '';
						}
					},
					gridLines: {
						display: false,
						drawBorder: false
					},
				}],
				xAxes: [{
					ticks: {
						beginAtZero: false,
						fontFamily: "Lato",
						fontStyle: "bold",
						fontSize: 14,
						autoSkip: true,
						maxRotation: 60,
						minRotation: 60,
						display: "auto"
					},
					gridLines: {
						display: false,
						drawBorder: false
					}
				}]
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