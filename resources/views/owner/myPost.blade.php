<x-app-layout>
    <section class="py-16 px-4 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="container mx-auto max-w-6xl">
            <!-- Header -->
            <div class="text-center mb-10">
                <span class="bg-teal-100 text-teal-800 text-xs font-medium px-3 py-1 rounded-full">Owner
                    Dashboard</span>
                <h2 class="text-3xl md:text-4xl font-bold mt-4 mb-2">Your Properties</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Manage your World Cup 2030 accommodations and connect with
                    travelers from around the world.</p>
            </div>

            <!-- Add Listing Button -->
            <div class="flex justify-center mb-10">
                <button type="button" onclick="document.getElementById('addPropertyModal').classList.remove('hidden')"
                    class="bg-teal-600 hover:bg-teal-700 text-white py-3 px-6 rounded-lg transition flex items-center justify-center font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add New Listing
                </button>
            </div>

            <!-- Property Cards -->
            @if($listings->isEmpty())
                <div class="text-center py-10">
                    <p class="text-gray-600">You have no listings yet. Start adding some!</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($listings as $listing)
                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden transition-transform hover:scale-[1.02] hover:shadow-lg">
                            <div class="relative h-48 bg-gray-200">
                                <img src="{{ asset('storage/' . $listing->image) }}" alt="{{ $listing->title }}"
                                    class="w-full h-full object-cover">
                                <div
                                    class="absolute top-3 right-3 bg-teal-500 text-white px-2 py-1 rounded-lg text-sm font-medium">
                                    €{{ number_format($listing->price, 2) }} / night
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="font-bold text-xl mb-2">{{ $listing->title }}</h3>
                                <div class="flex items-center text-gray-600 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>{{ $listing->location }}</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $listing->description }}</p>
                                <div class="flex items-center justify-between">
                                    <span
                                        class="bg-gray-100 rounded-full px-3 py-1 text-sm text-gray-500">{{ $listing->available_from }}
                                        -
                                        {{ $listing->available_until }}</span>

                                    <!-- Edit and Delete Icons -->
                                    <div class="flex space-x-2">
                                        <!-- Edit Icon -->
                                        <a href="{{ route('listings.edit', $listing->id) }}"
                                            class="p-1 rounded-full hover:bg-gray-100 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('listings.destroy', $listing) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this listing?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1 rounded-full hover:bg-gray-100 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <!-- "No listings" message (shown when there are no listings) -->
            <div class="hidden text-center py-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <h3 class="text-gray-600 text-xl font-medium mb-2">No properties listed yet</h3>
                <p class="text-gray-500 mb-6">Click the button above to add your first property for the World Cup.</p>
            </div>
        </div>
    </section>








    <!-- Modal -->
    <div id="addPropertyModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                onclick="document.getElementById('addPropertyModal').classList.add('hidden')"></div>

            <!-- Modal panel -->
            <div
                class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <div class="flex justify-between items-center border-b pb-4 mb-4">
                                <h3 class="text-2xl font-bold text-gray-900" id="modal-title">
                                    Add Your Property
                                </h3>
                                <button type="button" class="text-gray-400 hover:text-gray-500"
                                    onclick="document.getElementById('addPropertyModal').classList.add('hidden')">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <!-- Form -->
                            <form action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data"
                                class="space-y-6">
                                @csrf <!-- CSRF token for security -->

                                <!-- Title -->
                                <div class="space-y-2">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Property Title
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="title" name="title"
                                        placeholder="e.g. Luxury Apartment Near Stadium"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                                        required>
                                </div>

                                <!-- Description -->
                                <div class="space-y-2">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description
                                        <span class="text-red-500">*</span></label>
                                    <textarea id="description" name="description" rows="3"
                                        placeholder="Describe your property, amenities, and what makes it special..."
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                                        required></textarea>
                                </div>

                                <!-- Two column layout for the form -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Location -->
                                    <div class="space-y-2">
                                        <label for="location" class="block text-sm font-medium text-gray-700">Location
                                            <span class="text-red-500">*</span></label>
                                        <input type="text" id="location" name="location"
                                            placeholder="e.g. Casablanca, Barcelona, Lisbon"
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                                            required>
                                    </div>

                                    <!-- Country -->
                                    <div class="space-y-2">
                                        <label for="country" class="block text-sm font-medium text-gray-700">Country
                                            <span class="text-red-500">*</span></label>
                                        <select id="country" name="country"
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                                            required>
                                            <option value="" disabled selected>Select a country</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Spain">Spain</option>
                                        </select>
                                    </div>

                                    <!-- Price -->
                                    <div class="space-y-2">
                                        <label for="price" class="block text-sm font-medium text-gray-700">Price per
                                            Night (USD) <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500">$</span>
                                            </div>
                                            <input type="number" id="price" name="price" min="1" placeholder="150"
                                                class="w-full pl-8 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                                                required>
                                        </div>
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="space-y-2">
                                        <label for="image" class="block text-sm font-medium text-gray-700">Property
                                            Image</label>
                                        <div class="flex items-center">
                                            <label
                                                class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer bg-white hover:bg-gray-50">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span class="text-sm text-gray-600">Choose file</span>
                                                <input type="file" name="image" id="image" class="hidden">
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Availability Dates -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label for="available_from"
                                            class="block text-sm font-medium text-gray-700">Available From <span
                                                class="text-red-500">*</span></label>
                                        <input type="date" id="available_from" name="available_from"
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                                            required>
                                    </div>

                                    <div class="space-y-2">
                                        <label for="available_until"
                                            class="block text-sm font-medium text-gray-700">Available Until <span
                                                class="text-red-500">*</span></label>
                                        <input type="date" id="available_until" name="available_until"
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                                            required>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="pt-4">
                                    <button type="submit"
                                        class="w-full bg-teal-600 hover:bg-teal-700 text-white py-3 px-6 rounded-lg transition flex items-center justify-center font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        List Your Property
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add simple JavaScript for better UX -->
    <script>
        // Get the modal and its elements
        const modal = document.getElementById('addPropertyModal');
        const fileInput = document.getElementById('image');
        const fileLabel = fileInput.previousElementSibling;

        // Update file input label when a file is selected
        fileInput.addEventListener('change', function () {
            if (fileInput.files.length > 0) {
                fileLabel.querySelector('span').textContent = fileInput.files[0].name;
            } else {
                fileLabel.querySelector('span').textContent = 'Choose file';
            }
        });

        // Close modal when clicking outside of it
        window.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>