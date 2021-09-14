<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>Recommend System</title>
        <link rel="icon" type="image/x-icon" href="{{asset('assets/favicon.ico')}}" />
    </head>
    
    <body class="antialiased">
        <ul>
            <li class="list-group-item list-group-item-dark" style="float:right;margin:7px; font-size: large;right:20%;"><a class="nav-link" href="/">Home</a></li>
        </ul>
        <br>  
        <br>
        <div class="container">
            <form method="POST" action="/delete">
                @csrf
                <h4>Delete one data(by index)</h4>
                <input name="index" type="text" name="del">
                <input type="submit" value="Delete id">
                <p style="color:red;">{{ $delete_error}}{{ $static }}{{ $text }}</p>
            </form>

            <form method="POST" action="/search">
                @csrf
                <h4>Search (by User ID)</h4>
                <input name="index_search" type="text">
                <input type="submit"value="Search User">
                <p style="color:red;">{{ $search_error}}</p>
            </form>

            <form method="POST" action="/modify">
                @csrf
                <h4>Modify one data(by index)</h4>
                User_ID : <input name="userId" type="text" >
                Movie_ID : <input name="movieId" type="text">
                Rating : <input name="rating" type="text">
                <input type="submit" value="Modify data">
                <p style="color:red;">{{ $modify_error}}</p>
            </form>
            <p style="color:red;"></p>
        </div>

        <div class="container">
            <h3 style="color:black;">Data base</h3>
            <table class="table table-bordered table-striped">
                <tr>
                    <td><h4 style="color:brown;">Index</h4></td>
                    <td><h4 style="color:brown;">User ID</h4></td>
                    <td><h4 style="color:brown;">Movie ID</h4></td>
                    <td><h4 style="color:brown;">Rating</h4></td>
                    <td><h4 style="color:brown;">Timestamp</h4></td>
                    <td></td>
                </tr>
                @foreach($movies as $movie)
                <tr>
                    <td>{{ $movie['index_id'] }}</td>
                    <td>{{ $movie['userId'] }}</td>
                    <td>{{ $movie['movieId'] }}</td>
                    <td>{{ $movie['rating'] }}</td>
                    <td>{{ $movie['timestamp'] }}</td>
                    <td> 
                        <form method="POST" action="/delete_withrow">
                        @csrf
                            <input type="hidden" name="delete_id" value="{{ $movie->id }}"/>
                            <button class="btn btn-danger" type="submit">刪除</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </body>
</html>
