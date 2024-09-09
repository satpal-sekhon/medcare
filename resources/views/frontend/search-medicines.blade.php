@extends('layouts.frontend-layout')
@section('title', 'Search Medicines')

@section('content')
<section class="search-section">
    <div class="container-fluid-lg">
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search for medicines...">
            <button id="searchButton">Search</button>
        </div>

        <div class="alphabet-container" id="alphabetTabs">
            @foreach ($alphabets as $letter)
                <a href="{{ route('search-medicine.alphabet', strtolower($letter)) }}" @class(['active' => $alphabet == strtolower($letter)])>{{ $letter }}</a>
            @endforeach
        </div>

        <!-- Dropdown for mobile view -->
        <div class="resde">
            <select id="alphabetDropdown">
                @for ($i = 'A'; $i <= 'Z' ; $i++) 
                    <option value="?alphabet={{ $i }}" data-letter="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <!-- Section for search results -->
        <div id="searchResults" class="search-results">
            <button class="close-btn" id="closeSearchResults">×</button>
            <h2>Search Results</h2>
            <div id="resultsContainer"></div>
        </div>

        <!-- Medicines for $alphabet -->
        <div id="{{ $alphabet }}" class="medicine-list d-block">
            @if($products->count() > 0)
                @foreach ($products as $product)
                <a href="{{ route('products.view', $product->id) }}">
                    <h4 class="mb-2">
                        {{ $product->name }} 
                        @if ($product->composition)
                        <span class="composition">(Composition: {{ $product->composition }})</span>
                        @endif
                    </h4>
                </a>
                @endforeach
            @else
                <x-warning-message message="Products not found starting with {{ strtoupper($alphabet) }}"></x-warning-message>
            @endif

            {{ $products->links() }}
        </div>
    </div>
</section>

@push('scripts')
<script>
    $(document).ready(function() {
            // Function to open the selected tab
            function openTab(letter) {
                $('.medicine-list').hide();
                $('#alphabetTabs a').removeClass('active');
                $('#' + letter).show();
                $('a[data-letter="' + letter + '"]').addClass('active');
            }

            // Function to handle mobile tab switch
            $('#alphabetDropdown').change(function() {
                openTab($(this).val());
            });

            // Function to search for medicines
            $('#searchButton').click(function() {
                var input = $('#searchInput').val().toLowerCase();
                var resultsContainer = $('#resultsContainer');
                var searchResultsSection = $('#searchResults');
                resultsContainer.empty();
                searchResultsSection.hide();

                var found = false;

                $('.medicine-list').each(function() {
                    $(this).find('h2').each(function() {
                        var medicineName = $(this).text().toLowerCase();
                        if (medicineName.includes(input)) {
                            resultsContainer.append('<div>' + $(this).html() + '</div>');
                            found = true;
                        }
                    });
                });

                if (found) {
                    searchResultsSection.show();
                } else if (input) {
                    alert("No medicines found with the name: " + input);
                }
            });

            // Function to close search results
            $('#closeSearchResults').click(function() {
                $('#searchResults').hide();
            });

            // Function to auto-hide search results if input is empty
            $('#searchInput').on('input', function() {
                if ($(this).val().trim() === '') {
                    $('#searchResults').hide();
                }
            });

            // Function to update view based on screen size
            function updateView() {
                if ($(window).width() <= 768) {
                    $('#alphabetDropdown').show();
                    $('#alphabetTabs').hide();
                } else {
                    $('#alphabetDropdown').hide();
                    $('#alphabetTabs').show();
                }
            }

            // Update view on page load and resize
            updateView();
            $(window).resize(updateView);

            // Handle tab clicks
            $('#alphabetTabs a').click(function() {
                openTab($(this).data('letter'));
            });
        });
</script>
@endpush

@push('styles')
<style>
    /* Style for search button */
    .search-container {
        margin: 20px;
        text-align: center;
    }

    .search-container input[type="text"] {
        padding: 10px;
        font-size: 16px;
        width: 80%;
        max-width: 500px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .search-container button {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        background-color: #28a745;
        color: white;
        cursor: pointer;
        border-radius: 5px;
        margin-left: 10px;
    }

    .search-container button:hover {
        background-color: #218838;
    }

    /* Alphabet tabs */
    .alphabet-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 20px;
        background: #00cea7;
        border-radius: 5px;
        padding: 5px 0px;
    }

    .alphabet-container a {
        padding: 8px 10px;
        margin: 5px;
        cursor: pointer;
        background-color: #fff;
        color: #000;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
    }

    .alphabet-container a.active {
        background-color: #000;
        color: white;
    }

    /* Medicine list */
    .medicine-list {
        display: none;
        /* text-align: center; */
        margin: 20px;
    }

    .medicine-list h2 {
        font-size: 24px;
        margin: 10px 0;
    }

    .composition {
        font-size: 14px;
        font-style: italic;
        color: #00614e;

    }

    .search-results {
        margin: 20px;
        padding: 10px;
        border: 1px solid #ddd;
        background-color: #f9f9f9;
        display: none;
    }

    .search-results h2 {
        font-size: 22px;
        color: #333;
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        font-size: 18px;
        color: #333;
        background-color: #ddd;
        border: none;
        padding: 5px 10px;
        border-radius: 50%;
    }

    .close-btn:hover {
        background-color: #bbb;
    }

    /* Responsive for mobile view */
    @media (max-width: 768px) {
        .alphabet-container {
            display: none;
        }

        #alphabetDropdown {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px auto;
            font-size: 18px;
        }
    }
</style>
@endpush
@endsection