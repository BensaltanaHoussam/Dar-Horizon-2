<x-app-layout>
    <div class="max-w-2xl mx-auto py-8">
        <h2 class="text-2xl font-bold mb-6">Edit Property</h2>

        <form action="{{ route('listings.update', $listing->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Property Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Property Title</label>
                    <input type="text" id="title" name="title" value="{{ $listing->title }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                        required>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                        required>{{ $listing->description }}</textarea>
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" id="location" name="location" value="{{ $listing->location }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                        required>
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price per Night</label>
                    <input type="number" id="price" name="price" value="{{ $listing->price }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                        required>
                </div>

                <!-- Country Select -->
                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                    <select id="country" name="country"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                        required>
                        <option value="Portugal" {{ $listing->country == 'Portugal' ? 'selected' : '' }}>Portugal</option>
                        <option value="Morocco" {{ $listing->country == 'Morocco' ? 'selected' : '' }}>Morocco</option>
                        <option value="Spain" {{ $listing->country == 'Spain' ? 'selected' : '' }}>Spain</option>
                    </select>
                </div>

                <!-- Image Upload -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Property Image</label>
                    <input type="file" id="image" name="image"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors">
                </div>

                <!-- Availability Dates -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="available_from" class="block text-sm font-medium text-gray-700">Available
                            From</label>
                        <input type="date" id="available_from" name="available_from"
                            value="{{ $listing->available_from->toDateString() }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                            required>
                    </div>
                    <div>
                        <label for="available_until" class="block text-sm font-medium text-gray-700">Available
                            Until</label>
                        <input type="date" id="available_until" name="available_until"
                            value="{{ $listing->available_until->toDateString() }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                            required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-teal-600 hover:bg-teal-700 text-white py-3 px-6 rounded-lg transition">
                        Update Property
                    </button>
                </div>
            </div>
        </form>

    </div>
</x-app-layout>