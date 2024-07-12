<?php require_once __SITE_PATH . '/view/_header.php'; ?>

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

