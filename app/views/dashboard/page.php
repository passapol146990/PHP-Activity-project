<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="Logo_size32.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <title>แดชบอร์ด</title>
    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background:rgb(253, 5, 5)
        }
        .div-menu{
            height: 100vh;
            .header{
                background: linear-gradient(to right, #f77062, #fe5196);
                height: 100px;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 40px;
                font-weight: bold;
                color: #fff;
            }
            .body{
                a{
                    display: block;
                    width: 100%;
                    text-decoration: none;
                    color:#fff;
                    &:hover{
                        color: #d9d9d9;
                        text-decoration: underline;
                    }
                }
            }
            .footer{

            }
        }
        .div-content{
            .header{
                /* height: 200px; */
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="div-menu col-3 bg-dark">
            <div class="header">
                <label>สรุปข้อมูล</label>
            </div>
            <div class="body">
                <a class="p-3" href="/">กลับหน้าแรก</a>
                <!-- <a class="p-3" href="/">สรุปรวม</a>
                <a class="p-3" href="/">กิจกรรมของฉัน</a>
                <a class="p-3" href="/">กิจกรรมที่เข้าร่วม</a> -->
            </div>
            <div class="footer"></div>
        </div>
        <div class="div-content col-9">
            <div class="header bg-white p-5">
                <canvas id="Chart1" style="width:100%;height: 300px;"></canvas>
                <canvas id="Chart2" style="width:100%;height: 300px;"></canvas>
                <div class="d-flex justify-content-center gap-2">
                    <canvas id="Chart3" class="border rounded" style="max-width: 450px;"></canvas>
                    <canvas id="Chart4" class="border rounded" style="max-width: 450px;"></canvas>
                </div>
                <script>
                    function setChartTop10MyActivity(id,title){
                        const data = <?= json_encode($getTop10["data"], JSON_UNESCAPED_UNICODE); ?>;
                                const xValues = [];
                                const yValues = [];
                                data.forEach(function(item) {
                                    xValues.push(item.p_name);
                                    yValues.push(item.total_regis);  
                                });
                        const barColors = ["red", "green","blue","orange","brown","yellow","lime","pink","black","skyblue"];

                        new Chart(id, {
                        type: "bar",
                        data: {
                            labels: xValues,
                            datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                            }]
                        },
                        options: {
                            legend: {display: false},
                            scales: {
                            yAxes: [{
                                ticks: {
                                beginAtZero: true
                                }
                            }]
                            },

                            title: {
                            display: true,
                            text: title
                            }
                        }
                        });
                    }
                    setChartTop10MyActivity("Chart1","10 อันดับกิจกรรมของคุณที่มีคนเข้าร่วมมากที่สุด");
                    
                    function setRegMyActivity(id,title){
                        const xValues = ["ม.ค.","ก.พ.","มี.ค","เม.ย","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."];
                        new Chart(id, {
                        type: "line",
                        data: {
                            labels: xValues,
                            datasets: [{ 
                                data: [860,1140,900,1060,1070,1110,1330,2210,7830,2478],
                                borderColor: "red",
                                fill: false
                            }]
                        },
                        options: {
                            title:{
                                display:true,
                                text:title
                            },
                            legend:{display:false}
                        }
                        });
                    }
                    setRegMyActivity('Chart2',"คำขอเข้าร่วมกิจกรรมที่คุณสร้าง") //คนอื่นขอเรา
                    function setChartCicleMyStatus(canid,title){
                        const data = <?= json_encode($total_Countstatus_1["data"], JSON_UNESCAPED_UNICODE); ?>;
                        const yValues = [];

                            const xValues = ["รอดำเนินการ", "อนุมัติ", "ปฏิเสธ"];

                            data.forEach(function(item) {
                                yValues.push(item.pending);  
                                yValues.push(item.approved); 
                                yValues.push(item.rejected);
                            });
                        const barColors = [
                            "#f1c40f",
                            "#2ecc71",
                            "#e74c3c"
                        ];
                        new Chart(canid, {
                            type: "doughnut",
                            data: {
                                labels: xValues,
                                datasets: [{
                                    backgroundColor: barColors,
                                    data: yValues
                                }]
                            },
                            options: {
                                title: {
                                    display: true,
                                    text: title
                                }
                            }
                        });
                    }
                    setChartCicleMyStatus("Chart3","สถานะคำขอของคนอื่น ที่ขอเข้าร่วมกิจกรรมของคุณ") //เราขอคนอื่น
                    function setChartCicleMyReg(canid,title){
                        const data = <?= json_encode($total_Countstatus_2["data"], JSON_UNESCAPED_UNICODE); ?>;
                            const yValues = [];

                            const xValues = ["รอดำเนินการ", "อนุมัติ", "ปฏิเสธ"];

                            data.forEach(function(item) {
                                yValues.push(item.pending); 
                                yValues.push(item.approved); 
                                yValues.push(item.rejected); 
                            });
                        const barColors = [
                            "#f1c40f",
                            "#2ecc71",
                            "#e74c3c"
                        ];
                        new Chart(canid, {
                            type: "doughnut",
                            data: {
                                labels: xValues,
                                datasets: [{
                                    backgroundColor: barColors,
                                    data: yValues
                                }]
                            },
                            options: {
                                title: {
                                    display: true,
                                    text: title
                                }
                            }
                        });
                    }
                    setChartCicleMyReg("Chart4","สถานะคำขอของคุณ ที่ขอเข้าร่วมกิจกรรมของคนอื่น")
                </script>
            </div>
        </div>
    </div>
</body>
</html>