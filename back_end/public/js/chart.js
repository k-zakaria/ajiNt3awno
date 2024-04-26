document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById('articlesChart').getContext('2d');

    var articlesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Articles par jour',
                data: {!! json_encode($data) !!},
                fill: false,
                borderColor: 'rgb(54, 162, 235)',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});