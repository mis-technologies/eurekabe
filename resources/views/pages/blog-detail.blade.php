@extends('layout.app')
@section('content')

  <!-- Navigation -->
  <div id="mini-nav-header"
  class="container flex flex-col items-start justify-between py-10 gap-10 lg:flex-row lg:gap-20 lg:items-center">
  <div
    class="relative w-full p-1 rounded-xl bg-gray-300 max-w-80 focus-within:border-primary focus-within:border-2 dark:text-dark">
    <span class="absolute left-4 top-1/2 -translate-y-1/2">
      <i class="fa-solid fa-magnifying-glass opacity-60"></i>
    </span>
    <input type="text" name="search" id="search"
      class="w-full p-1 pl-10 text-sm font-semibold outline-none bg-transparent" placeholder="Search a topic" />
  </div>
  <ul class="flex items-start justify-start w-full gap-3 overflow-x-scroll md:w-10/12 md:gap-10 md:justify-between md:items-center hide-scrollbar">
    @foreach($categories as $category)
        <li class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80 whitespace-nowrap">
            <a href="{{ route('blogs', ['category_id' => $category->id]) }}" class="tab {{ $category->id == $blog->category_id ? 'active' : '' }}">
                {{ $category->name }}
            </a>
        </li>
    @endforeach
</ul>
</div>

<div class="flex flex-col items-center gap-8 w-full max-w-[1024px] mx-auto px-6 dark:bg-dark-card dark:text-white pb-10">
 <!-- Back Button -->
 <div class="w-full">
   <a href="{{route('blogs')}}"
     class="text-primary uppercase font-bold hover:underline transition-all duration-300"
   >
     <!-- Back to ${category} Articles -->
     Back to blog post
   </a>
 </div>

 <!-- Title -->
 <h1 class="font-bold text-3xl uppercase text-center w-full">
     <!-- ${article.title} -->
     {{$blog?->title}}
 </h1>

 <!-- Image -->
 <img
   src="{{$blog?->image}}"
   alt="${article.title}"
   class="w-full h-auto md:w-auto md:h-80 object-cover rounded-lg"
 />

 <!-- Content -->
 <div class="content text-base text-justify">
     <!-- ${article.fullContent} -->
     {{$blog?->content}}
 </div>

 <!-- Meta Information -->
 <div class="w-full flex flex-wrap gap-4 justify-center text-sm font-semibold dark:text-gray-300">

   <!-- <span class="font-bold italic">Date: ${article.date}</span> -->
   <span class="font-bold italic">Date: {{$blog?->created_at?->diffForHumans()}}</span>
 </div>
</div>

@endsection
