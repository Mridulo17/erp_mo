<div class="mb-3">
    <h5>Review Your Information</h5>
    <ul class="list-group">
        @for ($i = 1; $i <= 6; $i++)
            @foreach(session("form.step_$i", []) as $key => $value)
                <li class="list-group-item">
                    <strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}
                </li>
            @endforeach
        @endfor
    </ul>
    
    <div class="form-group mt-4">
        <div class="form-check" style="padding-left: 0;">
            <input class="form-check-input" type="checkbox" id="confirmInfoCheckbox">
            <label class="form-check-label" for="confirmInfoCheckbox">
                I've confirmed that all the information I filled in is correct!
            </label>
        </div>
    </div>
</div>