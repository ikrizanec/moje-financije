<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje financije</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <button id="addCategoryBtn">Add Category</button>
    <p id="test"></p>


    <script>
        $.ajax(
        {
            url: '<?php echo __SITE_URL; ?>/index.php?rt=categories',
            type: 'GET',
            data: 
            { 
                action: "list"
            },
            dataType: 'json',
            success: function(data) {
                let output = "";
                data.categories.forEach(category => {
                    output += `<p> Name: ${category.category_name}, Description: ${category.description}</p>`;
                });
                $('#test').html(output);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                $('#test').html('An error occurred while fetching categories.');
            }
        } );

        // Button click event handler
        $('#addCategoryBtn').click(function() {
                window.location.href = '<?php echo __SITE_URL; ?>/index.php?rt=categories/add';
        });
    </script>
</body>
</html>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
