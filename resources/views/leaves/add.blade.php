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
                    <a class="btn red absolute left" href="{{ route('leave.index') }}"><img
                            src="{{ asset('./icons/ic_left.svg') }}"></a>
                </div>

                <form class="user-form w-full lg:w-1/2 flex flex-col p-5" method="POST"
                    action="{{ route('leave.add') }}" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}" required>
                        <label>
                            Name:
                        </label>
                        <input type="text" value="{{ auth()->user()->name }}" disabled>
                    </div>

                    <div>
                        <label for="type">
                            Leave Type:
                        </label>
                        <select class="input" id="type" name="type" required>
                            @foreach ($leave_types as $leave_type)
                                <option value="{{ $leave_type->id }}">{{ $leave_type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <input type="hidden" id="reason" name="reason" required>
                        <label>
                            Leave Reason:
                        </label>
                        <textarea name='reason' placeholder="description"></textarea>
                    </div>


                    <div class="my-30 mx-auto flex flex-col" style="margin:10px; color: grey">
                        Attachment
                        <label for='documents' class="attachment">
                            <img class="icon-doc" src="{{ asset('./icons/ic_plus.svg') }}">
                            <div id="image-preview" class="my-30 mx-auto" style="margin:10px; padding:0; display:none">
                                <img id="preview" src="#" alt="Image Preview"
                                    style="max-width: 100px; max-height: 100px; display: none;">
                            </div>
                            <div id="file-name" style="display:none; padding:20px; color: black;"></div>
                        </label>
                        <input type="file" id="documents" name="documents" accept="image/*,.pdf"
                            onchange="previewFile(event)" style="padding:5px; margin:5px; display:block" required>
                    </div>

                    <div>
                        <label for="start">
                            Start Date:
                        </label>
                        <input type="date" id="start" name="start" required>
                    </div>

                    <div>
                        <label for="end">
                            End Date:
                        </label>
                        <input type="date" id="end" name="end" required>
                    </div>

                    <div class="flex justify-center w-full pt-3" style="flex-direction: row">
                        <input class="btn red" style="padding: 10px 20px !important;" type="submit"
                            value="Request Leave">
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
                    reader.onload = function(e) {
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
