<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<body>
    <button id="addCategoryBtn" class="addButton">add new category</button>
   
        <p id="test"></p>
    

    <script>
        $.ajax(
        {
            url: '<?php echo __SITE_URL; ?>/index.php?rt=categories',
            type: 'GET',
            data: 
            { 
                action: "list"
            },
            dataType: 'json',
            success: function(data) {
                let output = `<table id="categoriesTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>`;
                data.categories.forEach(category => {
                    output += `<tr>
                        <td>${category.category_name}</td>
                        <td>${category.description}</td>
                       </tr>`;
                });
                output += `</tbody></table>`;
                $('#test').html(output);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                $('#test').html('An error occurred while fetching categories.');
            }
        } );

        $('#addCategoryBtn').click(function() {
                window.location.href = '<?php echo __SITE_URL; ?>/index.php?rt=categories/add';
        });
    </script>
</body>
</html>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
