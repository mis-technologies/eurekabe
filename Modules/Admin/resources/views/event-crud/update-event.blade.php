@extends('admin::layouts.app')
@include('admin::partials.znotify')

@section('content')
<main class="flex-grow p-6">
    <div class="card">
        <div class="card-header">
            <div class="flex justify-between items-center">
                <h4 class="card-title">Update Event</h4>
            </div>
        </div>
        <div class="p-6">
            <div class="grid lg:grid-cols-6 gap-6">
                <div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <div class="text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $error }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <form action="{{ route('admin.pages.update.event', $event?->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Title</label>
                            <input class="form-input mt-1 block w-full" name="title" type="text"
                                value="{{ old('title', $event?->title) }}" placeholder="Event title">
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Type</label>
                            <select class="form-input mt-1 block w-full" name="type" id="">
                                <option value="{{old('type', $event?->type)}}">{{old('type', $event?->type)}}</option>

                                <option value="in_person">In Person</option>
                                <option value="virtual">Virtual</option>
                            </select>
                            
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Start Date & Time</label>
                            <input class="form-input mt-1 block w-full" name="start_datetime" type="datetime-local"
                                value="{{ old('start_datetime', \Carbon\Carbon::parse($event?->start_datetime)->format('Y-m-d\TH:i')) }}">
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">End Date & Time</label>
                            <input class="form-input mt-1 block w-full" name="end_datetime" type="datetime-local"
                                value="{{ old('end_datetime', \Carbon\Carbon::parse($event?->end_datetime)->format('Y-m-d\TH:i')) }}">
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Location</label>
                            <input class="form-input mt-1 block w-full" name="location" type="text"
                                value="{{ old('location', $event?->location) }}" placeholder="Event location">
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Price</label>
                            <input class="form-input mt-1 block w-full" name="price" type="text" step="0.01"
                                value="{{ old('price', $event?->price) }}" placeholder="Event price">
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea class="form-input mt-1 block w-full" name="description" rows="4"
                                placeholder="Event description">{{ old('description', $event?->description) }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Special Bonus</label>
                            <input class="form-input mt-1 block w-full" name="special_bonus" type="text"
                                value="{{ old('special_bonus', $event?->special_bonus) }}">
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Registration Link</label>
                            <input class="form-input mt-1 block w-full" name="reg_link" type="url"
                                value="{{ old('reg_link', $event?->reg_link) }}">
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select class="form-input mt-1 block w-full" name="status">

                                <option value="{{$event?->status}}">{{$event?->status}}
                                </option>
                                <option value="UPCOMING">UPCOMING
                                </option>
                                <option value="PAST EVENT">PAST EVENT
                                </option>
                            </select>
                        </div>

                        {{-- <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Speakers (JSON)</label>
                            <textarea class="form-input mt-1 block w-full" name="speakers" rows="6"
                                placeholder='[{"name":"John","title":"CEO","img_url":"img.png"}]'>{{ old('speakers', json_encode($event?->speakers)) }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Sponsors (JSON)</label>
                            <textarea class="form-input mt-1 block w-full" name="sponsors" rows="6"
                                placeholder='[{"name":"Eureka","logo_url":"logo.png"}]'>{{ old('sponsors', json_encode($event?->sponsors)) }}</textarea>
                        </div> --}}

                        @php
                        $speakers = old('speakers', json_decode($event?->speakers, true) ?? []);
                        $sponsors = old('sponsors', json_decode($event?->sponsors, true) ?? []);
                        @endphp

                        {{-- SPEAKERS --}}
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Speakers</label>
                            <div id="speaker-list">
                                @foreach ($speakers as $index => $speaker)
                                <div class="grid grid-cols-3 gap-2 mb-2 speaker-item" data-index="{{ $index }}">
                                    <input class="form-input" name="speakers[{{ $index }}][name]"
                                        value="{{ $speaker['name'] ?? '' }}" placeholder="Name" />
                                    <input class="form-input" name="speakers[{{ $index }}][title]"
                                        value="{{ $speaker['title'] ?? '' }}" placeholder="Title" />
                                    <input class="form-input" name="speakers[{{ $index }}][img_url]" type="file"
                                        value="{{ $speaker['img_url'] ?? '' }}" accept="images/*" />

                                    <input type="hidden" name="speakers[{{ $index }}][img_urll]"
                                        value="{{ $speaker['img_url'] ?? '' }}">
                                    <img src="{{ $speaker['img_url'] ?? '' }}" style="height: 100px; width: 100px;"
                                        alt="no image">

                                    <button type="button" onclick="removeSpeaker(this)"
                                        class="text-red-500">Remove</button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" onclick="addSpeaker()" class="btn mt-2 bg-blue-600 text-white">+ Add
                                Speaker</button>
                        </div>

                        {{-- SPONSORS --}}
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sponsors</label>
                            <div id="sponsor-list">
                                @foreach ($sponsors as $index => $sponsor)
                                <div class="grid grid-cols-2 gap-2 mb-2 sponsor-item" data-index="{{ $index }}">
                                    <input class="form-input" name="sponsors[{{ $index }}][name]"
                                        value="{{ $sponsor['name'] ?? '' }}" placeholder="Name" />
                                    <input class="form-input" name="sponsors[{{ $index }}][logo_url]" type="file"
                                        accept="images/*" placeholder="Logo URL" />
                                    <input name="sponsors[{{ $index }}][logo_urll]"
                                        value="{{ $sponsor['logo_url'] ?? '' }}" type="hidden" />
                                    <img src="{{ $sponsor['logo_url'] ?? '' }}" style="height: 100px; width: 100px;"
                                        alt="no image">
                                    <button type="button" onclick="removeSponsor(this)"
                                        class="text-red-500 col-span-2 text-left">Remove</button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" onclick="addSponsor()" class="btn mt-2 bg-blue-600 text-white">+ Add
                                Sponsor</button>
                        </div>


                        @php
                        $assets = env('APP_URL').'/';
                        @endphp

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Event Image</label>
                            @if ($assets.$event?->image)
                            <img src="{{ $event?->image }}" alt="Event Image"
                                class="w-64 h-64 object-cover rounded-xl mb-2">
                            @endif
                            <input type="file" name="image" class="form-input mt-1 block w-full">
                        </div>

                        <button class="btn bg-primary text-white mt-6" type="submit">
                            Update Event
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script>
    let speakerIndex = {{ count($speakers) }};
    let sponsorIndex = {{ count($sponsors) }};

    function addSpeaker() {
        const container = document.getElementById('speaker-list');
        const html = `
            <div class="grid grid-cols-3 gap-2 mb-2 speaker-item" data-index="${speakerIndex}">
                <input class="form-input" name="speakers[${speakerIndex}][name]" placeholder="Name" />
                <input class="form-input" name="speakers[${speakerIndex}][title]" placeholder="Title" />
                <input class="form-input" type="file" accept="images/*" name="speakers[${speakerIndex}][img_url]" placeholder="Image URL" />
                <button type="button" onclick="removeSpeaker(this)" class="text-red-500">Remove</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        speakerIndex++;
    }

    function removeSpeaker(button) {
        const item = button.closest('.speaker-item');
        if (item) item.remove();
    }

    function addSponsor() {
        const container = document.getElementById('sponsor-list');
        const html = `
            <div class="grid grid-cols-2 gap-2 mb-2 sponsor-item" data-index="${sponsorIndex}">
                <input class="form-input" name="sponsors[${sponsorIndex}][name]" placeholder="Name" />
                <input class="form-input" type="file" accept="images/*" name="sponsors[${sponsorIndex}][logo_url]" placeholder="Logo URL" />
                <button type="button" onclick="removeSponsor(this)" class="text-red-500 col-span-2 text-left">Remove</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        sponsorIndex++;
    }

    function removeSponsor(button) {
        const item = button.closest('.sponsor-item');
        if (item) item.remove();
    }
</script>
@endpush

@endsection
