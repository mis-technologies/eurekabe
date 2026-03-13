@extends('advocate::layouts.auth')
@section('content')
    <section class="flex flex-col md:flex-row-reverse gap-10 h-full w-full items-center justify-center">
        <!-- Image Container -->
        <div id="image-container" class="hidden w-full md:w-1/2 md:flex items-center justify-center relative">
            <img id="register-image" src="{{ asset('asset/images/team.png') }}" alt="Register"
                class="max-h-full w-full object-cover" />
            <div
                class="bg-[#E4F1FF] text-black max-w-xs h-fit w-full absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-[20px] p-5 text-center flex flex-col items-center justify-center gap-3">
                <h1 class="text-[20px] font-bold">Don’t have an account yet?</h1>
                <p class="text-[14px] opacity-80">
                    Let’s get you all set so you can start creating your first learning
                    experience.
                </p>
                <a href="{{ route('advocate.apply') }}"
                    class="text-[#006BE5] font-bold text-[12px] p-2 px-24 rounded-[25px] border-2 border-[#006BE5] cursor-pointer hover:bg-[#006BE5] hover:text-white transition-all ease-in-out duration-200">
                    SIGN UP
                </a>
            </div>
        </div>

        <!-- Form Container-->
        <div id="form-container" class="w-full md:w-1/2 flex flex-col p-8 lg:px-12 items-center justify-center gap-6">
            <div class="">
                <h1 class="font-bold text-[32px] text-center mt-4">Reset password!</h1>
                <p class="opacity-50 text-[20px] text-center mb-5">You are here from your mail box. Enter your NEW password.</p>
            </div>

            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div class="text-red-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">{{ $error }}</span>
                                @if ($error == 'Password Reset Successfully. Click on login to access dasboard.')
                                    <div style="margin-top: 30px" class="w-full ">
                                        <a class="w-full p-4 mt-3 bg-primary text-white text-base font-semibold rounded-[30px] cursor-pointer hover:opacity-80 hover:scale-105" href="{{ route('advocate.login') }}">Login</a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <form action="{{ route('advocate.change.password') }}" method="POST"
                class="flex flex-col gap-5 poppins text-[20px] w-full max-w-lg">
                @csrf
                @method('POST')

                <input type="hidden" name="token" value="{{$token}}">

                <div class="">
                    <label class="block mb-1 font-semibold text-base" for="email">Password</label>
                    <input type="password"  name="password"
                        class="w-full p-4 px-6 border-[#453F3F80] border-2 text-base rounded-[30px] bg-transparent"
                        placeholder="Enter New Password" required />
                </div>
                <div class="">
                    <label class="block mb-1 font-semibold text-base" for="email">Confirm Password</label>
                    <input type="password"  name="password_confirmation"
                        class="w-full p-4 px-6 border-[#453F3F80] border-2 text-base rounded-[30px] bg-transparent"
                        placeholder="Re-enter New Password" required />
                </div>





                <div class="w-full">
                    <button type="submit"
                        class="w-full p-4 mt-3 bg-primary text-white text-base font-semibold rounded-[30px] cursor-pointer hover:opacity-80 hover:scale-105">
                        Reset Password
                    </button>


                </div>


            </form>

    </section>


    <script src="{{ asset('asset/src/scripts/main.js') }}"></script>
@endsection
