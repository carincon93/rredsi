@forelse ($knowledgeAreas as $knowledgeArea)
    <div>
        <h4 class="p-2 text-center">Área de conocimiento: {{ $knowledgeArea->name }}</h4>
        <p class="p-2 text-gray-400">Sub-áreas de concimiento:</p>
        @forelse ($knowledgeArea->knowledgeSubareas as $knowledgeSubarea)
            <button type="button" class="accordion focus:outline-none bg-white hover:bg-gray-200">{{ $knowledgeSubarea->name }}</button>
            <div class="panel p-4">
            <p class="p-2 text-gray-400">Disciplinas de la sub-área de concimiento:</p>
            @forelse ($knowledgeSubarea->knowledgeSubareaDisciplines as $knowledgeSubareaDiscipline)
                <div class="mt-4 mb-4">
                    <input class="form-check-input" type="checkbox" name="knowledge_subarea_discipline_id[]" @if(is_array(old('knowledge_subarea_discipline_id')) && in_array($knowledgeSubareaDiscipline->id, old('knowledge_subarea_discipline_id'))) checked @else @if ($model) {{ $model->knowledgeSubareaDisciplines->pluck('id')->contains($knowledgeSubareaDiscipline->id) ? 'checked' : '' }} @endif @endif id="{{ "knowledge-subarea-discipline-$knowledgeSubareaDiscipline->id" }}" value="{{ $knowledgeSubareaDiscipline->id }}" />
                    <label label class="text-justify text-sm items-end text-gray-700" for="{{ "knowledge-subarea-discipline-$knowledgeSubareaDiscipline->id" }}">{{ $knowledgeSubareaDiscipline->name }}</label>
                </div>
                @empty
                    <p>{{ __('No data recorded') }}</p>
            @endforelse
            </div>
            @empty
                <p>{{ __('No data recorded') }}</p>
        @endforelse
    </div>
    <x-jet-section-border />
    @empty
        <p>{{ __('No data recorded') }}</p>
@endforelse

@once
    @push('scripts')
    <script>
        document.addEventListener(
            "DOMContentLoaded",
            function() {
                var acc = document.getElementsByClassName('accordion');
                var i;

                for (i = 0; i < acc.length; i++) {
                    acc[i].addEventListener('click', function() {
                    this.classList.toggle('active');
                    var panel = this.nextElementSibling;
                    if (panel.style.display === 'block') {
                        panel.style.display = 'none';
                    } else {
                        panel.style.display = 'block';
                    }
                    });
                }
            }, false
        )
    </script>
    @endpush
@endonce
