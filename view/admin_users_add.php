<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<body>
    <h1 class="title">add new user</h1>

    <form id="addUserForm" class="form">
        <div>
            <label for="username" class="label">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password" class="label">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="email" class="label">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="name" class="label">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="surname" class="label">Surname:</label>
            <input type="text" id="surname" name="surname" required>
        </div>
        <div>
            <label for="balance" class="label">Balance:</label>
            <input type="number" id="balance" name="balance" required>
        </div>
        <div>
            <label>
                <input type="checkbox" id="is_admin" name="is_admin"> is admin
            </label>
        </div>
        <div class="buttonContainer">
            <button type="submit" class="button">add user</button>
        </div>
    </form>

    <div id="successMessage"></div>

    <script>
        $(document).ready(function() {
            $('#addUserForm').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: '<?php echo __SITE_URL; ?>/index.php?rt=admin/newUser',
                    type: 'POST',
                    data: {
                        action: "add",
                        username: $('#username').val(),
                        password: $('#password').val(),
                        email: $('#email').val(),
                        name: $('#name').val(),
                        surname: $('#surname').val(),
                        balance: $('#balance').val(),
                        is_admin: $('#is_admin').is(':checked')
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#successMessage').text(data.message);
                        $('#addUserForm')[0].reset();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                        $('#successMessage').text('Failed to add user.');
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
