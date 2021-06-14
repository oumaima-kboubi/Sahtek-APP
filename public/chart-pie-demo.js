// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");

const entryInfoElements1 =
    document.querySelectorAll('[data-entry-info]');
const entryInfoObjects1 =
    Array.from(entryInfoElements1).map(
        item => JSON.parse(item.dataset.entryInfo)
    );
var num = entryInfoObjects1[1]['number'];
var female = (entryInfoObjects1[1]['female']/num) * 100;
var male = (entryInfoObjects1[1]['male']/num) *100;


var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["female", "male"],
    datasets: [{
      data: [female, male],
      backgroundColor: ['#EE1867', '#157DEF'],
      hoverBackgroundColor: ['#C11F5B', '#1A5392'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: true
    },
    cutoutPercentage: 80,
  },
});
