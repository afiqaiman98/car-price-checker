@extends('layout.app')
@section('title', 'Extra')
<style>
    .custom-btn {
    background-color: #DE012F !important;
    border-color: #DE012F !important;
}
</style>

@section('content')
<body>
    <div class="container mt-5">
        <h1 class="text-center">Car Price Range Filter</h1>
        <div class="text-center">
            <button type="button" class="btn btn-primary custom-btn" data-toggle="modal" data-target="#priceRangeModal">
                Filter by Price Range
            </button>
        </div>

        <!-- Modal for Price Range Filter -->
        <div class="modal fade" id="priceRangeModal" tabindex="-1" role="dialog" aria-labelledby="priceRangeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="priceRangeModalLabel">Filter by Price Range</h5>
                        <button type="button" class=".custom-btn close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="priceRangeForm">
                            <div class="form-group">
                                <label for="price_min">Price Min (RM):</label>
                                <input type="number" id="price_min" class="form-control" placeholder="Enter minimum price">
                            </div>
                            <div class="form-group">
                                <label for="price_max">Price Max (RM):</label>
                                <input type="number" id="price_max" class="form-control" placeholder="Enter maximum price">
                            </div>
                            <button type="submit" class=".custom-btn btn btn-primary btn-block">Filter by Price Range</button>
                        </form>
                        
                        <div class="text-center mt-3" id="makeFilterButtonSection" style="display: none;">
                            <button type="button" class=".custom-btn btn btn-secondary" id="showMakeFilterButton">Filter by Make</button>
                        </div>
                        <div class="form-group mt-3" id="makeDropdownSection" style="display: none;">
                            <label for="makeSelect">Make:</label>
                            <select class="form-control" id="makeSelect">
                                <option value="">Select Make</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                            <button type="button" class=".custom-btn btn btn-primary mt-2" id="applyMakeFilterButton">Apply Make Filter</button>
                        </div>

                        <div class="text-center mt-3" id="yearFilterButtonSection" style="display: none;">
                            <button type="button" class=".custom-btn btn btn-secondary" id="showYearFilterButton">Filter by Year</button>
                        </div>
                        <div class="form-group mt-3" id="yearDropdownSection" style="display: none;">
                            <label for="yearSelect">Year:</label>
                            <select class="form-control" id="yearSelect">
                                <option value="">Select Year</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                            <button type="button" class=".custom-btn btn btn-primary mt-2" id="applyYearFilterButton">Apply Year Filter</button>
                        </div>

                        <div class="text-center mt-3" id="modelFilterButtonSection" style="display: none;">
                            <button type="button" class=".custom-btn btn btn-secondary" id="showModelFilterButton">Filter by Model</button>
                        </div>
                        <div class="form-group mt-3" id="modelDropdownSection" style="display: none;">
                            <label for="modelSelect">Model:</label>
                            <select class="form-control" id="modelSelect">
                                <option value="">Select Model</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                            <button type="button" class=".custom-btn btn btn-primary mt-2" id="applyModelFilterButton">Apply Model Filter</button>
                        </div>

                        <div class="text-center mt-3" id="variantFilterButtonSection" style="display: none;">
                            <button type="button" class=".custom-btn btn btn-secondary" id="showVariantFilterButton">Filter by Variant</button>
                        </div>
                        <div class="form-group mt-3" id="variantDropdownSection" style="display: none;">
                            <label for="variantSelect">Variant:</label>
                            <select class="form-control" id="variantSelect">
                                <option value="">Select Variant</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                            <button type="button" class=".custom-btn btn btn-primary mt-2" id="applyVariantFilterButton">Apply Variant Filter</button>
                        </div>

                        <div class="text-center mt-3">
                            <button type="button" class=".custom-btn btn btn-danger" id="resetFiltersButton">Reset Filters</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h2 class="text-center">Filtered Cars</h2>
            <p id="no-cars-message" class="text-center">Please filter by price range to show cars.</p>
            <div class="table-responsive">
                <table class="table table-bordered" id="car-table" style="display: none;">
                    <thead>
                        <tr>
                            <th>Make</th>
                            <th>Year</th>
                            <th>Model</th>
                            <th>Variant</th>
                            <th>Price (RM)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Car data will be appended here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var filteredCars = [];
            var filteredCarsByMake = [];
            var filteredCarsByYear = [];
            var filteredCarsByModel = [];

            // Handle form submission for price range filter
            $('#priceRangeForm').submit(function(event) {
                event.preventDefault();
                var minPrice = $('#price_min').val();
                var maxPrice = $('#price_max').val();
                if (minPrice && maxPrice) {
                    fetchCarsByPriceRange(minPrice, maxPrice);
                } else {
                    alert("Please enter both minimum and maximum prices.");
                }
            });

            // Function to fetch cars by price range
            function fetchCarsByPriceRange(minPrice, maxPrice) {
                $.get("/api/cars/filter?price_min=" + minPrice + "&price_max=" + maxPrice, function(data) {
                    filteredCars = data;
                    displayCars(filteredCars);
                    populateMakeDropdown(filteredCars);
                    $('#makeFilterButtonSection').show();
                });
            }

            // Function to display cars in table
            function displayCars(cars) {
                var tableBody = $('#car-table tbody');
                tableBody.empty();
                if (cars.length > 0) {
                    $.each(cars, function(index, car) {
                        var row = '<tr>' +
                            '<td>' + car.make + '</td>' +
                            '<td>' + car.year + '</td>' +
                            '<td>' + car.model + '</td>' +
                            '<td>' + car.variant + '</td>' +
                            '<td>' + 'RM ' + car.price + '</td>' +
                            '</tr>';
                        tableBody.append(row);
                    });
                    $('#no-cars-message').hide();
                    $('#car-table').show();
                } else {
                    $('#no-cars-message').text("No cars found within the specified price range.");
                    $('#no-cars-message').show();
                    $('#car-table').hide();
                }
            }

            // Function to populate make dropdown
            function populateMakeDropdown(cars) {
                var makes = [...new Set(cars.map(car => car.make))];
                var makeSelect = $('#makeSelect');
                makeSelect.empty();
                makeSelect.append('<option value="">Select Make</option>');
                $.each(makes, function(index, make) {
                    makeSelect.append('<option value="' + make + '">' + make + '</option>');
                });
            }

            // Handle show make filter button click
            $('#showMakeFilterButton').click(function() {
                $('#showMakeFilterButton').hide();
                $('#makeDropdownSection').show();
            });

            // Handle apply make filter button click
            $('#applyMakeFilterButton').click(function() {
                var selectedMake = $('#makeSelect').val();
                if (selectedMake) {
                    filteredCarsByMake = filteredCars.filter(car => car.make === selectedMake);
                    displayCars(filteredCarsByMake);
                    populateYearDropdown(filteredCarsByMake);
                    $('#yearFilterButtonSection').show();
                } else {
                    displayCars(filteredCars);
                }
            });

            // Function to populate year dropdown
            function populateYearDropdown(cars) {
                var years = [...new Set(cars.map(car => car.year))];
                var yearSelect = $('#yearSelect');
                yearSelect.empty();
                yearSelect.append('<option value="">Select Year</option>');
                $.each(years, function(index, year) {
                    yearSelect.append('<option value="' + year + '">' + year + '</option>');
                });
            }

            // Handle show year filter button click
            $('#showYearFilterButton').click(function() {
                $('#showYearFilterButton').hide();
                $('#yearDropdownSection').show();
            });

            // Handle apply year filter button click
            $('#applyYearFilterButton').click(function() {
                var selectedYear = $('#yearSelect').val();
                if (selectedYear) {
                    filteredCarsByYear = filteredCarsByMake.filter(car => car.year == selectedYear);
                    displayCars(filteredCarsByYear);
                    populateModelDropdown(filteredCarsByYear);
                    $('#modelFilterButtonSection').show();
                } else {
                    displayCars(filteredCarsByMake);
                }
            });

            // Function to populate model dropdown
            function populateModelDropdown(cars) {
                var models = [...new Set(cars.map(car => car.model))];
                var modelSelect = $('#modelSelect');
                modelSelect.empty();
                modelSelect.append('<option value="">Select Model</option>');
                $.each(models, function(index, model) {
                    modelSelect.append('<option value="' + model + '">' + model + '</option>');
                });
            }

            // Handle show model filter button click
            $('#showModelFilterButton').click(function() {
                $('#showModelFilterButton').hide();
                $('#modelDropdownSection').show();
            });

            // Handle apply model filter button click
            $('#applyModelFilterButton').click(function() {
                var selectedModel = $('#modelSelect').val();
                if (selectedModel) {
                    filteredCarsByModel = filteredCarsByYear.filter(car => car.model === selectedModel);
                    displayCars(filteredCarsByModel);
                    populateVariantDropdown(filteredCarsByModel);
                    $('#variantFilterButtonSection').show();
                } else {
                    displayCars(filteredCarsByYear);
                }
            });

            // Function to populate variant dropdown
            function populateVariantDropdown(cars) {
                var variants = [...new Set(cars.map(car => car.variant))];
                var variantSelect = $('#variantSelect');
                variantSelect.empty();
                variantSelect.append('<option value="">Select Variant</option>');
                $.each(variants, function(index, variant) {
                    variantSelect.append('<option value="' + variant + '">' + variant + '</option>');
                });
            }

            // Handle show variant filter button click
            $('#showVariantFilterButton').click(function() {
                $('#showVariantFilterButton').hide();
                $('#variantDropdownSection').show();
            });

            // Handle apply variant filter button click
            $('#applyVariantFilterButton').click(function() {
                var selectedVariant = $('#variantSelect').val();
                if (selectedVariant) {
                    var filteredCarsByVariant = filteredCarsByModel.filter(car => car.variant === selectedVariant);
                    displayCars(filteredCarsByVariant);
                } else {
                    displayCars(filteredCarsByModel);
                }
            });

            // Handle reset filters button click
            $('#resetFiltersButton').click(function() {
                $('#price_min').val('');
                $('#price_max').val('');
                $('#makeSelect').empty().append('<option value="">Select Make</option>');
                $('#yearSelect').empty().append('<option value="">Select Year</option>');
                $('#modelSelect').empty().append('<option value="">Select Model</option>');
                $('#variantSelect').empty().append('<option value="">Select Variant</option>');
                $('#makeDropdownSection, #yearDropdownSection, #modelDropdownSection, #variantDropdownSection').hide();
                $('#makeFilterButtonSection, #yearFilterButtonSection, #modelFilterButtonSection, #variantFilterButtonSection').hide();
                $('#showMakeFilterButton').show();
                $('#car-table').hide();
                $('#no-cars-message').show().text('Please filter by price range to show cars.');
            });
        });
    </script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
@endsection
