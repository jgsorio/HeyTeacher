@props([
    'id',
    'question',
    'likes',
    'dislikes'
])

<div class="border-2 border-gray-700 rounded-md my-2 py-3 dark:text-white shadow-md shadow-blue-500/20 flex justify-between">
    <span class="ml-2">
        {{ $question }}
    </span>
    <span class="mr-2">
        <x-form action="{{ route('question.like', $id) }}">
             <button>
                 <x-icons.thumbs-up class="text-green-900 hover:text-green-300 cursor-pointer flex" likes="{{ $likes }}" dislikes="{{ $dislikes }}"/>
             </button>
        </x-form>
        <x-icons.thumbs-down class="text-red-900 hover:text-red-300 cursor-pointer flex"/>
    </span>
</div>
