<x-app-layout>
    <section class="py-16 px-4 bg-white min-h-screen">
        <div class="container mx-auto max-w-6xl">
            <!-- Header -->
            <div class="text-center mb-10">
                <span class="bg-black text-white text-xs font-medium px-3 py-1 rounded-full">Owner Dashboard</span>
                <h2 class="text-3xl md:text-4xl font-bold mt-4 mb-2 text-black">Your Properties</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Manage your World Cup 2030 accommodations and connect with
                    travelers from around the world.</p>
            </div>

            <!-- Add Listing Button -->
            <div class="flex justify-center mb-10">
                <button type="button" onclick="document.getElementById('addPropertyModal').classList.remove('hidden')"
                    class="bg-black hover:bg-gray-900 text-white py-3 px-6 rounded-lg transition duration-300 flex items-center justify-center font-medium">
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
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($listings as $listing)
                        <div
                            class="bg-white rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-lg border border-gray-100">
                            <div class="relative h-48 bg-gray-100">
                                <img src="{{ asset('storage/' . $listing->image) }}" alt="{{ $listing->title }}"
                                    class="w-full h-full object-cover">
                                <div
                                    class="absolute top-3 right-3 bg-black text-white px-3 py-1 rounded-lg text-sm font-medium">
                                    €{{ number_format($listing->price, 2) }} / night
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="font-bold text-xl mb-3 text-black">{{ $listing->title }}</h3>
                                <div class="flex items-center text-gray-600 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                    <span class="text-sm">{{ $listing->location }}</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $listing->description }}</p>
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <span class="text-sm text-gray-500">{{ $listing->available_from }} -
                                        {{ $listing->available_until }}</span>
                                    <div class="flex space-x-3">
                                        <a href="{{ route('listings.edit', $listing->id) }}"
                                            class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('listings.destroy', $listing) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this listing?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
        </div>
    </section>

    <!-- Modal -->
    <div id="addPropertyModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" aria-hidden="true"
                onclick="document.getElementById('addPropertyModal').classList.add('hidden')"></div>

            <!-- Modal panel -->
            <div
                class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                <div class="bg-white px-6 pt-6 pb-6">
                    <div class="flex justify-between items-center border-b border-gray-100 pb-4 mb-6">
                        <h3 class="text-2xl font-bold text-black" id="modal-title">Add Your Property</h3>
                        <button type="button" class="text-gray-400 hover:text-gray-500"
                            onclick="document.getElementById('addPropertyModal').classList.add('hidden')">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <!-- Title -->
                        <div class="space-y-2">
                            <label for="title" class="block text-sm font-medium text-gray-700">Property Title <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="title" name="title" placeholder="e.g. Luxury Apartment Near Stadium"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors"
                                required>
                        </div>

                        <!-- Description -->
                        <div class="space-y-2">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description <span
                                    class="text-red-500">*</span></label>
                            <textarea id="description" name="description" rows="3"
                                placeholder="Describe your property, amenities, and what makes it special..."
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors"
                                required></textarea>
                        </div>

                        <!-- Two column layout -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Location -->
                            <div class="space-y-2">
                                <label for="location" class="block text-sm font-medium text-gray-700">Location <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="location" name="location"
                                    placeholder="e.g. Casablanca, Barcelona, Lisbon"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors"
                                    required>
                            </div>

                            <!-- Country -->
                            <div class="space-y-2">
                                <label for="country" class="block text-sm font-medium text-gray-700">Country <span
                                        class="text-red-500">*</span></label>
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
                                <label for="price" class="block text-sm font-medium text-gray-700">Price per Night (EUR)
                                    <span class="text-red-500">*</span></label>
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
                                <label for="image" class="block text-sm font-medium text-gray-700">Property
                                    Image</label>
                                <div class="flex items-center">
                                    <label
                                        class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg cursor-pointer bg-white hover:bg-gray-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                                <label for="available_from" class="block text-sm font-medium text-gray-700">Available
                                    From <span class="text-red-500">*</span></label>
                                <input type="date" id="available_from" name="available_from"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors"
                                    required>
                            </div>

                            <div class="space-y-2">
                                <label for="available_until" class="block text-sm font-medium text-gray-700">Available
                                    Until <span class="text-red-500">*</span></label>
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



    <!-- Footer -->
    <footer class="bg-black text-white py-12 px-4">
        <div class="container mx-auto max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">DARHORIZON</h3>
                    <p class="text-white/80 mb-4">Find your ideal accommodation for the 2030 World Cup in Morocco,
                        Spain, and Portugal.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-white hover:text-gray-300 transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-gray-300 transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-gray-300 transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#"
                                class="text-white/80 hover:text-white hover:underline transition-colors duration-300">Home</a>
                        </li>
                        <li><a href="#"
                                class="text-white/80 hover:text-white hover:underline transition-colors duration-300">About
                                Us</a></li>
                        <li><a href="#"
                                class="text-white/80 hover:text-white hover:underline transition-colors duration-300">Listings</a>
                        </li>
                        <li><a href="#"
                                class="text-white/80 hover:text-white hover:underline transition-colors duration-300">Contact</a>
                        </li>
                        <li><a href="#"
                                class="text-white/80 hover:text-white hover:underline transition-colors duration-300">FAQ</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Contact Us</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-white/80">123 World Cup Avenue, Casablanca, Morocco</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="text-white/80">info@darhorizon.com</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="text-white/80">+212 555 123 4567</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/20 mt-8 pt-8 text-center">
                <p class="text-white/60">&copy; 2023 DARHORIZON. All rights reserved.</p>
            </div>
        </div>
    </footer>

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