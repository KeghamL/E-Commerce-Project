<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <div class="pull-right">

            <a class="btn btn-danger" href="javascript:history.back()"> Back</a>

        </div>

        <li class="nav-item active">>
            <a href="/dashboard"><button class="btn btn-info" type="submit">Home</button></button></a>
        </li>


    </nav>

    <table class="table">
        <thead>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Email</th>
            <th>Password</th>
            <th>Birthday</th>
            <th>Gender</th>
        </thead>
        <tbody>
            <tr>
                <td>{{ $data->fname }}</td>
                <td>{{ $data->lname }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->password }}</td>
                <td>{{ $data->birthday }}</td>
                <td>{{ $data->gender }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
