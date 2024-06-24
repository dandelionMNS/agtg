<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New User
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

                <div class="w-full relative ">
                    <a class="btn red absolute left" href="{{route('user.index')}}"><img
                            src="{{asset('./icons/ic_left.svg')}}"></a>
                </div>

                <form class="user-form w-full lg:w-1/2 flex flex-col p-5" method="POST"
                    action="{{ route('user.add')}}">
                    @csrf
                

                    <div>
                        <label for="name">
                            Name:
                        </label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div>
                        <label for="position">
                            Position:
                        </label>
                        <select class="input" id="position" name="position" required>
                            <option value="employee" >Employee
                            </option>
                            <option value="supervisor">Supervisor
                            </option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div>
                        <label for="email">
                            Email:
                        </label>
                        <input type="email" id="email" name="email"  required>
                    </div>

                    <div>
                        <label for="password">
                            Password:
                        </label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div>
                        <label for="phone_no">
                            Phone No:
                        </label>
                        <input type="text" id="phone_no" name="phone_no"  required>
                    </div>

                    <div>
                        <label for="gender">
                            Gender:
                        </label>
                        <select class="input" id="user_type" name="user_type" required>
                            <option value="male" >Male</option>
                            <option value="femalte">Female</option>
                        </select>
                    </div>

                    <div>
                        <label for="address">
                            Address
                        </label>
                        <textarea name="address" required></textarea>
                    </div>

                    <div>
                        <label for="age">
                            Age:
                        </label>
                        <input type="number" id="age" name="age" required>
                    </div>

                    <div>
                        <label for="leave_remaining">
                            Leave Remaining:
                        </label>
                        <input type="number" id="leave_remaining" name="leave_remaining"
                            value="20">
                    </div>

                    <div class="flex justify-center w-full pt-3" style="flex-direction: row">
                        <input class="btn red" style="padding: 10px 20px !important;" type="submit" value="Add New User">
                    </div>
                </form>

    

            </div>
        </div>
    </div>
</x-app-layout>