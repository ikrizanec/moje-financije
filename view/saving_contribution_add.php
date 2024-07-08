<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_savings = $_POST['id_savings'];
    $id_user = $_POST['id_user'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Contribution</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1 class="title">Add New Contribution</h1>

    <form id="addContributionForm" class="form">
        <input type="hidden" id="id_saving" name="id_saving" value="<?php echo $id_savings; ?>">
        <input type="hidden" id="id_user" name="id_user" value="<?php echo $id_user; ?>">
        <div>
            <label for="balance" class="label">New Balance:</label>
            <input type="number" id="balance" name="balance" required>
        </div>
        <div class="buttonContainer">
            <button type="submit" class="button">Add Contribution</button>
        </div>
    </form>

    <div id="successMessage"></div>

    <script>
        $(document).ready(function() {
            $('#addContributionForm').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: '<?php echo __SITE_URL; ?>/index.php?rt=savings/add_contribution',
                    type: 'POST',
                    data: {
                        id_savings: $('#id_savings').val(),
                        id_user: $('#id_user').val(),
                        balance: $('#balance').val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#successMessage').text(data.message);
                        // Clear form fields
                        $('#balance').val('');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                        $('#successMessage').text('Failed to add contribution.');
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>