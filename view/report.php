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
    <h1 class="title">Generate Report</h1>

    <form id="reportForm" class="form" method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=reports">
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
        <input type="hidden" name="action" value="generate">
    </form>

    <div id="successMessage"></div>

    <script>
        $(document).ready(function() {
            $('#begin_date').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#end_date').datepicker({ dateFormat: 'yy-mm-dd' });
        });
    </script>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>

