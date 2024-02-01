<?php
$db = new PDO('mysql:host=localhost;dbname=car_sales', 'username', 'password');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Image upload handling
    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $fileName = basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $fileName;
        $fileType = pathinfo($targetPath, PATHINFO_EXTENSION);

        // Check if file is an actual image
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            // Check if file already exists
            if (!file_exists($targetPath)) {
                // Allow certain file formats
                if (in_array($fileType, ['jpg', 'png', 'jpeg', 'gif'])) {
                    // Move file to uploads directory
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                        $imagePath = $targetPath;
                    } else {
                        echo json_encode(['error' => 'Sorry, there was an error uploading your file.']);
                        exit;
                    }
                  } else {
                    echo json_encode(['error' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.']);
                    exit;
                }
            } else {
                echo json_encode(['error' => 'Sorry, file already exists.']);
                exit;
            }
        } else {
            echo json_encode(['error' => 'File is not an image.']);
            exit;
        }
    }

    // SQL query to insert data into the database
    $stmt = $db->prepare("INSERT INTO cars (make, model, year, price, description, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$make, $model, $year, $price, $description, $imagePath]);

    echo json_encode(['success' => true]);
}
?>