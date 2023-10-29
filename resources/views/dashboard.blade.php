<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($errors->all() as $error)
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <span class="font-medium">Opss...</span> {{ $error }}
                </div>
            @endforeach
            <x-form action="{{ route('question.store') }}">
                <div>
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Question</label>
                    <textarea id="message" name="question" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."> {{ old('question') ?? '' }}</textarea>
                </div>
                <x-button type="submit" label="Send Message"></x-button>
                <x-button type="reset" label="Cancel" class="dark:bg-red-900 hover:dark:bg-red-700"></x-button>
            </x-form>
            <hr class="w-full mt-5 text-white" />
            <div class="w-full mt-5 flex flex-col">
                <h2 class="text-white font-medium text-xl">List of Questions</h2>
                @foreach ($questions as $question)
                  <x-question id="{{ $question->id }}" question="{{ $question->question }}" likes="{{ $question->likes }}" dislikes="{{ $question->dislikes }}"/>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
