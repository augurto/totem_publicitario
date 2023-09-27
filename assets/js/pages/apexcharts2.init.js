options = {
  chart: { height: 350, type: "bar", toolbar: { show: !1 } },
  plotOptions: { bar: { horizontal: !1, columnWidth: "45%", endingShape: "rounded" } },
  dataLabels: { enabled: !1 },
  stroke: { show: !0, width: 2, colors: ["transparent"] },
  series: [
    { name: "Net Profit", data: [46, 57, 59, 54, 62, 58, 64, 60, 66] },
    { name: "Revenue", data: [74, 83, 102, 97, 86, 106, 93, 114, 94] },
    { name: "Free Cash Flow", data: [37, 42, 38, 26, 47, 50, 54, 55, 43] },
  ],
  colors: ["#5867c3", "#34c38f", "#f9c341"],
  xaxis: { categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct"] },
  yaxis: { title: { text: "$ (thousands)" } },
  grid: { borderColor: "#f1f1f1", padding: { bottom: 10 } },
  fill: { opacity: 1 },
  tooltip: {
    y: {
      formatter: function (e) {
        return "$ " + e + " thousands";
      },
    },
  },
  legend: { offsetY: 7 },
};
