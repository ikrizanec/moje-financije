<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<body>
    <main>
    <div class="buttonContainer">
        <button id="addSavingsBtn" class="button">add new savings</button>
    </div>
    <p id="test" class="test"></p>

    <script>
        $(document).ready(function() {
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
                    if (data.status === 'error') {
                        console.error(data.message);
                        $('#test').html('An error occurred while fetching savings.');
                        return;
                    }
                    let output = `<table id="categoriesTable">
                            <thead>
                                <tr>
                                    <th>name</th>
                                    <th>goal</th>
                                    <th>balance</th>
                                    <th>deadline</th>
                                </tr>
                            </thead>
                            <tbody>`;
                    data.savings.forEach(saving => {
                        output += `<tr id="${saving.id_savings}">
                                <td>${saving.savings_name}</td>
                                <td>${saving.savings_goal}</td>
                                <td>${saving.current_balance} €</td>
                                <td>${saving.deadline}</td>
                            </tr>`;
                    });
                    output += `</tbody></table>`;
                    $('#test').html(output);

                    $('#categoriesTable tbody').on('click', 'tr', function() {
                        let payment_amount = prompt("New contribution:");
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





