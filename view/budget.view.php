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
			width: 15%;
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
	</style>
</head>

<body>
	<?php require_once('include/navigation.budget.php'); ?>

	<div class="container">
		<div class="page-header">
			<div class="row">
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
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
				<div class="panel panel-primary">
					<div class="panel-heading">
						Transaction Trends
						<div class="pull-right">
							<sub><i>Last 3 Months</i><sub>
						</div>
					</div>
					<div class="panel-body">
						<div id="uxTransactionSpotlight"></div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading">Savings Breakdown</div>
					<div class="panel-body">
						<div id="uxBudgetFundSpotlight"></div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">Budget Summaries</div>
					<div class="panel-body">
						<div id="uxBudgetSummarySpotlight"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script id="tmplBudgetCategorySpotlight" type="text/x-handlebars-template">
		<div class="currentMonth">
			<a id="uxBudgetMonth" class="summaryLink" href="/budget/plan">
				<strong>{{BudgetMonth}}</strong>
			</a>
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
		<div class="center-me">
			<ul class="nav nav-pills">
				<li class="active"><a data-toggle="pill" href="#Weekly">Weekly</a></li>
				<li class=""><a data-toggle="pill" href="#Daily">Daily</a></li>
			</ul>
		</div>
		<div class="tab-content">
			<div id="Weekly" class="tab-pane fade in active">
				<canvas id="uxTransactionSpotlightWeeklyChart"></canvas>

				<table>
					<thead>
						<th>KeyID</th>
						<th>TransactionID</th>
						<th>DateRangeWeekBegin</th>
						<th>DateRangeWeekEnd</th>
						<th>TransactionCountWeekly</th>
					</thead>
					<tbody>
						<td>{{KeyID}}</td>
						<td>{{TransactionID}}</td>
						<td>{{DateRangeWeekBegin}}</td>
						<td>{{DateRangeWeekEnd}}</td>
						<td>{{TransactionCountWeekly}}</td>
					</tbody>
				</table>
			</div>
			<div id="Daily" class="tab-pane fade">
				<h3>Menu 1</h3>
				<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			</div>
		</div>
	</script>

	<?php require_once('include/footer.php'); ?>

	<script type="text/javascript" src="../../../controller/budget.controller.js"></script>
</body>

</html>