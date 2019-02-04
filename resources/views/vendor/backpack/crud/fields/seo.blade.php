@isset($field['value'])

    @php
        $seo = $field['value'];
        $locale = request()->get('locale') ?? config('app.locale');
    @endphp

    <div @include('crud::inc.field_wrapper_attributes') >
        <label>Title</label>
        <input
            type="text"
            name="seo[title]"
            value="{{ $seo->getTranslation('title', $locale) }}"
            @include('crud::inc.field_attributes')
        >
    </div>

    <div @include('crud::inc.field_wrapper_attributes') >
        <label>Description</label>
        <textarea name="seo[description]"
            @include('crud::inc.field_attributes')
        >{{ $seo->getTranslation('description', $locale) }}</textarea>
    </div>

    <div @include('crud::inc.field_wrapper_attributes') >
        <label>Keywords</label>
        <textarea name="seo[keywords]"
            @include('crud::inc.field_attributes')
        >{{ $seo->getTranslation('keywords', $locale) }}</textarea>
    </div>

@endisset


@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
    {{-- FIELD EXTRA CSS  --}}
    {{-- push things in the after_styles section --}}

    @push('crud_fields_styles')
        <!-- no styles -->
    @endpush


    {{-- FIELD EXTRA JS --}}
    {{-- push things in the after_scripts section --}}

    @push('crud_fields_scripts')
        <!-- no scripts -->
    @endpush
@endif

{{-- Note: most of the times you'll want to use @if ($crud->checkIfFieldIsFirstOfItsType($field, $fields)) to only load CSS/JS once, even though there are multiple instances of it. --}}
