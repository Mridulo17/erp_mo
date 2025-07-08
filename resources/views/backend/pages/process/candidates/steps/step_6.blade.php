<div class="row">
    <div class="form-group col-md-6">
        <label for="file_type" class="form-label">File Type <span class="text-danger">*</span></label>
        <select name="file_type" id="file_type" class="form-control select2" required>
            <option value="">-- Select File Type --</option>
            <option value="passport_copy">Passport Copy</option>
            <option value="photo">Photo</option>
            <option value="nid_copy">NID Copy</option>
            <!-- Add more types as needed -->
        </select>
    </div>
    
    <div class="form-group col-md-6">
        <label for="file_path" class="form-label">Upload File <span class="text-danger">*</span></label>
        <input type="file" name="file_path" id="file_path" class="form-control" required>
    </div>
</div>