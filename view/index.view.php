<!DOCTYPE html>
<html lang="en">

<head>

<?php
    $pageTitle = 'Planner';

    require_once('include/header.php');

    require_once('include/icon.index.php');
?>

<style>
    body {
        background-color: #2c3e50;
    }

    a.plannerButton {
        font-size: 12vw;
        display: inline-block;
        padding: 10px;
    }

    a.plannerButton, a.plannerButton:visited, a.plannerButton:link {
        color: #FFF;
    }

    a.plannerButton:hover {
        color: #DCDCDC;
    }

    .text-center {
        text-align: center;
    }
</style>

</head>
<body>
  <?php require_once('include/navigation.index.php'); ?>

  <div class="container">
      <div class="page-header">
          <div class="row">
          </div>
      </div>
      <div class="row text-center">
         <div class="col-md-6">
            <a href="/budget" class="plannerButton" title="Budget"><span class="fa fa-usd"></span></a>
         </div>
         <div class="col-md-6">
            <a href="#" class="plannerButton" title="To Do List"><span class="fa fa-list"></span></a>
         </div>
      </div>
      <div class="row text-center">
         <div class="col-md-6">
            <a href="#" class="plannerButton" title="Tracker"><span class="fa fa-thumb-tack"></span></a>
         </div>
         <div class="col-md-6">
            <a href="#" class="plannerButton" title="Wish List"><span class="fa fa-magic"></span></a>
         </div>
      </div>
  </div>

  <?php require_once('include/footer.php'); ?>

  <script>
    $(document).ready(function() {
      console.log("Ready!");
    });
  </script>

</body>
</html>