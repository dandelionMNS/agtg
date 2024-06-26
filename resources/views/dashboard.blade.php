<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Welcome back {{ Auth::user()->name }}!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex" style="gap: 20px">
                    
                    <x-card title="Users Profiles" route="{{route('user.index')}}" image="./images/card_profile.jpg" />

                    <x-card title="Weekly Duties" route="{{route('duty.index')}}" image="./images/card_duty.jpg" />

                    <x-card title="Leave Request" route="{{route('leave.index')}}" image="./images/card_leave.jpg" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>