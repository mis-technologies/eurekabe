@extends('layout.app')
@section('content')

<div class="container py-20">
    <!-- Events List Container -->
    <div id="eventListContainer" class="container">
        <!-- Headings section -->
        <div class="mb-20 space-y-6">
            <h2 class="w-fit p-1 px-4 rounded-xl font-semibold font-roboto text-accent bg-accent bg-opacity-20 mx-auto">
                Events</h2>
            <h2 class="text-2xl md:text-4xl lg:text-5xl text-center font-bold">Featured Events</h2>

            <!-- Mini Nav -->
            <div class="flex items-center gap-4">
                <ul class="flex gap-2 rounded-full transition-all duration-200 border border-dark dark:border-white mx-auto">
                    <li class="filter-btn px-5 py-2 rounded-full">
                        <a href="#physical" class="tab">In Person</a>
                    </li>
                    <li class="filter-btn px-5 py-2 rounded-full bg-primary">
                        <a href="#virtual" class="tab">Virtual</a>
                    </li>
                </ul>
            </div>
        </div>

        @php
        $assets = env('APP_URL').'/';
        // dd($events);
        @endphp

        <section id="eventsList">
            <!-- In person events -->
            <div id="physical" class="content space-y-20 gap-6 md:container">
                @if($events->isEmpty())
                    <p>No data available</p>
                @else
                    @foreach ($events as $event)
                        @if($event->type == 'in_person')
                        <div style="margin-bottom: 250px" class="relative flex lg:h-[600px] overflow:hidden">
                            <!-- BG Image -->
                            <div class="w-full h-full relative">
                                <!-- Toggle Button -->
                                <div onclick="toggleDetails()" style="color: #4F92FE" class="toggler absolute -top-10 -left-100 h-10 w-1000 shadow bg-danger-600 overflow-hidden rounded-xl p-4 cursor-pointer">
                                    Show more details
                                    <i class="fa fa-eye"></i>
                                    <i class="fa fa-close hidden"></i>
                                </div>



                                <img class="w-full h-full object-cover rounded-2xl -z-20" src="{{$assets.$event->getRawOriginal('image')}}" alt="image here">
                                {{-- <img class="w-full h-full object-cover rounded-2xl -z-20" src="/{{$event->getRawOriginal('image')}}" alt="image here"> --}}
                                <div class="w-full h-full bg-gradient-to-t from-white dark:from-dark to-[rgba(0,0,0,0.1)] absolute top-0"></div>

                                <!-- Event Sponsors -->
                                @foreach ($event['sponsors'] as $sponsor)
                                <div class="toggleUp hidden md:block absolute -top-10 -right-10 h-24 w-52 shadow bg-gray-200 dark:bg-dark2 overflow-hidden rounded-xl p-4">
                                    <img class="w-auto h-full object-cover mx-auto" src="{{ $sponsor['logo_url'] }}" alt="logo">
                                </div>
                                @endforeach

                                <!-- Event Type -->
                                <div class="toggleUp hidden md:flex absolute top-10 left-10 h-10 text-white flex items-center">
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

                                <!-- Event Detail Card -->
                                <div class="toggleUp absolute top-1/4 md:-left-[10%] h-2/3 w-full md:w-[45%] bg-gray-200 dark:bg-dark2 rounded-2xl md:rounded-3xl p-6 dark:text-white">
                                    <div class="flex items-center gap-2 mb-4 font-roboto">
                                        <span class="text-primary text-2xl font-semibold">{{ $event->price }} </span>
                                        <span class="text-sm">in total prizes</span>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-4xl font-roboto mb-5">{{ $event->title }}</h3>
                                        <div class="flex flex-col gap-4">
                                            <p class="dark:text-gray-100">{{ \Carbon\Carbon::parse($event->start_datetime)->format('d M') }} - {{ \Carbon\Carbon::parse($event->end_datetime)->format('d M Y') }} | {{ $event->duration }} hours</p>
                                            <span class="rounded-full w-fit px-2 text-gray-100 bg-gray-600 uppercase">{{ $event->location }}</span>
                                        </div>
                                        <button onclick="showEventDetail({{ json_encode($event) }})" class='border-2 border-dark dark:border-white rounded-lg p-2 px-14 font-semibold mt-10 transition-all duration-200 {{ $event->status == "UPCOMING" ? "bg-primary hover:bg-transparent" : "hover:bg-white hover:text-black" }}'>
                                            View details
                                        </button>
                                    </div>
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
                        <div style="margin-bottom: 250px" class="relative flex lg:h-[600px] overflow:hidden">
                            <!-- BG Image -->
                            <div class="w-full h-full relative">
                                <!-- Toggle Button -->
                                <div onclick="toggleDetails()"  style="color: #4F92FE" class="toggler absolute -top-10 -left-100 h-10 w-1000 shadow bg-danger-600 overflow-hidden rounded-xl p-4 cursor-pointer">
                                    Show more details
                                    <i class="fa fa-eye"></i>
                                    <i class="fa fa-close hidden"></i>
                                </div>
                                <img class="w-full h-full object-cover rounded-2xl -z-20" src="{{$assets. $event->getRawOriginal('image') }}" alt="image here">
                                <div class="w-full h-full bg-gradient-to-t from-white dark:from-dark to-[rgba(0,0,0,0.1)] absolute top-0"></div>
                                <!-- event logo -->
                                @foreach ($event['sponsors'] as $sponsor)
                                <div class=" toggleUp hidden md:block absolute -top-10 -right-10 h-24 w-52 shadow bg-gray-200 dark:bg-dark2 overflow-hidden rounded-xl p-4">
                                    <img class="w-auto h-full object-cover mx-auto" src="{{ $sponsor['logo_url'] }}" alt="logo">
                                </div>
                                @endforeach
                            </div>

                            <!-- Event type-->
                            <div class="toggleUp hidden md:flex absolute top-10 left-10 h-10 text-white flex items-center">
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
                            <div class=" toggleUp  absolute top-1/4 md:-left-[10%] h-2/3 w-full md:w-[45%] bg-gray-200 dark:bg-dark2 rounded-2xl md:rounded-3xl p-6 dark:text-white">
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
                                    <button onclick="showEventDetail({{ json_encode($event) }})" class='border-2 border-dark dark:border-white rounded-lg p-2 px-14 font-semibold mt-10 transition-all duration-200 {{ $event->status == "UPCOMING" ? "bg-primary hover:bg-transparent" : "hover:bg-white hover:text-black" }}'>
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
                <h1 id="eventTitle" class="text-3xl font-bold mb-4"></h1>
                <div id="eventPrice" class="text-primary text-xl font-bold mb-4"></div>
                <div id="eventDateLocation" class="mb-6"></div>
                <div id="eventDescription" class="prose mb-6"></div>
                <div id="eventSpeakers" class="bg-primary bg-opacity-20 p-4 rounded-lg mb-6"></div>
                <div id="eventBonus" class="bg-primary bg-opacity-20 p-4 rounded-lg"></div>
                <button class="register-now-button mt-6 w-full bg-primary text-white py-3 rounded-lg hover:bg-opacity-50 transition-all">
                    Register Now
                </button>
            </div>
        </div>
    </section>
</div>

<!-- JavaScript for Toggle Functionality -->
<script>
    function toggleDetails() {
        let elements = document.querySelectorAll('.toggleUp');
        let eyeIcon = document.querySelector('.fa-eye');
        let closeIcon = document.querySelector('.fa-close');

        elements.forEach(el => {
            el.classList.toggle('hidden');
        });

        eyeIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    }

    function showEventDetail(event) {
        document.getElementById('eventTitle').innerText = event.title;
        document.getElementById('eventPrice').innerText = event.price + ' in total prizes';
        document.getElementById('eventDateLocation').innerHTML = `<p class="text-gray-500">${new Date(event.start_datetime).toLocaleDateString('en-GB', { day: '2-digit', month: 'short' })} - ${new Date(event.end_datetime).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' })} | ${event.duration} hours</p><p class="text-gray-500">${event.location}</p>`;
        document.getElementById('eventDescription').innerHTML = event.description;
        document.getElementById('eventBonus').innerHTML = event.special_bonus;


        let speakersHtml = '<h3 class="text-xl font-bold mb-2">Featured Speakers:</h3><ul class="list-disc pl-6">';
        event.speakers.forEach(speaker => {
            speakersHtml += `<li>${speaker.name}</li>`;
        });
        speakersHtml += '</ul>';
        document.getElementById('eventSpeakers').innerHTML = speakersHtml;

      // Set the onclick attribute of the Register Now button to open the event registration link
      document.querySelector('.register-now-button').setAttribute('onclick', `window.open('${event.reg_link}', '_blank');`);

        document.getElementById('eventListContainer').classList.add('hidden');
        document.getElementById('eventDetail').classList.remove('hidden');
    }

    function showEventList() {
        document.getElementById('eventListContainer').classList.remove('hidden');
        document.getElementById('eventDetail').classList.add('hidden');
    }
</script>

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
</script>

@endsection
