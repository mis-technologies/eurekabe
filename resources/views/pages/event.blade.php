@extends('layout.app')
@section('content')

<div class="container py-20">
  <!-- Events List Container -->
  <div id="eventsList" class="container">
      <!-- Filter Section -->
      <div class="mb-20 space-y-6">
          <h2 class="w-fit p-1 px-4 rounded-xl font-semibold font-roboto text-accent bg-accent bg-opacity-20 mx-auto"> Events</h2>
          <h2 class="text-2xl md:text-4xl lg:text-5xl text-center font-bold">Featured Events</h2>
          <div class="flex items-center gap-4">
              <div class="flex gap-2 rounded-full transition-all duration-200 border border-dark dark:border-white mx-auto">
                  <button onclick="filterEvents('in-person')" 
                          class="filter-btn px-5 py-2 rounded-full bg-primary">
                      In Person
                  </button>
                  <button onclick="filterEvents('virtual')" 
                          class="filter-btn px-5 py-2 rounded-full ">
                      Virtual
                  </button>

                  
              </div>
          </div>
      </div>

      <!-- Events -->
      <div class="event space-y-20 gap-6 md:container">
          <!-- Event cards here -->
      </div>
  </div>

  <!-- Event Detail -->
  <div id="eventDetail" class="hidden max-w-4xl mx-auto">
      <button onclick="showEventList()" class="mb-4 text-primary font-semibold hover:underline">
          ← Back to Events
      </button>
      <div id="detailContent" class="bg-secondary dark:bg-dark2 dark:text rounded-xl p-8 shadow-md">
          <!-- Detail content here -->
      </div>
  </div>
</div>
<script>
  // Event data 
  const events = {
      'in-person': [
          {
              id: 1,
              image: "{{ asset('asset/images/team.png')}}') }}",
              logo: "{{ asset('asset/images/white_logo.png')}}",
              title: 'EasyA Consensus Hong Kong Hackathon',
              date: '19 Feb - 20 Feb 2025 | 48 hours',
              location: 'HONG KONG, HK',
              prize: 'N200,000 NGN',
              description: 'This February, we\'re taking over Hong Kong with our epic Consensus Hong Kong Hackathon...',
              speakers: ['Shayne Coplan (Polymarket)', 'Yat Siu (Animoca Brands)'],
              bonus: 'Free ticket to main Consensus conference',
              upcoming: true,
          },
          {
              id: 2,
              image: "{{ asset('asset/images/team.png')}}",
              logo: "{{ asset('asset/images/white_logo.png')}}",
              title: 'EasyB Hackathon',
              date: '19 Feb - 20 Feb 2025 | 48 hours',
              location: 'Nigeria, NG',
              prize: 'N200,000 NGN',
              description: 'This February, we\'re taking over Hong Kong with our epic Consensus Hong Kong Hackathon...',
              speakers: ['Shayne Coplan (Polymarket)', 'Yat Siu (Animoca Brands)'],
              bonus: 'Free ticket to main Consensus conference',
              upcoming: false,
          },
          {
              id: 3,
              image: "{{ asset('asset/images/team.png')}}",
              logo: "{{ asset('asset/images/white_logo.png')}}",
              title: 'Writing test cases',
              date: '19 Feb - 20 Feb 2025 | 48 hours',
              location: 'HONG KONG, HK',
              prize: 'N200,000 NGN',
              description: 'This February, we\'re taking over Hong Kong with our epic Consensus Hong Kong Hackathon...',
              speakers: ['Shayne Coplan (Polymarket)', 'Yat Siu (Animoca Brands)'],
              bonus: 'Free ticket to main Consensus conference',
              upcoming: false,
          },
          {
              id: 4,
              image: "{{ asset('asset/images/team.png')}}",
              logo: "{{ asset('asset/images/white_logo.png')}}",
              title: 'Eureka Event Hackathon',
              date: '19 Feb - 20 Feb 2025 | 48 hours',
              location: 'HONG KONG, HK',
              prize: 'N200,000 NGN',
              description: 'This February, we\'re taking over Hong Kong with our epic Consensus Hong Kong Hackathon...',
              speakers: ['Shayne Coplan (Polymarket)', 'Yat Siu (Animoca Brands)'],
              bonus: 'Free ticket to main Consensus conference',
              upcoming: true,
          },
          
      ],
      'virtual': [
          {
              id: 6,
              image: "{{ asset('asset/images/team.png')}}",
              logo: "{{ asset('asset/images/white_logo.png')}}",
              title: 'Virtual Blockchain Challenge',
              date: '15 Mar - 17 Mar 2025 | 72 hours',
              location: 'Online Event',
              prize: '$100,000 USD',
              description: 'Join our global virtual hackathon from anywhere in the world...',
              speakers: ['Virtual Speaker 1', 'Virtual Speaker 2'],
              bonus: 'Remote mentoring sessions'
          },
          {
              id: 7,
              image: "{{ asset('asset/images/team.png')}}",
              logo: "{{ asset('asset/images/white_logo.png')}}",
              title: 'Virtual Blockchain Challenge',
              date: '15 Mar - 17 Mar 2025 | 72 hours',
              location: 'Online Event',
              prize: '$100,000 USD',
              description: 'Join our global virtual hackathon from anywhere in the world...',
              speakers: ['Virtual Speaker 1', 'Virtual Speaker 2'],
              bonus: 'Remote mentoring sessions'
          },
          
      ]
  };

  // Initialize events
  document.addEventListener('DOMContentLoaded', () => {
      renderEvents('in-person');
  });

  // Render events list
  function renderEvents(type) {
      const container = document.querySelector('#eventsList .event');
      container.innerHTML = '';
      
      events[type].forEach(event => {
          container.innerHTML += `
              <div class="relative flex lg:h-[600px] overflow:hidden"
                   data-event-type="${type}">
                   
                   <div class="w-full h-full relative">
                      <img class="w-full h-full object-cover rounded-2xl -z-20" src="${event.image}" alt="${event.title}">
                      <div class="w-full h-full bg-gradient-to-t from-white dark:from-dark to-[rgba(0,0,0,0.1)] absolute top-0"></div>
                      <div class="absolute -top-10 -right-10 h-24 w-52 shadow bg-gray-200 dark:bg-dark2  rounded-xl p-4">
                          <img class="w-full h-auto object-center" src="${event.logo}" alt="${event.title}">
                      </div>
                   </div>

                  <div class="absolute top-10 left-10 h-10 text-white flex items-center">
                      <div class="flex">
                          <div class="w-10 h-10 rounded-full border-[2px] border-primary bg-red-100 ">
                              <img src="{{ asset('asset/images/Marv.png')}}" alt="" class="w-full h-auto object-cover">
                          </div>
                          <div class="w-10 h-10 rounded-full border-[2px] border-primary bg-pink-100 -translate-x-1/2">
                              <img src="{{ asset('asset/images/Marv.png')}}" alt="" class="w-full h-auto object-cover">
                          </div>
                          <div class="w-10 h-10 rounded-full border-[2px] border-primary bg-green-100 -translate-x-full">
                              <img src="{{ asset('asset/images/Marv.png')}}" alt="" class="w-full h-auto object-cover">
                          </div>
                      </div>
                      <div class="flex items-center gap-2 p-1 px-4 rounded-xl font-semibold font-roboto bg-opacity-20 ${event.upcoming ? "bg-green-300 text-green-500" : "bg-dark"}">
                          <span class="uppercase"> ${event.upcoming ? "Upcoming" : "past"} </span>                                
                      </div>
                  </div>

                  <div class="absolute top-1/4 md:-left-[10%] h-2/3 w-full md:w-[45%] bg-gray-200 dark:bg-dark2 rounded-2xl md:rounded-3xl p-6 dark:text-white">
                  <div class="flex items-center gap-2 mb-4 font-roboto">
                      <span class="text-primary text-2xl font-semibold">${event.prize} </span>
                      <span class="text-sm">in total prizes</span>
                  </div>
                  <div class="">
                      <h3 class="font-bold text-4xl font-roboto mb-5">${event.title}</h3>
                      <div class="flex flex-col gap-4"> 
                          <p class="dark:text-gray-100">${event.date}</p>
                          <span class="rounded-full w-fit px-2 text-gray-100 bg-gray-600">${event.location}</span>
                      </div>
                  <button 
                      class='border-2 border-dark dark:border-white rounded-lg p-2 px-14 font-semibold mt-10 transition-all duration-200 ${event.upcoming ? "bg-primary hover:bg-transparent" : "hover:bg-white hover:text-black" }'
                      onclick="showEventDetail(${event.id}, '${type}')">
                      View details
                  </button>

                  </div>
                  </div>
              </div>
          `;
      });
  }

  // Show event detail view
  function showEventDetail(eventId, type) {
      const event = events[type].find(e => e.id === eventId);
      const detailContainer = document.getElementById('detailContent');
      
      detailContainer.innerHTML = `
          <h1 class="text-3xl font-bold mb-4">${event.title}</h1>
          <div class="text-primary text-xl font-bold mb-4">${event.prize}</div>
          <div class="mb-6">
              <p class="text-gray-500">${event.date}</p>
              <p class="text-gray-500">${event.location}</p>
          </div>
          <div class="prose mb-6">
              <p>${event.description}</p>
          </div>
          <div class="bg-primary bg-opacity-20 p-4 rounded-lg mb-6">
              <h3 class="text-xl font-bold mb-2">Featured Speakers:</h3>
              <ul class="list-disc pl-6">
                  ${event.speakers.map(speaker => `<li>${speaker}</li>`).join('')}
              </ul>
          </div>
          <div class="bg-primary bg-opacity-20 p-4 rounded-lg">
              <h3 class="text-xl font-bold mb-2">Special Bonus:</h3>
              <p>${event.bonus}</p>
          </div>
          <button class="mt-6 w-full bg-primary text-white py-3 rounded-lg hover:bg-opacity-50 transition-all">
              Register Now
          </button>
      `;

      document.getElementById('eventsList').classList.add('hidden');
      document.getElementById('eventDetail').classList.remove('hidden');
  }

  // Show event list view
  function showEventList() {
      document.getElementById('eventsList').classList.remove('hidden');
      document.getElementById('eventDetail').classList.add('hidden');
  }

  // Filter events
  function filterEvents(type) {
      renderEvents(type);
      const buttons = document.querySelectorAll('.filter-btn');
          buttons.forEach(btn => {
              btn.classList.remove('bg-primary'); 
          });

          const activeButton = document.querySelector(`.filter-btn[onclick="filterEvents('${type}')"]`); 
          if (activeButton) {
              activeButton.classList.add('bg-primary'); 
          }
  }
</script>

@endsection