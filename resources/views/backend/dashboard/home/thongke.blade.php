@include('backend.dashboard.home.style-table')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<style>
    .ibox-content {
        margin-bottom: 20px;
    }
</style>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="overlay" id="overlay" onclick="toggleForm()"></div>
        <div class="ibox float-e-margins">
            <div class="row wrapper border-bottom white-bg page-heading"
                style="margin-left: -9px; margin-bottom: 20px; position: relative;">
                <div class="col-lg-10">
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">Trang chủ</a>
                        </li>
                        <li class="active">
                            <strong>Thống kê</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-4">
                        <canvas id="studentsChart" height="300"></canvas>
                        <script></script>
                    </div>

                    <div class="col-md-4">
                        <canvas id="classStatusChart" height="300"></canvas>
                    </div>

                    <div class="col-md-4">
                        <canvas id="tuitionChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const studentsChart = new Chart(document.getElementById('studentsChart'), {
        type: 'bar',
        data: {
            labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
            datasets: [{
                label: 'Học viên mới',
                data: @json($studentData),
                backgroundColor: '#42a5f5'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Học viên mới theo tháng ({{ date('Y') }})'
                }
            }
        }
    });

    const classStatusChart = new Chart(document.getElementById('classStatusChart'), {
        type: 'pie',
        data: {
            labels: @json($classStats->keys()),
            datasets: [{
                label: 'Lớp học',
                data: @json($classStats->values()),
                backgroundColor: ['#66bb6a', '#ef5350']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Tình trạng lớp học'
                }
            }
        }
    });

    const tuitionChart = new Chart(document.getElementById('tuitionChart'), {
        type: 'bar',
        data: {
            labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
            datasets: [{
                label: 'Tổng học phí thu (VNĐ)',
                data: @json($tuitionData),
                backgroundColor: '#ffca28',
                borderColor: '#f57c00',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Học phí thu được theo tháng ({{ date('Y') }})'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let value = context.raw || 0;
                            return value.toLocaleString('vi-VN') + ' VNĐ';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString('vi-VN') + ' đ';
                        }
                    }
                }
            }
        }
    });
</script>
