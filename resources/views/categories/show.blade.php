<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo config('app.name')?></title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
</head>
<body>
<div class="container">
    <h1 class="mb-3">{{$title}}</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover" border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Parent ID</th>
                <th>Created At</th>
                <th>updated At</th>
            </tr>
                <tr>
                    <td>{{$category->id}}</td>
                    <td><a href="{{route('dashboard.categories.show',$category->id)}}">{{$category->name}}</a></td>
                    <td>{{$category->slug}}</td>
                    <td>{{$category->parent_id}}</td>
                    <td>{{$category->created_at}}</td>
                    <td>{{$category->updated_at}}</td>
                </tr>
        </table>
    </div>
</div>
</body>

</html>
