<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign Up - Demander</title>
 <link href="{{ asset('css/app.css') }}" rel="stylesheet">

 
</head>
<body class="bg-white min-h-screen flex flex-col justify-between">

    <!-- Main Content -->
    <div class="flex flex-1">

        <!-- Left side image -->
        <div class="w-1/2 flex flex-col justify-center items-center bg-white">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-40 mt-10">
            <img src="{{ asset('images/DEMANDER APP-PAPER CUP.png') }}" alt="Illustration" class="w-80">
        </div>

        <!-- Right side form -->
        <div class=" flex justify-center items-center">
            <div class="w-96 p-8 shadow-lg bg-white rounded-lg">

                <h2 class="text-2xl font-semibold text-center mb-6">Create Your Account</h2>

                <form>
                    <div class="mb-4">
                        <input type="text" id="sellername" class="border border-gray-300 rounded-md w-full py-2 px-3 focus:outline-none focus:ring-1 focus:ring-yellow-500" placeholder="Business Name">
                    </div>

                    <div class="mb-4">
                        <input type="email" id="mailid" class="border border-gray-300 rounded-md w-full py-2 px-3 focus:outline-none focus:ring-1 focus:ring-yellow-500" placeholder="Email Address">
                    </div>

                    <div class="mb-6">
                        <input type="password" id="password" class="border border-gray-300 rounded-md w-full py-2 px-3 focus:outline-none focus:ring-1 focus:ring-yellow-500" placeholder="Set Password">
                    </div>

                    <div class="flex justify-between space-x-3">
                        <button type="button" class="border-2 border-yellow-500 bg-yellow-500 text-white py-2 px-6 rounded-md hover:bg-yellow-600 transition get-started-button" >
                            Get Started
                        </button>
                        <button type="button" class="border-2 border-gray-400 text-gray-700 py-2 px-6 rounded-md hover:bg-gray-100 transition go-back">
                            Go Back
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Footer text -->
    <footer class="text-center py-4 text-gray-700 italic font-medium">
        Everyday orders from trusted buyers—easier than ever.
    </footer>

   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
