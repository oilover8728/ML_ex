<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Recommend System</title>
  <link rel="icon" type="image/x-icon" href="{% static 'assets/favicon.ico' %}" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="icon" type="image/x-icon" href="{% static 'assets/favicon.ico' %}" />

</head>

<body>
  <ul>
    <li class="list-group-item list-group-item-dark" style="float:right;margin:7px; font-size: large;right:20%;"><a class="nav-link" href="/">Home</a></li>
    <li class="list-group-item list-group-item-dark" style="float:left;margin:7px; font-size: large;left:20%;"><a class="nav-link"href="/index">Back</a></li>
  </ul>
  <br>  
  <br>
  <div class="container">
            <h3 style="color:black;">Data base</h3>
            <table class="table table-bordered table-striped">
                <tr>
                    <td><h4 style="color:brown;">Index</h4></td>
                    <td><h4 style="color:brown;">User ID</h4></td>
                    <td><h4 style="color:brown;">Movie ID</h4></td>
                    <td><h4 style="color:brown;">Rating</h4></td>
                    <td><h4 style="color:brown;">Timestamp</h4></td>
                </tr>
                @foreach($movies as $movie)
                <tr>
                    <td>{{ $movie['index_id'] }}</td>
                    <td>{{ $movie['userId'] }}</td>
                    <td>{{ $movie['movieId'] }}</td>
                    <td>{{ $movie['rating'] }}</td>
                    <td>{{ $movie['timestamp'] }}</td>
                </tr>
                @endforeach
            </table>
        </div>

</body>

</html>