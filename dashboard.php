<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// List of pages - Use clean names (no spaces, use underscores or hyphens instead)
$pages = [
    'about.php',
    'career.php',
    'contact.php',
    'gallery.php',
    'index.php',
    'neet_services.php'  // Changed to avoid space issue
];

// Optional: Map display names if you want friendly names shown in the dashboard
$pageDisplayNames = [
    'about.php' => 'About Us',
    'career.php' => 'Career',
    'contact.php' => 'Contact Us',
    'gallery.php' => 'Gallery',
    'index.php' => 'Home Page',
    'neet_services.php' => 'NEET Services'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 50px; }
        h2 { margin-bottom: 20px; }
        ul { list-style: none; padding: 0; }
        li { margin: 10px 0; }
        a { text-decoration: none; color: blue; }
        a:hover { text-decoration: underline; }
        .logout { margin-top: 20px; }
    </style>
</head>
<body>

<h2>Welcome to Admin Dashboard</h2>
<p>Select a page to edit:</p>

<ul>
    <?php foreach ($pages as $page): ?>
        <li>
            <?php 
                // Use friendly display name if available
                $displayName = isset($pageDisplayNames[$page]) ? $pageDisplayNames[$page] : $page;
                echo htmlspecialchars($displayName);
            ?>
            <a href="edit-page.php?page=<?php echo urlencode($page); ?>">[Edit]</a>
        </li>
    <?php endforeach; ?>
</ul>

<form method="post" action="logout.php" class="logout">
    <button type="submit">Logout</button>
</form>

</body>
</html>
