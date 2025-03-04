<x-app-layout>
    <section class="py-16 px-4 bg-white min-h-screen">
        <div class="container mx-auto max-w-6xl">
            <!-- Header -->
            <div class="text-center mb-10">
                <span class="bg-black text-white text-xs font-medium px-3 py-1 rounded-full">Owner Dashboard</span>
                <h2 class="text-3xl md:text-4xl font-bold mt-4 mb-2 text-black">Your Properties</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Manage your World Cup 2030 accommodations and connect with travelers from around the world.</p>
            </div>

            <!-- Add Listing Button -->
            <div class="flex justify-center mb-10">
                <button type="button" onclick="document.getElementById('addPropertyModal').classList.remove('hidden')"
                    class="bg-black hover:bg-gray-900 text-white py-3 px-6 rounded-lg transition duration-300 flex items-center justify-center font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
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
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($listings as $listing)
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-lg border border-gray-100">
                            <div class="relative h-48 bg-gray-100">
                                <img src="{{ asset('storage/' . $listing->image) }}" alt="{{ $listing->title }}"
                                    class="w-full h-full object-cover">
                                <div class="absolute top-3 right-3 bg-black text-white px-3 py-1 rounded-lg text-sm font-medium">
                                    €{{ number_format($listing->price, 2) }} / night
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="font-bold text-xl mb-3 text-black">{{ $listing->title }}</h3>
                                <div class="flex items-center text-gray-600 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                    <span class="text-sm">{{ $listing->location }}</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $listing->description }}</p>
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <span class="text-sm text-gray-500">{{ $listing->available_from }} - {{ $listing->available_until }}</span>
                                    <div class="flex space-x-3">
                                        <a href="{{ route('listings.edit', $listing->id) }}"
                                            class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('listings.destroy', $listing) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this listing?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
        </div>
    </section>

    <!-- Modal -->
    <div id="addPropertyModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" aria-hidden="true"
                onclick="document.getElementById('addPropertyModal').classList.add('hidden')"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                <div class="bg-white px-6 pt-6 pb-6">
                    <div class="flex justify-between items-center border-b border-gray-100 pb-4 mb-6">
                        <h3 class="text-2xl font-bold text-black" id="modal-title">Add Your Property</h3>
                        <button type="button" class="text-gray-400 hover:text-gray-500"
                            onclick="document.getElementById('addPropertyModal').classList.add('hidden')">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <!-- Title -->
                        <div class="space-y-2">
                            <label for="title" class="block text-sm font-medium text-gray-700">Property Title <span class="text-red-500">*</span></label>
                            <input type="text" id="title" name="title" placeholder="e.g. Luxury Apartment Near Stadium"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors"
                                required>
                        </div>

                        <!-- Description -->
                        <div class="space-y-2">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                            <textarea id="description" name="description" rows="3" placeholder="Describe your property, amenities, and what makes it special..."
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors"
                                required></textarea>
                        </div>

                        <!-- Two column layout -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Location -->
                            <div class="space-y-2">
                                <label for="location" class="block text-sm font-medium text-gray-700">Location <span class="text-red-500">*</span></label>
                                <input type="text" id="location" name="location" placeholder="e.g. Casablanca, Barcelona, Lisbon"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors"
                                    required>
                            </div>

                            <!-- Country -->
                            <div class="space-y-2">
                                <label for="country" class="block text-sm font-medium text-gray-700">Country <span class="text-red-500">*</span></label>
                                <select id="country" name="country"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors"
                                    required>
                                    <option value="" disabled selected>Select a country</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Spain">Spain</option>
                                </select>
                            </div>

                            <!-- Price -->
                            <div class="space-y-2">
                                <label for="price" class="block text-sm font-medium text-gray-700">Price per Night (EUR) <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">€</span>
                                    </div>
                                    <input type="number" id="price" name="price" min="1" placeholder="150"
                                        class="w-full pl-8 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors"
                                        required>
                                </div>
                            </div>

                            <!-- Image Upload -->
                            <div class="space-y-2">
                                <label for="image" class="block text-sm font-medium text-gray-700">Property Image</label>
                                <div class="flex items-center">
                                    <label class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg cursor-pointer bg-white hover:bg-gray-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
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
                                <label for="available_from" class="block text-sm font-medium text-gray-700">Available From <span class="text-red-500">*</span></label>
                                <input type="date" id="available_from" name="available_from"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors"
                                    required>
                            </div>

                            <div class="space-y-2">
                                <label for="available_until" class="block text-sm font-medium text-gray-700">Available Until <span class="text-red-500">*</span></label>
                                <input type="date" id="available_until" name="available_until"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors"
                                    required>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit"
                                class="w-full bg-black hover:bg-gray-900 text-white py-3 px-6 rounded-lg transition duration-300 flex items-center justify-center font-medium">
                                List Your Property
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        const modal = document.getElementById('addPropertyModal');
        const fileInput = document.getElementById('image');
        const fileLabel = fileInput.previousElementSibling;

        fileInput.addEventListener('change', function () {
            if (fileInput.files.length > 0) {
                fileLabel.querySelector('span').textContent = fileInput.files[0].name;
            } else {
                fileLabel.querySelector('span').textContent = 'Choose file';
            }
        });

        window.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>