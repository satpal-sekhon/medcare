<div class="row justify-content-center align-items-center">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-body text-center">
                <div>
                    <h3 class="text-info"><i class="fa fa-clock text-info"></i> We are reviewing your profile!</h3>
                    <h4 class="mt-3"><i class="fa fa-hourglass-half text-warning"></i> We will notify you when your account has been verified.</h4>
                    <p class="mt-4">Thank you for your patience while we complete the review process. If you have any questions, feel free to reach out to us.</p>
                    <a href="#" id="view-submitted-records">Click here to view submitted records</a>
                </div>

                <div class="submitted-docs d-none">
                    <div class="d-block">
                        <label for="storeImage" class="w-100 fw-bold">Store Image</label>
                        @if (auth()->user()->vendor->image)
                            <img src="{{ asset(auth()->user()->vendor->image) }}" alt="" style="width: 100px; height: auto;">
                        @endif
                    </div>

                    @if(count(auth()->user()->vendor->assets) > 0)
                        <div class="d-block">
                            <label for="storeImage" class="w-100 fw-bold">Submitted documents</label>
                                @foreach (auth()->user()->vendor->assets as $key => $asset)
                                <div class="d-flex justify-content-between">
                                    <div class="document-name">
                                        <a href="{{ asset($asset->path) }}" target="_blank">Document {{ ++$key }}</a>
                                    </div>
                                    <div class="document-action">
                                        <label>
                                            <input type="checkbox" name="delete_documents[]" value="{{ $asset->id }}"> Delete
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 text-center">
                            <a href="{{ route('vendor.resubmit-docs') }}" class="btn btn-primary d-flex align-items-center justify-content-center w-100">
                                <i class="fas fa-file-alt me-2"></i>
                                Resubmit documents
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        $(function(){
            $('#view-submitted-records').click(function(){
                $(this).addClass('d-none')
                $('.submitted-docs').removeClass('d-none');
            });
        })
    </script>
@endpush