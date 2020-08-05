var api = $.apiUrl() + "/budget";
var data = {};

var objBudget = {};
objBudget.BudgetSpotlight = "";
objBudget.BudgetCategorySpotlight = "";
objBudget.BudgetFundSpotlight = "";
objBudget.BudgetSummarySpotlight = "";
objBudget.TransactionSpotlight = "";
objBudget.TransactionLeaderboard = "";
objBudget.TransactionBalance = "";

var objBudgetSpotlightChart = {
	Monthly: {
		chartLabel: [],
		chartData: []
	}
};

var objTransactionSpotlightChart = {
	Weekly: {
		chartLabel: [],
		chartData: []
	},
	Daily: {
		chartLabel: [],
		chartData: []
	}
};

$(document).ready(function () {
	console.log("Ready!");

	data.EffectiveDT = Date.today().toString("yyyy-MM-dd");

	BudgetSpotlightGet();
	BudgetCategorySpotlightGet();
	BudgetFundSpotlightGet();
	BudgetSummarySpotlightGet();
	TransactionSpotlightGet();
	TransactionLeaderboardGet();
	TransactionBalanceGet("UBAM");

	console.log("State!");
	console.log(objBudget);

	console.log("Budget Trend");
	console.log(objBudgetSpotlightChart);

	console.log("Transaction Trend");
	console.log(objTransactionSpotlightChart);
});

// Budget

function BudgetSpotlightGet() {
	BudgetSpotlightRender();
	BudgetBalanceMetricRender();
	BudgetAverageMonthlySpotlightGet();
}

function BudgetSpotlightRender() {
	$("#uxBudgetSpotlight").html("<div class='text-center'><i class='fa fa-refresh fa-spin fa-2x fa-fw'></i><span class='loading'>Loading...</span></div>");

	var source = $("#tmplBudgetSpotlight").html();
	var template = Handlebars.compile(source);
	var context = objBudget;
	var html = template(context);

	$("#uxBudgetSpotlight").html(html);
}

function BudgetAverageMonthlySpotlightGet() {
	$.ajax({
		type: "GET",
		url: api + "/average/snapshot",
		cache: false,
		data: null,
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		async: true,
		beforeSend: function () {
			$("#uxBudgetAverageMonthlySpotlightChart").html("<div class='text-center'><i class='fa fa-refresh fa-spin fa-2x fa-fw'></i><span class='loading'>Loading...</span></div>");
		},
		success: function (result) {
			objBudget.BudgetSpotlight = result;

			BudgetAverageMonthlySpotlightChartLabelSet(result);
			BudgetAverageMonthlySpotlightChartDataSet(result);

			BudgetAverageMonthlySpotlightChartRender();

			BudgetBalanceMetricSet(result);
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			if (XMLHttpRequest.readyState < 4) {
				return true;
			} else {
				alert("Error :" + XMLHttpRequest.responseText);
			}
		}
	});
}

function BudgetAverageMonthlySpotlightChartLabelSet(result) {
	$.each(result, function (index, value) {
		objBudgetSpotlightChart.Monthly.chartLabel.push(value.BudgetMonth);
	});
}

function BudgetAverageMonthlySpotlightChartDataSet(result) {
	$.each(result, function (index, value) {
		objBudgetSpotlightChart.Monthly.chartData.push(value.TotalIncomeVsExpenseActual);
	});
}

function BudgetAverageMonthlySpotlightChartRender() {
	var ctx = document.getElementById("uxBudgetAverageMonthlySpotlightChart").getContext('2d');

	var ctxBudgetAverageMonthlySpotlightChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: objBudgetSpotlightChart.Monthly.chartLabel,
			datasets: [
				{
					fill: "origin",
					data: objBudgetSpotlightChart.Monthly.chartData,
					pointBorderWidth: 2,
					pointRadius: 5,
					pointHoverRadius: 8
				}
			]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
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
				titleFontFamily: "Lato",
				titleFontStyle: "normal",
				titleFontSize: 14,
				bodyFontFamily: "Lato",
				bodyFontStyle: "bold",
				bodyFontSize: 16,
				displayColors: false,
				callbacks: {
					label: function (tooltipItem, data) {
						var totalIncomeVsExpenseActual = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];

						return "$" + NumberCommaFormat(totalIncomeVsExpenseActual);
					}
				}
			},
			scales: {
				yAxes: [
					{
						ticks: {
							beginAtZero: false,
							fontFamily: "Lato",
							fontStyle: "bold",
							fontSize: 12,
							callback: function (value, index, values) {
								return "$" + NumberCommaFormat(value);
							}
						},
						gridLines: {
							display: true,
							drawBorder: false
						}
					}
				],
				xAxes: [
					{
						ticks: {
							beginAtZero: false,
							fontFamily: "Lato",
							fontStyle: "bold",
							fontSize: 12,
							autoSkip: true,
							maxRotation: 0,
							minRotation: 0,
							display: "auto"
						},
						gridLines: {
							display: false,
							drawBorder: false
						}
					}
				]
			}
		},
		plugins: [
			{
				beforeRender: function (x, options) {
					var c = x.chart;
					var dataset = x.data.datasets[0];
					var yScale = x.scales["y-axis-0"];
					var yPos = yScale.getPixelForValue(0);

					if (yPos) {
						var gradientFill = c.ctx.createLinearGradient(0, 0, 0, c.height);
						gradientFill.addColorStop(0, "#18bc9c");
						gradientFill.addColorStop(yPos / c.height - 0.01, "#18bc9c");
						gradientFill.addColorStop(yPos / c.height + 0.01, "#e74c3c");
						gradientFill.addColorStop(1, "#e74c3c");

						var model = x.data.datasets[0]._meta[Object.keys(dataset._meta)[0]].dataset._model;
						model.backgroundColor = gradientFill;
						model.borderColor = gradientFill;
					}
				}
			}
		]
	})
}

function BudgetBalanceMetricRender() {
	var source = $("#tmplBudgetBalanceMetric").html();
	var template = Handlebars.compile(source);
	var context = objBudget;
	var html = template(context);

	$("#uxBudgetBalanceMetric").html(html);
}

function BudgetBalanceMetricSet(result) {
	var budgetBalance = result[(result.length - 1)].TotalIncomeVsExpenseActual;

	if (budgetBalance > 0) {
		$("#uxBudgetBalance").addClass("text-success");

		budgetBalance = "$" + NumberCommaFormat(budgetBalance);
	}
	else {
		$("#uxBudgetBalance").addClass("text-danger");

		budgetBalance = "$" + NumberCommaFormat(budgetBalance)
	}

	$("#uxBudgetBalance").html(budgetBalance);
}

// Budget Category

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
			BudgetCategoryPercentageSet();

			$("[data-toggle='tooltip']").tooltip();
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

function BudgetCategoryPercentageSet() {
	var objBudgetCategoryPercentage = {};
	objBudgetCategoryPercentage.monthNumber = parseInt(Date.today().toString("M")) - 1;
	objBudgetCategoryPercentage.yearNumber = parseInt(Date.today().toString("yyyy"));
	objBudgetCategoryPercentage.dayNumber = parseInt(Date.today().toString("dd"));
	objBudgetCategoryPercentage.daysInMonth = parseInt(Date.getDaysInMonth(objBudgetCategoryPercentage.yearNumber, objBudgetCategoryPercentage.monthNumber));
	objBudgetCategoryPercentage.monthPercentThrough = Math.round(objBudgetCategoryPercentage.dayNumber / objBudgetCategoryPercentage.daysInMonth * 100);

	$("#uxBudgetMonth").attr("data-toggle", "tooltip").attr("data-placement", "top").attr("data-original-title", objBudgetCategoryPercentage.monthPercentThrough + "%");
}

// Budget Fund

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

// Budget Summary

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

// Transaction

function TransactionSpotlightGet() {
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
		success: function (result) {
			objBudget.TransactionSpotlight = result;

			TransactionSpotlightWeeklyChartLabelSet(result);
			TransactionSpotlightWeeklyChartDataSet(result);
			TransactionSpotlightDailyChartLabelSet(result);
			TransactionSpotlightDailyChartDataSet(result);

			TransactionSpotlightRender();

			TransactionSpotlightWeeklyChartRender();
			TransactionSpotlightDailyChartRender();
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

function TransactionSpotlightWeeklyChartLabelSet(result) {
	var tmpTransactionWeek = $.map(result, function (item) {
		return {
			TransactionWeek: item.TransactionWeek,
			CalendarWeekID: item.CalendarWeekID,
			CalendarWeekBegin: item.CalendarWeekBegin,
			CalendarWeekEnd: item.CalendarWeekEnd,
			AmountWeekly: item.AmountWeekly,
			DateRangeWeekBegin: item.ateRangeWeekBegin,
			DateRangeWeekEnd: item.DateRangeWeekEnd,
			DateRangeWeek: item.DateRangeWeek,
			TransactionCountWeekly: item.TransactionCountWeekly
		};
	});

	var uniqTransactionWeek = _.uniqWith(tmpTransactionWeek, _.isEqual);

	$.each(uniqTransactionWeek, function (index, value) {
		objTransactionSpotlightChart.Weekly.chartLabel.push(value.DateRangeWeek);
	});
}

function TransactionSpotlightWeeklyChartDataSet(result) {
	var tmpTransactionWeek = $.map(result, function (item) {
		return {
			TransactionWeek: item.TransactionWeek,
			CalendarWeekID: item.CalendarWeekID,
			CalendarWeekBegin: item.CalendarWeekBegin,
			CalendarWeekEnd: item.CalendarWeekEnd,
			AmountWeekly: item.AmountWeekly,
			DateRangeWeekBegin: item.ateRangeWeekBegin,
			DateRangeWeekEnd: item.DateRangeWeekEnd,
			DateRangeWeek: item.DateRangeWeek,
			TransactionCountWeekly: item.TransactionCountWeekly
		};
	});

	var uniqTransactionWeek = _.uniqWith(tmpTransactionWeek, _.isEqual);

	$.each(uniqTransactionWeek, function (index, value) {
		objTransactionSpotlightChart.Weekly.chartData.push(value.AmountWeekly);
	});
}

function TransactionSpotlightDailyChartLabelSet(result) {
	var tmpTransactionDay = $.map(result, function (item) {
		return {
			TransactionMonth: item.TransactionMonth,
			TransactionDay: item.TransactionDay,
			CalendarDayName: item.CalendarDayName,
			AmountDaily: item.AmountDaily,
			DateRangeDaily: item.DateRangeDaily,
			TransactionCountDaily: item.TransactionCountDaily
		};
	});

	var uniqTransactionDay = _.uniqWith(tmpTransactionDay, _.isEqual);

	$.each(uniqTransactionDay, function (index, value) {
		var dateRangeStart = (uniqTransactionDay.length - 14);
		var dateRangeDaily = (value.DateRangeDaily + " " + value.TransactionMonth + "/" + value.TransactionDay);

		// Last 7 Days
		if (index > dateRangeStart) {
			objTransactionSpotlightChart.Daily.chartLabel.push(dateRangeDaily);
		}
	});
}

function TransactionSpotlightDailyChartDataSet(result) {
	var tmpTransactionDay = $.map(result, function (item) {
		return {
			TransactionMonth: item.TransactionMonth,
			TransactionDay: item.TransactionDay,
			CalendarDayName: item.CalendarDayName,
			AmountDaily: item.AmountDaily,
			DateRangeDaily: item.DateRangeDaily,
			TransactionCountDaily: item.TransactionCountDaily
		};
	});

	var uniqTransactionDay = _.uniqWith(tmpTransactionDay, _.isEqual);

	$.each(uniqTransactionDay, function (index, value) {
		var dateRangeStart = (uniqTransactionDay.length - 14);

		// Last 7 Days
		if (index > dateRangeStart) {
			objTransactionSpotlightChart.Daily.chartData.push(value.AmountDaily);
		}
	});
}

function TransactionSpotlightRender() {
	var source = $("#tmplTransactionSpotlight").html();
	var template = Handlebars.compile(source);
	var context = objBudget;
	var html = template(context);

	$("#uxTransactionSpotlight").html(html);
}

function TransactionSpotlightWeeklyChartRender() {
	var ctx = document.getElementById("uxTransactionSpotlightWeeklyChart").getContext('2d');

	var gradient = ctx.createLinearGradient(0, 0, 0, 400);
	gradient.addColorStop(0, 'rgba(250,189,9,1)');
	gradient.addColorStop(1, 'rgba(250,189,9,0)');

	var ctxTransactionSpotlightWeeklyChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: objTransactionSpotlightChart.Weekly.chartLabel,
			datasets: [
				{
					data: objTransactionSpotlightChart.Weekly.chartData,
					fill: "start",
					backgroundColor: gradient,
					borderColor: "#f4c247",
					pointBorderColor: "#000000",
					pointBackgroundColor: "#ffffff",
					pointBorderWidth: 2,
					pointRadius: 8,
					pointHoverRadius: 8
				}
			]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
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
				titleFontFamily: "Lato",
				titleFontStyle: "normal",
				titleFontSize: 16,
				bodyFontFamily: "Lato",
				bodyFontStyle: "bold",
				bodyFontSize: 16,
				footerFontFamily: "Lato",
				footerFontStyle: "italic",
				footerFontSize: 12,
				displayColors: false,
				callbacks: {
					label: function (tooltipItem, data) {
						var weekTotal = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];

						return "$" + NumberCommaFormat(weekTotal);
					},
					footer: function (tooltipItem, data) {
						var transactionCountWeekly = 0;
						var dateRangeWeek = tooltipItem[0].xLabel;

						$.each(objBudget.TransactionSpotlight, function (index, value) {
							if (value.DateRangeWeek == dateRangeWeek) {
								transactionCountWeekly = value.TransactionCountWeekly;

								return false;
							}
						});

						return "(" + transactionCountWeekly + ") Transactions";
					}
				}
			},
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true,
						callback: function (value, index, values) {
							return "";
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
						maxRotation: 0,
						minRotation: 0,
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

function TransactionSpotlightDailyChartRender() {
	var ctx = document.getElementById("uxTransactionSpotlightDailyChart").getContext('2d');

	var gradient = ctx.createLinearGradient(0, 0, 0, 400);
	gradient.addColorStop(0, 'rgba(250,189,9,1)');
	gradient.addColorStop(1, 'rgba(250,189,9,0)');

	var ctxTransactionSpotlightDailyChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: objTransactionSpotlightChart.Daily.chartLabel,
			datasets: [{
				data: objTransactionSpotlightChart.Daily.chartData,
				fill: "start",
				backgroundColor: gradient,
				borderColor: "#f4c247",
				pointBorderColor: "#000000",
				pointBackgroundColor: "#ffffff",
				pointBorderWidth: 2,
				pointRadius: 8,
				pointHoverRadius: 8
			}]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
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
				titleFontFamily: "Lato",
				titleFontStyle: "normal",
				titleFontSize: 16,
				bodyFontFamily: "Lato",
				bodyFontStyle: "bold",
				bodyFontSize: 16,
				footerFontFamily: "Lato",
				footerFontStyle: "italic",
				footerFontSize: 12,
				displayColors: false,
				callbacks: {
					label: function (tooltipItem, data) {
						var dayTotal = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];

						return "$" + NumberCommaFormat(dayTotal);
					},
					footer: function (tooltipItem, data) {
						var transactionCountDaily = 0;
						var amountDaily = tooltipItem[0].yLabel;

						$.each(objBudget.TransactionSpotlight, function (index, value) {
							if (value.AmountDaily == amountDaily) {
								transactionCountDaily = value.TransactionCountDaily;

								return false;
							}
						});

						return "(" + transactionCountDaily + ") Transactions";
					}
				}
			},
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true,
						callback: function (value, index, values) {
							return "";
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
						maxRotation: 0,
						minRotation: 0,
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

// Transaction Leaderboard

function TransactionLeaderboardGet() {
	$.ajax({
		type: "GET",
		url: api + "/transaction/leaderboard",
		cache: false,
		data: data,
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		async: true,
		beforeSend: function () {
			$("#uxTransactionLeaderboard").html("<div class='text-center'><i class='fa fa-refresh fa-spin fa-2x fa-fw'></i><span class='loading'>Loading...</span></div>");
		},
		success: function (result) {
			objBudget.TransactionLeaderboard = result;

			TransactionLeaderboardRender();
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

function TransactionLeaderboardRender() {
	var source = $("#tmplTransactionLeaderboard").html();
	var template = Handlebars.compile(source);
	var context = objBudget;
	var html = template(context);

	$("#uxTransactionLeaderboard").html(html);
}

// Transaction Balance

function TransactionBalanceGet(description) {
	$.ajax({
		type: "GET",
		url: api + "/transaction/balance",
		cache: false,
		data: { Keyword: description } ,
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		async: true,
		beforeSend: function () {
			$("#uxTransactionBalance").html("<div class='text-center'><i class='fa fa-refresh fa-spin fa-2x fa-fw'></i><span class='loading'>Loading...</span></div>");
		},
		success: function (result) {
			objBudget.TransactionBalance = result;

			TransactionBalanceRender();
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

function TransactionBalanceRender() {
	var source = $("#tmplTransactionBalance").html();
	var template = Handlebars.compile(source);
	var context = objBudget;
	var html = template(context);

	$("#uxTransactionBalance").html(html);
}