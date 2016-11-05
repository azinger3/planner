<!DOCTYPE html>
<html lang="en">

<head>

<?php
  $pageTitle = 'Planner';

  require_once('include/header.php');
?>

<style>
    body {
        background-color: #2c3e50;
    }

    a.plannerButton {
        font-size: 15vw;
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

  <!--Navigation START-->

  <div id="navigation"></div>

  <!--Navigation END-->

  <!--Container START-->

  <div class="container">

      <!--Page Header START-->

      <div class="page-header">
          <div class="row">
          </div>
      </div>

      <!--Page Header END-->

      <!--**********************************************************Main Content START**********************************************************-->

      <div class="row text-center">
          <div class="col-md-4">
              <a href="/budget" class="plannerButton" title="Budget"><span class="fa fa-usd"></span></a>
          </div>
          <div class="col-md-4">
              <a href="#" class="plannerButton" title="To Do List"><span class="fa fa-list"></span></a>
          </div>
          <div class="col-md-4">
              <a href="#" class="plannerButton" title="Tracker"><span class="fa fa-thumb-tack"></span></a>
          </div>
      </div>
      <div class="row text-center">
          <div class="col-md-3">
          </div>
          <div class="col-md-3">
              <a href="#" class="plannerButton" title="Wish List"><span class="fa fa-magic"></span></a>
          </div>
          <div class="col-md-3">
              <a href="#" class="plannerButton" title="Administration"><span class="fa fa-cog"></span></a>
          </div>
          <div class="col-md-3">
          </div>
      </div>

      <!--**********************************************************Main Content END**********************************************************-->

  </div>

  <!--Container END-->

  <?php require_once('include/footer.php'); ?>

  <script type="text/babel" src="../../../component/navigation.js"></script>

  <script>
    $(document).ready(function() {
      console.log("ready!");

      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>

</body>
</html>
