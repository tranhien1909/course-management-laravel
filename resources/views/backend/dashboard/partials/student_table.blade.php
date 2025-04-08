@if (isset($users) && is_object($users))
    @foreach ($users as $index => $user)
        <tr class="course-row">
            <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
            <td>{{ $user->student_id }}</td>
            <td><img src="{{ $user->avatar ?? 'https://img.myloview.com/stickers/default-avatar-profile-icon-vector-social-media-user-image-700-205124837.jpg' }}"
                    class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;" alt='Ảnh avatar'></td>
            <td>{{ $user->fullname }}</td>
            <td>{{ $user->gender }}</td>
            <td>{{ date('d/m/Y', strtotime($user->birthday)) }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>
                <a href="{{ route('student.detail', $user->id) }}" title="Xem chi tiết">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
            </td>
            <td>
                <a href="javascript:void(0);" onclick="deleteStudent('{{ $user->id }}')">
                    <i class="fa-solid fa-trash" title="Xoá"></i>
                </a>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="10">Không tìm thấy học viên nào.</td>
    </tr>
@endif

@if (isset($users))
    <tr>
        <td colspan="10">
            {{ $users->links('pagination::bootstrap-4') }}
        </td>
    </tr>
@endif
