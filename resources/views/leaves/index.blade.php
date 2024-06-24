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

        .mid-c {
            border-left: 1px solid white;
            border-right: 1px solid white;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            List of Leave Requests
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-yellow-400 text-base overflow-hidden shadow-sm sm:rounded-lg flex flex-col items-center p-10">

                @if (auth()->user()->position != 'employee')
                    <div class="grid grid-cols-1 w-full md:grid-cols-3" style="max-width:800px">
                        <div class="counters">
                            <h1>
                                {{ $leaves->count() }}
                            </h1>
                            <p>
                                Total Leave {{ date('Y') }}
                            </p>
                        </div>
                        <div class="counters mid-c">
                            <h1>
                                {{ $leaves->where('status', 'supervisor')->count() }}
                            </h1>
                            <p>
                                Pending
                            </p>
                        </div>
                        <div class="counters">
                            <h1>
                                {{ $leaves->where('status', 'employee')->count() }}
                            </h1>
                            <p>
                                Rejected
                            </p>
                        </div>
                    </div>
                @endif

                @if (auth()->user()->position != 'admin')

                    <a href="{{route('leave.addPage')}}" class="btn red mb-5 font-medium">
                        Request Leave
                    </a>
                @endif


                <table>
                    <thead>
                        <td class="w-min">No.</td>
                        @if (auth()->user()->position == 'admin' || auth()->user()->position == 'supervisor')
                            <td class="w-min text-nowrap">Name</td>
                        @endif
                        <td class="w-min text-nowrap">Type</td>
                        <td class="w-fit text-nowrap">Start</td>
                        <td class="w-fit text-nowrap">End</td>
                        <td class="w-fit text-nowrap">Status</td>
                        <td colspan="2">Actions</td>
                    </thead>
                    <tbody>
                        <div class="hidden">
                            <?= $counter=1 ?>
                        </div>
                        @foreach ($leaves as $leave)
                            @if (auth()->user()->position == 'admin' || auth()->user()->position == 'supervisor')
                                <tr>
                                    <td>
                                        <?= $counter++ ?>
                                    </td>
                                    <td>{{$leave->user->name}}</td>
                                    <td>{{$leave->leave_type->name}}</td>
                                    <td>{{ \Carbon\Carbon::parse($leave->start)->format('d M Y') }}</td>
                                    @if ($leave->start == $leave->end)
                                        <td>-</td>
                                    @else
                                        <td>{{ \Carbon\Carbon::parse($leave->end)->format('d M Y') }}</td>
                                    @endif
                                    <td>{{$leave->status}}</td>
                                    <td class="p-3">
                                        <a href="{{route('leave.details', ['id' => $leave->id])}}" class="btn red">
                                            Details
                                        </a>
                                    </td>

                                    <td class="p-3">

                                        <form class="w-fit" method="POST"
                                            action="{{ route('leave.delete', ['id' => $leave->id]) }}">

                                            @csrf
                                            @method('DELETE')
                                            <input class="btn dlt" type="submit" value="Remove">
                                        </form>
                                    </td>
                                </tr>

                            @else
                                @if ((auth()->user()->id == $leave->user->id))

                                    <tr>
                                        <td>
                                            <?= $counter++ ?>
                                        </td>
                                        <td>{{$leave->leave_type->name}}</td>
                                        <td>{{ \Carbon\Carbon::parse($leave->start)->format('d M Y') }}</td>
                                        @if ($leave->start == $leave->end)
                                            <td>-</td>
                                        @else
                                            <td>{{ \Carbon\Carbon::parse($leave->end)->format('d M Y') }}</td>
                                        @endif
                                        <td>{{$leave->status}}</td>
                                        <td class="p-3">
                                            <a href="{{route('leave.details', ['id' => $leave->id])}}" class="btn red">
                                                Details
                                            </a>
                                        </td>

                                        <td class="p-3">

                                            <form class="w-fit" method="POST"
                                                action="{{ route('leave.delete', ['id' => $leave->id]) }}">

                                                @csrf
                                                @method('DELETE')
                                                <input class="btn dlt" type="submit" value="Remove">
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>