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
            <a href="javascript:void(0)" data-letter="a" class="active">A</a>
            <a href="javascript:void(0)" data-letter="b">B</a>
            <a href="javascript:void(0)" data-letter="c">C</a>
            <!-- Add more letters as needed -->
            <a href="javascript:void(0)" data-letter="z">Z</a>
        </div>

        <!-- Dropdown for mobile view -->
        <div class="resde">
            <select id="alphabetDropdown">
                <option value="a">A</option>
                <option value="b">B</option>
                <option value="c">C</option>
                <!-- Add more options as needed -->
                <option value="z">Z</option>
            </select>
        </div>

        <!-- Section for search results -->
        <div id="searchResults" class="search-results">
            <button class="close-btn" id="closeSearchResults">×</button>
            <h2>Search Results</h2>
            <div id="resultsContainer"></div>
        </div>

        <!-- Medicines for A -->
        <div id="a" class="medicine-list" style="display: block;">
            <h2>Amlodipine <span class="composition">(Composition: Amlodipine besylate 5mg, Excipients q.s.)</span></h2>
            <h2>Aspirin <span class="composition">(Composition: Acetylsalicylic acid 75mg, Microcrystalline cellulose q.s.)</span></h2>
            <!-- Add more medicines as needed -->
        </div>

        <!-- Medicines for B -->
        <div id="b" class="medicine-list">
            <h2>Bisoprolol <span class="composition">(Composition: Bisoprolol fumarate 5mg, Magnesium stearate q.s.)</span></h2>
            <h2>Betamethasone <span class="composition">(Composition: Betamethasone valerate 0.1%, White soft paraffin q.s.)</span></h2>
            <!-- Add more medicines as needed -->
        </div>

        <!-- Medicines for C -->
        <div id="c" class="medicine-list">
            <h2>Ciprofloxacin <span class="composition">(Composition: Ciprofloxacin hydrochloride 500mg, Excipients q.s.)</span></h2>
            <h2>Cetirizine <span class="composition">(Composition: Cetirizine dihydrochloride 10mg, Lactose monohydrate q.s.)</span></h2>
            <!-- Add more medicines as needed -->
        </div>

        <!-- Add more sections for other letters -->
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
        color:white;
    }

    /* Medicine list */
    .medicine-list {
        display: none;
        text-align: center;
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