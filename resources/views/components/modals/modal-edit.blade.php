@props([
    'modalId',
    'title' => 'Ubah Data',
    'formAction' => '#',
    'method' => 'PUT',
    'data' => [],
    'fields' => [],
])

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ $formAction }}" method="POST">
                @csrf
                @method($method)

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

                            @if(($field['type'] ?? 'text') === 'select')
                                <select name="{{ $field['name'] }}" class="form-control" required>
                                    <option value="">-- Pilih {{ $field['label'] }} --</option>
                                    @foreach($field['options'] as $value => $label)
                                        <option value="{{ $value }}" {{ $data[$field['name']] == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>

                            @elseif(($field['type'] ?? 'text') === 'textarea')
                                <textarea name="{{ $field['name'] }}" class="form-control" rows="3" {{ $field['required'] ?? true ? 'required' : '' }}>
                                    {{ $data[$field['name']] ?? '' }}
                                </textarea>

                            @else
                                <input type="{{ $field['type'] ?? 'text' }}"
                                       name="{{ $field['name'] }}"
                                       class="form-control"
                                       placeholder="{{ $field['placeholder'] ?? '' }}"
                                       value="{{ $data[$field['name']] ?? '' }}"
                                       min="{{ $field['min'] ?? '' }}"
                                       {{ $field['required'] ?? true ? 'required' : '' }}>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! $iconBatal !!} Batal</button>
                    <button type="submit" class="btn btn-primary">{!! $iconTombolSimpan !!} Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
