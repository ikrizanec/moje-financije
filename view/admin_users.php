<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<body>
    <h1>Admin Dashboard</h1>
    <h1 class="title">all users</h1>
    <div class="buttonContainer">
        <button onclick="location.href='<?php echo __SITE_URL; ?>/index.php?rt=admin/newUser'" class="button">new user</button>
    </div>

    <div style="overflow-x:auto;">
    <table id="categoriesTable">
        <thead>
            <tr>
                <th>username</th>
                <th>email</th>
                <th>name</th>
                <th>surname</th>
                <th>balance</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) { ?>
                <tr id="user_<?php echo $user->id_user; ?>">
                    <td><?php echo htmlspecialchars($user->username); ?></td>
                    <td><?php echo htmlspecialchars($user->email); ?></td>
                    <td><?php echo htmlspecialchars($user->name); ?></td>
                    <td><?php echo htmlspecialchars($user->surname); ?></td>
                    <td><?php echo htmlspecialchars(number_format($user->balance, 2)) . " €"; ?></td>
                    <td>
                        <button onclick="deleteUser(<?php echo $user->id_user; ?>)" class="button">Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    <p id="message"></p>

    <script>
        function deleteUser(id_user) {
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: '<?php echo __SITE_URL; ?>/index.php?rt=admin/deleteUser',
                    type: 'POST',
                    data: { 
                        action: "delete",
                        id_user: id_user 
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.message) {
                            $('#message').text(data.message);
                            $('#user_' + id_user).remove();
                        } else if (data.error) {
                            alert(data.error);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                        $('#message').text('Failed to delete user.');
                    }
                });
            }
        }
    </script>
</body>
</html>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
