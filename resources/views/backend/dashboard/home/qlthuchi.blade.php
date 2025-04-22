@include('backend.dashboard.home.style-table')

<style>
    .ibox-content {
        position: relative;
    }

    table img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 5px;
        margin-left: 6px;
    }

    .course-row {
        background-color: white;
        opacity: 1;
        transition: background 0.3s ease, opacity 0.3s ease;
    }

    .course-row.selected {
        background-color: #f5fcff;
        opacity: 1;
    }

    .input-group {
        position: relative;
    }

    .input-group::before {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: gray;
        pointer-events: none;
    }

    .input-group input {
        padding-left: 100px;
        height: 40px;
        border-radius: 4px;
        border: 1px solid #ccc;
        box-sizing: border-box;
        width: 250px;
        font-size: 15px;
    }

    .input-group.from::before {
        content: "Từ ngày:";
    }

    .input-group.to::before {
        content: "Đến ngày:";
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.4);
        /* Màu đen mờ */
        display: none;
        /* Mặc định ẩn */
        justify-content: center;
        align-items: center;
        z-index: 1001;
        /* Hiển thị trên cùng */
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
        background-color: #d4edda;
        color: #155724;
    }

    .status-failed {
        background-color: #f8d7da;
        color: #721c24;
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
                            <strong>QL Thu Chi</strong>
                        </li>
                        <h3 style="font-size: 18px; margin-top: 20px">DANH SÁCH HÓA ĐƠN</h3>
                    </ol>
                </div>
            </div>
            <div class="filter-bar">
                <button>Export</button>

                <form action={{ route('spending.index') }} method="GET" style="display: flex; gap: 10px;">
                    <div class="input-group from">
                        <input type="date" id="tungay" name="tungay" value="{{ request('tungay') }}">
                    </div>
                    <div class="input-group to">
                        <input type="date" id="denngay" name="denngay" value="{{ request('denngay') }}">
                    </div>

                    <div class="search-container">
                        <input type="text" name="search" class="form-control"
                            placeholder="Tìm kiếm theo mã (tuỳ chọn)" value="{{ request('search') }}"
                            style="padding: 19px 0px 19px 20px; width: 440px;">
                    </div>
                    <button type="submit" class="btn-success" style="left: 8px; padding: 6px 12px;"><i
                            class="fa-solid fa-magnifying-glass" style="color: white;"></i></button>
                </form>



                <button class="add-btn" onclick="toggleForm()">+ Thêm Hoá đơn</button>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Ngày tạo</th>
                                <th>Mã học viên</th>
                                <th>Mã khóa học</th>
                                <th>Học phí</th>
                                <th>Phương thức thanh toán</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $index => $payment)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y H:i') }}</td>
                                    <td>{{ $payment->student->student_id }}</td>
                                    <td>{{ $payment->course->course_name ?? $payment->course_id }}</td>
                                    <td>{{ number_format($payment->amount, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($payment->payment_method) }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $payment->status }}">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                        <button class="btn btn-sm btn-outline-primary update-status-btn"
                                            data-id="{{ $payment->id }}" data-status="{{ $payment->status }}"
                                            data-toggle="modal" data-target="#statusModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Chưa có khoản thanh toán nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
                    action="{{ route('spending.updateStatus', ['payment' => $payment->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="status">Tình trạng</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending">Chờ xử lý</option>
                                <option value="completed">Hoàn thành</option>
                                <option value="failed">Thất bại</option>
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

</div>
<div class="form-container" id="addForm">
    <button class="closebtn" onclick="toggleForm()">X</button>
    <h2 class="text-center">THÊM HÓA ĐƠN</h2>
    <form>
        <label>Ngày tạo</label>
        <input type="date" name="ngay_tao" required>

        <label>Mã học viên</label>
        <input type="text" name="ten_hoc_vien" required>

        <label>Mã khóa học</label>
        <textarea type="text" name="khoa_hoc" required></textarea>

        <label>Học phí</label>
        <input type="text" name="hoc_phi" required>

        <label>Trạng thái thanh toán</label>
        <select name="trang_thai_thanh_toan" required>
            <option value="chua_thanh_toan">Chưa thanh toán</option>
            <option value="da_thanh_toan">Đã thanh toán</option>
        </select>

        <label>Phương thức thanh toán</label>
        <select name="phuong_thuc_thanh_toan" required>
            <option value="tien_mat">Tiền mặt</option>
            <option value="chuyen_khoan">Chuyển khoản</option>
        </select>

        <label>Ghi chú</label>
        <textarea name="ghi_chu"></textarea>

        <div class="form-footer">
            <button type="submit" class="save-btn">Lưu</button>
        </div>
    </form>
</div>


<script>
    function toggleForm() {
        var form = document.getElementById("addForm");
        var overlay = document.getElementById("overlay");
        var mainContent = document.getElementById("mainContent");

        if (form.classList.contains("active")) {
            form.classList.remove("active");
            overlay.classList.remove("active");
        } else {
            form.classList.add("active");
            overlay.classList.add("active");
            mainContent.style.filter = "blur(5px)";
        }
    }
</script>

@section('scripts')
    <script>
        $(document).ready(function() {
            // Khi click nút cập nhật trạng thái
            $('.update-status-btn').click(function() {
                const paymentId = $(this).data('id');
                const currentStatus = $(this).data('status');

                // Cập nhật form action với ID thanh toán
                $('#statusForm').attr('action', '/payments/' + paymentId + '/status');

                // Set giá trị hiện tại cho select
                $('#status').val(currentStatus);
            });

            // Xử lý submit form bằng AJAX
            $('#statusForm').submit(function(e) {
                e.preventDefault();

                const form = $(this);
                const url = form.attr('action');

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
