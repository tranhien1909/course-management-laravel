@include('backend.dashboard.home.style-table')

<style>
    .table-responsive {
        margin-top: 30px;

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
                            <strong>QL Người cần tư vấn</strong>
                        </li>
                        <h3 style="font-size: 18px; margin-top: 20px">DANH SÁCH NGƯỜI CẦN TƯ VẤN</h3>
                    </ol>
                </div>
            </div>

            {{-- Hiển thị thông báo thành công --}}
            @if (session('success'))
                <script>
                    toastr.success('{{ session('success') }}');
                </script>
            @endif

            <div class="filter-bar">

                <div class="search-container">
                    <form action="{{ route('class.index') }}" method="GET">
                        <input type="text" name="search" class="form-control"
                            placeholder="Tìm kiếm theo mã hoặc tên khóa học" value="{{ request('search') }}">
                        <button type="submit" class="search-icon"
                            style="background-color: white; left: 8px; padding: 6px;"><i
                                class="fa-solid fa-magnifying-glass" style="color: #3b6db3;"></i></button>
                    </form>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Khoá học quan tâm</th>
                                <th>Nội dung</th>
                                <th>Ngày điền form</th>
                                <th>Tình trạng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($consultations) && is_object($consultations))
                                @foreach ($consultations as $index => $consultation)
                                    <tr class="course-row">
                                        <td>{{ ($consultations->currentPage() - 1) * $consultations->perPage() + $index + 1 }}
                                        </td>
                                        <td>{{ $consultation->fullname }}</td>
                                        <td>{{ $consultation->phone }}</td>
                                        <td>{{ $consultation->email }}</td>
                                        <td>{{ $consultation->course_interested }}</td>
                                        <td>{{ $consultation->message }}</td>
                                        <td>{{ date('d/m/Y', strtotime($consultation->created_at)) }}</td>
                                        <td>{{ $consultation->status }}</td>
                                        <td style="padding: 1px 24px;">
                                            <a href="" title="Xem chi tiết"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9">Không có khóa học nào.</td>
                                </tr>
                            @endif

                            @if (isset($consultations))
                                <tr>
                                    <td colspan="9">
                                        {{ $consultations->links('pagination::bootstrap-4') }}
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
