@extends('layouts.app')

@section('content')
        
    <div class="row align-items-center mb-4">
        <div class="col-md">
            <h3 class="font-weight-bold text-dark">Menu Data Blog</h3>
            <h6 class="text-secondary">Olah Konten Seperti anda menjadi Admin</h6>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('posts.create') }}" class="btn btn-outline-primary"><i class="fas fa-plus mr-2"></i> Tambah Blog</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Body</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @for ($startPage; $startPage < $endPage; $startPage++)
                    <tr>
                        <th scope="row">{{ $startPage+1 }}</th>
                        <td><img src="{{ asset('storage/'.$posts[$startPage]->img) }}" alt="" width="50px"></td>
                        <td style="max-width: 200px">{{ $posts[$startPage]->title }}</td>
                        <td>{{ substr(strip_tags($posts[$startPage]->body), 0, 50).( (strlen(strip_tags($posts[$startPage]->body)) > 50) ? '...' : ''  ) }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('posts.show', $posts[$startPage]->id) }}" class="btn btn-sm btn-primary mr-1"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('posts.edit', $posts[$startPage]->id) }}" class="btn btn-sm btn-warning mr-1"><i class="fas fa-edit text-white"></i></a>
                                <form 
                                    onsubmit="return confirm('Hapus Blog Ini ?')"
                                    action="{{ route('posts.destroy', $posts[$startPage]->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>    
                @endfor
            </tbody>
        </table>
    </div>
    <div class="row justify-content-center justify-content-md-end">
        <div class="col-auto">
            {{ $posts->links() }}
        </div>
    </div>

@endsection