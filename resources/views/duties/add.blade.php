<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Request Leave
        </h2>
    </x-slot>

    <style>
        form {
            div {
                display: flex;
                flex-direction: column;
                padding: 20px 0;
            }
        }

        input,
        textarea,
        select {
            padding: 10px !important;
            border-radius: 10px !important;

            &:hover {
                cursor: pointer;
            }
        }

        .attachment {
            width: fit-content;
            margin: 20px 20px 0 0;
            border: 2px dashed #999;

            .icon-doc {
                margin: 30px;
            }
        }
    </style>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex items-center flex-col p-5 shadow-sm sm:rounded-lg">

                <div class="w-full relative ">
                    <a class="btn red absolute left" href="{{route('duty.index')}}"><img
                            src="{{asset('./icons/ic_left.svg')}}"></a>
                </div>

                <form class="user-form w-full lg:w-1/2 flex flex-col p-5" method="POST"
                    action="{{ route('duty.add',['date' => $date])}}" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label for="type">
                           Person Incharge: 
                        </label>
                        <select class="input" id="user_id" name="user_id" required>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>             

                    <div>
                        <label for="duty_type_id">
                            Duty Type:
                        </label>
                        <select class="input" id="duty_type_id" name="duty_type_id" required>
                            @foreach ($duty_types as $duty_type)
                                <option value="{{$duty_type->id}}">{{$duty_type->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div>
                        <label for="date">
                            Date:
                        </label>
                        <input type="date" id="date" name="date" value="{{$date}}" required>
                    </div>

                    <div class="flex justify-center w-full pt-3" style="flex-direction: row">
                        <input class="btn red" style="padding: 10px 20px !important;" type="submit"
                            value="Add Duty">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>