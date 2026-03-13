@extends('layout.app')
@section('content')

<section class="flex flex-col md:flex-row-reverse gap-10 h-full w-full items-center justify-center py-20">
    <div id="image-container" class="hidden w-full md:w-1/2 md:flex items-center justify-center relative">
        <img id="register-image" src="/asset/images/team.png" alt="Register" class="max-h-full w-full object-cover" />
        <div class="bg-[#E4F1FF] text-black max-w-md h-fit w-full absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-[20px] p-6 px-8 text-center pb-10">
            <h1 class="text-[28px] font-bold">Already signed up?</h1>
            <p class="text-[20px] opacity-80 mt-5 mb-12">
                Login to your account so you can learn and explore more from Eureka.
            </p>
            <a href="/login" class="text-[#006BE5] font-bold text-[20px] p-2 px-24 rounded-[25px] border-2 border-[#006BE5] cursor-pointer hover:bg-[#006BE5] hover:text-white transition ease-in-out duration-150">
                LOG IN
            </a>
        </div>
    </div>

    <!-- Forms -->
    <div id="form-container" class="w-full md:w-1/2 flex flex-col p-8 lg:px-12 rounded-lg">
        <div class="h-fit overflow-y-scroll hide-scrollbar flex flex-col justify-start px-1">

            @if ($errors->any())
                <div class="mb-4">
                    <ul class="list-disc list-inside text-red-600">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Verify Email Form -->
            <form action="{{route('verify.delete-useraccount')}}" method="POST" class="form mb-5">
                @csrf
                <h3 class="text-xl lg:text-3xl font-bold mb-10 tracking-wider lg:text-start text-flip-container">
                   Submit Delete Account Form
                </h3>

                <div class="mb-4">
                    <label class="block text-black font-semibold dark:text-white">Email</label>
                    <input name="email" type="text" required placeholder="info@eureka.academy" class="p-2 px-5 border rounded-full w-full bg-transparent" />
                    
                </div>

                <div class="form-group w-full">
                    <button type="submit" class="bg-primary w-full text-white px-4 py-2 mt-5 rounded-full disabled:bg-[#D9D9D9] disabled:text-gray-500 disabled:cursor-not-allowed">
                      Submit
                    </button>
                </div>
            </form

           
          
        </div>
    </div>
</section>


<script src="/asset/src/scripts/main.js"></script>

@endsection