<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @isset($add)
                Add New User
            @else
                User Details
            @endisset
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
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex items-center flex-col p-5 shadow-sm sm:rounded-lg">

                @if (auth()->user()->position == 'admin')
                    <div class="w-full relative ">
                        <a class="btn red absolute left" href="{{ route('user.index') }}"><img
                                src="{{ asset('./icons/ic_left.svg') }}"></a>
                    </div>

                    <form class="user-form w-full lg:w-1/2 flex flex-col p-5" method="POST"
                        action="{{ route('user.update', ['id' => $user->id]) }}">
                        @csrf
                        @method('PUT')
                    @else()
                        <form class="user-form w-full lg:w-1/2 flex flex-col p-5">
                @endif

                <div>
                    <label for="name">
                        Name:
                    </label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" required
                        {{ auth()->user()->position != 'admin' ? 'disabled' : '' }}>
                </div>

                <div>
                    <label for="position">
                        Position:
                    </label>
                    <select class="input" id="position" name="position" required
                        {{ auth()->user()->position != 'admin' ? 'disabled' : '' }}>
                        <option value="employee" {{ $user->position == 'employee' ? 'selected' : '' }}>Employee
                        </option>
                        <option value="supervisor" {{ $user->position == 'supervisor' ? 'selected' : '' }}>
                            Supervisor
                        </option>
                        <option value="admin" {{ $user->position == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div>
                    <label for="email">
                        Email:
                    </label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" required
                        {{ auth()->user()->position != 'admin' ? 'disabled' : '' }}>
                </div>


                @if (auth()->user()->position == 'admin')
                    <div>
                        <label for="password">
                            Password:
                        </label>
                        <input type="password" id="password" name="password" value='{{ $user->password }}' required>
                    </div>
                @endif
                <div>
                    <label for="phone_no">
                        Phone No:
                    </label>
                    <input type="text" id="phone_no" name="phone_no" value="{{ $user->phone_no }}" required
                        {{ auth()->user()->position != 'admin' ? 'disabled' : '' }}>
                </div>

                <div>
                    <label for="gender">
                        Gender:
                    </label>
                    <select class="input" id="user_type" name="user_type" required
                        {{ auth()->user()->position != 'admin' ? 'disabled' : '' }}>
                        <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="femalte" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div>
                    <label for="address">
                        Address
                    </label>
                    <textarea name="address" {{ auth()->user()->position != 'admin' ? 'disabled' : '' }}>{{ $user->address }}</textarea>
                </div>

                <div>
                    <label for="age">
                        Age:
                    </label>
                    <input type="number" id="age" name="age" value="{{ $user->age }}"
                        {{ auth()->user()->position != 'admin' ? 'disabled' : '' }}>
                </div>

                <div>
                    <label for="leave_remaining">
                        Leave Remaining:
                    </label>
                    <input type="number" id="leave_remaining" name="leave_remaining"
                        value="{{ $user->leave_remaining }}"
                        {{ auth()->user()->position != 'admin' ? 'disabled' : '' }}>
                </div>

                @if (auth()->user()->position == 'admin')
                    <div class="flex justify-center w-full pt-3" style="flex-direction: row">
                        <input class="btn red" style="padding: 10px 20px !important;" type="submit" value="Update">
                    </div>

                    </form>
                    <div class="flex gap-5 relative w-full justify-center">
                        <form class="w-fit" method="POST" action="{{ route('user.delete', ['id' => $user->id]) }}">
                            @csrf
                            @method('DELETE')
                            <input class="btn dlt" type="submit" value="Remove User">
                        </form>

                        <form action="{{ route('monthly_record', ['id' => $user->id]) }}" method="get"
                            class="absolute right-5">
                            <input placeholder="month" type="month" name="date">
                            <input type="submit" value="Monthly Record" class="btn red">
                        </form>

                    </div>
                @else
                    </form>

                    <form action="{{ route('monthly_record', ['id' => $user->id]) }}" method="get">
                        <input placeholder="month" type="month" name="date">
                        <input type="submit" value="Monthly Record" class="btn red">
                    </form>
                @endif

            </div>

        </div>
    </div>
    </div>
</x-app-layout>
