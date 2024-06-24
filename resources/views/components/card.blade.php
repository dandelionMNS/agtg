
<style>
    .card{
        transition: 400ms;

        &:hover{
            scale:1.01;
        }
    }
</style>

<a class="card bg-white flex flex-col justify-center h-full" href="{{ $route }}">
    <div>
        <img src="{{ asset($image) }}" style="width: 355px" class="w-full">
    </div>
    <h2 class="py-6 bg-white text-black text-center">
        {{ $title }}
    </h2>
</a>


