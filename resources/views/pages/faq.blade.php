@extends('layout.app')
@section('content')

<section id="faq" class="container py-10">
  <h2 class="script-font mb-4">FAQ</h2>
  <h1
    class="text-3xl font-bold border-b-2 border-[#0279B9] pb-6 md:text-4xl"
  >
    Frequently Asked Questions
  </h1>
  <!-- <hr class="text-[#0279B9] h-1" /> -->
  <div
    class="faq-section flex flex-col md:flex-row items-start justify-between gap-10 gap-y-20 mt-10"
  >
    <!-- Accordians -->
    <div class="accordion w-full md:max-w-xl flex flex-col gap-5">
      <div
        class="accordion-item bg-white border-b-[#0279B9] border-b-2 p-3 rounded-none w-full dark:bg-dark"
      >
        <div
          id="accordion-header"
          class="accordion-header cursor-pointer w-full inline-flex items-center justify-between font-bold text-xl py-3"
        >
          What is Eureka? <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-content opacity-60 text-lg">
          <p>
            Eureka is a platform designed to empower education by supporting
            and promoting dynamic learning experiences and impactful events.
          </p>
        </div>
      </div>
      <div
        class="accordion-item bg-white border-[#0279B9] border-b-2 p-3 rounded-none w-full dark:bg-dark"
      >
        <div
          id="accordion-header"
          class="accordion-header cursor-pointer w-full inline-flex items-center justify-between font-bold text-xl py-3"
        >
          How can I become an advocate?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-content hidden opacity-60 text-lg">
          <p>
            Join our community by clicking the 'Become an Advocate' button
            and filling out the necessary information to get started.
          </p>
        </div>
      </div>
      <div
        class="accordion-item bg-white border-b-[#0279B9] border-b-2 p-3 rounded-none w-full dark:bg-dark"
      >
        <div
          id="accordion-header"
          class="accordion-header cursor-pointer w-full inline-flex items-center justify-between font-bold text-xl py-3"
        >
          What benefits do I get as an advocate?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-content hidden opacity-60 text-lg">
          <p>
            As an advocate, you gain leadership experience, enhance your
            communication skills, and have the opportunity to shape the
            direction of education in your school.
          </p>
        </div>
      </div>
      <div
        class="accordion-item bg-white border-[#0279B9] border-b-2 p-3 rounded-none w-full dark:bg-dark"
      >
        <div
          id="accordion-header"
          class="accordion-header cursor-pointer w-full inline-flex items-center justify-between font-bold text-xl py-3"
        >
          How can I contact Eureka? <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-content hidden opacity-60 text-lg">
          <p>
            You can contact us through the 'Contact Us' page or by filling
            out the form in the 'Have Any More Questions?' section below.
          </p>
        </div>
      </div>
      <div
        class="accordion-item bg-white border-[#0279B9] border-b-2 p-3 rounded-none w-full dark:bg-dark"
      >
        <div
          id="accordion-header"
          class="accordion-header cursor-pointer w-full inline-flex items-center justify-between font-bold text-xl py-3"
        >
          What benefits do I get as an advocate?
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-content hidden opacity-60 text-lg">
          <p>
            As an advocate, you gain leadership experience, enhance your
            communication skills, and have the opportunity to shape the
            direction of education in your school.
          </p>
        </div>
      </div>
      <div
        class="accordion-item bg-white border-[#0279B9] border-b-2 p-3 rounded-none w-full dark:bg-dark"
      >
        <div
          id="accordion-header"
          class="accordion-header cursor-pointer w-full inline-flex items-center justify-between font-bold text-xl py-3"
        >
          How can I contact Eureka? <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="accordion-content hidden opacity-60 text-lg">
          <p>
            You can contact us through the 'Contact Us' page or by filling
            out the form in the 'Have Any More Questions?' section below.
          </p>
        </div>
      </div>
    </div>

    <!-- Form -->
    <div
      class="w-full md:w-1/2 md:max-w-sm flex flex-col gap-4 items-center"
    >
      <img src="{{ asset('asset/images/programs/5225086 1.png')}}" alt="" />
      <h3 class="font-bold text-lg text-center">
        Have Any More Questions?
      </h3>
      <p class="opacity-70 text-center">
        If you have any more questions, feel free to reach out to us by
        filling out the form below.
      </p>
      <form id="faq" class="w-full flex flex-col gap-5 items-center">
        <div class="w-full flex flex-col gap-1">
          <label for="email" class="font-bold text-base"
            >Email Address</label
          >
          <input
            type="email"
            id="email"
            name="email"
            placeholder="Your email address"
            ol
            class="w-full p-4 rounded-full border-[#ddd] border-2 focus:outline-none dark:bg-dark"
            required
          />
        </div>
        <div class="w-full flex flex-col gap-1">
          <label for="message" class="font-bold text-base"
            >Your Message</label
          >
          <textarea
              id="message"
              name="message"
              rows="3"
              placeholder="Type your message here"
              class="w-full p-4 px-6 rounded-3xl border-[#ddd] border-2 focus:outline-none dark:bg-dark custom-textarea"
              required
            ></textarea>

        </div>
        <div class="form-group w-full">
          <button
            type="submit"
            class="bg-primary w-full py-3 font-bold text-white text-lg rounded-full cursor-pointer hover:opacity-80 hover:scale-105"
          >
            Send
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- POPUP animation -->
<div class="submit_popup" id="submit_popup">
  <!-- Loader -->
  <div class="submit_loader flex justify-center items-center" id="submit_loader">
    <div class="flex items-center justify-center h-full w-full">
      <img src="{{ asset('asset/images/loader.gif')}}" class="object-cover" alt="preloader" />
    </div>
  </div>
  <!-- Popup  -->
  <div class="submit_success container bg-white rounded-xl w-full h-fit max-w-[580px] items-center justify-center translate-y-5 py-12 dark:bg-dark relative" id="submit_success">
    <button 
      class="absolute top-0 right-0 text-black dark:text-white font-bold text-3xl p-5 rounded-full  flex items-center justify-center cursor-pointer hover:opacity-90" 
      id="close_popup"
    >&times;
  </button>
    <div class="flex-col flex items-center justify-center gap-10 h-full w-full">
      <img src="{{ asset('asset/images/mail_sent.gif')}}" alt="" />
      <div class="flex flex-col items-center w-full text-primary gap-3 dark:text-white">
        <p class="font-semibold text-center text-xl">
          Question Successfully sent!
        </p>
        <p class="font-semibold text-center text-lg">
          We get back to you via email, thank you.
        </p>
        <button class="mt-4 bg-primary text-white px-4 py-2 rounded-md" id="redirect_home">Go to Home</button>
      </div>
    </div>
  </div>
</div>

</section>

@endsection