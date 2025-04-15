<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Lớp Học</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            font-size: 13px;
            src: url('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/DejaVuSans.ttf') format('truetype');
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            text-align: center;
            margin: 0;
        }

        .header-container {
            display: flex;
            margin-bottom: 15px;
        }

        .header-logo {
            flex: 0.5;
        }

        .header-title {
            text-align: center;
            margin-bottom: 10px;
            flex: 1;
        }

        .logo {
            width: 60px;
            margin-right: 20px;
            object-fit: contain;
        }

        .line {
            border-top: 2px dashed black;
            margin-top: 10px;
        }

        .title {
            font-size: 16px;
            font-weight: bold;
        }

        .date {
            text-align: right;
            font-style: italic;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            font-size: 11px;
        }

        th {
            background-color: #549af6;
        }

        /* Watermark Background */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.1;
            /* Độ mờ */
            z-index: -1;
            /* Hiển thị phía sau nội dung */
        }
    </style>
</head>

<body>

    <div class="header-container">
        <div class="header-logo">
            <img src="{{ public_path('backend/img/smart_logo_color.png') }}" alt="Logo" class="logo">
        </div>

        <div class="header-title">
            <h4>Cộng hòa xã hội chủ nghĩa Việt Nam</h4>
            <p>Độc lập - Tự do - Hạnh phúc</p>
        </div>

    </div>
    <div class="line"></div>

    <div class="date">
        <p>
            ......., ngày {{ now()->format('d') }} tháng {{ now()->format('m') }} năm
            {{ now()->format('Y') }}
        </p>

    </div>

    <h2 class="title">DANH SÁCH LỚP HỌC</h2>
    <table>
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th width="15%">Mã lớp học</th>
                <th width="20%">Tên khóa học</th>
                <th width="10%">Ngày khai giảng</th>
                <th width="25%">Giáo viên phụ trách</th>
                <th width="15%">Sĩ số</th>
                <th width="10%">Phòng học</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classes as $index => $class)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $class->id }}</td>
                    <td>{{ $class->course->course_name }}</td>
                    <td>{{ date('d/m/Y', strtotime($class->start_date)) }}</td>
                    <td>{{ $class->user->fullname ?? 'N/A' }}</td>
                    <td>{{ $class->number_of_student }}</td>
                    <td>{{ $class->room }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <img src="{{ public_path('backend/img/smart_logo_color.png') }}" class="watermark" width="400">

</body>

</html>
