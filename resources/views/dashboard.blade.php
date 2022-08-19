<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden sm:rounded-lg">
                <div class="shadow-lg rounded-2xl max-w-sm p-4 bg-white dark:bg-gray-800">
                    <div class="flex items-center">
                        <span class="rounded-xl relative p-4 bg-purple-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </span>
                        <p class="text-md text-black dark:text-white ml-2">
                            Appointments
                        </p>
                    </div>
                    <div class="flex flex-col justify-start">
                        <p class="text-gray-700 dark:text-gray-100 text-4xl text-left font-bold my-4">
                            {{ $appointments }}
                            <span class="text-sm">
                                in {{ \Carbon\Carbon::now()->monthName }}
                            </span>
                        </p>
                        <div class="flex items-center text-green-500 text-sm">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1408 1216q0 26-19 45t-45 19h-896q-26 0-45-19t-19-45 19-45l448-448q19-19 45-19t45 19l448 448q19 19 19 45z">
                                </path>
                            </svg>
                            <span>
                                5.5%
                            </span>
                            &nbsp;
                            <span class="text-gray-400">
                                vs last month
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
