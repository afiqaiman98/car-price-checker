@extends('layout.app')
@section('title', 'Car Price Checker')
{{-- <style>
    .button{
        background-color: #DE012F;
        color: white;
        border-radius: 20px;
    }
</style> --}}


@section('content')
<body>
    <div class="container mt-5">
        <h2>Car Price Checker</h2>
        <div class="form-group">
            <label for="make">Make:</label>
            <select class="form-control" id="make">
                <option value="">Select Make</option>
            </select>
        </div>
        <div class="form-group">
            <label for="year">Year:</label>
            <select class="form-control" id="year" disabled>
                <option value="">Select Year</option>
            </select>
        </div>
        <div class="form-group">
            <label for="model">Model:</label>
            <select class="form-control" id="model" disabled>
                <option value="">Select Model</option>
            </select>
        </div>
        <div class="form-group">
            <label for="variant">Variant:</label>
            <select class="form-control" id="variant" disabled>
                <option value="">Select Variant</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">RM</div>
                </div>
                <input type="text" class="form-control" id="price" readonly>
            </div>
        </div>
        <button style="background-color: #DE012F"  type="button" id="reset" class="btn btn-secondary">Reset</button>
    </div>

    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Populate Make dropdown
            $.get("/api/cars/makes", function(data) {
                $.each(data, function(index, item) {
                    $('#make').append('<option value="' + item.make + '">' + item.make + '</option>');
                });
            });

            // Handle Make selection
            $('#make').change(function() {
                var make = $(this).val();
                if (make !== '') {
                    // Enable Year dropdown
                    $('#year').prop('disabled', false).html('<option value="">Loading...</option>');
                    // Fetch Years for selected Make
                    $.get("/api/cars/years?make=" + make, function(data) {
                        $('#year').html('<option value="">Select Year</option>');
                        $.each(data, function(index, item) {
                            $('#year').append('<option value="' + item.year + '">' + item.year + '</option>');
                        });
                        // Disable Model, Variant and Price
                        $('#model').prop('disabled', true).html('<option value="">Select Model</option>');
                        $('#variant').prop('disabled', true).html('<option value="">Select Variant</option>');
                        $('#price').val('');
                    });
                } else {
                    // Disable Year, Model, Variant and Price if Make is not selected
                    $('#year').prop('disabled', true).html('<option value="">Select Year</option>');
                    $('#model').prop('disabled', true).html('<option value="">Select Model</option>');
                    $('#variant').prop('disabled', true).html('<option value="">Select Variant</option>');
                    $('#price').val('');
                }
            });

            // Handle Year selection
            $('#year').change(function() {
                var make = $('#make').val();
                var year = $(this).val();
                if (year !== '') {
                    // Enable Model dropdown
                    $('#model').prop('disabled', false).html('<option value="">Loading...</option>');
                    // Fetch Models for selected Make and Year
                    $.get("/api/cars/models?make=" + make + "&year=" + year, function(data) {
                        $('#model').html('<option value="">Select Model</option>');
                        $.each(data, function(index, item) {
                            $('#model').append('<option value="' + item.model + '">' + item.model + '</option>');
                        });
                        // Disable Variant and Price
                        $('#variant').prop('disabled', true).html('<option value="">Select Variant</option>');
                        $('#price').val('');
                    });
                } else {
                    // Disable Model, Variant and Price if Year is not selected
                    $('#model').prop('disabled', true).html('<option value="">Select Model</option>');
                    $('#variant').prop('disabled', true).html('<option value="">Select Variant</option>');
                    $('#price').val('');
                }
            });

            // Handle Model selection
            $('#model').change(function() {
                var make = $('#make').val();
                var year = $('#year').val();
                var model = $(this).val();
                if (model !== '') {
                    // Enable Variant dropdown
                    $('#variant').prop('disabled', false).html('<option value="">Loading...</option>');
                    // Fetch Variants for selected Make, Year, and Model
                    $.get("/api/cars/variants?make=" + make + "&year=" + year + "&model=" + model, function(data) {
                        $('#variant').html('<option value="">Select Variant</option>');
                        $.each(data, function(index, item) {
                            $('#variant').append('<option value="' + item.variant + '">' + item.variant + '</option>');
                        });
                        // Clear Price
                        $('#price').val('');
                    });
                } else {
                    // Disable Variant and Price if Model is not selected
                    $('#variant').prop('disabled', true).html('<option value="">Select Variant</option>');
                    $('#price').val('');
                }
            });

            // Handle Variant selection
            $('#variant').change(function() {
                var make = $('#make').val();
                var year = $('#year').val();
                var model = $('#model').val();
                var variant = $(this).val();
                if (variant !== '') {
                    // Fetch Price for selected Make, Year, Model, and Variant
                    $.get("/api/cars/price?make=" + make + "&year=" + year + "&model=" + model + "&variant=" + variant, function(data) {
                        $('#price').val(data.price);
                    });
                } else {
                    $('#price').val('');
                }
            });

            $('#reset').click(function() {
                $('#make').val('');
                $('#year').prop('disabled', true).html('<option value="">Select Year</option>');
                $('#model').prop('disabled', true).html('<option value="">Select Model</option>');
                $('#variant').prop('disabled', true).html('<option value="">Select Variant</option>');
                $('#price').val('');
            });
        });
    </script>
</body>
@endsection


