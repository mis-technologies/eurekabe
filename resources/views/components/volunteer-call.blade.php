@if($showCall)
<div class="bg-blue-600 text-white py-8">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-2xl font-bold mb-2">Call for Volunteers</h2>
        <p class="mb-4">Help us grow our community! We're looking for passionate volunteers to join our team.</p>
        <a href="{{ route('volunteer.apply') }}" class="bg-white text-blue-600 px-6 py-2 rounded font-semibold hover:bg-gray-100">Apply to Volunteer</a>
    </div>
</div>
@endif