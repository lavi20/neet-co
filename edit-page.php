<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Check if page is passed in URL
if (!isset($_GET['page'])) {
    die("No page specified.");
}

$page = $_GET['page'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'neetcodb');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch content from database
$content = '';
$sql = "SELECT content FROM content WHERE page = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $page);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $content = $row['content'];
} else {
    $content = ''; // No content yet, new page
}

// Handle form submission (update or insert content)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newContent = $_POST['content'];

    if ($result->num_rows > 0) {
        $updateSql = "UPDATE content SET content = ? WHERE page = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param('ss', $newContent, $page);
        $updateStmt->execute();
    } else {
        $insertSql = "INSERT INTO content (page, content) VALUES (?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param('ss', $page, $newContent);
        $insertStmt->execute();
    }

    echo "<script>
        alert('Content updated successfully!');
        window.location.href='edit-page.php?page=" . htmlspecialchars($page) . "';
    </script>";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Page: <?php echo htmlspecialchars(ucwords(str_replace('.php', '', $page))); ?></title>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 500,
            menubar: true,
            plugins: 'advlist autolink lists link image charmap print preview anchor',
            toolbar: 'undo redo | formatselect | bold italic backcolor | \
                      alignleft aligncenter alignright alignjustify | \
                      bullist numlist outdent indent | removeformat | help'
        });

        // Improved iframe refresh (works better in some browsers)
        function reloadIframe() {
            const iframe = document.getElementById('previewFrame');
            iframe.src = iframe.src.split('?')[0] + '?' + new Date().getTime(); // Force cache refresh
        }
    </script>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 0; 
            background-color: #f4f4f4;
        }
        header, footer { 
            background: #007bff; 
            color: white; 
            padding: 10px; 
            text-align: center; 
        }
        header a { 
            color: white; 
            text-decoration: none; 
            margin-left: 15px; 
            font-weight: bold;
        }
        main { 
            display: flex; 
            height: calc(100vh - 120px); 
        }
        iframe { 
            flex: 1; 
            border: 1px solid #ccc; 
            background: white;
        }
        .editor-panel { 
            width: 400px; 
            padding: 15px; 
            background: #fff; 
            overflow-y: auto; 
            box-shadow: -2px 0 5px rgba(0,0,0,0.1);
        }
        button { 
            margin-top: 10px; 
            padding: 10px 15px; 
            background: #28a745; 
            color: white; 
            border: none; 
            cursor: pointer; 
            font-size: 16px;
        }
        button:hover { 
            background: #218838;
        }
        textarea { 
            width: 100%; 
            box-sizing: border-box; 
        }
        footer { 
            text-align: center; 
            padding: 10px; 
            background: #007bff; 
            color: white; 
            position: relative; 
            bottom: 0; 
            width: 100%;
        }
        @media (max-width: 768px) {
            main { flex-direction: column; }
            .editor-panel { width: 100%; }
        }
    </style>
</head>
<body>

<header>
    <h1>Editing: <?php echo htmlspecialchars(ucwords(str_replace('.php', '', $page))); ?></h1>
    <a href="dashboard.php">Back to Dashboard</a>
</header>

<main>
    <!-- Page Preview -->
    <iframe id="previewFrame" src="<?php echo htmlspecialchars($page); ?>"></iframe>

    <!-- Editor Panel -->
    <div class="editor-panel">
        <h3>Edit Page Content</h3>
        <form method="post">
            <textarea name="content"><?php echo htmlspecialchars($content); ?></textarea>
            <button type="submit" onclick="setTimeout(reloadIframe, 500);">Save Changes</button>
        </form>
    </div>
</main>

<footer>
    <p>&copy; 2025 NEET Advisor Admin Panel</p>
</footer>

</body>
</html>
