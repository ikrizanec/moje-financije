<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Add New User</h1>

    <form id="addUserForm">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="surname">Surname:</label>
            <input type="text" id="surname" name="surname" required>
        </div>
        <div>
            <label for="balance">Balance:</label>
            <input type="number" id="balance" name="balance" required>
        </div>
        <div>
            <label>
                <input type="checkbox" id="is_admin" name="is_admin"> Is Admin
            </label>
        </div>
        <div>
            <button type="submit">Add User</button>
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
