<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horizon</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/choices.js/10.2.0/choices.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/choices.js/10.2.0/choices.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./assets/images/LOOGOksajxd.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dark: '#121212',
                        darker: '#0a0a0a',
                        darkgray: '#1e1e1e',
                        lightgray: '#2d2d2d',
                    }
                }
            }
        }
    </script>
    <script defer>
        const showToast = (message, type = 'success') => {
            const toastContainer = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `p-4 rounded shadow text-white ${type === 'success' ? 'bg-gray-700' : 'bg-gray-800'}`;
            toast.textContent = message;

            toastContainer.appendChild(toast);

            // Remove toast after 3 seconds
            setTimeout(() => {
                toast.remove();
            }, 3000);
        };

        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('.toggle-password');
            const passwordInput = document.querySelector('input[name="password"]');
            
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js" defer></script>
</head>

<body class="bg-darker text-white">
    <div id="toast-container" class="fixed top-4 right-4 z-50 flex flex-col gap-2"></div>

    <div class="font-[sans-serif] max-w-7xl mx-auto h-screen">
        <div class="grid md:grid-cols-2 items-center gap-8 h-full">
            <form class="max-w-lg max-md:mx-auto w-full p-12  border-[1px]">
                <div class="mb-12">
                    <h3 class="text-white text-4xl font-bold">Sign in</h3>
                    <p class="text-gray-400 text-sm mt-6">Immerse yourself in a hassle-free login journey with our
                        intuitively designed login form. Effortlessly access your account.</p>
                </div>

                <div>
                    <label class="text-gray-300 text-[15px] mb-2 block">Email</label>
                    <div class="relative flex items-center">
                        <input name="email" type="text" required
                            class="w-full text-sm text-white bg-darkgray focus:bg-dark pl-4 pr-10 py-3 rounded-md border border-gray-700 focus:border-gray-500 outline-none transition-all"
                            placeholder="Enter email" />
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#666" stroke="#666"
                            class="w-[18px] h-[18px] absolute right-4" viewBox="0 0 682.667 682.667">
                            <defs>
                                <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                    <path d="M0 512h512V0H0Z" data-original="#000000"></path>
                                </clipPath>
                            </defs>
                            <g clip-path="url(#a)" transform="matrix(1.33 0 0 -1.33 0 682.667)">
                                <path fill="none" stroke-miterlimit="10" stroke-width="40"
                                    d="M452 444H60c-22.091 0-40-17.909-40-40v-39.446l212.127-157.782c14.17-10.54 33.576-10.54 47.746 0L492 364.554V404c0 22.091-17.909 40-40 40Z"
                                    data-original="#000000"></path>
                                <path
                                    d="M472 274.9V107.999c0-11.027-8.972-20-20-20H60c-11.028 0-20 8.973-20 20V274.9L0 304.652V107.999c0-33.084 26.916-60 60-60h392c33.084 0 60 26.916 60 60v196.653Z"
                                    data-original="#000000"></path>
                            </g>
                        </svg>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="text-gray-300 text-[15px] mb-2 block">Password</label>
                    <div class="relative flex items-center">
                        <input name="password" type="password" required
                            class="w-full text-sm text-white bg-darkgray focus:bg-dark pl-4 pr-10 py-3 rounded-md border border-gray-700 focus:border-gray-500 outline-none transition-all"
                            placeholder="Enter password" />
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#666" stroke="#666"
                            class="w-[18px] h-[18px] absolute right-4 cursor-pointer toggle-password" viewBox="0 0 128 128">
                            <path
                                d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z"
                                data-original="#000000"></path>
                        </svg>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-4 justify-between mt-4">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="shrink-0 h-4 w-4 text-gray-400 focus:ring-gray-500 border-gray-600 rounded-md bg-darkgray" />
                        <label for="remember-me" class="ml-3 block text-sm text-gray-300">
                            Remember me
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="javascript:void(0);" class="text-gray-400 font-semibold hover:text-white transition-colors">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <div class="mt-8">
                    <button type="button"
                        class="w-full shadow-xl py-2.5 px-4 text-sm tracking-wide font-semibold rounded-md text-black bg-white hover:bg-gray-200 focus:outline-none transition-colors">
                        Log in
                    </button>
                </div>
                <p class="text-sm mt-8 text-center text-gray-400">Don't have an account? <a href="javascript:void(0);"
                        class="text-gray-300 font-semibold tracking-wide hover:text-white transition-colors ml-1">Register here</a></p>
            </form>

            <div class="h-full md:py-6 flex flex-col items-center justify-center relative max-md:before:hidden before:absolute before:bg-gradient-to-r before:from-dark before:via-darkgray before:to-dark before:h-full before:w-3/4 before:right-0 before:z-0">
                <div class="z-50 relative flex flex-col items-center lg:w-4/5 md:w-11/12">
                    <img src="{{ asset('assets/img/Logo.png') }}" class="w-48 mb-6 grayscale contrast-125" alt="Logo" />
                    
                    <div class="bg-darkgray bg-opacity-80 p-6 rounded-lg text-center mb-8 w-full">
                        <h2 class="text-white text-2xl font-bold mb-3">Discover Extraordinary Homes</h2>
                        <p class="text-gray-300 leading-relaxed">
                            Explore spectacular properties across Spain, Morocco, and Portugal. From Mediterranean villas with ocean views to historic riads nestled in ancient medinas, find your perfect escape in these captivating destinations.
                        </p>
                        <div class="flex justify-center mt-4 space-x-6">
                            <div class="text-center">
                                <span class="block text-white text-xl font-bold">Spain</span>
                                <span class="text-gray-400 text-sm">Coastal Villas</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-white text-xl font-bold">Morocco</span>
                                <span class="text-gray-400 text-sm">Historic Riads</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-white text-xl font-bold">Portugal</span>
                                <span class="text-gray-400 text-sm">Rustic Estates</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>

</html>