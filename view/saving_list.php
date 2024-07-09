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
    <div class="buttonContainer">
        <button id="addSavingsBtn" class="button">add new savings</button>
    </div>
    <p id="test"></p>

    <script>
        $(document).ready(function() {
    $.ajax({
        url: '<?php echo __SITE_URL; ?>/index.php?rt=savings',
        type: 'GET',
        data: { action: "list" },
        dataType: 'json',
        success: function(data) {
            if (data.status === 'error') {
                console.error(data.message);
                $('#test').html('An error occurred while fetching savings.');
                return;
            }
            let output = `<table id="savingsTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Goal</th>
                            <th>Current balance</th>
                            <th>Deadline</th>
                        </tr>
                    </thead>
                    <tbody>`;
            data.savings.forEach(saving => {
                output += `<tr id="${saving.id_savings}">
                        <td>${saving.savings_name}</td>
                        <td>${saving.savings_goal}</td>
                        <td>${saving.current_balance}</td>
                        <td>${saving.deadline}</td>
                       </tr>`;
            });
            output += `</tbody></table>`;
            $('#test').html(output);

            $('#savingsTable tbody').on('click', 'tr', function() {
                let payment_amount = prompt("Payment amount:");
                console.log(payment_amount);

                $.ajax({
                    url: '<?php echo __SITE_URL; ?>/index.php?rt=savings/add_contribution',
                    type: 'POST',
                    data: {
                        action: "add_contribution",
                        id_savings: $(this).attr('id'),
                        payment_amount: payment_amount
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#successMessage').text(data.message);
                        if ($('#addSavingForm').length) {
                            $('#addSavingForm')[0].reset();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                        $('#successMessage').text('Failed to add contribution.');
                    }
                });
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error:', textStatus, errorThrown);
            $('#test').html('An error occurred while fetching savings.');
        }
    });

    $('#addSavingsBtn').click(function() {
        window.location.href = '<?php echo __SITE_URL; ?>/index.php?rt=savings/add';
    });
});

    </script>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>

