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
                
                <h2>LeaveID: {{$leave->id}}</h2>
                <div class="w-full relative ">
                    <a class="btn red absolute left" href="{{route('leave.index')}}">
                        <img src="{{asset('./icons/ic_left.svg')}}">
                    </a>
                </div>

                <form class="user-form w-full lg:w-1/2 flex flex-col p-5" method="POST"
                    action="{{ route('leave.update', ['id' => $leave->id])}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <input type="hidden" id="user_id" name="user_id" value="{{$leave->user_id}}" required>
                        <label>
                            Name:
                        </label>
                        <input type="text" value="{{$leave->user->name}}" disabled>
                    </div>

                    <div>
                        <label for="type">
                            Leave Type:
                        </label>
                        <select class="input" id="type" name="type" required>
                            @foreach ($leave_types as $leave_type)
                                <option value="{{$leave_type->id}}" {{ $leave->leave_type_id == $leave_type->id ? 'selected' : '' }}>{{$leave_type->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <input type="hidden" id="reason" name="reason" required>
                        <label>
                            Leave Reason:
                        </label>
                        <textarea name='reason' placeholder="description">{{$leave->reason}}</textarea>
                    </div>


                    <div class="my-30 mx-auto flex flex-col" style="margin:10px; color: grey">
                        Attachment
                        <label for='documents' class="attachment">
                            @if ($leave->documents == 'none' || $leave->documents == null)
                                <img class="icon-doc" src="{{ asset('./icons/ic_plus.svg') }}">
                            @endif

                            @if (Str::contains($leave->documents, '.pdf'))
                                <p class="p-3">{{$leave->documents}}</p>
                            @else
                                <div id="image-preview" class="my-30 mx-auto" style="margin:10px; padding:0;">
                                    <img id="preview" src="{{asset($leave->documents)}}" alt="{{$leave->documents}}"
                                        style="width: 100%; max-width: 100px; max-height: 100px; ">
                                </div>
                            @endif
                            <div id="file-name" style="display:none; padding:20px; color: black;"></div>
                        </label>
                        @if (Str::contains($leave->documents, '.pdf'))
                            <p>
                                Click <a href="{{asset($leave->documents)}}" class="underline text-blue-700 w-0"
                                    download>here</a> to download
                            </p>
                        @endif

 
                        @if (auth()->user()->position == "employee")
                        <input type="hidden" name="status" value="Pending" >
                        @endif


                        <input type="file" id="documents" name="documents" accept="image/*,.pdf"
                            onchange="previewFile(event)" value="{{$leave->documents}}"
                            style="padding:5px; margin:5px; display:none" {{auth()->user()->position == 'employee' ? "" : "disabled"}}>


                    </div>


                    <div>
                        <label for="start">
                            Start Date:
                        </label>
                        <input type="date" id="start" name="start" value="{{$leave->start}}" required>
                    </div>

                    <div>
                        <label for="end">
                            End Date:
                        </label>
                        <input type="date" id="end" name="end" value="{{$leave->end}}" required>
                    </div>

                    @if (auth()->user()->position == 'admin' || auth()->user()->position == 'supervisor')

                        <label for="status">
                            Status:
                        </label>
                        <select class="input" id="status" name="status" required>
                            <option value="Approved" {{ $leave->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                            <option value="Rejected" {{ $leave->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>

                        </select>
                    @endif


                    <div class="flex justify-center w-full pt-3" style="flex-direction: row">

                        @if(auth()->user()->position == 'employee' && $leave->status == "Approved")

                        @else                    
                        <input class="btn red" style="padding: 10px 20px !important;" type="submit"
                            value="Update Leave">

                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function previewFile(event) {
            var input = event.target;
            var file = input.files[0];
            var fileNameDiv = document.getElementById('file-name');
            var imagePreviewDiv = document.getElementById('image-preview');
            var previewImg = document.getElementById('preview');
            var icon = document.getElementsByClassName('icon-doc')[0];

            if (file) {
                var fileType = file.type;

                // Hide elements initially
                fileNameDiv.style.display = 'none';
                imagePreviewDiv.style.display = 'none';
                previewImg.style.display = 'none';

                if (fileType.startsWith('image/')) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        imagePreviewDiv.style.display = 'block';
                        previewImg.src = e.target.result;
                        previewImg.style.display = 'block';
                        icon.style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                } else if (fileType === 'application/pdf') {
                    fileNameDiv.innerHTML = file.name;
                    fileNameDiv.style.display = 'block';
                    icon.style.display = 'none';
                } else {
                    alert('Unsupported file type!');
                }
            }
        }
    </script>
</x-app-layout>