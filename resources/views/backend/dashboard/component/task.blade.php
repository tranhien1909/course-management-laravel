<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h4> My Task</h4>
            </div>
            <div class="ibox-content ibox-heading">
                <form action="{{ route('admin.tasks.add') }}" method="POST" class="form-inline">
                    @csrf
                    <div class="filter-bar">
                        <div class="form-group col-md-4">
                            <input style="width: 100%;" type="text" name="title" class="form-control"
                                placeholder="Thêm task..." required>
                        </div>
                        <div class="form-group col-md-7">
                            <input style="width: 100%;" type="text" name="note" class="form-control"
                                placeholder="Ghi chú (tuỳ chọn)">
                        </div>
                        <div class="form-group col-md-1">
                            <button type="submit" class="btn btn-primary">Thêm</button>

                        </div>
                    </div>

                </form>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                    @forelse ($tasks as $task)
                        <li style="justify-content: space-between;"
                            class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <form action="{{ route('admin.tasks.toggle', $task->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    <button type="submit" style="background: none; border: none; cursor: pointer;">
                                        @if ($task->is_done)
                                            ✅
                                        @else
                                            ⭕
                                        @endif
                                    </button>
                                </form>
                                <strong style="{{ $task->is_done ? 'text-decoration: line-through;' : '' }}">
                                    {{ $task->title }}
                                </strong>
                                <div style="font-size: 13px; color: gray;">
                                    {{ $task->note }}
                                </div>
                            </div>
                            <div>
                                <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link p-0"
                                        style="border: none; margin-left: 65px;" title="Xoá">
                                        <i class="fa-solid fa-xmark text-danger"></i>
                                    </button>
                                </form>
                                <span style="font-size: 12px;">{{ $task->created_at->format('d/m/Y H:i') }}</span>

                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">Chưa có task nào</li>
                    @endforelse
                </ul>
            </div>

        </div>
    </div>
</div>
