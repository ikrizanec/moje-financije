<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<body>
    <main>
    <div class="buttonContainer">
        <button id="addBtn" class="button">add transaction</button>
    </div>
    <p id="test" class="test"></p>


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
                let output = `<div style="overflow-x:auto;">
                    <table id="categoriesTable">
                        <thead>
                            <tr>
                                <th>category</th>
                                <th>type</th>
                                <th>description</th>
                                <th>date</th>
                                <th>amount</th>
                            </tr>
                        </thead>
                        <tbody>`;
                data.transactions.forEach(transaction => {
                    let formattedAmount = parseFloat(transaction.amount).toFixed(2);
                    output += `<tr>
                        <td>${transaction.category_name}</td>
                        <td>${transaction.type}</td>
                        <td>${transaction.description}</td>
                        <td>${transaction.transaction_date}</td>
                        <td>${formattedAmount} €</td>
                       </tr>`;
                });
                output += `</tbody></table></div>`;
                $('.test').html(output);
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
