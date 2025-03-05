@extends('layout.app')
@section('content')

{{-- @php
$email = request()->query('email', '');
dd($email);
@endphp --}}
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


            @if ($errors->any())
            <div class="mb-4">
                <ul class="list-disc list-inside text-red-600">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- form one -->
            <form action="{{route('verify')}}" method="POST" class="form mb-5">

                @csrf

                <h3 class="text-xl lg:text-3xl font-bold mb-10 tracking-wider lg:text-start text-flip-container">
                    Verify Delete Account Request<br />Email Form
                    {{-- <span class="text-primary" id="text-container">an Advocate.</span> --}}
                </h3>

                <div class="mb-4">
                    <label class="block text-black font-semibold dark:text-white">Code</label>
                    <input name="ver_code" type="number" required placeholder="123456"
                        class="p-2 px-5 border rounded-full w-full bg-transparent" />
                    <input type="hidden" name="email" id="emailInput">
                    <input type="hidden" name="delete" value="delete" id="emailInput">

                </div>

                <div class="form-group w-full">
                    <button type="button" onclick="confirmDelete()"
                        class="bg-primary w-full text-white px-4 py-2 mt-5 rounded-full disabled:bg-[#D9D9D9] disabled:text-gray-500 disabled:cursor-not-allowed">
                        Verify Delete request
                    </button>

                </div>

            </form>


        </div>
    </div>
</section>

@php
$verified = session()->get('deleteVerified');
@endphp

@if($verified == true)


<div class="submit_popup z-10 show" id="submit_popup">

    <!-- Popup -->
    <div style="display: block"
        class="submit_success container bg-white rounded-xl w-full h-fit max-w-[300px] md:max-w-[580px] items-center justify-center translate-y-5 py-12 dark:bg-dark relative"
        id="submit_success">

        <button
            class="absolute top-0 right-0 text-black dark:text-white font-bold text-3xl p-5 rounded-full flex items-center justify-center cursor-pointer hover:opacity-90"
            onclick="window.location='/'">&times;
        </button>
        <div class="flex-col flex items-center justify-center gap-10 h-full w-full">
            <img src="/asset/images/mail_sent.gif" alt="" />
            <div class="flex flex-col items-center w-full text-primary gap-3 dark:text-white">
                <button><a href="/">Go to Home</a></button>
                <h1 class="font-bold text-center text-3xl pb-2">Account Deleted successfully. If you wish to undo this reach out to us.</h1>
            </div>
        </div>
    </div>
</div>
@endif




{{-- @dd(session()->all()); --}}

<script>
    function confirmDelete() {
                        if (confirm("Are you sure you want to delete your account? This action cannot be undone.")) {
                            document.querySelector('form').submit();
                        }
                    }
    document.addEventListener("DOMContentLoaded", function () {
        const storedData = localStorage.getItem("registrationFormData");
        if (storedData) {
            const formData = JSON.parse(storedData);
            if (formData.email) {
                document.getElementById("emailInput").value = formData.email;
            }
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const storedData = localStorage.getItem("registrationFormData");
        if (storedData) {
            const formData = JSON.parse(storedData);
            if (formData.email) {
                document.getElementById("emailInput2").value = formData.email;
            }
        }
    });
</script>

<script>
    const dashboardUrl = "/";
</script>

<script src="/asset/src/scripts/main.js"></script>

@endsection
