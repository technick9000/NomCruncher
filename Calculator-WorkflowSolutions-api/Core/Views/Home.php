<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="index, follow">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- !TODO include any scripts ,styles etc if needed-->
    <title>NumberCruncher-REST APi</title>
    <link rel="stylesheet" href="./assets/styles/main.css"/>
</head>
<body>

{{content}}


<div class="main_content">
    <div class="container">

        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <h1 class="display-4">@WorkflowSolutions</h1>
            </div>

        </div>

        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <h1>NumberCruncher-REST APi</h1>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <ul class="nav">
                <li class="nav-item">
                    <h3>
                        <a class="nav-link active" href="/">Home</a>
                    </h3>
                </li>
                <li class="nav-item">
                    <span class="nav-link blockquote">|</span>
                </li>
                <li class="nav-item">
                    <h3>
                        <a class="nav-link" href="#" id="toggleComponent">Toggle Ellement</a>
                    </h3>
                </li>
                <li class="nav-item">
                    <span class="nav-link blockquote">|</span>
                </li>
                <li class="nav-item">
                    <h3>
                        <a class="nav-link" href="#">Docs</a>
                    </h3>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <h6>Author
                    <i><?= $__author_name; ?>&copy;</i>
                    <script>document.write(new Date().getFullYear());</script>
                </h6>
            </div>

            <form method="post" action="/calc" accept-charset="utf-8"  class="d-flex">
                <input class="form-control me-2" type="input" name="equation" placeholder="Equation" aria-label="Equation">
                <input class="form-control me-2" type="input" name="result" placeholder="Result" aria-label="Result">
                <button class="btn btn-outline-success" type="submit">Calc</button>
            </form>

        </div>
        <div class="row ">
            <div class="col-12 d-flex justify-content-center ">
                <img src="./assets/img/number_cruncher.png" alt="I crunch numbers like im eating cake"
                     title="I crunch numbers like im eating cake" class="logo-img"></div>


        </div>

    </div>

</div>


<div class="row hide-the-component" id="the-component">
    <div class="col-lg d-flex justify-content-center flex-row">
        {{content2}}
    </div>
    <br/> <h5>This second menu is just to show the use of multiple components </h5>
</div>
</body>


<div class="circle-btl"></div>
<div class="circle-btl1 rounded-circle"></div>
<div class="circle-btl2 rounded-circle"></div>
<div class="circle-tpr rounded-circle"></div>
<div class="circle-tpr1 rounded-circle"></div>
<div class="circle-tpr2 rounded-circle"></div>


<!--cripts-->
<script defer src="./assets/scripts/main.js"></script>

</body>
</html>