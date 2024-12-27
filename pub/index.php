<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link href="./output.css" rel="stylesheet">
</head>
<body class="bg-amber-200">
    <main class="p-4 items-center justify-center">
        <form method="POST" action="save_event.php" class="space-y-4 p-4 bg-amber-400 rounded-xl items-center">
            <h2 class="text-2xl font-bold">Create an Event</h2>
            <label for="title" class="font-semibold">Event Title:</label>
            <input type="text" id="title" name="title" class="w-full p-2 rounded-lg" required />

            <label for="description" class="font-semibold">Description:</label>
            <textarea id="description" name="description" class="w-full p-2 rounded-lg"></textarea>

            <label for="date" class="font-semibold">Event Date:</label>
            <input type="date" id="date" name="date" class="w-full p-2 rounded-lg" required />

            <label for="type" class="font-semibold">Event Type:</label>
            <select id="type" name="type" class="w-full p-2 rounded-lg">
                <option value="conference">Conference</option>
                <option value="webinar">Webinar</option>
                <option value="workshop">Workshop</option>
            </select>

            <label for="price" class="font-semibold">Ticket Price ($):</label>
            <input type="number" id="price" name="price" class="w-full p-2 rounded-lg" min="0" required />

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Submit</button>
        </form>
    </main>
</body>
</html>

<!-- view_events.php -->
<?php
require 'db_connection.php';

$order = $_GET['order'] ?? 'date';
$sort = $_GET['sort'] ?? 'ASC';
$sql = "SELECT * FROM events ORDER BY $order $sort";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events</title>
    <link href="./output.css" rel="stylesheet">
</head>
<body class="bg-amber-200">
    <main class="p-4">
        <table class="table-auto w-full bg-white rounded-xl">
            <thead>
                <tr>
                    <th><a href="?order=title&sort=<?= $sort == 'ASC' ? 'DESC' : 'ASC' ?>">Title</a></th>
                    <th>Description</th>
                    <th><a href="?order=date&sort=<?= $sort == 'ASC' ? 'DESC' : 'ASC' ?>">Date</a></th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= htmlspecialchars($row['description']) ?></td>
                        <td><?= htmlspecialchars($row['date']) ?></td>
                        <td><?= htmlspecialchars($row['type']) ?></td>
                        <td><?= htmlspecialchars($row['price']) ?></td>
                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
