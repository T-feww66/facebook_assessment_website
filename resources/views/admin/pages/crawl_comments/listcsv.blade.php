@extends('layouts.admin')

@section("title", "List csv")
@section("header", "Liệt kê các file dữ liệu bình luận đã thu thập")

@section('content')

<table class="table table-dark table-striped table-bordered mt-4">
    <thead>
        <tr>
            <th class="px-4 py-2">File</th>
            <th class="px-4 py-2">Actions</th>
            <th class="px-4 py-2">Dowload file</th>
        </tr>
    </thead>
    <tbody>
        @forelse($files as $file)
        <tr id="row-{{ $file }}">
            <td class="px-4 py-2">{{ $file }}</td>
            <td class="px-4 py-2">
                <button type="submit" class="btn btn-danger btn-sm" onclick="deleteFile('{{ $file }}')">Xoá</button>
            </td>
            <td class="px-4 py-2">
                <a href="http://localhost:60074/crawl/download/{{ $file}}" class="btn btn-success">
                    📥 Tải dữ liệu
                </a>
            </td>

        </tr>
        @empty
        <tr>
            <td colspan="2">Không có file CSV nào.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<script>
    function deleteFile(filename) {
        if (!confirm(`Bạn có chắc chắn muốn xoá "${filename}"?`)) return;
        fetch(`http://localhost:60074/crawl/delete-csv-file/${filename}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('row-' + filename).remove();
                    alert(data.message);
                } else {
                    alert('Lỗi khi xoá file.');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Lỗi kết nối đến API.');
            });
    }
</script>
@endsection