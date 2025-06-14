// chart.js

document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("cloroChart")?.getContext("2d");

    // Validar que exista el canvas
    if (!ctx) {
        console.warn("No se encontró el elemento #cloroChart.");
        return;
    }

    // Obtener datos desde atributos de HTML
    const dataFechas = document.getElementById("chart-data")?.getAttribute("data-fechas");
    const dataNiveles = document.getElementById("chart-data")?.getAttribute("data-niveles");

    if (!dataFechas || !dataNiveles) {
        console.warn("Datos del gráfico no disponibles.");
        return;
    }

    const fechas = JSON.parse(dataFechas);
    const nivelesCloro = JSON.parse(dataNiveles);

    if (fechas.length === 0 || nivelesCloro.length === 0) {
        console.warn("No hay datos suficientes para mostrar el gráfico.");
        return;
    }

    // Crear gráfico
    new Chart(ctx, {
        type: "line",
        data: {
            labels: fechas,
            datasets: [{
                label: "Nivel de Cloro Residual (mg/L)",
                data: nivelesCloro,
                fill: true,
                borderColor: "rgba(34, 197, 94, 1)",
                backgroundColor: "rgba(34, 197, 94, 0.2)",
                tension: 0.4,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBackgroundColor: "rgba(22, 163, 74, 1)",
                pointBorderColor: "#fff",
                pointBorderWidth: 1.5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: "Tendencia del Nivel de Cloro Residual",
                    color: "#1e293b",
                    font: {
                        size: 18,
                        weight: 'bold'
                    },
                    padding: {
                        top: 10,
                        bottom: 20
                    }
                },
                legend: {
                    display: true,
                    position: "top",
                    labels: {
                        color: "#334155"
                    }
                },
                tooltip: {
                    backgroundColor: "#f8fafc",
                    titleColor: "#0f172a",
                    bodyColor: "#1e293b",
                    borderColor: "#a5b4fc",
                    borderWidth: 1
                }
            },
            scales: {
                y: {
                    beginAtZero: false,
                    title: {
                        display: true,
                        text: "Nivel de Cloro (mg/L)",
                        color: "#0f172a"
                    },
                    ticks: {
                        color: "#1e293b"
                    },
                    grid: {
                        color: "#e2e8f0"
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: "Fecha",
                        color: "#0f172a"
                    },
                    ticks: {
                        color: "#1e293b"
                    },
                    grid: {
                        color: "#f1f5f9"
                    }
                }
            }
        }
    });
});
