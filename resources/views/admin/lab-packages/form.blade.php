<div class="mb-3">
    <label class="form-label-title mb-0">Package Name</label>
    <input type="text" name="name" placeholder="Package Name" value="{{ old('name', ($labPackage->name ?? '')) }}"
        @class(['form-control', 'is-invalid'=> $errors->first('name')]) maxlength="100">

    @if ($errors->has('name'))
    <span class="invalid-feedback">{{ $errors->first('name') }}</span>
    @endif
</div>

<div class="mb-3">
    <label class="form-label-title mb-0">Package Title</label>
    <input type="text" name="package_title" placeholder="Package Title"
        value="{{ old('package_title', ($labPackage->package_title ?? 'Package Includes')) }}"
        @class(['form-control', 'is-invalid'=> $errors->first('package_title')]) maxlength="100">

    @if ($errors->has('package_title'))
    <span class="invalid-feedback">{{ $errors->first('package_title') }}</span>
    @endif
</div>

<div class="mb-3">
    <label class="form-label-title col-sm-4 mb-0" for="tests">Include Tests</label>
    <select name="tests[]" id="tests" multiple @class(['form-control', 'is-invalid'=> $errors->first('tests')])>
        @foreach ($labTests as $labTest)
        @php
        $selectedTests = isset($labPackage)
        ? old('tests', $labPackage->labTests->pluck('id')->toArray() ?? [])
        : old('tests', []);
        @endphp

        <option value="{{ $labTest->id }}" @selected(in_array($labTest->id, $selectedTests))>{{ $labTest->name }}
        </option>
        @endforeach
    </select>

    @if ($errors->has('tests'))
    <span class="invalid-feedback">{{ $errors->first('tests') }}</span>
    @endif
</div>

<div class="mb-3">
    <label class="form-label-title">Image</label>
    <div class="form-group">
        <input type="file" name="image" accept="image/*" @class(['form-control', 'is-invalid'=>
        $errors->first('image')])>

        @if ($errors->has('image'))
        <div class="invalid-feedback">{{ $errors->first('image') }}</span>
            @endif
        </div>

        @if ($labPackage->image ?? '')
        <img src="{{ asset($labPackage->image) }}" alt="" style="width: 100px; height: auto;">
        @endif
    </div>
</div>

<div class="mb-3">
    <label class="form-label-title mb-0">Amount</label>
    <input type="number" name="amount" placeholder="Enter amount" value="{{ old('fee', ($labPackage->amount ?? '')) }}"
        @class(['form-control', 'is-invalid'=> $errors->first('amount')]) step="0.01">

    @if ($errors->has('amount'))
    <div class="invalid-feedback d-block`">{{ $errors->first('amount') }}</div>
    @endif
</div>

<div class="mb-3">
    <label class="form-label-title mb-0">Description</label>
    <textarea name="description" placeholder="Enter Description" @class([ 'form-control'
        , 'is-invalid'=> $errors->first('description')])>{{ old('description', ($labPackage->description ?? '')) }}</textarea>

    @if ($errors->has('description'))
    <span class="invalid-feedback">{{ $errors->first('description') }}</span>
    @endif
</div>

<div class="mb-3">
    <button type="submit" class="btn w-100 theme-bg-color text-white">Save</button>
</div>

<x-include-plugins :plugins="['chosen']"></x-include-plugins>


@push('scripts')
<script>
    $(function(){
        $('#tests').chosen({
            width: '100%',
            placeholder_text_multiple: 'Include tests'
        });
    })
</script>
@endpush