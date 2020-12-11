@foreach ($knowledgeAreas as $knowledgeArea)
    <div>
        <p class="p-2">Área de conocimiento: {{ $knowledgeArea->name }}</p>
        <p class="p-2 text-gray-400">Sub-áreas de concimiento:</p>
        @foreach ($knowledgeArea->knowledgeSubareas as $knowledgeSubarea)
            <button type="button" class="accordion focus:outline-none bg-white hover:bg-gray-200">{{ $knowledgeSubarea->name }}</button>
            <div class="panel p-4">
            <p class="p-2 text-gray-400">Disciplinas de la sub-área de concimiento:</p>
            @foreach ($knowledgeSubarea->knowledgeSubareaDisciplines as $knowledgeSubareaDiscipline)
                <div class="mt-4 mb-4">
                    <input class="form-check-input" type="checkbox" name="knowledge_subarea_discipline_id[]" @if(is_array(old('knowledge_subarea_discipline_id')) && in_array($knowledgeSubareaDiscipline->id, old('knowledge_subarea_discipline_id'))) checked @else @if ($model) {{ $model->knowledgeSubareaDisciplines->pluck('id')->contains($knowledgeSubareaDiscipline->id) ? 'checked' : '' }} @endif @endif id="{{ "knowledge-subarea-discipline-$knowledgeSubareaDiscipline->id" }}" value="{{ $knowledgeSubareaDiscipline->id }}" />
                    <label label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="{{ "knowledge-subarea-discipline-$knowledgeSubareaDiscipline->id" }}">{{ $knowledgeSubareaDiscipline->name }}</label>
                </div>
            @endforeach
            </div>
        @endforeach
    </div>
    <x-jet-section-border />
@endforeach

@once                    
    @push('scripts')
    <script>
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
    </script>
    @endpush
@endonce