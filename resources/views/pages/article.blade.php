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
    <li class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80 whitespace-nowrap">
      <a href="/blog.html#tech" class="tab">Trending Now</a>
    </li>
    <li class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80">
      <a href="/blog.html#dev" class="tab">Technology</a>
    </li>
    <li class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80">
      <a href="/blog.html#entertainment" class="tab">Entertainment</a>
    </li>
    <li class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80">
      <a href="/blog.html#marketing" class="tab">Marketing</a>
    </li>
    <li class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80">
      <a href="/blog.html#sports" class="tab">Sports</a>
    </li>
    <li class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80">
      <a href="/blog.html#politics" class="tab">Politics</a>
    </li>
  </ul>
</div>

<div class="flex flex-col items-center gap-8 w-full max-w-[1024px] mx-auto px-6 dark:bg-dark-card dark:text-white pb-10">
 <!-- Back Button -->
 <div class="w-full">
   <a href="{{route('pages.blogs')}}"
     class="text-primary uppercase font-bold hover:underline transition-all duration-300"
   >
     <!-- Back to ${category} Articles -->
     Back to blog post
   </a>
 </div>

 <!-- Title -->
 <h1 class="font-bold text-3xl uppercase text-center w-full">
     <!-- ${article.title} -->
     The revolution Ai Chatbot Training library for NodeJS
 </h1>

 <!-- Image -->
 <img
   src="/asset/images/programs/ent.jpg"
   alt="${article.title}"
   class="w-full h-auto md:w-auto md:h-80 object-cover rounded-lg"
 />

 <!-- Content -->
 <div class="content text-base text-justify">
     <!-- ${article.fullContent} -->
     Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quas necessitatibus quibusdam dolor, optio perspiciatis sint blanditiis, provident cum expedita corrupti nemo maiores laudantium sequi, incidunt amet. Quam officia aliquid, aut error pariatur, veritatis voluptatibus ducimus sequi alias dicta velit maxime accusamus sit quis quod nobis nostrum labore amet qui nemo?
 </div>

 <!-- Meta Information -->
 <div class="w-full flex flex-wrap gap-4 justify-center text-sm font-semibold dark:text-gray-300">

   <!-- <span class="font-bold italic">Date: ${article.date}</span> -->
   <span class="font-bold italic">Date: 22 Feb, 2025</span>
 </div>
</div>

@endsection
