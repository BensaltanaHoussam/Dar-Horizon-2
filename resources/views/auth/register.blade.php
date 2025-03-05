<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horizon - Register</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/choices.js/10.2.0/choices.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/choices.js/10.2.0/choices.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./assets/images/LOOGOksajxd.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script defer>
        const showToast = (message, type = 'success') => {
            const toastContainer = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `p-4 rounded shadow text-white ${type === 'success' ? 'bg-black' : 'bg-black'}`;
            toast.textContent = message;

            toastContainer.appendChild(toast);

            // Remove toast after 3 seconds
            setTimeout(() => {
                toast.remove();
            }, 3000);
        };

        document.addEventListener('DOMContentLoaded', function () {
            const togglePasswordButtons = document.querySelectorAll('.toggle-password');

            togglePasswordButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const passwordInput = this.closest('div').querySelector('input');
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                });
            });

            // Initialize custom select styling for role dropdown
            if (document.getElementById('role')) {
                const choices = new Choices('#role', {
                    itemSelectText: '',
                    searchEnabled: false,
                    classNames: {
                        containerOuter: 'choices bg-darkgray border border-gray-700 rounded-md',
                    }
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js" defer></script>
</head>

<body class="bg-black ">
    <div id="toast-container" class="fixed top-4 right-4 z-50 flex flex-col gap-2"></div>

    <div class="font-[sans-serif] max-w-7xl mx-auto h-screen">
        <div class="grid md:grid-cols-2 items-center gap-8 h-full">
            <form method="POST" action="{{ route('register') }}"
                class="max-w-lg max-md:mx-auto w-full p-12 border-[1px]">
                @csrf
                <div class="mb-4">
                    <h3 class="text-white text-4xl font-bold">Sign up</h3>
                </div>

                <!-- Name -->
                <div>
                    <label for="name" class="text-gray-300 text-[15px] mb-2 block">{{ __('Name') }}</label>
                    <div class="relative flex items-center">
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                            autocomplete="name"
                            class="w-full text-sm text-white bg-black focus:bg-black pl-4 pr-10 py-3 rounded-md border border-gray-700 focus:border-gray-500 outline-none transition-all"
                            placeholder="Enter your name" />
                    </div>
                    @error('name')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <label for="email" class="text-gray-300 text-[15px] mb-2 block">{{ __('Email') }}</label>
                    <div class="relative flex items-center">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autocomplete="username"
                            class="w-full text-sm text-white bg-black focus:bg-black pl-4 pr-10 py-3 rounded-md border border-gray-700 focus:border-gray-500 outline-none transition-all"
                            placeholder="Enter email" />
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="text-gray-300 text-[15px] mb-2 block">{{ __('Password') }}</label>
                    <div class="relative flex items-center">
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="w-full text-sm text-white bg-black focus:bg-black pl-4 pr-10 py-3 rounded-md border border-gray-700 focus:border-gray-500 outline-none transition-all"
                            placeholder="Enter password" />
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label for="password_confirmation"
                        class="text-gray-300 text-[15px] mb-2 block">{{ __('Confirm Password') }}</label>
                    <div class="relative flex items-center">
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            autocomplete="new-password"
                            class="w-full text-sm text-white bg-black focus:bg-black pl-4 pr-10 py-3 rounded-md border border-gray-700 focus:border-gray-500 outline-none transition-all"
                            placeholder="Confirm password" />
                    </div>
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Selection -->
                <div class="mt-4 relative">
                    <label for="role" class="text-gray-300 text-[15px] mb-2 block">{{ __('Register as') }}</label>
                    <div class="relative">
                        <select id="role" name="role"
                            class="w-full text-sm text-white bg-black focus:bg-black pl-4 pr-10 py-3 rounded-md border border-gray-700 focus:border-gray-500 outline-none transition-all appearance-none">
                            <option value="tourist" class="text-black bg-white">Tourist</option>
                            <option value="owner" class="text-black bg-white">Property Owner</option>
                        </select>
                    </div>
                    @error('role')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8">
                    <button type="submit"
                        class="w-full shadow-xl py-2.5 px-4 text-sm tracking-wide font-semibold rounded-md text-black bg-white hover:bg-gray-200 focus:outline-none transition-colors">
                        {{ __('Register') }}
                    </button>
                </div>
                <p class="text-sm mt-8 text-center text-gray-400">Already have an account? <a
                        href="{{ route('login') }}"
                        class="text-gray-300 font-semibold tracking-wide hover:text-white transition-colors ml-1">Login
                        here</a></p>
            </form>

            <div
                class="h-full md:py-6 flex flex-col items-center justify-center relative max-md:before:hidden before:absolute before:bg-gradient-to-r before:from-black before:via-gray-800 before:to-black before:h-full before:w-3/4 before:right-0 before:z-0">
                <div class="z-50 relative flex flex-col items-center lg:w-4/5 md:w-11/12">
                    <img src="{{ asset('assets/img/Logo.png') }}" class="w-48 mb-6 grayscale contrast-125" alt="Logo" />

                    <div class="bg-black bg-opacity-80 p-6 rounded-lg text-center mb-8 w-full">
                        <h2 class="text-white text-2xl font-bold mb-3">Join Our Community</h2>
                        <p class="text-gray-300 leading-relaxed">
                            Create an account to unlock exclusive access to premium properties across Spain, Morocco,
                            and Portugal. Whether you're looking to book your dream vacation or list your property,
                            we've got you covered.
                        </p>
                        <div class="flex justify-center mt-4 space-x-6">
                            <div class="text-center">
                                <span class="block text-white text-xl font-bold">Tourist</span>
                                <span class="text-gray-400 text-sm">Book Properties</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-white text-xl font-bold">Owner</span>
                                <span class="text-gray-400 text-sm">List Properties</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
