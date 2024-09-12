<div class="row">
    <div class="col-sm-8 m-auto">
        <div class="card">
            <div class="card-body">
                <div class="card-header-2">
                    <h5>Submit profile for verification</h5>
                </div>

                <div class="theme-form theme-form-2 mega-form">
                    <form action="{{ route('vendor.submit-docs-for-verification') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <x-form-input type="file" name="store_image" label="Store Image" accept="image/*"></x-form-input>
                            </div>
                            <div class="col-md-12 mb-1">
                                <x-form-input type="file" name="documents" label="Upload Documents" multiple="true">
                                </x-form-input>
                            </div>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn w-100 theme-bg-color text-white">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>