<?php
// Path to the JSON file
$file_path = 'werlrepo.json';

// Check if the file exists, and if so, read its content
if (file_exists($file_path)) {
    $json_data = file_get_contents($file_path);
    $repo_data = json_decode($json_data, true);
} else {
    $repo_data = ['repos' => []]; // If no file, initialize an empty array
}

// Check if data was sent via POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $repo_name = $_POST['repo_name'];
    $repo_description = $_POST['repo_description'];

    // Validate the data
    if (!empty($repo_name) && !empty($repo_description)) {
        // Create new repo array
        $new_repo = [
            'name' => $repo_name,
            'description' => $repo_description,
            'url' => 'https://github.com/werlhub/' . urlencode($repo_name),
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Add the new repo to the list of repositories
        $repo_data['repos'][] = $new_repo;

        // Save the updated data back to the JSON file
        if (file_put_contents($file_path, json_encode($repo_data, JSON_PRETTY_PRINT))) {
            echo json_encode(['message' => 'Repository created successfully!', 'repo' => $new_repo]);
        } else {
            echo json_encode(['message' => 'Error saving the repository data.']);
        }
    } else {
        echo json_encode(['message' => 'Both repo name and description are required.']);
    }
} else {
    echo json_encode(['message' => 'Invalid request method.']);
}
?>
