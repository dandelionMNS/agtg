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
            List of Users
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-yellow-400 text-base overflow-hidden shadow-sm sm:rounded-lg flex flex-col items-center p-10">

                <div class="grid grid-cols-1 w-full md:grid-cols-3" style="max-width:800px">
                    <div class="counters">
                        <h1>
                            {{ $users->count() }}
                        </h1>
                        <h3>
                            Total users
                        </h3>
                    </div>
                    <div class="counters mid-c">
                        <h1>
                            {{ $users->where('position', 'supervisor')->count() }}
                        </h1>
                        <h3>
                            Supervisors
                        </h3>
                    </div>
                    <div class="counters">
                        <h1>
                            {{ $users->where('position', 'employee')->count() }}
                        </h1>
                        <h3>
                            Employees
                        </h3>
                    </div>
                </div>

                <form action="" class="w-full flex gap-3 p-6" style="max-width: 900px">
                    <input class="w-full border-none rounded-lg" type="text">
                    <input type="submit" class="btn red" value="search">
                    <a href="{{route('user.addPage')}}" class=" text-nowrap btn red">Add New User</a>
                </form>

                <table>
                    <thead>
                        <td class="w-min">No.</td>
                        <td class="w-min text-nowrap">IDs</td>
                        <td class="w-min text-nowrap">Position</td>
                        <td class="w-fit text-nowrap">Name</td>
                        <td class="w-fit text-nowrap">Phone No</td>
                        <td class="w-full">Email</td>
                        <td colspan="2">Actions</td>
                    </thead>
                    <tbody>
                        <div class="hidden">
                            <?= $counter=1 ?>
                        </div>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <?= $counter++ ?>
                                </td>
                                <td>{{$user->id}}</td>
                                <td>{{$user->position}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->phone_no}}</td>
                                <td>{{$user->email}}</td>
                                <td class="p-3">
                                    <a href="{{route('user.details', ['id' => $user->id])}}" class="btn red">
                                        Details
                                    </a>
                                </td>

                                <td class="p-3">
                                    @if (auth()->user()->position == 'admin')
                                    <form class="w-fit" method="POST"
                                        action="{{ route('user.delete', ['id' => $user->id]) }}">

                                        @csrf
                                        @method('DELETE')
                                        <input class="btn dlt" type="submit" value="Remove">
                                    </form>
                                    @endif
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>