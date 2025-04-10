<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bowling Reservation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navigation Bar -->
    <nav class="bg-indigo-600 shadow-md">
        <div class="max-w-screen-xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="#" class="text-white text-2xl font-semibold">Bowling Alley</a>
                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-6">
                    <a href="#home" class="text-white hover:text-indigo-200">Home</a>
                    <a href="#about" class="text-white hover:text-indigo-200">About</a>
                    <a href="#services" class="text-white hover:text-indigo-200">Services</a>
                    <a href="#contact" class="text-white hover:text-indigo-200">Contact</a>
                </div>
                <!-- Mobile Menu Button -->
                <button class="md:hidden text-white" id="menu-toggle">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            <!-- Mobile Menu -->
            <div class="md:hidden hidden" id="menu">
                <a href="#home" class="block text-white py-2 px-4">Home</a>
                <a href="#about" class="block text-white py-2 px-4">About</a>
                <a href="#services" class="block text-white py-2 px-4">Services</a>
                <a href="#contact" class="block text-white py-2 px-4">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Reservation Form Section -->
    <section class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Reserve Your Bowling Lane</h2>
        <form action="/submit-reservation" method="POST">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- First Name -->
                <div>
                    <label for="first_name" class="block text-gray-700">First Name</label>
                    <input type="text" id="first_name" name="first_name" required
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <!-- Last Name -->
                <div>
                    <label for="last_name" class="block text-gray-700">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Email -->
                <div>
                    <label for="email" class="block text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" required
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <!-- Phone Number -->
                <div>
                    <label for="phone_number" class="block text-gray-700">Phone Number</label>
                    <input type="tel" id="phone_number" name="phone_number" required
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Lane Selection -->
                <div>
                    <label for="lane_id" class="block text-gray-700">Select Lane</label>
                    <select id="lane_id" name="lane_id" required
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <!-- Loop through lanes dynamically -->
                        <option value="1">Lane 1</option>
                        <option value="2">Lane 2</option>
                        <option value="3">Lane 3</option>
                        <option value="4">Lane 4</option>
                        <option value="5">Lane 5</option>
                        <option value="6">Lane 6</option>
                        <option value="7">Lane 7</option>
                        <option value="8">Lane 8</option>
                    </select>
                </div>
                <!-- Reservation Date -->
                <div>
                    <label for="reservation_date" class="block text-gray-700">Reservation Date</label>
                    <input type="date" id="reservation_date" name="reservation_date" required
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Start Time -->
                <div>
                    <label for="start_time" class="block text-gray-700">Start Time</label>
                    <input type="time" id="start_time" name="start_time" required
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <!-- End Time -->
                <div>
                    <label for="end_time" class="block text-gray-700">End Time</label>
                    <input type="time" id="end_time" name="end_time" required
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>
            <div class="mt-6">
                <label for="number_of_players" class="block text-gray-700">Number of Players</label>
                <input type="number" id="number_of_players" name="number_of_players" min="1" required
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="mt-6">
                <label for="status" class="block text-gray-700">Reservation Status</label>
                <select id="status" name="status" required
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="Bevestigd">Bevestigd</option>
                    <option value="Geannuleerd">Geannuleerd</option>
                    <option value="Afwachten betaling">Afwachten betaling</option>
                </select>
            </div>
            <div class="mt-6 flex justify-center">
                <button type="submit"
                    class="px-6 py-2 bg-indigo-500 text-white font-semibold rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Reserve Now
                </button>
            </div>
        </form>
    </section>

    <script>
        // Toggle mobile menu visibility
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        });
    </script>

</body>
</html>
