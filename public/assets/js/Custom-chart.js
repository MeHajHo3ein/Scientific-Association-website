const usersCanvas = document.getElementById("UsersChart");
const contentCanvas = document.getElementById("ContentChart");

const userStats = {
  students: parseInt(usersCanvas.dataset.students) || 0,
  teachers: parseInt(usersCanvas.dataset.teachers) || 0,
  admins: parseInt(usersCanvas.dataset.admins) || 0,
};

const contentStats = {
  courses: parseInt(contentCanvas.dataset.courses) || 0,
  articles: parseInt(contentCanvas.dataset.articles) || 0,
  files: parseInt(contentCanvas.dataset.files) || 0,
  notifications: parseInt(contentCanvas.dataset.notifications) || 0,
  neas: parseInt(contentCanvas.dataset.neas) || 0,
};

const UsersChart = new Chart(usersCanvas.getContext("2d"), {
  type: "bar",
  data: {
    labels: ["دانشجو", "استاد", "ادمین"],
    datasets: [
      {
        label: "آمار کاربران",
        data: [userStats.students, userStats.teachers, userStats.admins],
        backgroundColor: [
          "rgba(54, 162, 235, 0.6)",
          "rgba(75, 192, 192, 0.6)",
          "rgba(255, 206, 86, 0.6)",
        ],
        borderColor: [
          "rgba(54, 162, 235, 1)",
          "rgba(75, 192, 192, 1)",
          "rgba(255, 206, 86, 1)",
        ],
        borderWidth: 1,
        borderRadius: 5,
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        labels: {
          font: {
            family: "Tahoma, Arial",
          },
        },
      },
    },
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          stepSize: 1,
          font: { family: "Tahoma, Arial" },
        },
      },
      x: {
        ticks: {
          font: { family: "Tahoma, Arial" },
        },
      },
    },
  },
});

const ContentChart = new Chart(contentCanvas.getContext("2d"), {
  type: "bar",
  data: {
    labels: ["دوره ها", "مقالات", "فایل ها", "اعلانات", "اخبار/رویداد/اطلاعیه"],
    datasets: [
      {
        label: "آمار محتوا",
        data: [
          contentStats.courses,
          contentStats.articles,
          contentStats.files,
          contentStats.notifications,
          contentStats.neas,
        ],
        backgroundColor: [
          "rgba(75, 192, 192, 0.6)",
          "rgba(255, 206, 86, 0.6)",
          "rgba(153, 102, 255, 0.6)",
          "rgba(255, 159, 64, 0.6)",
          "rgba(255, 99, 132, 0.6)",
        ],
        borderColor: [
          "rgba(75, 192, 192, 1)",
          "rgba(255, 206, 86, 1)",
          "rgba(153, 102, 255, 1)",
          "rgba(255, 159, 64, 1)",
          "rgba(255, 99, 132, 1)",
        ],
        borderWidth: 1,
        borderRadius: 5,
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        labels: {
          font: {
            family: "Tahoma, Arial",
          },
        },
      },
    },
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          stepSize: 1,
          font: { family: "Tahoma, Arial" },
        },
      },
      x: {
        ticks: {
          font: { family: "Tahoma, Arial" },
        },
      },
    },
  },
});
