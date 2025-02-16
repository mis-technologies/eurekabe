@extends('layout.app')
@section('content')

<section
class="flex flex-col md:flex-row-reverse gap-10 h-full w-full items-center justify-center"
>
<!-- Image Container -->
<div
  id="image-container"
  class="hidden w-full md:w-1/2 md:flex items-center justify-center relative"
>
  <img
    id="register-image"
    src="{{ asset('asset/images/team.png')}}"
    alt="Register"
    class="max-h-full w-full object-cover"
  />
  <div
    class="bg-[#E4F1FF] text-black max-w-xs h-fit w-full absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-[20px] p-5 text-center flex flex-col items-center justify-center gap-3"
  >
    <h1 class="text-[20px] font-bold">Don’t have an account yet?</h1>
    <p class="text-[14px] opacity-80">
      Let’s get you all set so you can start creating your first learning
      experience.
    </p>
    <a
      href="./register.html"
      class="text-[#006BE5] font-bold text-[12px] p-2 px-24 rounded-[25px] border-2 border-[#006BE5] cursor-pointer hover:bg-[#006BE5] hover:text-white transition-all ease-in-out duration-200"
    >
      SIGN UP
    </a>
  </div>
</div>

<!-- Form Container-->
<div id="form-container" class="w-full md:w-1/2 flex flex-col p-8 lg:px-12 items-center justify-center gap-6">
<div class="">
  <h1 class="font-bold text-[32px] text-center mt-4">Welcome back!</h1>
  <p class="opacity-50 text-[20px] text-center mb-5">Log in to your Eureka account.</p>
</div>

  <form id="signInForm" class="flex flex-col gap-5 poppins text-[20px] w-full max-w-lg">
    <div class="">
      <label class="block mb-1 font-semibold text-base" for="email"
        >Email</label
      >
      <input
        type="email"
        id="email"
        name="email"
        class="w-full p-4 px-6 border-[#453F3F80] border-2 text-base rounded-[30px] bg-transparent"
        placeholder="Your Email Address"
        required
      />
    </div>

    <div class="">
      <label class="block mb-1 font-semibold text-base" for="password"
        >Password</label
      >
      <input
        type="password"
        id="password"
        name="password"
        class="w-full p-4 px-6 border-[#453F3F80] border-2 text-base rounded-[30px] bg-transparent"
        placeholder="Enter a strong password"
        required
      />
    </div>

    <div class="flex items-center justify-between text-base font-medium">
      <div class="inline-flex items-center gap-3">
        <input type="checkbox" name="remember" id="remember" class="w-6 h-6  via-gray-400 cursor-pointer" > <span>Remember me</span> 
      </div>
      <a href="/" class="text-primary">Forgot Password</a>

    </div>

    <div class="w-full">
      <button
        type="submit"
        id="contactSubmit"
        class="w-full p-4 mt-3 bg-primary text-white text-base font-semibold rounded-[30px] cursor-pointer hover:opacity-80 hover:scale-105"
      >
        Login
      </button>
    </div>
  </form>

</section>

<!-- POPUP animation -->
<div class="submit_popup" id="submit_popup">
<!-- Loader -->
<div
  class="submit_loader flex justify-center items-center"
  id="submit_loader"
>
  <div class="flex items-center justify-center h-full w-full">
    <img src="{{ asset('asset/images/loader.gif')}}" class="object-cover" alt="preloader" />
  </div>
</div>
<!-- Popup  -->
<div
  class="submit_success container bg-white rounded-xl w-full h-fit max-w-[580px] items-center justify-center translate-y-5 py-12"
  id="submit_success"
>
  <div
    class="flex-col flex items-center justify-center gap-10 h-full w-full"
  >
    <div class="flex flex-col items-center w-full text-primary gap-3">
      <p class="font-semibold text-center text-xl">Login Successful</p>
    </div>
  </div>
</div>
</div>
<script src="{{ asset('asset/src/scripts/main.js')}}"></script>

@endsection