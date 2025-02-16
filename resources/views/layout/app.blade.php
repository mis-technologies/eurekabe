<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Eureka EdTech</title>
    <link rel="stylesheet" href="{{ asset('asset/styles/output.css')}}" />
    <link rel="stylesheet" href="{{ asset('asset/styles/main.css')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <script
    src="https://kit.fontawesome.com/b4b8be07f5.js"
    crossorigin="anonymous"
    ></script>
    <script type="module"  src="{{ asset('asset/scripts/main.js')}}"></script>
    <script defer src="{{ asset('asset/scripts/data.js')}}"></script>
    
     <!-- App favicon -->
     <link rel="shortcut icon" href="{{asset('asset/images/favicon.png')}}" />

     

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body class="transition-all duration-1000 dark:bg-dark">

    <!-- Navbar Section -->
    <header class="sticky top-0 left-0 z-50 bg-secondary dark:bg-dark transition-all duration-1000">
      <nav class="flex justify-between items-center py-5 container">
        <a class="translate-y-1" href="/">
          <img id="logo" src="{{ asset('asset/images/logo.png')}}" alt="Eureka EdTech" class="" />
        </a>
  
        <div
          class="relative flex items-center min-w-[75%] justify-between gap-20"
          id="nav-bar"
        >
          <!-- Nav Items -->
          <ul
            class="gap-3 relative items-center text-black dark:text-white hidden md:flex justify-between lg:gap-12"
          >
            <li class="font-sans font-bold hover:text-primary  {{ Request::is('/') ? 'active' : '' }}">
              <a href="/">Home</a>
            </li>
            <li class="font-sans font-bold hover:text-primary {{ Request::is('events') ? 'active' : '' }}">
              <a href="/events">Events</a>
            </li>  
            <li class="font-sans font-bold hover:text-primary {{ Request::is('blog') ? 'active' : '' }}">
              <a href="/blog">Blog</a>
            </li>
            <li class="font-sans font-bold hover:text-primary  {{ Request::is('faq') ? 'active' : '' }}">
              <a href="/faq">FAQ</a>
            </li>
            <li class="font-sans font-bold hover:text-primary {{ Request::is('contact') ? 'active' : '' }}">
              <a href="/contact">Contact Us</a>
            </li>
          </ul>
  
          <!-- Toggle Switch formerly here-->
  
          <button
            class="hidden md:block bg-primary p-3 lg:px-4 xl:px-6 max-w-28 xl:max-w-none rounded-[2rem] font-lato font-bold text-white cursor-pointer hover:opacity-90 scale-105"
          >
            <a href="/requestForm"> Become an Advocate </a>
          </button>
        </div>
  
        <!-- Toggle Switch -->
        <label class="flex items-center cursor-pointer absolute right-[20%] md:right-[25%] xl:right-[30%] scale-75 lg:scale-90">
          <div class="relative">
              <input id="theme-toggle" type="checkbox" class="sr-only" />
              <!-- Switch Background -->
              <div class="block bg-black w-[70px] h-9 rounded-full dark:bg-blue-200 transition-all duration-700"></div>
              <div class="block bg-black w-[70px] h-9 rounded-full dark:hidden absolute top-0 left-0">
                <div class="w-full h-full rounded-full relative">
                  <div class="bg-white absolute top-4 left-0 w-[3px] h-[3px] rounded-full"></div>
                  <div class="bg-white absolute top-1/3 left-4 w-[1px] h-[1px] rounded-full"></div>
                  <div class="bg-white absolute bottom-1/3 left-4 w-[1px] h-[1px] rounded-full"></div>
                  <div class="bg-white absolute top-[12%] left-[30%] w-[1px] h-[1px] rounded-full"></div>
                  <!-- <div class="bg-red-400 absolute top-[78%] left-[35%] w-[2px] h-[2px] rounded-full"></div> -->
                  <!-- <div class="bg-red-400 absolute top-[34%] left-[42%] w-[1px] h-[1px] rounded-full"></div> -->
                  <!-- <div class="bg-red-400 absolute top-[5%] left-[40%] w-[1px] h-[1px] rounded-full"></div> -->
                  <!-- <div class="bg-red-400 absolute top-[83%] left-[25%] w-[1px] h-[1px] rounded-full"></div> -->
                  <div class="bg-white absolute top-[29%] left-[20%] w-[1px] h-[1px] rounded-full"></div>
                  <div class="bg-white absolute top-[8%] left-[23%] w-[1px] h-[1px] rounded-full"></div>
                  <div class="bg-white absolute top-[76%] left-[37%] w-[2px] h-[2px] rounded-full"></div>
                  <div class="bg-white absolute bottom-[80%] right-[45%] w-[1.5px] h-[1.5px] rounded-full"></div>
                  <div class="bg-white absolute top-[80%] right-[45%] w-[1.5px] h-[1.5px] rounded-full"></div>
                  <div class="bg-white absolute top-[20%] left-[40%] w-[2px] h-[2px] rounded-full"></div>
                  <div class="bg-white absolute bottom-[80%] right-[45%] w-[1.5px] h-[1.5px] rounded-full"></div>
                  <div class="bg-white absolute bottom-[30%] left-[35%] w-[1px] h-[1px] rounded-full"></div>
                  <div class="bg-white absolute top-[80%] right-[45%] w-[1.5px] h-[1.5px] rounded-full"></div>
  </div>
                </div>
              </div>
              <!-- Switch Icon -->
              <div class="switchIcon absolute right-1 top-1 rounded-full transition-all ease-in-out h-7 w-7">
                <div id="lightIcon" class="relative">
                  <img src="{{ asset('asset/images/icons/Toggle.png')}}" alt=" ">
                  <img src="{{ asset('asset/images/icons/clouds.png')}}" alt="" class="absolute scale-75 -right-2 top-1/2 -translate-y-1/2 cloud-in" id="cloud">
                </div>
                <div id="darkIcon" class="bg-white w-full h-full rounded-full hidden transition-all duration-500">
                  <div class="bg-dark w-full h-full rounded-full -translate-x-2 relative">
                    <div class="bg-white absolute top-[29%] left-[20%] w-[1.5px] h-[1.5px] rounded-full"></div>
                    <div class="bg-white absolute top-[8%] left-[23%] w-[1.5px] h-[1.5px] rounded-full"></div>
                    <div class="bg-white absolute top-[76%] left-[37%] w-[2px] h-[2px] rounded-full"></div>
                    <div class="bg-white absolute bottom-[80%] right-[45%] w-[1.5px] h-[1.5px] rounded-full"></div>
                    <div class="bg-white absolute top-[80%] right-[45%] w-[1.5px] h-[1.5px] rounded-full"></div>
                  </div>
                </div>
              </div>
          </div>
         </label>
  
        <!-- Mobile Nav Bar -->
        <div
          class="container absolute top-24 left-0 w-full py-10 hidden flex-col items-start justify-center gap-6 rounded-lg bg-secondary dark:bg-dark md:hidden"
          id="mobileNav"
        >
          <ul
            class="flex flex-col gap-12 md:relative md:flex-row md:items-center text-black dark:text-white"
          >
            <li class="font-sans font-bold hover:text-primary {{ Request::is('/') ? 'active' : '' }}">
              <a href="/">Home</a>
            </li>
  
            <li class="font-sans font-bold hover:text-primary {{ Request::is('events') ? 'active' : '' }} ">
              <a href="/events">Event</a>
            </li>
  
            <li class="font-sans font-bold hover:text-primary {{ Request::is('contact') ? 'active' : '' }} ">
              <a href="/contact">Contact Us</a>
            </li>
            <li class="font-sans font-bold hover:text-primary {{ Request::is('faq') ? 'active' : '' }} ">
              <a href="/faq">FAQ</a>
            </li>
            <li class="font-sans font-bold hover:text-primary {{ Request::is('blog') ? 'active' : '' }} ">
              <a href="/blog">Blog</a>
            </li>
          </ul>
          <button
            class="bg-primary mt-3 p-3 px-6 rounded-[2rem] font-lato font-bold text-white cursor-pointer hover:opacity-90 scale-105"
          >
            <a href="/requestForm"> Become an Advocate </a>
          </button>
        </div>
  
        <div class="block md:hidden text-black dark:text-white">
          <span class="material-symbols-outlined" id="openMenu">
            &#xe5d2;
          </span>
        </div>
      </nav>
    </header>

        <!-- Page Content -->
        @yield('content')

         <!-- Footer Section -->
         <!-- Footer Section -->
    <footer class="bg-secondary relative dark:bg-dark dark:text-white" >
      <div class="morphism z-10 bg-secondary py-20 relative dark:bg-dark dark:text-white ">
      <div
        class="container w-full flex flex-col items-center mx-auto md:max-w-2xl gap-7 text-center z-[3]"
      >
        <h1 class="text-xl font-bold font-lato md:text-3xl">
          Join our community. Support, Promote, Advocate. Get Started Today.
        </h1>
        <p class="opacity-60 text-base">
          Make a difference in your school today!
        </p>
        <div
          class="flex flex-col justify-center items-center gap-5 w-full md:mt-10 md:flex-row md:items-start md:gap-16"
        >
          <button
            class="w-fit bg-primary px-5 py-3 font-bold text-white rounded-[2rem] cursor-pointer hover:opacity-80 hover:scale-105"
          >
            Join the community
          </button>
          <div class="flex flex-col items-center">
            <button
              class="w-fit px-14 py-2 font-bold text-primary border-2 border-primary rounded-[2rem] cursor-pointer hover:bg-primary hover:text-white"
            >
              Learn more
            </button>
            <img
              src="{{ asset('asset/images/designs/Vector 7.png')}}"
              alt=""
              class="w-1/3 h-auto mt-2"
            />
          </div>
        </div>
      </div>
      <!-- Footer Icons -->
      <!-- <div class="absolute top-1/2 left-10 md:top-1/4 md:left-[15%]">
        <img src="./images/designs/Frame2.png" alt="" />
      </div> -->
      <div class="hidden md:block absolute right-32 top-1/3 scale-75">
        <img src="{{ asset('asset/images/designs/footer-icon2.png')}}" alt="" />
      </div>

    </div>
    <div class="absolute top-0 left-0 h-full bg-slate-0 w-full ">
      <div class="particle-container h-full w-full ">
        <div class="particle">
          <img src="{{ asset('asset/images/particle1.png')}}" alt="" class="opacity-30 dark:opacity-60">
        </div>
        <div class="particle">
          <img src="{{ asset('asset/images/particle2.png')}}" alt="" class="opacity-30 dark:opacity-60">
        </div>
        <div class="particle">
          <img src="{{ asset('asset/images/particle3.png')}}" alt="" class="opacity-30 dark:opacity-60">
        </div>         
    </div> 
      <!-- <div class="particle-container h-full w-full">
        <li class="particle bg-[#070d5a] bg-opacity-50 w-48 h-48 rounded-full list-none"></li>
        <li class="particle bg-[#070d5a] bg-opacity-50 w-52 h-52 rounded-full list-none"></li>
        <li class="particle bg-[#070d5a] bg-opacity-50 w-64 h-64 rounded-full list-none"></li>
    </div>  -->
    </div> 
    </footer>
    

    <!-- Footer Socials -->
     <div class="container flex flex-col items-center justify-between py-7 md:flex-row gap-y-10 dark:text-white">
      <img src="{{ asset('asset/images/logo.png')}}" alt="" class="eurekaLogo md:-translate-x-5 eurekaLogo">
      <div class="text-sm text-center">
        <p class="text-[rgba(0, 0. 0. 0.5)]">
          <a class="underline text-primary" href="privacy.html">Our Privacy policy </a> 
            and 
          <a class="underline text-primary" href="terms-and-condition.html"> Terms & condition </a>
        </p>
        <p class="opacity-50"> &copy; 2024 Eureka. All rights reveserved. For inquries. contact: info@eureka.com</p>
      </div>
      <div class="flex items-center gap-6">
        <a
        href="https://whatapp.com"
        target="_blank"        
        ><i class="fab fa-whatsapp font-bold text-3xl"></i
      ></a>   
      <a
        href="https://x.com"
        target="_blank"     
        ><i class="fab fa-x-twitter font-bold text-3xl"></i></a>
      <a
        href="https://telegram.com"
        target="_blank"        
        ><i class="fab fa-telegram-plane font-bold text-3xl"></i></a>       
      <a
        href="https://linkedin.com"
        target="_blank"        
        ><i class="fab fa-linkedin-in font-bold text-3xl"></i
      ></a>       
      </div>
     </div>

</body>

<script>
  document.addEventListener('DOMContentLoaded', function () {
const themeToggle = document.querySelector('#theme-toggle'); // Example toggle button
const logo = document.querySelector('#logo'); // The logo element

// Check and set initial theme
const currentTheme = localStorage.getItem('theme') || 'light';
document.documentElement.setAttribute('data-theme', currentTheme);

if (currentTheme === 'dark') {
logo.src = '{{ asset("asset/images/white_logo.png") }}'; // Dark logo
} else {
logo.src = '{{ asset("asset/images/logo-dark.png") }}'; // Light logo
}

// Toggle theme on button click
themeToggle.addEventListener('click', () => {
const theme = document.documentElement.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
document.documentElement.setAttribute('data-theme', theme);
localStorage.setItem('theme', theme);

// Change logo based on theme
if (theme === 'dark') {
    logo.src = '{{ asset("asset/images/white_logo.png") }}'; // Dark logo
} else {
    logo.src = '{{ asset("asset/images/logo-dark.png") }}'; // Light logo
}
});
});
</script>

<style>
  /* Light Theme (Default) */
:root {
--bg-color: #ffffff;
--text-color: #000000;
}

/* Dark Theme */
[data-theme="dark"] {
--bg-color: #000000;
--text-color: #ffffff;
}

body {
background-color: var(--bg-color);
color: var(--text-color);
transition: all 0.3s ease;
}
</style>

</html>
