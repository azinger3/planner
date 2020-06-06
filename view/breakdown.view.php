<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $pageTitle = 'Breakdown';

    require_once('include/header.php');

    require_once('include/icon.budget.php');
    ?>

    <style>
        .amount-red {
            color: red;
        }

        .transactionDetail {
            width: 20%;
        }

        .averageHeader {
            font-size: 28px;
            margin-bottom: 20px;
            margin-top: -5px;
        }

        .breakdownContainer {
            margin-top: 25px;
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
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="averageHeader">Breakdown</div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="pull-right" id="uxBudgetYearOption"></div>
            </div>
        </div>
        <div class="row">
            <div class="breakdownContainer">
                <canvas id="uxBudgetBreakdownChart"></canvas>
            </div>
        </div>
    </div>

    <script id="tmplBudgetYearOption" type="text/x-handlebars-template">
        {{#each BudgetYear}}
            <option value="{{YearValue}}">{{YearName}}</option>
        {{/each}}
    </script>

    <?php require_once('include/footer.php'); ?>

    <script type="text/javascript" src="../../../controller/breakdown.controller.js"></script>
</body>

</html>