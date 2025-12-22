<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1> Library Management System</h1>
    <p class="subtitle">Manage your books easily and efficiently</p>

    <!-- Add Book Card -->
    <div class="card">
        <h2>Add New Book</h2>
        <form action="add_book.php" method="post">
            <input type="text" name="title" placeholder="Book Title" required>
            <input type="text" name="author" placeholder="Author Name" required>
            <input type="text" name="category" placeholder="Category" required>
            <input type="number" name="quantity" placeholder="Quantity" required>
            <button type="submit">➕ Add Book</button>
        </form>
    </div>

    <!-- Search Card -->
    <div class="card">
        <h2>Search Books</h2>
        <form action="search.php" method="get">
            <input type="text" name="category" placeholder="Enter category name">
            <button type="submit">🔍 Search</button>
        </form>
    </div>

    <!-- Book Table -->
    <div class="card">
        <h2>Available Books</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Qty</th>
                <th>Action</th>
            </tr>

            <?php
            include 'db.php';
            $result = mysqli_query($conn, "SELECT * FROM books");

            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>
                        <td>{$row['book_id']}</td>
                        <td>{$row['title']}</td>
                        <td>{$row['author']}</td>
                        <td>{$row['category']}</td>
                        <td>{$row['quantity']}</td>
                        <td>
                            <a class='delete-btn' href='delete_book.php?id={$row['book_id']}'>Delete</a>
                        </td>
                      </tr>";
            }
            ?>
        </table>
    </div>

</div>

</body>
</html>
