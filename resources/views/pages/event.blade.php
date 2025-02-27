@extends('layout.app')
@section('content')

<div class="container py-20">
    <!-- Events List Container -->
    <div id="eventListContainer" class="container">
        <!-- Headins section -->
        <div class="mb-20 space-y-6">
            <h2 class="w-fit p-1 px-4 rounded-xl font-semibold font-roboto text-accent bg-accent bg-opacity-20 mx-auto">
                Events</h2>
            <h2 class="text-2xl md:text-4xl lg:text-5xl text-center font-bold">Featured Events</h2>

            <!-- Mini Nav -->
            <div class="flex items-center gap-4">
                <ul
                    class="flex gap-2 rounded-full transition-all duration-200 border border-dark dark:border-white mx-auto">
                    <li class="filter-btn px-5 py-2 rounded-full">
                        <a href="#physical" class="tab">In Person</a>
                    </li>
                    <li class="filter-btn px-5 py-2 rounded-full bg-primary">
                        <a href="#virtual" class="tab">Virtual</a>
                    </li>
                </ul>
            </div>
        </div>

        <section id="eventsList">
            <!-- In person events -->
            <div id="physical" class="content space-y-20 gap-6 md:container">
                @if($events->isEmpty())
                    <p>No data available</p>
                @else
                    @foreach ($events as $event)
                        @if($event->type == 'in_person')
                        <div class="relative flex lg:h-[600px] overflow:hidden">
                            <!-- BG Image -->
                            <div class="w-full h-full relative">
                                <img class="w-full h-full object-cover rounded-2xl -z-20" src="{{ $event->image }}" alt="image here">
                                <div class="w-full h-full bg-gradient-to-t from-white dark:from-dark to-[rgba(0,0,0,0.1)] absolute top-0"></div>
                                <!-- event logo -->
                                @foreach ($event['sponsors'] as $sponsor)
                                <div class="absolute -top-10 -right-10 h-24 w-52 shadow bg-gray-200 dark:bg-dark2 overflow-hidden rounded-xl p-4">
                                    <img class="w-auto h-full object-cover mx-auto" src="{{ $sponsor['logo_url'] }}" alt="logo">
                                </div>
                                @endforeach
                            </div>

                            <!-- Event type-->
                            <div class="absolute top-10 left-10 h-10 text-white flex items-center">
                                <div class="flex">
                                    @foreach ($event['speakers'] as $speaker)
                                    <div class="w-10 h-10 rounded-full border-[2px] border-primary bg-red-100">
                                        <img src="{{ $speaker['img_url'] }}" alt="" class="w-full h-auto object-cover">
                                    </div>
                                    @endforeach
                                </div>
                                <div class="p-1 px-4 rounded-xl font-semibold font-roboto bg-opacity-20 bg-green-300 text-green-500">
                                    <span class="uppercase"> {{ $event->status }} </span>
                                </div>
                            </div>

                            <!-- Event Detail card -->
                            <div class="absolute top-1/4 md:-left-[10%] h-2/3 w-full md:w-[45%] bg-gray-200 dark:bg-dark2 rounded-2xl md:rounded-3xl p-6 dark:text-white">
                                <div class="flex items-center gap-2 mb-4 font-roboto">
                                    <span class="text-primary text-2xl font-semibold">{{ $event->price }} </span>
                                    <span class="text-sm">in total prizes</span>
                                </div>
                                <div class="">
                                    <h3 class="font-bold text-4xl font-roboto mb-5">{{ $event->title }}</h3>
                                    <div class="flex flex-col gap-4">
                                        <p class="dark:text-gray-100">{{ \Carbon\Carbon::parse($event->start_datetime)->format('d M') }} - {{ \Carbon\Carbon::parse($event->end_datetime)->format('d M Y') }} | {{ $event->duration }} hours</p>
                                        <span class="rounded-full w-fit px-2 text-gray-100 bg-gray-600 uppercase">{{ $event->location }}</span>
                                    </div>
                                    <button onclick="showEventDetail()"
                                        class='border-2 border-dark dark:border-white rounded-lg p-2 px-14 font-semibold mt-10 transition-all duration-200 {{ $event->status == "UPCOMING" ? "bg-primary hover:bg-transparent" : "hover:bg-white hover:text-black" }}'>
                                        View details
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif
            </div>

          
            <!-- Virtual events -->
            <div id="virtual" class="content space-y-20 gap-6 md:container">
                @if($events->isEmpty())
                    <p>No data available</p>
                @else
                    @foreach ($events as $event)
                        @if($event->type == 'virtual')
                        <div class="relative flex lg:h-[600px] overflow:hidden">
                            <!-- BG Image -->
                            <div class="w-full h-full relative">
                                <img class="w-full h-full object-cover rounded-2xl -z-20" src="{{ $event->image }}" alt="image here">
                                <div class="w-full h-full bg-gradient-to-t from-white dark:from-dark to-[rgba(0,0,0,0.1)] absolute top-0"></div>
                                <!-- event logo -->
                                @foreach ($event['sponsors'] as $sponsor)
                                <div class="absolute -top-10 -right-10 h-24 w-52 shadow bg-gray-200 dark:bg-dark2 overflow-hidden rounded-xl p-4">
                                    <img class="w-auto h-full object-cover mx-auto" src="{{ $sponsor['logo_url'] }}" alt="logo">
                                </div>
                                @endforeach
                            </div>

                            <!-- Event type-->
                            <div class="absolute top-10 left-10 h-10 text-white flex items-center">
                                <div class="flex">
                                    @foreach ($event['speakers'] as $speaker)
                                    <div class="w-10 h-10 rounded-full border-[2px] border-primary bg-red-100">
                                        <img src="{{ $speaker['img_url'] }}" alt="" class="w-full h-auto object-cover">
                                    </div>
                                    @endforeach
                                </div>
                                <div class="p-1 px-4 rounded-xl font-semibold font-roboto bg-opacity-20 bg-green-300 text-green-500">
                                    <span class="uppercase"> {{ $event->status }} </span>
                                </div>
                            </div>

                            <!-- Event Detail card -->
                            <div class="absolute top-1/4 md:-left-[10%] h-2/3 w-full md:w-[45%] bg-gray-200 dark:bg-dark2 rounded-2xl md:rounded-3xl p-6 dark:text-white">
                                <div class="flex items-center gap-2 mb-4 font-roboto">
                                    <span class="text-primary text-2xl font-semibold">{{ $event->price }} </span>
                                    <span class="text-sm">in total prizes</span>
                                </div>
                                <div class="">
                                    <h3 class="font-bold text-4xl font-roboto mb-5">{{ $event->title }}</h3>
                                    <div class="flex flex-col gap-4">
                                        <p class="dark:text-gray-100">{{ \Carbon\Carbon::parse($event->start_datetime)->format('d M') }} - {{ \Carbon\Carbon::parse($event->end_datetime)->format('d M Y') }} | {{ $event->duration }} hours</p>
                                        <span class="rounded-full w-fit px-2 text-gray-100 bg-gray-600 uppercase">{{ $event->location }}</span>
                                    </div>
                                    <button onclick="showEventDetail()"
                                        class='border-2 border-dark dark:border-white rounded-lg p-2 px-14 font-semibold mt-10 transition-all duration-200 {{ $event->status == "UPCOMING" ? "bg-primary hover:bg-transparent" : "hover:bg-white hover:text-black" }}'>
                                        View details
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </section>
    </div>

    <!-- Event Detail -->
    <section id="eventDetailContainer">
        <div id="eventDetail" class="hidden max-w-4xl mx-auto">
            <button onclick="showEventList()" class="mb-4 text-primary font-semibold hover:underline">
                ← Back to Events
            </button>
            <div id="detailContent" class="bg-secondary dark:bg-dark2 dark:text rounded-xl p-8 shadow-md">
                <h1 class="text-3xl font-bold mb-4">EasyA Consensus Hong Kong Hackathon</h1>
                <div class="text-primary text-xl font-bold mb-4">N200,000 NGN</div>
                <div class="mb-6">
                    <p class="text-gray-500">20 Feb 2025 | 4 hours</p>
                    <p class="text-gray-500">NIGERIA, NG</p>
                </div>
                <div class="prose mb-6">
                    <p>This February, we\'re taking over Hong Kong with our epic Consensus Hong Kong Hackathon...</p>
                </div>
                <div class="bg-primary bg-opacity-20 p-4 rounded-lg mb-6">
                    <h3 class="text-xl font-bold mb-2">Featured Speakers:</h3>
                    <ul class="list-disc pl-6">
                        <li>Michael Marvelous</li>
                        <li>Cliton Brown Sugar</li>
                        <li>Joseph</li>
                    </ul>
                </div>
                <div class="bg-primary bg-opacity-20 p-4 rounded-lg')}}">
                    <h3 class="text-xl font-bold mb-2">Special Bonus:</h3>
                    <p>Free ticket to main Consensus conference</p>
                </div>
                <button class="mt-6 w-full bg-primary text-white py-3 rounded-lg hover:bg-opacity-50 transition-all">
                    Register Now
                </button>
            </div>
        </div>
    </section>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
   const tabs = document.querySelectorAll(".filter-btn"); // Select <li> instead of <a>
   const sections = document.querySelectorAll(".content");

   function showSection(id) {
     sections.forEach(section => {
       section.style.display = section.id === id ? "block" : "none";
     });

     tabs.forEach(tab => {
       const anchor = tab.querySelector("a"); // Get the <a> inside <li>
       tab.classList.toggle("bg-primary", anchor.getAttribute("href") === `#${id}`);
     });
   }

   const currentHash = window.location.hash.substring(1);
   showSection(currentHash || "physical");

   tabs.forEach(tab => {
     tab.addEventListener("click", function (event) {
       event.preventDefault(); // Prevent default anchor behavior
       const targetId = this.querySelector("a").getAttribute("href").substring(1);
       showSection(targetId);
       history.replaceState(null, null, `#${targetId}`); // Update URL without page reload
     });
   });
 });

       // Show event detail
       const eventListContainer = document.getElementById("eventsList");
       const eventDetailContainer = document.getElementById("eventDetail");

       const showEventDetail = () => {
         eventListContainer.classList.add("hidden");
         eventDetailContainer.classList.remove("hidden");
       };
       const showEventList = () => {
         eventListContainer.classList.remove("hidden");
         eventDetailContainer.classList.add("hidden");
       };
</script>

@endsection
