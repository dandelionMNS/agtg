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
                    <a class="btn red absolute left" href="{{ route('duty.index') }}"><img
                            src="{{ asset('./icons/ic_left.svg') }}"></a>
                </div>

                <form class="user-form w-full lg:w-1/2 flex flex-col p-5" method="POST" onsubmit="showalert(event)" id="theform"
                    action="{{ route('duty.add', ['date' => $date]) }}" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label for="type">
                            Person Incharge:
                        </label>
                        <select class="input" id="user_id" name="user_id" required>
                            @foreach ($users as $user)
                                @if (!$duties->where('date', $date)->where('user_id', $user->id)->count())
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    @php
                        function isWeekend($date)
                        {
                            $dayOfWeek = \Carbon\Carbon::parse($date)->dayOfWeek;
                            return $dayOfWeek == \Carbon\Carbon::SATURDAY || $dayOfWeek == \Carbon\Carbon::SUNDAY;
                        }

                        $isWeekend = isWeekend($date);
                    @endphp


                    <div>
                        <label for="duty_type_id">
                            Duty Type:
                        </label>
                        <select class="input" id="duty_type_id" name="duty_type_id" required>
                            @foreach ($duty_types as $duty_type)
                                @php
                                    $currentCount = $duties
                                        ->where('date', $date)
                                        ->where('duty_type_id', $duty_type->id)
                                        ->count();

                                    $limit = $isWeekend ? $duty_type->countwe : $duty_type->countwd;
                                @endphp

                                @if ($currentCount < $limit)
                                    <option value="{{ $duty_type->id }}">{{ $duty_type->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>


                    <div>
                        <label for="date">
                            Date:
                        </label>
                        <input type="date" id="date" name="date" value="{{ $date }}" required>
                    </div>

                    <div class="flex justify-center w-full pt-3" style="flex-direction: row">
                        <input class="btn red" style="padding: 10px 20px !important;" type="submit" value="Add Duty">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function showAlert(event) {
        event.preventDefault();
        alert('Duties Added successfully!');
        document.getElementById('theform').submit();
    }
</script>