<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1 class="title">add new category</h1>

    <form id="addCategoryForm" class="form">
        <div>
            <label for="name" class="label">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="inputGroup">
            <label for="description" class="label">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>
        <div class="buttonContainer">
            <button type="submit" class="button">create</button>
        </div>
    </form>

    <div id="successMessage"></div>

    <script>
        $(document).ready(function() {
            $('#addCategoryForm').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: '<?php echo __SITE_URL; ?>/index.php?rt=categories/add',
                    type: 'POST',
                    data: 
                    { 
                        action: "add",
                        name: $('#name').val(),
                        description: $('#description').val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#successMessage').text(data.message);
                        // Clear form fields
                        $('#name').val('');
                        $('#description').val('');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                        $('#successMessage').text('Failed to add category.');
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
