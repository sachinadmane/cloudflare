<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- CSS files-->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">


    <style>

        .h1{
            /*font-size:100px;*/
        }
        .btn{
            margin-right:15px;
        }

        .deactive_certificate{
            color:#d4260a!important;
            font-weight: bold;
            font-size: 13px;
            margin: 0 15px;
        }

        .active_certificate{
            color: #168816!important;
            font-weight: bold;
            font-size: 13px;
            margin: 0 15px;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script  src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
    <script type="text/javascript" src="/assets/js/form_validation.js"></script>

    <script src="/assets/js/customers_table.js"></script>


</head>
<body>
<!-- page content -->

<br>
<h1 class="col-md-12 text-center" style="color: black"> You can add/view and delete Customers here</h1>


<br>

<div class="table-responsive col-md-10">

    <table class="table table-bordered table-striped table-hover table-condensed  text-center" id="DyanmicTable">
        <thead>
        <tr>
            <th class="text-center">
                First Name
            </th>
            <th class="text-center">
                Last Name
            </th>
            <th class="text-center">
                Email
            </th>

            <th class="text-center">
                Certificates
            </th>

            <th class="text-center">
                Actions
            </th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<div class="clearfix">

</div>

<div class="container">


    <form class="well form-horizontal"   id="contact_form">
        <fieldset>

            <!-- Form Name -->
            <legend><center><h2><b>Registration Form</b></h2></center></legend><br>

            <!-- Text input-->

            <div class="form-group">
                <label class="col-md-4 control-label">First Name</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="first_name"  name="first_name" placeholder="First Name" class="form-control"  type="text">
                    </div>
                </div>
            </div>

            <!-- Text input-->

            <div class="form-group">
                <label class="col-md-4 control-label" >Last Name</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="last_name" name="last_name" placeholder="Last Name" class="form-control"  type="text">
                    </div>
                </div>
            </div>



            <!-- Text input-->



            <!-- Text input-->

            <div class="form-group">
                <label class="col-md-4 control-label" >Password</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="user_password" name="user_password" placeholder="Password" class="form-control"  type="password">
                    </div>
                </div>
            </div>

            <!-- Text input-->

            <div class="form-group">
                <label class="col-md-4 control-label" >Confirm Password</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input name="confirm_password" data-fv-identical="true" placeholder="Confirm Password" class="form-control"  type="password">
                    </div>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">E-Mail</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input id="email" name="email" placeholder="E-Mail Address" class="form-control"  type="text">
                    </div>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4"><br>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button id="addCustomer" type="submit" class="btn btn-warning" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspAdd Customer <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
                </div>
            </div>

        </fieldset>
    </form>

</div><!-- /.container -->



</body>
</html>



