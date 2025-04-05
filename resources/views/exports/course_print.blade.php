<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Khoá Học</title>
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
    </style>
</head>

<body>

    <div class="header-container">
        <div class="header-logo">
            <img src="{{ public_path('backend/img/smart_logo.jpg') }}" alt="Logo" class="logo">
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

    <h2 class="title">DANH SÁCH KHOÁ HỌC</h2>
    <table>
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th width="15%">Mã khoá học</th>
                <th width="30%">Tên khóa học</th>
                <th width="10%">Level</th>
                <th width="15%">Số buổi học</th>
                <th width="25%">Học phí (VNĐ)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $index => $course)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->course_name }}</td>
                    <td>{{ $course->level }}</td>
                    <td>{{ $course->lessons }}</td>
                    <td>{{ number_format($course->price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
