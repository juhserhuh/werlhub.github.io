<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create a Repo - Werlhub</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>Werlhub - Create a New Repository</h1>
</header>

<main>
    <section class="create-repo">
        <form id="create-repo-form">
            <label for="repo-name">Repository Name</label>
            <input type="text" id="repo-name" name="repo_name" required placeholder="Enter repo name">

            <label for="repo-description">Description</label>
            <textarea id="repo-description" name="repo_description" required placeholder="Enter repo description"></textarea>

            <button type="submit">Create Repo</button>
        </form>
        <div id="response-message"></div>
    </section>
</main>

<script>
// Handle form submission with AJAX
document.getElementById('create-repo-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form from submitting the traditional way

    var formData = new FormData(this);

    // Send the form data via AJAX to the PHP script
    fetch('createRepo.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Display response message from the PHP script
        var messageDiv = document.getElementById('response-message');
        messageDiv.textContent = data.message;
        messageDiv.style.color = data.message.includes('successfully') ? 'green' : 'red';
        
        // Optionally, reset the form
        if (data.message.includes('successfully')) {
            document.getElementById('create-repo-form').reset();
        }
    })
    .catch(error => {
        document.getElementById('response-message').textContent = 'An error occurred. Please try again later.';
    });
});
</script>

</body>
</html>
