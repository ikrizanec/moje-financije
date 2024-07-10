<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <h1 class="title">generate report</h1>

    <form id="reportForm" class="form">
        <div>
            <label for="begin_date" class="label">Begin date:</label>
            <input type="text" id="begin_date" name="begin_date" required>
        </div>
        <div>
            <label for="end_date" class="label">End date:</label>
            <input type="text" id="end_date" name="end_date" required>
        </div>
        <div class="buttonContainer">
            <button type="submit" class="button">generate</button>
        </div>
    </form>

    <div id="successMessage"></div>

    <script>
        $(document).ready(function() {
            $('#begin_date').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#end_date').datepicker({ dateFormat: 'yy-mm-dd' });

            $('#reportForm').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: '<?php echo __SITE_URL; ?>/index.php?rt=reports',
                    type: 'POST',
                    data: 
                    { 
                        action: "generate",
                        begin_date: $('#begin_date').val(),
                        end_date: $('#end_date').val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#successMessage').text(data.message);
                        $('#reportForm')[0].reset();
                        $('#begin_date').val('');
                        $('#end_date').val('');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                        $('#successMessage').text('Failed to generate report.');
                    }
                });
            });
        });
    </script>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
