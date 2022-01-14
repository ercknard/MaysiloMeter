<head>
    <meta charset="UTF-8">
    <title>Table</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
    body{
        background-color: lightblue;
    }
        .wrapper{
            width: 950px;
            margin: auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                    <img class="img-responsive center-block d-block mx-auto" src="/images/banner.png" width="309px" height="104px">
                    <hr color="lightblue" width="100%">
                        <h2 class="pull-left">Table      </h2>
                    </div>
                    <iframe width="100%" height="550px" frameborder="0" src="https://industrial.ubidots.com/app/dashboards/public/widget/gXYO-iVyQLnBFBsmAuDCjktcDItASgnV4ItZfaSgKwY?embed=true"></iframe>
                    </div>
                    <div class="form-group">
                        <br>
                    <p> Click the button below to generate PDF file </p>
                        <a href="Printable.php" class="btn btn-primary" onclick="window.print();return false;">Export as PDF</a>
                    </div>
            </div>        
        </div>
    </div>
</body>
</html>