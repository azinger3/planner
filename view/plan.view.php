<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $pageTitle = 'Budget Plan';

            require_once('include/header.php');
        ?>

        <style>
            .budgetMonthHeader {
                font-size: 28px; 
                margin-bottom: 20px;
                margin-top: -5px;
            }

            .pager li > a, .pager li > span {
                background-color: #3498db !important;
                margin: 5px !important;
            }

            h1 {
                margin-top: 15px !important;
                margin-bottom: 48.5px !important;
            }
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
                <div class="row text-center">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8">
                        <ul class="pager">
                            <li class="previous"><a href="#">&larr;&nbsp;&nbsp;August 2017</a></li>
                            <li class="budgetMonthHeader">September 2017</li>
                            <li class="next"><a href="#">October 2017&nbsp;&nbsp;&rarr;</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
            </div>
            <!--Page Header END-->

            <!--Content START-->
            <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-10" style="margin-top: 10%;">
                    <div class="jumbotron text-center">
                        <h1>Start Planning for September</h1>
                        <p><a href="#" class="btn btn-info btn-lg btn-block">Go</a></p>
                    </div>
                </div>
                <div class="col-md-1" >
                </div>
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
