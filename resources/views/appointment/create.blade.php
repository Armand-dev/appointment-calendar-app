<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/flowbite@1.5.2/dist/datepicker.js"></script>

</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    <div class="container min-h-screen mx-auto max-w-md">
        <!-- Main modal -->
        <div class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center flex" aria-modal="true" role="dialog">
            <div class="relative p-4 max-w-7xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="flex relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal left -->
                    <div class="p-6 space-y-6">
                        <h3>Armand Codreanu</h3>
                        <input type="hidden" id="user_id" value="1">
                        <h1 class="font-black text-2xl">Free Strategy Call</h1>
                        <div class="flex mt-4">
                            <svg class="mr-2" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm0 1c6.071 0 11 4.929 11 11s-4.929 11-11 11-11-4.929-11-11 4.929-11 11-11zm0 11h6v1h-7v-9h1v8z"/></svg>
                            60 mins
                        </div>
                        <div class="flex mt-4">
                            <svg class="mr-2" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M15 3c1.104 0 2 .896 2 2v4l7-4v14l-7-4v4c0 1.104-.896 2-2 2h-13c-1.104 0-2-.896-2-2v-14c0-1.104.896-2 2-2h13zm0 17c.552 0 1-.448 1-1v-14c0-.551-.448-1-1-1h-13c-.551 0-1 .449-1 1v14c0 .552.449 1 1 1h13zm2-9.848v3.696l6 3.429v-10.554l-6 3.429z"/></svg>
                            Online meeting
                        </div>
                    </div>
                    <!-- Modal right -->
                    <div id="rightSideDatePick" class=" p-6 space-x-2 border-l border-gray-200 dark:border-gray-600">
                        <h1 class="font-black text-2xl">Select a Date & Time</h1>
                        <div class="flex">
                            <div id="dph">
                                <div class="relative">
                                    <input id="datePickerInput" datepicker datepicker-format="dd-mm-yyyy" type="text" class="hidden bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                                </div>
                            </div>
                            <div>
                                <div id="timeSlots" class="w-48 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                                </div>
                                <button id="confirmTimeSlot" type="button" class="hidden w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Confirm</button>
                            </div>
                        </div>
                    </div>
                    <div id="rightSideInputForm" class="hidden p-6 space-x-2 border-l border-gray-200 dark:border-gray-600">
                        <h1 class="font-black text-2xl">Appointment Details</h1>
                        <div class="mt-4">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Name</label>
                                <input type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Name" required>
                            </div>

                            <div class="mt-2">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                                <input type="text" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Email" required>
                            </div>

                            <div class="mt-2">
                                <label for="info" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Additional information (optional)</label>
                                <textarea id="info" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Additional information"></textarea>
                            </div>
                            <button id="sendAppointment" type="button" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save Appointment</button>
                        </div>
                    </div>
                    <div id="rightSideSuccess" class="hidden p-6 space-x-2 border-l border-gray-200 dark:border-gray-600">
                        <h1 class="font-black text-2xl">Appointment Successful</h1>
                        <div class="mt-4">

                            <div class="overflow-x-auto relative">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="py-3 px-6">
                                            Appointment
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Date & Time
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Additional Info
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Beneficiary
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Free Strategy Call (Armand Codreanu)
                                        </th>
                                        <td id="succesDateAndTime" class="py-4 px-6">

                                        </td>
                                        <td id="successInfo" class="py-4 px-6">

                                        </td>
                                        <td id="successBeneficiary" class="py-4 px-6">
                                            $2999
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <button id="bookAgain" type="button" class="float-right mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Book Again</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous">
</script>
<script>

    $(document).ready(() => {
        $('.datepicker').appendTo('#dph');
        $('.datepicker').removeClass('absolute hidden');

        $('.datepicker-cell').click((event) => {
            $('#confirmTimeSlot').hide();

            setTimeout(function (){
                let date = $('#datePickerInput').val();

            $.ajax({
                url: '/getAvailableTimeSlots/' + date,
                type: 'GET',
                success: (response) => {
                    // console.log(response);
                    let freeSlotsHtml = '<a class="block text-center py-2 px-4 w-full border-b border-gray-200 cursor-pointer bg-blue-600 text-white focus:outline-none focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">' +
                                            date +
                                        '</a>';

                    if (! response.length)
                    {
                        freeSlotsHtml += '<a class="block text-center py-2 px-4 w-full border-b border-gray-200 cursor-pointer hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">' +
                                            'Not available' +
                                            '</a>';
                    }

                    for (let i = 0; i < response.length; i++)
                    {
                        freeSlotsHtml += '<a id=timeslot_' + response[i].id + ' class="time-slot block text-center py-2 px-4 w-full border-b border-gray-200 cursor-pointer hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">' +
                                            response[i].label +
                                        '</a>';
                    }
                    $('#timeSlots').html(freeSlotsHtml);


                    $('.time-slot').click((event) => {
                        $('.time-slot').removeClass(' text-white bg-blue-700');
                        $(event.target).addClass(' text-white bg-blue-700');
                        let timeSlot = $(event.target).attr('id');
                        let timeSlotLabel = $(event.target).html();
                        timeSlot = timeSlot.split('_')[1];

                        $('#confirmTimeSlot').show();

                        $('#confirmTimeSlot').click((event) => {
                           $('#rightSideDatePick').hide();
                           $('#rightSideInputForm').show();

                           $('#sendAppointment').click((event) => {
                               let info = $('#info').val();
                               let customerName = $('#name').val();
                               let customerEmail = $('#email').val();
                               let userId = $('#user_id').val();

                               console.log(info);
                               console.log(customerName);
                               console.log(customerEmail);
                               console.log(userId);
                               console.log(date);
                               console.log(timeSlot);

                               $.ajax({
                                   url: '/appointment',
                                   type: 'POST',
                                   data: {
                                       _token: '{{ csrf_token() }}',
                                       day: date,
                                       time_slot: timeSlot,
                                       info: info,
                                       customer_name: customerName,
                                       customer_email: customerEmail,
                                       user_id: userId,
                                   },
                                   success: (response) => {
                                       $('#rightSideInputForm').hide();
                                       $('#rightSideSuccess').show();

                                       $('#succesDateAndTime').html(date + ' ' + timeSlotLabel);
                                       $('#successInfo').html(info);
                                       $('#successBeneficiary').html(customerName + ' (' + customerEmail + ')');

                                       $('#bookAgain').click(() => {
                                           location.reload();
                                       });
                                   },
                                   error: (error) => {
                                       console.log(error);
                                   }
                               });
                           })
                        });
                    });
                },
                error: (error) => {
                    console.log(error);
                }
            });
            }, 50);
        });

    });
</script>
</body>
</html>
