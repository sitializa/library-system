<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Library System</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 0 auto; padding: 20px; }
        nav a { text-decoration: none; color: #2563eb; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f3f4f6; }
    </style>
</head>
<body>
    <header>
        <h1>Library System</h1>
        <nav>
            <a href="/dashboard">Dashboard</a> |
            <a href="/books">Books</a> |
            <a href="/categories">Categories</a> |
            <a href="/members">Members</a>
        </nav>
        <hr>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <hr>
        <p>&copy; Library System - Siti Aliza Sulthania</p>
    </footer>
</body>
</html>