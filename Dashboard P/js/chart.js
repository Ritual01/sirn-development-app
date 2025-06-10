// chart.js

document.addEventListener("DOMContentLoaded", function () {
    // Obtener los elementos del DOM
    const ctx = document.getElementById("cloroChart").getContext("2d");

    // Datos inyectados desde PHP (en index.php)
    const fechas = JSON.parse(document.getElementById("chart-data").getAttribute("data-fechas"));
    const nivelesCloro = JSON.parse(document.getElementById("chart-data").getAttribute("data-niveles"));

    // Validar que existan datos
    if (fechas.length === 0 || nivelesCloro.length === 0) {
        console.warn("No hay datos disponibles para mostrar en el gráfico.");
        return;
    }

    // Crear gráfico con Chart.js
    new Chart(ctx, {
        type: "line", // Puedes cambiar a 'bar', 'pie', etc.
        data: {
            labels: fechas,
            datasets: [{
                label: "Nivel de Cloro Residual (mg/L)",
                data: nivelesCloro,
                fill: true,
                borderColor: "rgba(54, 162, 235, 1)",
                backgroundColor: "rgba(54, 162, 235, 0.2)",
                tension: 0.3,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBackgroundColor: "rgba(54, 162, 235, 1)",
                pointBorderColor: "#fff",
                pointBorderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: "Tendencia del Nivel de Cloro Residual"
                },
                legend: {
                    display: true,
                    position: "top"
                },
                tooltip: {
                    mode: "index",
                    intersect: false
                }
            },
            scales: {
                y: {
                    beginAtZero: false,
                    title: {
                        display: true,
                        text: "Nivel de Cloro (mg/L)"
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: "Fecha"
                    }
                }
            }
        }
    });
});