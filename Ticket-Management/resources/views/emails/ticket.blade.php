<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Mail</title>
    <style>
        .label {
            margin-left: 40%;
            color: darkgreen;
        }
        .btn {
            margin-top: 3%;
            margin-left: 50%;
            cursor: pointer;
            color: white;
        }
        .btn:active {
            transform: translateY(1px);
        }
        .box {
            margin-left: 20%;
            margin-right: 20%;
        }
        p{
            font-size: 15px;
        }
    </style>
</head>
<body>
<div class="box">
    <form>
        @csrf
        <div class="form_box">
            <h1 class="label">Ticket were created!!!</h1>
            <hr>
            <div>
                <p>Hello, Admin</p>
                <p>The ticket is created. Here is ticket details.</p>
            </div>
            <div class="panel">
                <div>
                    <pre>
                        <b>Title       : </b> {{ $ticket->titles }}
                        <b>Created by  : </b> {{ $ticket->user->name }}
                    </pre>
                    <p></p>
                </div>
            </div>
            <p>Lets check it's need and assign the agent to that ticket !!!</p>
            <a class="btn btn-secondary" href="{{ route('tickets.edit',$ticket->id)}}">Assign Ticket</a>
        </div>
    </form>
</div>
</body>
</html>
