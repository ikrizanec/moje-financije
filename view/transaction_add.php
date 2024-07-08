<?php require_once __SITE_PATH . '/view/_header.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Transaction</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <h1>Add Transaction</h1>

    <form id="addTransactionForm">
        <div>
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id_category']; ?>"><?php echo $category['category_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount" required>
        </div>
        <div>
            <label for="date">Date:</label>
            <input type="text" id="date" name="date" required>
        </div>
        <div>
            <label>Description:</label><br>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>
        <div>
            <label>Type:</label><br>
            <input type="radio" id="income" name="type" value="income" required>
            <label for="income">Income</label>
            <input type="radio" id="expense" name="type" value="expense" required>
            <label for="expense">Expense</label>
        </div>
        <div>
            <button type="submit">Create</button>
        </div>
    </form>

    <div id="successMessage"></div>

    <script>
        $(document).ready(function() {
            $('#date').datepicker({ dateFormat: 'yy-mm-dd' });

            $('#addTransactionForm').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: '<?php echo __SITE_URL; ?>/index.php?rt=transactions/add',
                    type: 'POST',
                    data: {
                        action: "add",
                        amount: $('#amount').val(),
                        description: $('#description').val(),
                        type: $('input[name="type"]:checked').val(),
                        category: $('#category').val(), 
                        date: $('#date').val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#successMessage').text(data.message);
                        $('#addTransactionForm')[0].reset();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                        $('#successMessage').text('Failed to add transaction.');
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
