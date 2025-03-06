@extends('layout.app')
@section('content')
<section class="flex flex-col md:flex-row-reverse gap-10 h-full w-full items-center justify-center">
    <div id="image-container" class="hidden w-full md:w-1/2 md:flex items-center justify-center relative">
        <img id="register-image" src="/asset/images//team.png" alt="Register" class="max-h-full w-full object-cover" />
        <div
            class="bg-[#E4F1FF] text-black max-w-md h-fit w-full absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-[20px] p-6 px-8 text-center pb-10">
            <h1 class="text-[28px] font-bold">Already signed up?</h1>
            <p class="text-[20px] opacity-80 mt-5 mb-12">
                Login your account so you can learn and explore more from Eureka.
            </p>
            <a href="/login"
                class="text-[#006BE5] font-bold text-[20px] p-2 px-24 rounded-[25px] border-2 border-[#006BE5] cursor-pointer hover:bg-[#006BE5] hover:text-white transition ease-in-out duration-150">
                LOG IN
            </a>
        </div>
    </div>

    <!-- Forms -->
    <div id="form-container" class="w-full h-full md:w-1/2 flex flex-col p-8 lg:px-12 rounded-lg pt-28 pb-0">
        <div class="h-fit overflow-y-scroll hide-scrollbar flex flex-col justify-start px-1">


            <!-- form one -->
            <form id="signUpForm" class="form mb-5">
                <h3 class="text-xl lg:text-3xl font-bold mb-10 tracking-wider lg:text-start text-flip-container">
                    Join the community and <br />become
                    <span class="text-primary" id="text-container">an Advocate.</span>
                </h3>

                <div class="mb-4">
                    <label class="block text-black font-semibold dark:text-white">Full Name</label>
                    <input id="full_name" type="text" required placeholder="John Doe"
                        class="p-2 px-5 border rounded-full w-full bg-transparent" />
                </div>

                <div class="mb-4">
                    <label class="block text-black font-semibold dark:text-white">Password</label>
                    <input id="password" type="password" required placeholder="Your.8.Character@Password!"
                        class="p-2 px-5 border rounded-full w-full bg-transparent" />
                </div>
                <div class="mb-4">
                    <label class="block text-black font-semibold dark:text-white">Password Confirmation</label>
                    <input id="password_confirmation" type="password" required placeholder="Your.8.Character@Password!"
                        class="p-2 px-5 border rounded-full w-full bg-transparent" />
                </div>

                <div class="mb-4">
                    <label class="block text-black font-semibold dark:text-white">Gender</label>
                    <select id="gender" required
                        class="p-2 px-5 border rounded-full w-full bg-transparent appearance-none ">
                        <option value="" class="opacity-20">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-black font-semibold dark:text-white">Institution</label>
                    <select id="school_id" required
                        class="p-2 px-5 border rounded-full w-full bg-transparent appearance-none ">
                        <option value="" class="opacity-20">Select Institution</option>

                        @foreach ($schools as $sch)

                        <option value="{{$sch?->id}}" class="">{{$sch?->name}}, {{$sch?->acronym}}</option>

                        @endforeach

                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-black font-semibold dark:text-white">Level</label>
                    <input id="level" type="number" placeholder="300" required
                        class="p-2 px-5 border rounded-full w-full bg-transparent" />
                </div>
                <div class="mb-4">
                    <label class="block text-black font-semibold dark:text-white">Current CGPA</label>
                    <input id="cgpa" type="number" placeholder="5.00" required
                        class="p-2 px-5 border rounded-full w-full bg-transparent" />
                </div>
                <div class="form-group w-full">
                    <button id="continue-button" type="button"
                        class="bg-primary w-full text-white px-4 mt-5 py-2 rounded-full disabled:bg-[#D9D9D9] disabled:text-gray-500 disabled:cursor-not-allowed"
                        disabled>
                        Continue
                    </button>
                </div>
            </form>

            <!-- Form two -->
            <form id="second-form" class="form hidden">

                @if ($errors->any())
                <div class="mb-4">
                    <ul class="list-disc list-inside text-red-600">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <h3 class="text-xl lg:text-3xl font-bold mb-10 tracking-wider lg:text-start text-flip-container2">
                    Join the community and <br />become
                    <span class="text-primary" id="text-container2">an Advocate.</span>
                </h3>

                <div class="mb-4">
                    <label class="block text-black font-semibold dark:text-white">Email</label>
                    <input id="email" type="email" required placeholder="johndoe@gmail.com"
                        class="p-2 px-5 border rounded-full w-full bg-transparent" />
                </div>

                <div class="mb-4">
                    <label class="block text-black font-semibold dark:text-white">Do you have a leadership experience in
                        the
                        institution?</label>
                    <input id="leading_experience" required placeholder="Your reason"
                        class="mt-2 p-2 px-5 border rounded-full w-full bg-transparent" />
                </div>
                <div class="mb-4">
                    <label class="block text-black font-semibold dark:text-white">If yes, which position was
                        that?</label>
                    <input id="position" type="text" required placeholder="Yes"
                        class="mt-2 p-2 px-5 border rounded-full w-full bg-transparent" />
                </div>
                <div class="mb-4">
                    <label class="block text-black font-semibold dark:text-white">Give us your three attributes of a
                        leader you
                        find dear.</label>
                    <input id="leading_attribute" type="text" required placeholder="Money minded, Disciplined, Smart."
                        class="mt-2 p-2 px-5 border rounded-full w-full bg-transparent" />
                </div>
                <div class="mb-4">
                    <label class="block text-black font-semibold dark:text-white">Tell us how you know about
                        Eureka.</label>
                    <select id="refereed_by" required
                        class="p-2 px-5 border rounded-full w-full bg-transparent appearance-none ">
                        <option value="" class="opacity-20">Select Option</option>
                        <option value="Friends">Friend</option>
                        <option value="Family">Family</option>
                        <option value="Social">Social Media</option>
                        <option value="Event">Event</option>

                    </select>
                </div>
                <div class="form-group w-full">
                    <button id="apply-button" type="button"
                        class="bg-primary w-full text-white px-4 py-2 mt-5 rounded-full disabled:bg-[#D9D9D9] disabled:text-gray-500 disabled:cursor-not-allowed"
                        disabled>
                        <span id="button-text">Apply</span>
                    </button>
                </div>
            </form>

            <!-- Dots -->
            <div class="flex justify-center mt-4 mb-8">
                <span id="dot1" class="dot active"></span>
                <span id="dot2" class="dot"></span>
            </div>
        </div>
    </div>
</section>

<!-- POPUP animation -->
<div class="submit_popup z-10" id="submit_popup">
    <!-- Loader -->
    <div class="submit_loader flex justify-center items-center" id="submit_loader">
        <div class="flex items-center justify-center h-full w-full">
            <img src="/asset/images/loader.gif" class="object-cover" alt="preloader" />
        </div>
    </div>
    <!-- Popup  -->
    <div class="submit_success container bg-white rounded-xl w-full h-fit max-w-[300px] md:max-w-[580px] items-center justify-center translate-y-5 py-12 dark:bg-dark relative"
        id="submit_success">
        <button
            class="absolute top-0 right-0 text-black dark:text-white font-bold text-3xl p-5 rounded-full  flex items-center justify-center cursor-pointer hover:opacity-90"
            id="close_popup">&times;
        </button>
        <div class="flex-col flex items-center justify-center gap-10 h-full w-full">
            <img src="/asset/images/mail_sent.gif" alt="" />
            <div class="flex flex-col items-center w-full text-primary gap-3 dark:text-white">
                <button class="" id="redirect_home">Click to Verify Email</button>
                {{-- <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded" id="redirect_home">Go to
                    Home</button> --}}
                {{-- <button class="" id="">Go to Home</button> --}}

                <h1 class="font-bold text-center text-3xl pb-2">Registration Successful!</h1>
                <!-- <p class="font-semibold text-center text-lg">We get back to you via email, thank you.</p> -->
            </div>
        </div>
    </div>
</div>

<script>
    const verificationUrl = "/verify-email";
   
</script>

<script src="/asset/src/scripts/main.js"></script>

@endsection
