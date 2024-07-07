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
    <main>
    <p id="test"></p>

    <script>
        $.ajax(
        {
            url: '<?php echo __SITE_URL; ?>/index.php?rt=savings',
            type: 'GET',
            data: 
            { 
                action: "list"
            },
            dataType: 'json',
            success: function(data) {
                let output = "";
                data.savings.forEach(saving => {
                    output += `<p> Name: ${saving.savings_name}, Goal: ${saving.savings_goal}, Balance: ${saving.current_balance}, Deadline: ${saving.deadline}</p>`;
                });
                $('#test').html(output);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                $('#test').html('An error occurred while fetching savings.');
            }
        } );
    </script>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
