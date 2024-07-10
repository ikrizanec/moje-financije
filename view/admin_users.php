<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<body>
    <h1>Admin Dashboard</h1>
    <h2>Users</h2>
    <button onclick="location.href='<?php echo __SITE_URL; ?>/index.php?rt=admin/newUser'">New User</button>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Balance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) { ?>
                <tr id="user_<?php echo $user->id_user; ?>">
                    <td><?php echo htmlspecialchars($user->username); ?></td>
                    <td><?php echo htmlspecialchars($user->email); ?></td>
                    <td><?php echo htmlspecialchars($user->name); ?></td>
                    <td><?php echo htmlspecialchars($user->surname); ?></td>
                    <td><?php echo htmlspecialchars($user->balance); ?></td>
                    <td>
                        <button onclick="deleteUser(<?php echo $user->id_user; ?>)">Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
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