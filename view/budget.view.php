<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	$pageTitle = 'Budget';

	require_once('include/header.php');

	require_once('include/icon.budget.php');
	?>

	<style>
		.progress {
			margin-bottom: 10px;
		}

		.remaining {
			text-align: right;
		}

		.balance {
			text-align: right;
		}

		.total {
			background-color: #f2f2f2;
		}

		.categoryWidth {
			width: 20%;
		}

		.progressWidth {
			width: 70%;
		}

		.remainingWidth {
			width: 15%;
		}

		.progress-sm {
			margin-top: 5px !important;
			margin-bottom: 5px !important;
		}

		.progress-lg {
			margin-top: 15px !important;
		}

		.currentMonth {
			text-align: center;
		}

		.quickLink {
			color: #ffffff;
			font-size: 16px;
			margin-left: 16px;
		}

		.amount-red {
			color: red;
		}

		a.summaryLink {
			text-decoration: none;
			color: #2c3e50;
		}

		.loading {
			vertical-align: super;
			margin: 5px;
		}

		sub {
			bottom: 0;
		}

		.section-default {
			padding: 1px 20px 10px 20px;
		}

		.budget-monthly-chart {
			height: 375px;
		}

		@media (max-width:414px) {
			.budget-monthly-chart {
				display: none;
			}
		}

		@media (min-width:415px) and (max-width:812px) {
			.budget-monthly-chart {
				display: none;
			}
		}

		.budget-balance-metric {
			display: none;
		}

		@media (max-width:414px) {
			.budget-balance-metric {
				display: inherit;
				font-size: 24px;
				font-weight: bolder;
			}

			.budget-spotlight-as-of {
				display: none;
			}
		}

		@media (min-width:415px) and (max-width:812px) {
			.budget-balance-metric {
				display: inherit;
				font-size: 24px;
				font-weight: bolder;
			}

			.budget-spotlight-as-of {
				display: none;
			}
		}

		.transaction-week-chart {
			height: 286px;
		}

		@media (max-width:414px) {
			.transaction-week-chart {
				height: 150px;
			}
		}

		@media (min-width:415px) and (max-width:812px) {
			.transaction-week-chart {
				height: 185px;
			}
		}

		.transaction-day-chart {
			height: 286px;
		}

		@media (max-width:414px) {
			.transaction-day-chart {
				height: 150px;
			}
		}

		@media (min-width:415px) and (max-width:812px) {
			.transaction-day-chart {
				height: 185px;
			}
		}

		.transaction-pills {
			display: inline-block;
		}
	</style>
</head>

<body>
	<?php require_once('include/navigation.budget.php'); ?>

	<section class="section-default">
		<div class="page-header">
			<div class="row">
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading">
						Remaining Flexible Funds
						<div class="pull-right">
							<a href="budget/breakdown" title="Breakdown" class="quickLink"><i class="fa fa-pie-chart"></i></a>
							<a href="budget/average" title="Averages" class="quickLink"><i class="fa fa-area-chart"></i></a>
							<a href="budget/summary" title="Summary" class="quickLink"><i class="fa fa-calendar"></i></a>
							<a href="budget/transaction" title="Add Transaction" class="quickLink"><i class="fa fa-plus"></i></a>
						</div>
					</div>
					<div class="panel-body">
						<div id="uxBudgetCategorySpotlight"></div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">
						Budget Trend
						<div class="budget-spotlight-as-of pull-right">
							<sub><i>Since Inception</i><sub>
						</div>
					</div>
					<div class="panel-body">
						<div id="uxBudgetSpotlight"></div>
						<div id="uxBudgetBalanceMetric"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading">Savings Breakdown</div>
					<div class="panel-body">
						<div id="uxBudgetFundSpotlight"></div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">
						Transaction Trend
					</div>
					<div class="panel-body">
						<div id="uxTransactionSpotlight"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading">Budget Summaries</div>
					<div class="panel-body">
						<div id="uxBudgetSummarySpotlight"></div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">
						Top 10 Transactions
						<div class="pull-right">
							<sub><i>Past Month</i><sub>
						</div>
					</div>
					<div class="panel-body">
						<div id="uxTransactionLeaderboard"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script id="tmplBudgetSpotlight" type="text/x-handlebars-template">
		<div class="budget-monthly-chart">
			<canvas id="uxBudgetAverageMonthlySpotlightChart"></canvas>
		</div>
	</script>

	<script id="tmplBudgetBalanceMetric" type="text/x-handlebars-template">
		<div class="budget-balance-metric text-center">
			<div id="uxBudgetBalance"></div>
		</div>
	</script>

	<script id="tmplBudgetCategorySpotlight" type="text/x-handlebars-template">
		<div class="currentMonth">
			<div id="uxBudgetMonth" class="summaryLink">
				<strong>{{BudgetMonth}}</strong>
			</div>
		</div>
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="categoryWidth"></th>
					<th class="progressWidth"></th>
					<th class="remainingWidth"></th>
				</tr>
			</thead>
			<tbody>
				{{#each BudgetCategorySpotlight}}
					<tr>
						<td>{{BudgetCategory}}</td>
						<td>
							<div class="progress progress-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{CategoryPercentageSpent}}%">
								<div class="progress-bar progress-bar-{{CategoryProgressBarStyle}}" style="width: {{CategoryPercentageSpent}}%"></div>
							</div>
						</td>
						{{#if IsCategoryNegativeFlg}}
							<td class="remaining amount-red">${{NumberCommaFormat CategoryActualVsBudget}}</td>
						{{else}}
							<td class="remaining">${{NumberCommaFormat CategoryActualVsBudget}}</td>
						{{/if}}
					</tr>
				{{/each}}
			</tbody>
			<tfoot>
				<tr>
					<td>
						<h4><strong>TOTAL</strong></h4>
					</td>
					<td>
						<div class="progress progress-striped progress-lg" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{TotalCategoryPercentageSpent}}%">
							<div class="progress-bar progress-bar-{{TotalCategoryProgressBarStyle}}" style="width: {{TotalCategoryPercentageSpent}}%"></div>
						</div>
					</td>
					<td class="remaining">
						{{#if IsTotalCategoryNegativeFlg}}
							<h4 class="amount-red"><strong>${{NumberCommaFormat TotalCategoryActualVsBudget}}</strong></h4>
						{{else}}
							<h4><strong>${{NumberCommaFormat TotalCategoryActualVsBudget}}</strong></h4>
						{{/if}}
					</td>
				</tr>
			</tfoot>
		</table>
	</script>

	<script id="tmplBudgetFundSpotlight" type="text/x-handlebars-template">
		<table class="table table-hover table-striped">
			<tbody>
				{{#each BudgetFundSpotlight}}
					<tr>
						<td><a class="normalLink" href="/budget/fund?FundID={{FundID}}">{{FundName}}</a></td>
						<td class="balance">${{NumberCommaFormat FundSpentVsReceived}}</td>
					</tr>
				{{/each}}
			</tbody>
			<tfoot>
				<tr>
					<td>
						<h4><strong>TOTAL</strong></h4>
					</td>
					<td class="balance">
						<h4><strong>${{NumberCommaFormat TotalFundSpentVsReceived}}</strong></h4>
					</td>
				</tr>
			</tfoot>
		</table>
	</script>

	<script id="tmplBudgetSummarySpotlight" type="text/x-handlebars-template">
		<div class="list-group text-center">
			{{#each BudgetSummarySpotlight}}
				<a class="list-group-item" href="/budget/summary?BudgetMonth={{BudgetMonthSummaryUrl}}">{{BudgetMonthSummary}}</a>
			{{/each}}
		</div>
	</script>

	<script id="tmplTransactionSpotlight" type="text/x-handlebars-template">
		<div class="text-center">
			<ul class="nav nav-pills transaction-pills">
				<li class="active"><a data-toggle="pill" href="#Weekly">Weekly</a></li>
				<li class=""><a data-toggle="pill" href="#Daily">Daily</a></li>
			</ul>
		</div>
		<div class="tab-content">
			<div id="Weekly" class="tab-pane fade in active">
				<div class="text-center">
					<br />
					<i><strong>Last 3 Months</strong></i>
				</div>
				<div class="transaction-week-chart">
					<canvas id="uxTransactionSpotlightWeeklyChart"></canvas>
				</div>
			</div>
			<div id="Daily" class="tab-pane fade">
				<div class="text-center">
					<br />
					<i><strong>Last 2 Weeks</strong></i>
				</div>
				<div class="transaction-day-chart">
					<canvas id="uxTransactionSpotlightDailyChart"></canvas>
				</div>
			</div>
		</div>
	</script>

	<script id="tmplTransactionLeaderboard" type="text/x-handlebars-template">
		<table class="table table-striped table-hover table-condensed small">
			<thead>
				<tr>
					<th scope="col" class="hidden-xs">Rank</th>
					<th scope="col">Date</th>
					<th scope="col">Description</th>
					<th scope="col" class="hidden-xs">Note</th>
					<th scope="col">Amount</th>
				</tr>
			</thead>
			<tbody>
				{{#each TransactionLeaderboard}}
				<tr>
					<th scope="row" class="hidden-xs">#{{RankID}}</th>
					<th scope="row">{{TransactionDTMask}}</th>
					<td>{{Description}} ({{BudgetCategory}})</td>
					<td class="hidden-xs">{{Note}}</td>
					<td>${{NumberCommaFormat Amount}}</td>
				</tr>
				{{/each}}
			</tbody>
		</table>
	</script>

	<?php require_once('include/footer.php'); ?>

	<script type="text/javascript" src="../../../controller/budget.controller.js"></script>
</body>

</html>