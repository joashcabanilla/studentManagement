const genderChart = new Chartisan({
    el: '#GenderChart',
    url: "api/chart/gender_chart",
    hooks: new ChartisanHooks()
        .pieColors(['#0d4b6a', '#0d4b6a64'])
        .legend({ position: 'bottom' })
        .title(`Student Gender`)
        .datasets('pie'),
});

const ageChart = new Chartisan({
    el: '#AgeChart',
    url: "api/chart/age_chart",
    hooks: new ChartisanHooks()
        .legend()
        .colors()
        .responsive()
        .beginAtZero()
        .legend({ position: 'bottom' })
        .title(`Student Age`)
        .datasets([{
            type: 'bar',
            fill: true,
            borderColor: '#0d4b6a',
            backgroundColor: "#0d4b6a",
        }]),
});

const StudentChart = new Chartisan({
    el: '#StudentChart',
    url: "api/chart/student_chart",
    hooks: new ChartisanHooks()
        .legend()
        .responsive()
        .beginAtZero()
        .legend({ position: 'bottom' })
        .title(`Student Registered`)
        .datasets([{
            type: 'line',
            fill: true,
            borderColor: '#0d4b6a',
            backgroundColor: '#0d4b6a64',
            tension: 0.1
        }]),
});
