<?php
session_start();
require_once 'utilities/header_footer.php';
require_once 'utilities/pdo.php';

// Check if user is logged in
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit;
}

title_bar("VeloWorld | Member Page");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $imagePath = null;

    // Handle uploaded image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $uploadDir = 'images/items/stock/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        // Sanitise filename and generate unique name
        $originalName = basename($_FILES['image']['name']);
        $ext = pathinfo($originalName, PATHINFO_EXTENSION);
        $imageName = time() . '_' . preg_replace("/[^a-zA-Z0-9_-]/", "", pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $ext;

        $imagePath = $uploadDir . $imageName;

        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    // Insert item into database
    $sql = "INSERT INTO items (item_name, colour, description, price, quantity, image) 
            VALUES (:item_name, :colour, :description, :price, :quantity, :image)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':item_name'   => $_POST['item_name'],
        ':description' => $_POST['description'],
        ':price'       => $_POST['price'],
        ':colour'      => $_POST['colour'],
        ':quantity'    => $_POST['quantity'],
        ':image'       => $imagePath
    ]);

    $_SESSION['item_added'] = "Item added successfully!";
    header("Location: insert_item.php");
    exit;
}
?>

<main>
    <h1>Member Area</h1>

    <?php
    // Show success message
    if (isset($_SESSION['item_added'])) {
        echo "<p style='color:green; font-weight:bold;'>" . htmlentities($_SESSION['item_added']) . "</p>";
        unset($_SESSION['item_added']);
    }
    ?>

    <form method="post" class="forms" enctype="multipart/form-data">
        <fieldset>
            <legend>Item Details</legend>

            <label for="item_name">Item Name:</label>
            <input type="text" id="item_name" name="item_name" required placeholder="Mountain Bike">

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required placeholder="Describe the item..."></textarea>

            <label for="price">Price (£):</label>
            <input type="number" id="price" name="price" min="0" step="0.01" required>

            <label for="colour">Colour:</label>
            <input type="text" id="colour" name="colour" required placeholder="Insert colour of the item...">

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="0" required>

            <label for="image">Item Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </fieldset>

        <input type="submit" value="Add Item" class="btn">
    </form>

    <a href="member.php" class="btn">Go Back</a>
</main>

<?php footer_bar(); ?>
