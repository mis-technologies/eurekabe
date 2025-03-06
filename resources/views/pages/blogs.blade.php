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
    <ul
        class="flex items-start justify-start w-full gap-3 overflow-x-scroll md:w-10/12 md:gap-10 md:justify-between md:items-center hide-scrollbar">
        @foreach($categories as $category)
            <li class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80 whitespace-nowrap">
                <a href="{{ route('blogs', ['category_id' => $category->id]) }}" class="tab {{ $categoryId == $category->id ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

<div id="programContent" class="container flex flex-wrap gap-8 items-center justify-between mb-8 md:items-start">
    @foreach($blogs as $blog)
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">{{ $blog->title }}</h4>
                    <p class="opacity-50 text-[13px]">{{ Str::limit($blog->content, 100) }}</p>
                    <h6 class="font-bold text-[11px]">{{ $blog->created_at->format('d F, Y') }}</h6>
                    <a href="{{ route('blogs.show', $blog->id) }}"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tabs = document.querySelectorAll(".tab");
        const sections = document.querySelectorAll(".content");

        function showSection(id) {
            sections.forEach(section => {
                section.style.display = section.id === id ? "block" : "none";
            });

            tabs.forEach(tab => {
                tab.classList.toggle("active", tab.getAttribute("href") === `#${id}`);
            });
        }

        const currentHash = window.location.hash.substring(1);
        showSection(currentHash || "tech");

        tabs.forEach(tab => {
            tab.addEventListener("click", function (event) {
                const targetId = this.getAttribute("href").substring(1);
                showSection(targetId);
            });
        });
    });
</script>

@endsection