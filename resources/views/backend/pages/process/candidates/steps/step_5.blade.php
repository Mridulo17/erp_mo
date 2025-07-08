<div class="row">
<div class="form-group col-md-3">
    <label for="country_id" class="font-weight-bold text-dark" style="font-size: 14px;">Country</label>
    <select id="country_id" name="country_id" class="form-control select2">
        <option value="">--Select One--</option>
        @foreach ($countries as $id => $name)
            <option value="{{ $id }}" 
                {{ session('form.step_5.country_id') == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group col-md-3">
    <label for="division_id" class="font-weight-bold text-dark" style="font-size: 14px;">Division</label>
    <select id="division_id" name="division_id" class="form-control select2">
        <option value="">--Select One--</option>
        @foreach ($divisions as $id => $name)
            <option value="{{ $id }}" 
                {{ session('form.step_5.division_id') == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group col-md-3">
    <label for="district_id" class="font-weight-bold text-dark" style="font-size: 14px;">District</label>
    <select id="district_id" name="district_id" class="form-control select2">
        <option value="">--Select One--</option>
        @foreach ($districts as $id => $name)
            <option value="{{ $id }}" 
                {{ session('form.step_5.district_id') == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group col-md-3">
    <label for="thana_id" class="font-weight-bold text-dark" style="font-size: 14px;">Thana</label>
    <select id="thana_id" name="thana_id" class="form-control select2">
        <option value="">--Select One--</option>
        @foreach ($thanas as $id => $name)
            <option value="{{ $id }}" 
                {{ session('form.step_5.thana_id') == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group col-md-3">
    <label for="post_office_id" class="font-weight-bold text-dark" style="font-size: 14px;">Post Office</label>
    <select id="post_office_id" name="post_office_id" class="form-control select2">
        <option value="">--Select One--</option>
        @foreach ($postOffices as $id => $name)
            <option value="{{ $id }}" 
                {{ session('form.step_5.post_office_id') == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group col-md-3">
    <label for="state_id" class="font-weight-bold text-dark" style="font-size: 14px;">State</label>
    <select id="state_id" name="state_id" class="form-control select2">
        <option value="">--Select One--</option>
        @foreach ($states as $id => $name)
            <option value="{{ $id }}" 
                {{ session('form.step_5.state_id') == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group col-md-12">
    <label for="current_address" class="font-weight-bold text-dark" style="font-size: 14px;">Current Address</label>
    <textarea id="current_address" name="current_address" class="form-control" placeholder="Current Address" rows="2">{{ session('form.step_5.current_address') }}</textarea>
</div>

<div class="form-group col-md-12">
    <label for="permanent_address" class="font-weight-bold text-dark" style="font-size: 14px;">Permanent Address</label>
    <textarea id="permanent_address" name="permanent_address" class="form-control" placeholder="Permanent Address" rows="2">{{ session('form.step_5.permanent_address') }}</textarea>
</div>
</div>