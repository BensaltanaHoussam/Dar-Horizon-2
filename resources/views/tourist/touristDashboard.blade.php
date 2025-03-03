<x-app-layout>
    <!-- Hero Section with Search -->
    <section class="bg-black text-white py-20 px-4 md:px-12 overflow-hidden relative">
        <div class="absolute inset-0 opacity-60 z-0">
            <img src="{{ asset('assets/img/00b9554a-900b-40eb-82cd-064e3b41bb91.webp') }}" alt="Background"
                class="w-full h-full object-cover">
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">Find your ideal accommodation for the 2030
                    World Cup</h1>
                <p class="text-xl opacity-90 mb-10">Discover thousands of accommodations in Morocco, Spain, and Portugal
                    to fully experience the 2030 World Cup.</p>


                <div>

                </div>
                <div
                    class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-lg shadow-xl p-6 mb-10 transition-all duration-300 hover:bg-white/15">
                    <form method="GET" action="{{ route('search') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="block text-white font-medium">Country</label>
                                <input type="text" name="country" placeholder="Enter the country"
                                    class="w-full text-black p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition-all duration-300">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-white font-medium">Max Price</label>
                                <input type="number" name="price" placeholder="Enter the max price"
                                    class="w-full text-black p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition-all duration-300">
                            </div>

                            <input type="hidden" name="per_page" value="{{ $perPage }}">
                        </div>
                        <button type="submit"
                            class="mt-4 bg-black text-white border border-white p-3 rounded-lg hover:bg-white hover:text-black transition-all duration-300">Search</button>
                    </form>


                </div>



                <div class="flex flex-wrap -mx-2">
                    <div class="px-2 w-full sm:w-auto mb-4">
                        <div
                            class="flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 transition-all duration-300 hover:bg-white/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span>+10,000 listings</span>
                        </div>
                    </div>
                    <div class="px-2 w-full sm:w-auto mb-4">
                        <div
                            class="flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 transition-all duration-300 hover:bg-white/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <span>Near the stadiums</span>
                        </div>
                    </div>
                    <div class="px-2 w-full sm:w-auto mb-4">
                        <div
                            class="flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 transition-all duration-300 hover:bg-white/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span>Secure reservation</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="px-8 py-4">
        <div class="mt-6">
            <h2 class="text-black text-xl font-bold mb-4">Search Results</h2>
            @if(request()->has('country') || request()->has('price'))
                @if($listings->isEmpty())
                    <p class="text-white">No listings found.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach ($listings as $listing)
                            <div
                                class="bg-black backdrop-blur-sm border border-white/20 p-4 rounded-lg transition-all duration-300 hover:bg-white/20">
                                <h3 class="font-medium text-white">{{ $listing->title }}</h3>
                                <p class="text-white/80">{{ $listing->country }}</p>
                                <p class="text-white/80">Price: €{{ $listing->price }}</p>
                                <p class="text-white/80">Available from: {{ $listing->available_from }}</p>
                                <p class="text-white/80">Available until: {{ $listing->available_until }}</p>
                                <form action="{{ route('favorites.store', $listing->id) }}" method="POST" class="mt-3">
                                    @csrf
                                    <button type="submit"
                                        class="bg-black text-white border border-white p-2 rounded-lg hover:bg-white hover:text-black transition-all duration-300">
                                        Add to Favorites
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <p class="text-white">Please enter search criteria.</p>
            @endif
        </div>
    </section>



    <!-- About Section -->
    <section id="about" class="py-24 px-4 bg-white">
        <div class="container mx-auto max-w-7xl">
            <div class="flex flex-col md:flex-row items-center gap-16">
                <!-- Left Content -->
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <div class="space-y-6">
                        <div class="inline-block">
                            <span class="bg-black text-white text-xs font-medium px-3 py-1 rounded-full">About Us</span>
                        </div>
                        <h2 class="text-4xl font-bold text-black leading-tight">About <span
                                class="text-black">DARHORIZON</span></h2>
                        <div class="w-20 h-1 bg-black rounded"></div>

                        <p class="text-lg text-gray-800 leading-relaxed">
                            TouriStay 2030 is a platform that facilitates the rental of houses and apartments, offering
                            a simple and quick solution for tourists attending the 2030 World Cup
                            "Morocco-Spain-Portugal" events.
                        </p>
                        <p class="text-lg text-gray-800 leading-relaxed">
                            Our mission is to connect travelers with local hosts in the host cities of the 2030 World
                            Cup, for an authentic and comfortable experience.
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-12">
                            <div
                                class="group bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-200">
                                <div
                                    class="bg-black/5 p-4 rounded-xl inline-flex mb-4 group-hover:bg-black/10 transition-colors duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-black" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </div>
                                <h3 class="font-bold text-lg mb-2 text-black">Verified Accommodations</h3>
                                <p class="text-gray-700">All our accommodations are thoroughly inspected and verified
                                    for quality</p>
                            </div>

                            <div
                                class="group bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-200">
                                <div
                                    class="bg-black/5 p-4 rounded-xl inline-flex mb-4 group-hover:bg-black/10 transition-colors duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-black" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <h3 class="font-bold text-lg mb-2 text-black">Strategic Locations</h3>
                                <p class="text-gray-700">Conveniently located near stadiums and popular attractions</p>
                            </div>

                            <div
                                class="group bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-200">
                                <div
                                    class="bg-black/5 p-4 rounded-xl inline-flex mb-4 group-hover:bg-black/10 transition-colors duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-black" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                </div>
                                <h3 class="font-bold text-lg mb-2 text-black">Secure Payment</h3>
                                <p class="text-gray-700">Protected and guaranteed transactions for peace of mind</p>
                            </div>

                            <div
                                class="group bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-200">
                                <div
                                    class="bg-black/5 p-4 rounded-xl inline-flex mb-4 group-hover:bg-black/10 transition-colors duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-black" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <h3 class="font-bold text-lg mb-2 text-black">24/7 Support</h3>
                                <p class="text-gray-700">Dedicated assistance available whenever you need it</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Image -->
                <div class="md:w-1/2 relative">
                    <div class="relative z-10">
                        <img src="{{ asset('assets/img/bggggggggggg.jpg') }}" alt="TouriStay Experience"
                            class="rounded-2xl shadow-xl object-cover w-full h-72 transform hover:scale-[1.02] transition-transform duration-500">

                        <!-- Decorative elements -->
                        <div class="absolute -top-6 -right-6 w-24 h-24 bg-black/10 rounded-full z-[-1]"></div>
                        <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-black/20 rounded-full z-[-1]"></div>

                        <!-- Stats Card -->
                        <div
                            class="absolute -bottom-16 -left-8 bg-white p-6 rounded-2xl shadow-xl max-w-xs transform hover:translate-y-[-8px] transition-transform duration-300">
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="flex -space-x-3">
                                    <img src="https://tse3.mm.bing.net/th?id=OIP.uykrwxWXpq2T7hv1xRTVsQHaFe&pid=Api&P=0&h=180"
                                        alt="User" class="w-12 h-12 rounded-full border-2 border-white object-cover">
                                    <img src="https://tse4.mm.bing.net/th?id=OIP.Q_vZZcSYOaPMcxnXMQQ99QHaE8&pid=Api&P=0&h=180"
                                        alt="User" class="w-12 h-12 rounded-full border-2 border-white object-cover">
                                    <img src="https://tse4.mm.bing.net/th?id=OIP.c0GTqHSPgp9rz7Pn2Aw_8wHaF7&pid=Api&P=0&h=180"
                                        alt="User" class="w-12 h-12 rounded-full border-2 border-white object-cover">
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Already used by</div>
                                    <div class="text-black font-bold text-lg">+15,000 travelers</div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="text-black flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </div>
                                <span class="text-gray-700 font-medium ml-3">4.5/5 <span
                                        class="text-gray-500 text-sm">(2,300+ reviews)</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Listings Section -->
    <div class="container mx-auto p-6 bg-white min-h-screen">
        <h1 class="text-3xl font-bold mb-8 text-black border-b pb-4">Explore Listings</h1>

        <!-- Filters and Pagination Selector -->
        <div
            class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-4 rounded-lg shadow-sm border border-gray-200">
            <form method="GET" action="{{ route('tourist.listings') }}" class="flex items-center space-x-3">
                <label for="per_page" class="text-gray-700 font-medium">Show per page:</label>
                <select name="per_page" id="per_page"
                    class="border rounded-lg px-8 py-2 bg-white focus:ring-2 focus:ring-black focus:border-black transition-all"
                    onchange="this.form.submit()">
                    <option value="4" {{ $perPage == 4 ? 'selected' : '' }}>4</option>
                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                </select>
            </form>
        </div>

        {{-- listings --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($listings as $listing)
                <div
                    class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:translate-y-[-4px] group border border-gray-200">
                    <div class="relative h-56 bg-gray-200 overflow-hidden">
                        <img src="{{ asset('storage/' . $listing->image) }}" alt="{{ $listing->title }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div
                            class="absolute top-3 right-3 bg-black text-white px-3 py-1.5 rounded-lg text-sm font-semibold shadow-md">
                            €{{ number_format($listing->price, 2) }} / night
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-xl mb-2 text-black">{{ $listing->title }}</h3>
                        <div class="flex items-center text-gray-600 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-black" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0z" />
                            </svg>
                            <span class="text-sm font-medium">{{ $listing->location }}</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $listing->description }}</p>
                        <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                            <span class="bg-gray-100 rounded-full px-3 py-1.5 text-xs font-medium text-gray-600">
                                {{ $listing->available_from }} - {{ $listing->available_until }}
                            </span>
                            <!-- Reserve Now Button -->
                            <button type="button" 
                                onclick="openModal('bookingModal-{{ $listing->id }}')"
                                class="text-white bg-black border hover:bg-white hover:text-black text-sm font-medium py-2 px-4 rounded-lg transition-all duration-300">
                                Reserve Now
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal for booking -->
                <div id="bookingModal-{{ $listing->id }}" 
                    class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
                    <div class="bg-white p-8 rounded-lg shadow-xl max-w-md w-full mx-4">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Reserve {{ $listing->title }}</h3>
                            <button type="button" onclick="closeModal('bookingModal-{{ $listing->id }}')" 
                                class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form action="{{ route('tourist.booking.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="listing_id" value="{{ $listing->id }}">

                            <div>
                                <label for="check_in-{{ $listing->id }}" class="block text-sm font-medium text-gray-700 mb-1">Check-in Date</label>
                                <input type="text" id="check_in-{{ $listing->id }}" name="check_in" 
                                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-black focus:border-black">
                            </div>

                            <div>
                                <label for="check_out-{{ $listing->id }}" class="block text-sm font-medium text-gray-700 mb-1">Check-out Date</label>
                                <input type="text" id="check_out-{{ $listing->id }}" name="check_out"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-black focus:border-black">
                            </div>

                            <button type="submit" 
                                class="w-full bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 transition-colors duration-300">
                                Confirm Booking
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if(count($listings) === 0)
            <div class="flex flex-col items-center justify-center py-12 bg-white rounded-xl shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <h3 class="text-lg font-medium text-gray-700 mb-1">No listings found</h3>
                <p class="text-gray-500 text-sm">Try adjusting your search criteria</p>
            </div>
        @endif

        <!-- Pagination Links -->
        <div class="mt-10 flex justify-center">
            <div class="bg-white rounded-lg shadow-sm p-2 inline-flex">
                {{ $listings->appends(['per_page' => $perPage])->links('vendor.pagination.tailwind') }}
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



    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', function () {
                mobileMenu.classList.toggle('hidden');
            });
        });


 


        document.addEventListener('DOMContentLoaded', function () {
            @foreach($listings as $listing)
                flatpickr("#check_in-{{ $listing->id }}", {
                    minDate: "today",
                    dateFormat: "Y-m-d",
                    onChange: function (selectedDates, dateStr, instance) {

                        const checkOut = document.querySelector('#check_out-{{ $listing->id }}');
                        checkOut._flatpickr.set('minDate', dateStr);
                    }
                });

                flatpickr("#check_out-{{ $listing->id }}", {
                    minDate: "today",
                    dateFormat: "Y-m-d"
                });


                fetch(`/tourist/listing/{{ $listing->id }}/available-dates`)
                    .then(response => response.json())
                    .then(data => {
                        const unavailableDates = data.unavailableDates;
                        flatpickr("#check_in-{{ $listing->id }}", {
                            disable: unavailableDates.map(date => date),
                            minDate: "today"
                        });
                        flatpickr("#check_out-{{ $listing->id }}", {
                            disable: unavailableDates.map(date => date),
                            minDate: "today"
                        });
                    });
            @endforeach
        });

        
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('fixed')) {
                event.target.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });

    </script>

    <style>
        .modal-content {
            position: relative;
            max-width: 500px;
            width: 90%;
            margin: 2rem auto;
        }
    </style>
</x-app-layout>