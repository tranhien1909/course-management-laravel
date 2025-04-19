@include('backend.dashboard.home.style-table')
<style>
    .ibox-content {
        margin-bottom: 30px;
    }

    .form-group.d-flex {
        justify-content: flex-start;
        /* Căn trái các phần tử */
        align-items: center;
        /* Căn giữa theo chiều dọc */
        gap: 10px;
        /* Khoảng cách giữa các phần tử */
    }

    .form-group.d-flex .form-control {
        flex: 1;
        /* Cho phép input text chiếm phần không gian còn lại */
        max-width: calc(100% - 40px);
        /* Đảm bảo có chỗ cho checkbox */
    }

    .form-group.d-flex input[type="checkbox"] {
        margin: 10px;
        /* Loại bỏ margin mặc định */
        width: auto;
        /* Giữ nguyên kích thước checkbox */
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
                            <strong>{{ $quiz->title }}</strong>
                        </li>
                        <h3 style="font-size: 18px; margin-top: 20px">TẠO CÂU HỎI</h3>
                    </ol>
                </div>
            </div>
        </div>

        <div class="ibox-content">

            <h3 class="text-success">CÁC CÂU HỎI ĐÃ THÊM</h3>

            @forelse ($quiz->questions as $question)

                <div class="panel panel-default"
                    style="padding: 10px; border: 1px solid #ddd; margin-bottom: 10px; position: relative;">

                    <strong>Câu {{ $loop->iteration }}:</strong> {!! nl2br(e($question->question_text)) !!}
                    <br>
                    <small>Loại: {{ ucfirst(str_replace('_', ' ', $question->question_type)) }} |
                        Điểm: {{ $question->points }}</small> <br>

                    @if ($question->options->count())
                        <ul style="margin-top: 10px;">
                            @foreach ($question->options as $option)
                                <li>
                                    {{ $option->option_text }}
                                    @if ($option->is_correct)
                                        <strong style="color: green;">(Đúng)</strong>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <small>Giải thích: {{ $question->explanation }}</small>

                    <form action="{{ route('questions.destroy', $question->id) }}" method="POST" class="delete-form"
                        onsubmit="return confirm('Bạn có chắc muốn xoá câu hỏi này không?')"
                        style="position: absolute; right: 0; top: 0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link p-0" style="border: none;" title="Xoá">
                            <i class="fas fa-trash text-danger"></i>
                        </button>
                    </form>

                </div>
            @empty
                <p>Chưa có câu hỏi nào.</p>
            @endforelse
        </div>

        <div class="ibox-content">
            <form action="{{ route('questions.store', $quiz->id) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nội dung câu hỏi</label>
                    <textarea name="question_text" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label>Loại câu hỏi</label>
                    <select name="question_type" class="form-control" required>
                        <option value="multiple_choice">Trắc nghiệm</option>
                        <option value="true_false">Đúng/Sai</option>
                        <option value="short_answer">Điền ngắn</option>
                        <option value="essay">Tự luận</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Điểm</label>
                    <input type="number" name="points" class="form-control" step="0.1" min="0"
                        value="1">
                </div>

                <div class="form-group">
                    <label>Giải thích (nếu có)</label>
                    <textarea name="explanation" class="form-control"></textarea>
                </div>

                <h5>Lựa chọn (chỉ với trắc nghiệm hoặc đúng/sai)</h5>
                @for ($i = 0; $i < 4; $i++)
                    <div class="form-group d-flex gap-2 align-items-center">
                        <input type="text" name="options[{{ $i }}][option_text]" class="form-control"
                            placeholder="Lựa chọn {{ $i + 1 }}">
                        <input type="checkbox" name="options[{{ $i }}][is_correct]"> Đúng
                    </div>
                    <hr style="background-color: rgb(19, 61, 212); height: 1px;">
                @endfor

                <button type="submit" class="btn btn-primary">Lưu câu hỏi</button>
            </form>
        </div>
    </div>
</div>

<script>
    // JavaScript để thêm lựa chọn động
    document.getElementById('add-option').addEventListener('click', function() {
        const container = document.getElementById('options-container');
        const index = container.children.length;
        container.innerHTML += `
            <div class="option-item">
                <input type="text" name="options[${index}][content]" placeholder="Lựa chọn ${index + 1}">
                <input type="checkbox" name="options[${index}][is_correct]"> Đúng
            </div>
        `;
    });
</script>
