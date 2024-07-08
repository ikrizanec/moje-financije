
<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<body>
    <div class="buttonContainer">
        <button id="addSavingsBtn" class="button">add new savings</button>
    </div>
    <p id="test" class="test"></p>


    <script>
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
                let output = `<table id="savingsTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Goal</th>
                                <th>Balance</th>
                                <th>Deadline</th>
                                <th>Contribute</th>
                            </tr>
                        </thead>
                        <tbody>`;
                data.savings.forEach(savings => {
                    output += `<tr>
                        <td>${savings.savings_name}</td>
                        <td>${savings.savings_goal}</td>
                        <td>${savings.current_balance}</td>
                        <td>${savings.deadline}</td>
                        <td><button id="addContributeBtn" class="button" value="${savings.id_savings}">contribute</button></td>
                       </tr>`;
                });
                output += `</tbody></table>`;
                $('.test').html(output);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                $('.test').html('An error occurred while fetching categories.');
            }
        } );

        $('#addSavingsBtn').click(function() {
            window.location.href = '<?php echo __SITE_URL; ?>/index.php?rt=savings/add';
        });

        $('#addContributeBtn').click(function() {
            let id_savings = $(this).data('id_savings');
            let id_user = '<?php echo $_SESSION['id_user']; ?>';

            
            window.location.href = '<?php echo __SITE_URL; ?>/index.php?rt=savings/add&id_savings=' + id_savings + '&id_user=' + id_user;
        });

    </script>
</body>
</html>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
