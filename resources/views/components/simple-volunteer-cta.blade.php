@if(isset($showCall) && $showCall)
<div class="bg-primary text-white py-10 text-center mb-10 rounded-[2rem]">
    <div class="container mx-auto">
        <h3 class="text-xl md:text-2xl font-bold mb-3">🙋‍♀️ Call for Volunteers</h3>
        <p class="text-lg mb-6 opacity-90">Join our mission to empower education. Apply now to become a volunteer!</p>
        <a href="{{ route('volunteer.apply') }}" 
           class="inline-block bg-white text-primary px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition duration-200">
            Apply to Volunteer
        </a>
    </div>
</div>
@endif