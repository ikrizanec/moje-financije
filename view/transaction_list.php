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
    <button id="addBtn">Add Transaction</button>
    <p id="test"></p>

    <script>
        $.ajax(
        {
            url: '<?php echo __SITE_URL; ?>/index.php?rt=transactions',
            type: 'GET',
            data: 
            { 
                action: "list"
            },
            dataType: 'json',
            success: function(data) {
                let output = "";
                data.transactions.forEach(transaction => {
                    output += `<p> Category: ${transaction.category_name}, Amount: ${transaction.amount}, Date: ${transaction.transaction_date}, Type: ${transaction.type}, Description: ${transaction.description}</p>`;
                });
                $('#test').html(output);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                $('#test').html('An error occurred while fetching transactions.');
            }
        } );

        $('#addBtn').click(function() {
                window.location.href = '<?php echo __SITE_URL; ?>/index.php?rt=transactions/add';
        });
    </script>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
