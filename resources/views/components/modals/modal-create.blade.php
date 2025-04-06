@props([
    'modalId',
    'title' => 'Tambah Data',
    'formAction' => '#',
    'fields' => [],
])

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ $formAction }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ $modalId }}Label">{{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @foreach($fields as $field)
                        <div class="form-group">
                            <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>

                            @if(isset($field['type']) && $field['type'] === 'select')
                                <select name="{{ $field['name'] }}" class="form-control" required>
                                    <option value="">-- Pilih {{ $field['label'] }} --</option>
                                    @foreach($field['options'] as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            @elseif(isset($field['type']) && $field['type'] === 'textarea')
                                <textarea name="{{ $field['name'] }}" class="form-control" rows="3" {{ $field['required'] ?? true ? 'required' : '' }}>{{ $field['value'] ?? '' }}</textarea>
                            @else
                                <input type="{{ $field['type'] ?? 'text' }}"
                                       name="{{ $field['name'] }}"
                                       class="form-control"
                                       placeholder="{{ $field['placeholder'] ?? '' }}"
                                       value="{{ $field['value'] ?? '' }}"
                                       min="{{ $field['min'] ?? '' }}"
                                       {{ $field['required'] ?? true ? 'required' : '' }}>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! $iconBatal !!} Batal</button>
                    <button type="submit" class="btn btn-primary">{!! $iconTombolSimpan !!} Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
