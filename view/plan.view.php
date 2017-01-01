<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $pageTitle = 'Budget Plan';

            require_once('include/header.php');
        ?>

        <style>

        </style>
    </head>
    <body>

        <!--Navigation START-->
        <?php require_once('include/navigation.budget.php'); ?>
        <!--Navigation END-->

        <!--Container START-->
        <div class="container">
            <!--**********************************************************Main Content START**********************************************************-->
            
            <!--Page Header START-->
            <div class="page-header">
                <div class="row">
                </div>
            </div>
            <!--Page Header END-->

            <!--Content START-->
            <div class="row">

            </div>
            <div class="row">

            </div>
            <!--Content END-->

            <!--**********************************************************Main Content END**********************************************************-->
        </div>
        <!--Container END-->

        <!--Templates START-->
        <script id="tmpl" type="text/x-handlebars-template">

        </script>
        <!--Templates END-->

        <!--Footer START-->
        <?php 
            require_once('include/footer.php'); 
        ?>
        <!--Footer END-->

        <!--Javascript START-->
        <script>
            var api = "http://api.jordanandrobert.com/budget";
            var data = new Object();

            $(document).ready(function() {
                console.log("Ready!");

               
            });

           
        </script>
        <!--Javascript END-->
    </body>
</html>
