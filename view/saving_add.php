<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Saving</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <h1>Add Saving</h1>

    <form id="addSavingForm">
        <div>
            <label for="savings_name">Savings Name:</label>
            <input type="text" id="savings_name" name="savings_name" required>
        </div>
        <div>
            <label for="savings_goal">Savings Goal:</label>
            <input type="number" id="savings_goal" name="savings_goal" required>
        </div>
        <div>
            <label for="deadline">Deadline:</label>
            <input type="text" id="deadline" name="deadline" required>
        </div>
        <div>
            <button type="submit">Create</button>
        </div>
    </form>

    <div id="successMessage"></div>

    <script>
        $(document).ready(function() {
            $('#deadline').datepicker({ dateFormat: 'yy-mm-dd' });

            $('#addSavingForm').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: '<?php echo __SITE_URL; ?>/index.php?rt=savings/add',
                    type: 'POST',
                    data: {
                        action: "add",
                        savings_name: $('#savings_name').val(),
                        savings_goal: $('#savings_goal').val(),
                        deadline: $('#deadline').val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#successMessage').text(data.message);
                        $('#addSavingForm')[0].reset();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                        $('#successMessage').text('Failed to add saving.');
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
