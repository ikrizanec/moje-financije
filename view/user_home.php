<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<body>
    <main>

    <div class="balanceContainer">
        <h2>current account balance</h2>
        <div id="accountBalance" class="balance">0.00 €</div>
    </div>
    <div class="pieCharts">
        <div class="pieChartContainer">
            <h3>pie chart showing income </h3>
            <canvas id="myPieChartIncome" class="canvas"></canvas>
        </div>
        <div class="pieChartContainer">
            <h3>pie chart showing expenses </h3>
            <canvas id="myPieChartExpense" class="canvas"></canvas>
        </div>
    </div>
    <div class="savingsContainer">
        <canvas id="savingsChart" class="canvas"></canvas>
    </div>

    <script>
        $.ajax({
            url: '<?php echo __SITE_URL; ?>/index.php?rt=users/balance',
            type: 'GET',
            data: { 
                action: "balance"
            },
            dataType: 'json',
            success: function(data) {
                $('#accountBalance').text(Number(data.balance).toFixed(2) + ' €');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                $('#accountBalance').text('Error fetching balance');
            }
        });

        $.ajax({
            url: '<?php echo __SITE_URL; ?>/index.php?rt=transactions',
            type: 'GET',
            data: 
            { 
                action: "list"
            },
            dataType: 'json',
            success: function(data) {
            let expenses = {};
            let incomes = {};
            data.transactions.forEach(transaction => {
                if (transaction.type === 'expense') {
                    if (expenses[transaction.category_name]) {
                        expenses[transaction.category_name] += parseFloat(transaction.amount);
                    } else {
                        expenses[transaction.category_name] = parseFloat(transaction.amount);
                    }
                } else if (transaction.type === 'income') {
                    if (incomes[transaction.category_name]) {
                        incomes[transaction.category_name] += parseFloat(transaction.amount);
                    } else {
                        incomes[transaction.category_name] = parseFloat(transaction.amount);
                    }
                }
            });

            // Priprema podataka za pie chart 'expense'
            let expenseCategoryNames = Object.keys(expenses);
            let expenseCategoryAmounts = Object.values(expenses);

            // Priprema podataka za pie chart 'income'
            let incomeCategoryNames = Object.keys(incomes);
            let incomeCategoryAmounts = Object.values(incomes);

            // Funkcija za prilagodbu tooltipa
            function currencyTooltip(tooltipItem) {
                return tooltipItem.label + ': ' + tooltipItem.raw + ' €'; // Promijenite simbol valute prema potrebi
            }

            // Crtanje pie charta za expense
            var ctxExpense = document.getElementById('myPieChartExpense').getContext('2d');
            var myPieChartExpense = new Chart(ctxExpense, {
                type: 'pie',
                data: {
                    labels: expenseCategoryNames,
                    datasets: [{
                        data: expenseCategoryAmounts,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return  context.raw + ' €';
                                }
                            }
                        }
                    }
                }
            });

            // Crtanje pise charta za income
            var ctxIncome = document.getElementById('myPieChartIncome').getContext('2d');
            var myPieChartIncome = new Chart(ctxIncome, {
                type: 'pie',
                data: {
                    labels: incomeCategoryNames,
                    datasets: [{
                        data: incomeCategoryAmounts,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.raw + ' €';
                                }
                            }
                        }
                    }
                }
            });

  
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                $('#myPieChartIncome').html('An error occurred while fetching transactions.');
                $('#myPieChartExpense').html('An error occurred while fetching transactions.');
            }
        } );

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
                let labels = [];
                let currentBalanceData = [];
                let remainingData = [];

                data.savings.forEach(saving => {
                    labels.push(saving.savings_name);
                    currentBalanceData.push(saving.current_balance);
                    remainingData.push(saving.savings_goal - saving.current_balance);
                });

                var ctx = document.getElementById('savingsChart').getContext('2d');
                var savingsChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Current Balance',
                                data: currentBalanceData,
                                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Remaining Goal',
                                data: remainingData,
                                backgroundColor: 'rgba(75, 192, 192, 0.3)',
                                borderColor: 'rgba(75, 192, 192, 0.5)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                stacked: true
                            },
                            x: {
                                stacked: true
                            }
                        }
                    }
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                $('#savingsContainer').html('An error occurred while fetching savings.');
            }
        } );
    </script>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>

