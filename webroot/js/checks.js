var chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(201, 203, 207)'
};

async function onRefresh(chart) {
    let curDate = moment().subtract(1, 'minutes').toDate();
    let playing = 0;
    let total = 0;
    let stopped = 0;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);
            let posList = response.stats.points_of_sale;

            posList.forEach(pos => {
                pos.lastCheck = getLastCheck(pos);
                if (pos.lastCheck.state == 'playing') {
                    playing++;
                } else {
                    stopped++;
                }
                total++;
            });

            updateRealtime(posList);

            console.log(chart);

            chart.config.data.labels.push(curDate);
            chart.config.data.datasets[0].data.push(playing);
            chart.config.data.datasets[1].data.push(total);
            chart.config.data.datasets[2].data.push(stopped);
        }
    };

    xhttp.open("GET", statsURI, true);
    xhttp.send();
}

function updateRealtime(posList) {
    const tableBody = document.querySelector("#real-time tbody");

    tableBody.innerHTML = '';

    posList.forEach(pos => {
        let row = document.createElement("tr");
        posName = document.createElement("td");
        posDate = document.createElement("td");
        posStatus = document.createElement("td");
        posStatusIcon = document.createElement("td");
        posVolume = document.createElement("td");
        icon = document.createElement("i");

        if (pos.lastCheck.state == 'playing') {
            icon.className = "fas fa-circle enabled";
        } else {
            icon.className = "fas fa-circle disabled";
        }
        posStatusIcon.append(icon);

        created = new Date(pos.lastCheck.created);
        formattedCreatedDate = moment(created).format('YYYY-MM-DD hh:mm:ss A');
        posName.innerHTML = pos.name;
        posDate.innerHTML = formattedCreatedDate;
        posStatus.innerHTML = status[pos.lastCheck.state];
        posVolume.innerHTML = pos.lastCheck.volume + '%';

        row.append(posName);
        row.append(posVolume);
        row.append(posDate);
        row.append(posStatus);
        row.append(posStatusIcon);

        tableBody.appendChild(row);
    });

    return posList;
}

function getLastCheck(pos) {
    let checks = pos.checks;
    let lastCheck;

    const lastUpdatedDate = moment().subtract(1, 'minutes').toDate();

    checks.forEach(stat => {
        if (lastCheck == null) {
            lastCheck = stat;
        } else {
            if (stat.created >= lastCheck.created) {
                lastCheck = stat;
            }
        }
    });

    if (lastCheck == null) {
        lastCheck = {
            state: 'disconnected',
            volume: 0,
            current_song: status['unknown'],
            created: new Date()
        }
    } else {
        let createdDate = new Date(lastCheck.created)
        if (createdDate < lastUpdatedDate) {
            lastCheck = {
                state: 'disconnected',
                volume: 0,
                current_song: status['unknown'],
                created: new Date()
            }
        }
    }

    return lastCheck;
}

var color = Chart.helpers.color;
var configRealTime = {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Reproduciendo',
            type: 'line',
            backgroundColor: color(chartColors.green).alpha(0.5).rgbString(),
            borderColor: chartColors.green,
            fill: false,
            cubicInterpolationMode: 'monotone',
            data: []
        }, {
            label: 'Total',
            backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
            borderColor: chartColors.blue,
            borderWidth: 1,
            data: []
        }, {
            label: 'Detenidos',
            type: 'line',
            backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
            borderColor: chartColors.red,
            fill: false,
            cubicInterpolationMode: 'monotone',
            data: []
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Active players'
        },
        scales: {
            xAxes: [{
                type: 'realtime',
                realtime: {
                    duration: 60000 * 15,
                    refresh: 5000,
                    delay: 60000,
                    onRefresh: onRefresh
                }
            }],
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Puntos de venta'
                },
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        tooltips: {
            mode: 'nearest',
            intersect: false
        },
        hover: {
            mode: 'nearest',
            intersect: false
        }
    }
};

var configToday = {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Reproduciendo',
            type: 'line',
            backgroundColor: color(chartColors.green).alpha(0.5).rgbString(),
            borderColor: chartColors.green,
            fill: false,
            cubicInterpolationMode: 'monotone',
            data: generateData()
        }, {
            label: 'Total',
            backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
            borderColor: chartColors.blue,
            borderWidth: 1,
            data: []
        }, {
            label: 'Detenidos',
            type: 'line',
            backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
            borderColor: chartColors.red,
            fill: false,
            cubicInterpolationMode: 'monotone',
            data: []
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Active players'
        },
        scales: {
            xAxes: [{
                type: 'time',
                distribution: 'series',
                offset: true,
                ticks: {
                    major: {
                        enabled: true,
                        fontStyle: 'bold'
                    },
                    source: 'data',
                    autoSkip: true,
                    autoSkipPadding: 75,
                    maxRotation: 0,
                    sampleSize: 100
                }
            }],
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Puntos de venta'
                },
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        tooltips: {
            mode: 'nearest',
            intersect: false
        },
        hover: {
            mode: 'nearest',
            intersect: false
        }
    }
};

function generateData() {
    var unit = 'hour';

    function unitLessThanDay() {
        return unit === 'second' || unit === 'minute' || unit === 'hour';
    }

    function beforeNineThirty(date) {
        return date.hour() < 9 || (date.hour() === 9 && date.minute() < 30);
    }

    // Returns true if outside 9:30am-4pm on a weekday
    function outsideMarketHours(date) {
        if (date.isoWeekday() > 5) {
            return true;
        }
        if (unitLessThanDay() && (beforeNineThirty(date) || date.hour() > 16)) {
            return true;
        }
        return false;
    }

    function randomNumber(min, max) {
        return Math.random() * (max - min) + min;
    }

    function randomBar(date, lastClose) {
        var open = randomNumber(lastClose * 0.95, lastClose * 1.05).toFixed(2);
        var close = randomNumber(open * 0.95, open * 1.05).toFixed(2);
        return {
            t: date.valueOf(),
            y: close
        };
    }

    var date = moment('Jan 01 1990', 'MMM DD YYYY');
    var now = moment();
    var data = [];
    var lessThanDay = unitLessThanDay();
    for (; data.length < 600 && date.isBefore(now); date = date.clone().add(1, unit).startOf(unit)) {
        if (outsideMarketHours(date)) {
            if (!lessThanDay || !beforeNineThirty(date)) {
                date = date.clone().add(date.isoWeekday() >= 5 ? 8 - date.isoWeekday() : 1, 'day');
            }
            if (lessThanDay) {
                date = date.hour(9).minute(30).second(0);
            }
        }
        data.push(randomBar(date, data.length > 0 ? data[data.length - 1].y : 30));
    }

    return data;
}

window.onload = function () {

    var ctxRealtime = document.getElementById('realtimeChart').getContext('2d');
    var ctxToday = document.getElementById('todayChart').getContext('2d');

    window.myChart = new Chart(ctxRealtime, configRealTime);
    window.myChart = new Chart(ctxToday, configToday);

};

//getStats();
//window.setInterval(getStats, 1000, customerId);
