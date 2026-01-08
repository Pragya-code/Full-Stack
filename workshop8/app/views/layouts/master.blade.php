<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; }
        .btn-edit { background: #4CAF50; color: white; }
        .btn-delete { background: #f44336; color: white; }
        .btn-add { background: #008CBA; color: white; }
        form { max-width: 400px; }
        input { width: 100%; padding: 8px; margin: 5px 0; }
        button { padding: 10px 15px; background: #4CAF50; color: white; border: none; }
    </style>
</head>
<body>
    <h1>@yield('title')</h1>
    @yield('content')
</body>
</html>