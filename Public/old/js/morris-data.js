$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2010 Q1',
            每月教师工资: 2666,
            每月学员充值: null,
            每月顾问工资: 2647
        }, {
            period: '2010 Q2',
            每月教师工资: 2778,
            每月学员充值: 2294,
            每月顾问工资: 2441
        }, {
            period: '2010 Q3',
            每月教师工资: 4912,
            每月学员充值: 1969,
            每月顾问工资: 2501
        }, {
            period: '2010 Q4',
            每月教师工资: 3767,
            每月学员充值: 3597,
            每月顾问工资: 5689
        }, {
            period: '2011 Q1',
            每月教师工资: 6810,
            每月学员充值: 1914,
            每月顾问工资: 2293
        }, {
            period: '2011 Q2',
            每月教师工资: 5670,
            每月学员充值: 4293,
            每月顾问工资: 1881
        }, {
            period: '2011 Q3',
            每月教师工资: 4820,
            每月学员充值: 3795,
            每月顾问工资: 1588
        }, {
            period: '2011 Q4',
            每月教师工资: 15073,
            每月学员充值: 5967,
            每月顾问工资: 5175
        }, {
            period: '2012 Q1',
            每月教师工资: 10687,
            每月学员充值: 4460,
            每月顾问工资: 2028
        }, {
            period: '2012 Q2',
            每月教师工资: 8432,
            每月学员充值: 5713,
            每月顾问工资: 1791
        }],
        xkey: 'period',
        ykeys: ['每月教师工资', '每月学员充值', '每月顾问工资'],
        labels: ['每月教师工资', '每月学员充值', '每月顾问工资'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    // Morris.Donut({
    //     element: 'morris-donut-chart',
    //     data: [{
    //         label: "Download Sales",
    //         value: 12
    //     }, {
    //         label: "In-Store Sales",
    //         value: 30
    //     }, {
    //         label: "Mail-Order Sales",
    //         value: 20
    //     }],
    //     resize: true
    // });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '2016 1',
            teacher: 100,
            student: 80
        }, {
            y: '2016 2',
            teacher: 60,
            student: 40
        }, {
            y: '2016 3',
            teacher: 60,
            student: 40
        }, {
            y: '2016 4',
            teacher: 60,
            student: 100
        }, {
            y: '2016 5',
            teacher: 80,
            student: 40
        }, {
            y: '2016 6',
            teacher: 60,
            student: 80
        }, {
            y: '2016 7',
            teacher: 100,
            student: 80
        }],
        xkey: 'y',
        ykeys: ['teacher', 'student'],
        labels: ['教师评价', '学生评价'],
        hideHover: 'auto',
        resize: true
    });

});
