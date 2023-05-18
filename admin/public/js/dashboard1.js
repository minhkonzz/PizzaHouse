$(document).ready(() => {

   new Chart($("#barChart"), {
      type: 'line',
      data: {
        labels: ["January", "Febuary", "March", "April", "May", "June", "July"],
        datasets: [{
          label: 'My First Dataset',
          data: [65, 59, 80, 81, 56, 55, 40],
          fill: false,
          borderColor: 'rgb(75, 192, 192)',
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

   new Chart($("#donutChart"), {
      type: 'doughnut',
      data: {
         labels: [
            'Red',
            'Blue',
            'Yellow'
         ],
         datasets: [{
            label: 'My First Dataset',
            data: [300, 50, 100],
            backgroundColor: [
               'rgb(255, 99, 132)',
               'rgb(54, 162, 235)',
               'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
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

   const barChartWidth = 320
   const barChartCurrentWidth = $(".donut-chart").width()
   const barChartCurrentHeight = $(".donut-chart").height()
   $(".donut-chart").width(barChartWidth)
   $(".donut-chart").height((barChartWidth * barChartCurrentHeight) /  barChartCurrentWidth)

   $("#dashboard-charts").height($(".donut-chart").height())
   $(".bar-chart").height("100%")
})