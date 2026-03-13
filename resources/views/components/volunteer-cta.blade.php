@if(isset($showCall) && $showCall)
<div class="bg-primary text-white py-12 px-4 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="particle-container h-full w-full">
            <div class="particle">
                <img src="{{ asset('asset/images/particle1.png')}}" alt="" class="opacity-30">
            </div>
            <div class="particle">
                <img src="{{ asset('asset/images/particle2.png')}}" alt="" class="opacity-30">
            </div>
        </div>
    </div>
    
    <div class="container mx-auto text-center relative z-10">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold font-lato mb-4">Join Our Volunteer Community</h2>
            <p class="text-lg md:text-xl mb-8 opacity-90">
                Make a difference in education! We're looking for passionate individuals to join our mission of empowering learning experiences and creating impactful educational events.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('volunteer.apply') }}" 
                   class="bg-white text-primary px-8 py-4 rounded-[2rem] font-bold text-lg hover:bg-opacity-90 hover:scale-105 transition-all duration-200 shadow-lg">
                    Apply to Volunteer
                </a>
                <div class="flex items-center gap-2 text-sm opacity-80">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    It's completely free
                </div>
            </div>
        </div>
    </div>
</div>
@endif