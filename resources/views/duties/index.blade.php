<x-app-layout>
    <style>
        td {
            padding: 20px;
            border-top: 1px solid #eee;
        }

        thead td {
            font-size: 1.2rem;
            font-weight: 700;
        }

        .counters {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 0 0 40px 0;
            width: 100%;
            aspect-ratio: 3/2;


            h1 {
                font-size: 3rem;
                font-weight: 700;
                margin: 15px
            }

            h3 {
                font-size: 1.2rem;
                font-weight: 400;
                height: unset;
            }
        }

        .clock {
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            padding: 3px 8px;
            border: 1px solid #aaa;
        }

        .mid-c {
            border-left: 1px solid white;
            border-right: 1px solid white;
        }

        .fc-direction-ltr .fc-daygrid-event.fc-event-start,
        .fc-direction-rtl .fc-daygrid-event.fc-event-end {
            margin: 0;
        }

        .fc-event-title {
            color: #000;
            font-weight: 600;
            letter-spacing: 1px;
            width: fit-content;
            margin: 5px 10px;
        }

        .fc-daygrid-day-events {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 0 1px;
        }

        .fc-daygrid-event-harness {
            width: fit-content;
            margin: 0;
        }

        .fc-daygrid-day-frame {
            /* max-height: 60px; */
        }

        .fc-targetdate-button {
            height: auto !important;
            width: auto !important;
        }

        #calendar {
            max-width: 800px;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Duties
        </h2>
        @php
            if (auth()->user()->position == 'employee') {
                $duties = $duties->where('user_id', auth()->user()->id);
            }
        @endphp
    </x-slot>

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.4.2/core/main.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.4.2/daygrid/main.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.4.2/core/main.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.4.2/daygrid/main.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.4.2/interaction/main.min.js"></script>

        <script src="{{ asset('public/fullcalendar/main.min.js') }}"></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>
        <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css">
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var today = "{{ $date }}";

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    initialDate: today,
                    headerToolbar: {
                        left: 'prev,next',
                        center: 'title',
                        right: ''
                    },
                    dateClick: function(info) {
                        var dateStr = info.dateStr;
                        var url = "{{ route('duty.goto', ':date') }}".replace(':date', dateStr);
                        window.location.href = url;
                    },
                    events: [
                        @foreach ($duties as $duty)
                            {
                                title: '{{ $duty->user_id }}',
                                start: '{{ $duty->date }}',
                                backgroundColor: '{{ $duty->remarks == null && $duty->start != null ? '#0f0' : ($duty->remarks == null && $duty->start == null ? '#fff' : '#f00') }}',
                            },
                        @endforeach
                    ],

                });

                calendar.render();
            });
        </script>
    </head>




    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap gap-1 text-base shadow-sm sm:rounded-lg">
                <div class="w-2/3 relative">
                    <div id='calendar' class="w-full bg-white p-10 m-0 rounded-lg"></div>
                    <!-- <a class=" absolute top-10 right-10 py-2 px-3 rounded-md" route=""
                        style="transform: translate(-5%, 0); color:white; background: #2c3e50;">Monthly Record</a> -->
                </div>


                <div class="bg-white p-8 rounded-lg flex flex-col gap-5" style="min-width:350px">
                    <div class="flex flex-col">
                        <div class="flex">
                            <h1 class="text-4xl font-semibold italic">
                                {{ Carbon\Carbon::parse($date)->format('d F Y') }}
                            </h1>
                            <a href="{{ route('duty.index') }}" class="btn dlt mx-2 p-2">
                                Today
                            </a>
                        </div>
                        @if (Carbon\Carbon::today()->format('Y-m-d') == $date)
                            <h4 class="text-lg font-medium">Today</h4>
                        @endif
                    </div>

                    @if (auth()->user()->position == 'supervisor')
                        <h2 class="text-xl">Tasks<a class="btn w-fit text-base font-normal ml-5 red"
                                href="{{ route('duty.addPage', ['date' => $date]) }}">Add task</a></h2>
                    @endif
                    <div class="flex gap-5 border-b-2 p-3">


                        <p class="flex"> <img src="{{ asset('./icons/ic_clock_in.svg') }}" class=""
                                alt="clock in"> -
                            Clock In </p>
                        <p class="flex"> <img src="{{ asset('./icons/ic_clock_out.svg') }}" alt="clock out"> - Clock
                            Out
                        </p>
                    </div>

                    <!-- List Duty -->

                    <div class="flex flex-col  gap-3">
                        @php
                            $groupedDuties = $duties->where('date', $date)->groupBy('duty_type.name');
                        @endphp

                        @foreach ($groupedDuties as $dutyType => $dutiesGroup)
                            <div>
                                <strong>{{ $dutyType }}:</strong>
                                @foreach ($dutiesGroup as $duty)
                                    <div class="flex flex-col gap-1 my-2 p-2 border-gray-500 rounded-lg"
                                        style="border: 1px solid #aaa">
                                        <div class="flex my-1">
                                            <p> {{ $duty->user_id }} - {{ $duty->user->name }} </p>
                                            @if (auth()->user()->position == 'supervisor')
                                                <form class="ml-3 btn dlt w-fit text-xs border-0 rounded-none p-1"
                                                    method="POST"
                                                    action="{{ route('duty.delete', ['id' => $duty->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="Delete">
                                                </form>
                                            @endif
                                        </div>
                                        <div class="flex gap-5">
                                            <div class="clock">
                                                <img src="{{ asset('./icons/ic_clock_in.svg') }}" class="m-1"
                                                    alt="clock in">

                                                @if (auth()->user()->position == 'employee')
                                                    <form
                                                        action="{{ route('duty.clockin', ['duty_id' => $duty->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')

                                                        <input type="submit"
                                                            value="{{ $duty->start == null ? '--:--' : $duty->start }}">
                                                    </form>
                                                @else
                                                    <div>{{ $duty->start == null ? '--:--' : $duty->start }}</div>
                                                @endif

                                            </div>
                                            <div class="clock">
                                                <img src="{{ asset('./icons/ic_clock_out.svg') }}" class="m-1"
                                                    alt="clock out">
                                                @if (auth()->user()->position == 'employee')
                                                    <form
                                                        action="{{ route('duty.clockout', ['duty_id' => $duty->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')

                                                        <input type="submit"
                                                            value="{{ $duty->end == null ? '--:--' : $duty->end }}">
                                                    </form>
                                                @else
                                                    <div>{{ $duty->end == null ? '--:--' : $duty->end }}</div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
