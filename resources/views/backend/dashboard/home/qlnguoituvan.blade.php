@include('backend.dashboard.home.style-table')

<style>
    .table-responsive {
        margin-top: 30px;
    }

    .status-badge {
        padding: 3px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
    }

    .status-pending {
        background-color: #ffc107;
        color: #000;
    }

    .status-contacted {
        background-color: #17a2b8;
        color: #fff;
    }

    .status-completed {
        background-color: #28a745;
        color: #fff;
    }

    .update-status-btn {
        padding: 0.15rem 0.4rem;
        margin-left: 5px;
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
                    <form action="{{ route('consultations.index') }}" method="GET">
                        <input type="text" name="search" class="form-control"
                            placeholder="Tìm kiếm theo mã khóa học" value="{{ request('search') }}">
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
                                        <td>
                                            <span class="status-badge status-{{ $consultation->status }}">
                                                {{ ucfirst($consultation->status) }}
                                            </span>
                                            <button class="btn btn-sm btn-outline-primary update-status-btn"
                                                data-id="{{ $consultation->id }}"
                                                data-status="{{ $consultation->status }}" data-toggle="modal"
                                                data-target="#statusModal">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">Không có khóa học nào.</td>
                                </tr>
                            @endif

                            @if (isset($consultations))
                                <tr>
                                    <td colspan="8">
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

<!-- Status Update Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Cập nhật trạng thái tư vấn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="statusForm" method="POST"
                action="{{ route('consultations.updateStatus', ['consultation' => $consultation->id]) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status">Tình trạng</label>
                        <select name="status" id="status" class="form-control">
                            <option value="pending">Chờ xử lý</option>
                            <option value="contacted">Đã liên hệ</option>
                            <option value="completed">Hoàn thành</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.update-status-btn').click(function() {
                const consultationId = $(this).data('id');
                const currentStatus = $(this).data('status');

                $('#statusForm').attr('action', '/consultations/' + consultationId + '/status');
                $('#status').val(currentStatus);
            });

            $('#statusForm').submit(function(e) {
                e.preventDefault();

                const form = $(this);
                const url = form.attr('action');

                console.log("Form will submit to: ", url); // <-- log này rất quan trọng

                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            // Đóng modal
                            $('#statusModal').modal('hide');

                            // Cập nhật UI
                            const row = $(
                                    `button[data-id="${form.attr('action').split('/')[2]}"]`)
                                .closest('tr');
                            row.find('.status-badge')
                                .removeClass('status-pending status-completed status-failed')
                                .addClass('status-' + response.new_status)
                                .text(response.new_status.charAt(0).toUpperCase() + response
                                    .new_status.slice(1));

                            // Cập nhật data-status trên nút
                            row.find('.update-status-btn').data('status', response.new_status);

                            toastr.success(response.message);
                        }
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.message || 'Có lỗi xảy ra');
                    }
                });
            });

        });
    </script>
@endsection
