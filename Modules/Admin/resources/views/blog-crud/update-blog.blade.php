@extends('admin::layouts.app')
@include('admin::partials.znotify')


@section('content')
<main class="flex-grow p-6">

    <div class="card">
        <div class="card-header">
            <div class="flex justify-between items-center">
                <h4 class="card-title">Update</h4>
            </div>
        </div>
        <div class="p-6">

            <div class="grid lg:grid-cols-6 gap-6">

                <div>
                    <div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            <div class="text-red-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">{{ $error }}
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <form action="{{route('admin.pages.update.blog', $blog?->id)}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="w-100 h-100 overflow-hidden rounded-t-xl">
                            <label class="block text-sm font-medium text-gray-700">Title</label>
                            <input class="form-input mt-1 block w-full" placeholder="Enter Your Title"
                                value="{{$blog?->title}}" name="title" type="text">
                        </div>

                        <div class="w-100 mt-4 overflow-hidden rounded-t-xl">
                            <label class="block text-sm font-medium text-gray-700">Category</label>

                            <select class="form-input mt-1 block w-full" name="category_id" id="">

                                @if ($blog != null )
                                <option value="{{$blog?->category?->id}}">{{$blog?->category?->name}}</option>
                                @else
                                <option selected disabled>Choose a Category</option>
                                @endif

                                @foreach($cats as $cat)
                                <option value="{{$cat?->id}}">{{$cat?->name}}</option>
                                @endforeach

                            </select>

                        </div>
                        <div class="w-100 mt-4 overflow-hidden rounded-t-xl">
                            <label class="block text-sm font-medium text-gray-700">Status</label>

                            <select class="form-input mt-1 block w-full" name="status" id="">
                                @if ($blog != null)
                                <option value="{{$blog?->status}}">{{$blog?->status}}</option>

                                @else

                                <option selected disabled>Choose a status to update</option>

                                @endif

                                <option value="PUBLISHED">PUBLISHED</option>
                                <option value="DRAFT">DRAFT</option>
                            </select>

                        </div>
                        <div class="w-100 mt-4 overflow-hidden rounded-t-xl">

                            @php
                            $assets = env('APP_URL').'/';
                            @endphp

                            @if ($blog != null)

                            <img style="height: 100%" class="w-64 h-64 object-cover rounded-t-xl"
                                src="{{ $assets.$blog?->image}}" alt="Enter image">
                            @endif

                            <div class="w-50% flex items-center justify-center bg-gray-200">
                                <input type="file" accept="images/*" id="image" name="image"
                                    class="form-input mt-1 block w-50%">
                            </div>
                        </div>

                        <div class="w-100 mt-4 overflow-hidden rounded-t-xl">
                            <label class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea id="editor" name="content" cols="30" rows="10"
                                class="form-input mt-1 block w-full">{!! $blog?->content ?? 'Enter content here'!!}</textarea>
                        </div>

                        <button class="btn bg-primary text-white mt-4" type="submit">
                            Edit
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </div> <!-- end card -->

</main>
@endsection
