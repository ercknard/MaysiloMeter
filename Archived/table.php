<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Table</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <form>
        <div class="form-group mt-5">
            <label for="contact">Contact #</label>
            <input class="form-control" type="number" id="contact">
        </div>
    </form>
    <div class="row justify-content-center align-items-center mt-5">
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Contact #</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Joshua</td>
                    <td>Garcia</td>
                    <td class="contactnum">09167738202</td>
                    <td><button class="view-record btn btn-primary">View</button></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Alfred</td>
                    <td>Butista</td>
                    <td class="contactnum">0912333312323</td>
                    <td><button class="view-record btn btn-primary">View</button></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Rio</td>
                    <td>Carpio</td>
                    <td class="contactnum">09141234121</td>
                    <td><button class="view-record btn btn-primary">View</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

    
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<script type="text/javascript">

    $(".view-record").on('click', function(){
        $contactNum = $(this).closest("tr")   // Finds the closest row <tr> 
					.find(".contactnum")     // Gets a descendent with class="contactnum"
					.text(); 
        $("#contact").val($contactNum)
    })
    
</script>
</html>