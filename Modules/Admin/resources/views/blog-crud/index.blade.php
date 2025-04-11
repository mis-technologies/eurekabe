@extends('admin::layouts.app')
@include('admin::partials.znotify')


@section('content')
<main class="flex-grow p-6">

    <div class="card">
        <div class="card-header">
            <div class="flex justify-between items-center">
                <h4 class="card-title">Update Blog</h4>
                <a href="{{route('admin.pages.update.blog.view')}}" target="_blank" class="btn bg-primary text-white" rel="noopener noreferrer">Create new</a>
            </div>
        </div>

        @php
            $assets = env('APP_URL').'/';
        @endphp
        <div class="p-6">
            <div class="grid lg:grid-cols-3 gap-6">
                @foreach ($blogs as $blog)
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{$blog?->title}}</label>
                    <div class="w-32 h-32 overflow-hidden rounded-t-xl">
                        <img style="height: 100%" class="w-64 h-64 object-cover rounded-t-xl" src="{{$assets.$blog?->image}}"
                            alt="Hero Image">
                    </div>


                    <h4 class="text-sm font-medium text-gray-700 mt-2">{{$blog?->created_at->diffForHumans()}}</h4>
                    <p>
                        {{ Str::limit($blog?->content, 10, '...') }}
                    </p>


                    <a href="{{route('admin.pages.update.blog.view', $blog?->id)}}" class="btn bg-primary mt-4 text-white"
                        target="_blank" rel="noopener noreferrer">
                        Edit
                    </a>
                    <a href="{{ route('admin.pages.delete.blog', $blog->id) }}" class="btn bg-danger mt-4 text-white">
                        Delete
                    </a>

                </div>
                @endforeach


            </div>
        </div>
    </div> <!-- end card -->

</main>
@endsection
